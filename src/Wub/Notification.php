<?php
class Wub_Notification extends Wub_Record implements Wub_Permissionable
{
    public $id;
    
    public $reference_class;
    
    public $reference_id;
    
    public $to_id;
    
    public $read;
    
    public $date_created;
    
    public $save_type;
    
    function __construct($options = array())
    {
        //Check to see if we are editing this bro.
        if (isset($options['model']) && get_called_class() != $options['model']) {
            //We are not viewing this model, return.
            return;
        }
        
        //An Id was not passed, so we are just making a new one.
        if (!isset($options['id'])) {
            return;
        }
        
        if (!$class = $this->getByID($options['id'])) {
            throw new Exception("Could not find that");
        }
        
        $this->synchronizeWithArray($class->toArray());
    }

    function insert()
    {
        return parent::insert();
    }
    
    function keys()
    {
        return array('id');
    }
    
    public static function getTable()
    {
        return 'notifications';
    }
    
    public static function getByID($id)
    {
        return self::getByAnyField('Wub_Notification', 'id', (int)$id);
    }
    
    function getName()
    {
        return 'Notification';
    }
    
    public function getURL()
    {
        if (isset($this->id)) {
            return Wub_Controller::$url . "notification/" . $this->id;
        }
        return false;
    }
    
    function canEdit()
    {
        return false;
    }
    
    function canView()
    {
        return false;
    }
    
    private function createNotification($referenceClass, $referenceID, $saveType, $toID) {
        $notification = new Wub_Notification();
        $notification->reference_class = $referenceClass;
        $notification->reference_id    = $referenceID;
        $notification->save_type     = $saveType;
        $notification->to_id           = $toID;
        $notification->date_created    = time();
        $notification->read            = 0;
        
        $notification->save();
    }
    
    static function createNotifications($referenceClass, $referenceID, $saveType)
    {
        $class = call_user_func($referenceClass. "::getByID", $referenceID);
        foreach($class->getNotifyMembersList() as $member) {
            if (Wub_Controller::getAccount() && Wub_Controller::getAccount()->id !== $member->id) {
                self::createNotification($referenceClass, $referenceID, $saveType, $member->id);
            }
        }
    }
    
    public function getReference()
    {
        return call_user_func($this->reference_class . "::getByID", $this->reference_id);
    }
    
    public function canDelete()
    {
        if (!$account = Wub_Controller::getAccount()) {
            return false;
        }
        
        if ($account->isAdmin()) {
            return true;
        }
        
        if ($account->id == $this->to_id) {
            return true;
        }
        
        return false;
    }
    
    function handleAction($options = array())
    {
        if ($this->canDelete()) {
            $this->delete();
            Wub_Controller::redirect(Wub_Controller::$url . "success?for=".$this->getTable()."_delete");
        }
        
        throw new Exception("You do not have permission to delete this.");
    }
    
    function sendEmail()
    {
        $account = Wub_Account::getByID($this->to_id);
        
        $reference = $this->getReference();
        
        $html = " <html>
                    <head>
                      <title>Wubbles Notification</title>
                    </head>
                    <body>
                      <p>Hello, " .  $account->getFullName() . "</p>
                      <div>
                      " . $reference->getNotifyText($this->save_type) . " <br />
                      <a href='" . $reference->getURL() . "'>View it now!</a>
                      </div>
                      <em>Note: You can dissable emails from for profile on Wubbles.</em>
                    </body>
                    </html>";
        
        if (!class_exists('Mail')) {
            include('Mail.php');
            include('Mail/mime.php');
        }
        
        // Constructing the email
        $sender = Wub_Controller::$emailAddress;
        $recipient = $account->email;
        $subject = 'Wubbles Notification';
        $headers = array(
            'From'          => $sender,
            'Return-Path'   => $sender,
            'Subject'       => $subject
        );
        
        // Creating the Mime message
        $mime = new Mail_mime("\n");
        
        $mime->setHTMLBody($html);
        
         // Set body and headers ready for base mail class
        $body    = $mime->get();
        $headers = $mime->headers($headers);
        
        // SMTP params
        $smtp_params["host"] = "localhost"; // SMTP host
        $smtp_params["port"] = "25";               // SMTP Port (usually 25)
        
        // Sending the email using smtp
        $mail = Mail::factory("smtp", $smtp_params);
        
        $mail->send($recipient, $headers, $body);
    }

    function save()
    {
        parent::save();
        
        if (Wub_Account::getByID($this->to_id)->email_notifications) {
            $this->sendEmail();
        }
    }
    
    function handleDelete() {
        if (isset($_POST['action']) && $_POST['action'] == 'delete') {
            if (!$this->canDelete()) {
                throw new Exception("You do not have permission to delete this.");
            }
            
            $this->delete();
            
            Wub_Controller::redirect(Wub_Controller::$url . "success?for=".$this->getTable()."_delete");
        }
    }
}