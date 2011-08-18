<?php
class Wub_Group_Member extends Wub_Record
{
    public $id;
    
    public $gorup_id;
    
    public $account_id;
    
    function __construct($options = array())
    {
        parent::__construct($options);
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
        return 'group_members';
    }
    
    public static function getByID($id)
    {
        return self::getByAnyField('Wub_GroupMember', 'id', (int)$id);
    }
}
