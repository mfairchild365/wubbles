<?php
class Wub_Controller
{
    /**
     * Options array
     * Will include $_GET vars
     */
    public $options = array(
        'view'   => 'home',
        'format' => 'html'
    );

    static $pagetitle = null;
    
    protected static $auth;

    /**
     * The currently logged in user.
     *
     * @var Wub_Account
     */
    protected static $user = false;

    public static $url = '';
    
    public static $uploadDir = '';
    
    public static $uploadURL = '';

    public static $admins = array('admin');

    protected static $db_settings = array(
        'host'     => 'localhost',
        'user'     => 'wub',
        'password' => 'wub',
        'dbname'   => 'wub'
    );
    
    public static $emailAddress = "";
    
    public static  $webmasterEmail = "";
    
    public static $analytics = "";
    
    public static $captcha_publicKey = "";
    
    public static $captcha_privateKey = "";
    
    public static $share = "";
    
    public static $footerAd = "";
    
    public static $example_id = NULL;
    
    public $actionable = array();

    function __construct($options = array())
    {
        $this->options = $options + $this->options;
        
        try {
            
            if (!empty($_POST)) {
                $this->handlePost();
            }
            
            //handle GET actions specific to classes.
            if (isset($options['action'])) {
                $this->handleAction();
            }
            
            $this->run();
        } catch(Exception $e) {
            if (isset($this->options['ajaxupload'])) {
                echo $e->getMessage();
                exit();
            }

            if (false == headers_sent()
                && $code = $e->getCode()) {
                header('HTTP/1.1 '.$code.' '.$e->getMessage());
                header('Status: '.$code.' '.$e->getMessage());
            }

            $this->actionable = $e;
        }
    }
    
    /**
     * get the currently logged in user
     *
     * @return Wub_Account
     */
    public static function getAccount()
    {
        if (isset($_SESSION['account_id'])) {
            return Wub_Account::getByID($_SESSION['account_id']);
        }
        
        return false;
    }
    
    /**
     * Require login.  Redirects to login page if not logged in.
     *
     * @return true
     */
    public static function requireLogin() {
        if (!isset($_SESSION['account_id'])) {
            self::redirect(self::$url.'login');
        }
        return true;
    }
    
    /**
     * Check if the user is a site admin or not.
     *
     * @param string $uid The uid to check
     * 
     * @return bool
     */
    public static function isAdmin($id)
    {
        if (in_array((string)$id, self::$admins)) {
            return true;
        }

        return false;
    }

    public static function setDbSettings($settings = array())
    {
        self::$db_settings = $settings + self::$db_settings;
    }

    public static function getDbSettings()
    {
        return self::$db_settings;
    }

    /**
     * Handle data that is POST'ed to the controller.
     *
     * @return void
     */
    function handlePost()
    {
        $this->filterPostValues();
        
        if (!isset($_POST['_class'])) {
            // Nothing to do here
            return;
        }
        
        $class = new $_POST['_class']($this->options);
        
        if (isset($_POST['action']) && $_POST['action'] == 'delete') {
            $class->handleDelete($_POST);
        } else {
            $class->handlePost($_POST);
        }
    }
    
    /**
     * Handle GET actions specific to classes.
     *
     * @return void
     */
    function handleAction()
    {
        if (isset($this->options['model'])) {
            $class = new $this->options['model']($this->options);
        } else {
            throw new Exception('Un-registered view');
        }
        $class->handleAction($this->options);
    }
    
    /**
     * Filter any pre-populated POST fields to prevent their use.
     *
     * @return void
     */
    function filterPostValues()
    {
        unset($_POST['uid']);
    }

    /**
     * Get the main URL for this instance or an individual object
     *
     * @param mixed $mixed             An object to retrieve the URL to
     * @param array $additional_params Querystring params to add
     * 
     * @return string
     */
    public static function getURL($mixed = null, $additional_params = array())
    {
         
        $url = self::$url;
        
        if (is_object($mixed)) {
            switch (get_class($mixed)) {
            default:
                    
            }
        }
        
        return self::addURLParams($url, $additional_params);
    }

    /**
     * Add unique querystring parameters to a URL
     * 
     * @param string $url               The URL
     * @param array  $additional_params Additional querystring parameters to add
     * 
     * @return string
     */
    public static function addURLParams($url, $additional_params = array())
    {
        $params = array();
        if (strpos($url, '?') !== false) {
            list($url, $existing_params) = explode('?', $url);
            $existing_params = explode('&amp;', $existing_params);
            foreach ($existing_params as $val) {
                list($var, $val) = explode('=', $val);
                $params[$var] = $val;
            }
        }

        $params = array_merge($params, $additional_params);

        $url .= '?';
        
        foreach ($params as $option=>$value) {
            if ($option == 'driver') {
                continue;
            }
            if ($option == 'format'
                && $value = 'html') {
                continue;
            }
            if (!empty($value)) {
                $url .= "&amp;$option=$value";
            }
        }
        $url = str_replace('?&amp;', '?', $url);
        return trim($url, '?;=');
    }

    /**
     * Populate the actionable items according to the view map.
     *
     * @throws Exception if view is unregistered
     */
    function run()
    {
        if (!isset($this->options['model'])) {
             throw new Exception('Un-registered view', 404);
         }
         $this->actionable = new $this->options['model']($this->options);
    }

    /**
     * Set the public properties for an object with the values in an associative array
     *
     * @param mixed &$object The object to set, usually a Wub_Record
     * @param array $values  Associtive array of key=>value
     * @throws Exception
     *
     * @return void
     */
    public static function setObjectFromArray(&$object, $values)
    {
        if (!isset($object)) {
            throw new Exception('No object passed!', 400);
        }
        foreach (get_object_vars($object) as $key=>$default_value) {
            if (isset($values[$key]) && !empty($values[$key])) {
                $object->$key = $values[$key];
            }
        }
    }

    /**
     * Connect to the database and return it
     *
     * @return mysqli
     */
    public static function getDB()
    {
        static $db = false;
        if (!$db) {
            $settings = self::getDbSettings();
            $db = new mysqli($settings['host'], $settings['user'], $settings['password'], $settings['dbname']);
            if (mysqli_connect_error()) {
                throw new Exception('Database connection error (' . mysqli_connect_errno() . ') '
                        . mysqli_connect_error());
            }
            $db->set_charset('utf8');
        }
        return $db;
    }

    static function setReplacementData($field, $data)
    {
        switch($field) {
            case 'pagetitle':
                self::$pagetitle['dynamic'] = $data;
                break;
        }
    }

    public function postRun($data)
    {
        if (isset(self::$pagetitle['dynamic'])) {
            $data = str_replace('<title>Tsa </title>',
                                '<title>Tsa| '.self::$pagetitle['dynamic'].'</title>',
                                $data);
        }
        return $data;
    }

    static function redirect($url, $exit = true)
    {
        header('Location: '.$url);
        if (false !== $exit) {
            exit($exit);
        }
    }
}
