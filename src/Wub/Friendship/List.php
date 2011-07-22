<?php
class Wub_Friendship_List extends Wub_List
{
    function __construct($options = array())
    {
        if (!isset($options['model']) || $options['model'] != 'Wub_Friendship_List') {
            parent::__construct($options);
            return;
        }
        
        Wub_Controller::requireLogin();
        
        if (!isset($options['account_id'])) {
            throw new Exception("No account specified.", 404);
        }
        
        $options['returnArray'] = true;
        
        $options['array'] = self::getFriendsForAccount($options['account_id'], $options);
        
        parent::__construct($options);
    }
    
    function getDefaultOptions()
    {
        $options = array();
        $options['itemClass'] = 'Wub_Friendship';
        $options['listClass'] = 'Wub_Friendship_List';
        
        return $options;
    }
    
    public static function getFriendsForAccount($account_id, $options = array())
    {
        $options        = $options + self::getDefaultOptions();
        $options['sql'] = "SELECT id FROM friends WHERE (sender_id = " . (int)$account_id . " OR reciever_id = " . (int)$account_id . ") AND (status = 'sent' OR status = 'accepted')";
        return self::getBySql($options);
    }
}