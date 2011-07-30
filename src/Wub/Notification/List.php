<?php
class Wub_Notification_List extends Wub_List
{
    function __construct($options = array())
    {
        if (!isset($options['model']) || $options['model'] != 'Wub_Notification_List') {
            parent::__construct($options);
            return;
        }
        
        Wub_Controller::requireLogin();
        
        if (!isset($options['account_id'])) {
            throw new Exception("No account specified.", 404);
        }
        
        if ($options['account_id'] !== Wub_Controller::getAccount()->id) {
            throw new Exception("You do not have permission to view this.");
        }
        
        $options['returnArray'] = true;
        
        $options['array'] = self::getAllByAccount($options['account_id'], $options);
        
        parent::__construct($options);
    }
    
    function getDefaultOptions()
    {
        $options = array();
        $options['itemClass'] = 'Wub_Notification';
        $options['listClass'] = 'Wub_Notification_List';
        
        return $options;
    }
    
    public static function getAllByAccount($accountID, $options = array()) {
        $options        = $options + self::getDefaultOptions();
        $options['sql'] = "SELECT id FROM notifications WHERE to_id = '" . (int)$accountID . "' ORDER BY date_created DESC";
        return self::getBySql($options);
    }
    
    public static function getAllByClassAndID($class, $id, $options = array())
    {
        $db             = Wub_Controller::getDB();
        $options        = $options + self::getDefaultOptions();
        $options['sql'] = "SELECT id FROM notifications WHERE reference_class = '" . $db->escape_string($class) . "' AND reference_id = " . (int)$id . " ORDER BY date_created ASC";
        return self::getBySql($options);
    }

}