<?php
class Wub_SharedMemory_List extends Wub_List
{
    function __construct($options = array())
    {
        parent::__construct($options);
    }
    
    function getDefaultOptions()
    {
        $options = array();
        $options['itemClass'] = 'Wub_SharedMemory';
        $options['listClass'] = 'Wub_SharedMemory_List';
        
        return $options;
    }
    
    public static function getByAccountAndOwner($accountID, $ownerID, $options = array())
    {
        $options        = $options + self::getDefaultOptions();
        $options['sql'] = "SELECT id FROM shared_memory WHERE owner_id = " . (int)$ownerID . " AND account_id = ". (int)$accountID . " ORDER BY date_created ASC ";
        return self::getBySql($options);
    }

}