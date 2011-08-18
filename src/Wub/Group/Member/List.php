<?php
class Wub_Group_Member_List extends Wub_List
{
    function __construct($options = array())
    {
        parent::__construct($options);
    }
    
    function getDefaultOptions()
    {
        $options = array();
        $options['itemClass'] = 'Wub_Group_Member';
        $options['listClass'] = 'Wub_Group_Member_List';
        
        return $options;
    }
    
    public static function getGroupMembers($group_id, $options = array())
    {
        $options        = $options + self::getDefaultOptions();
        $options['sql'] = "SELECT id FROM group_members WHERE (group_id = " . (int)$group_id;
        return self::getBySql($options);
    }
}