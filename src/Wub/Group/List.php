<?php
class Wub_Group_List extends Wub_List
{
    function __construct($options = array())
    {
        parent::__construct($options);
    }
    
    function getDefaultOptions()
    {
        $options = array();
        $options['itemClass'] = 'Wub_Group';
        $options['listClass'] = 'Wub_Group_List';
        
        return $options;
    }
    
    public static function getGroupsForAccount($account_id, $options = array())
    {
        $options        = $options + self::getDefaultOptions();
        $options['sql'] = "SELECT id FROM groups WHERE (owner_id = " . (int)$account_id;
        return self::getBySql($options);
    }
}