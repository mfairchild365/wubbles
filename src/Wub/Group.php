<?php
class Wub_Group extends Wub_Editable
{
    public $name;
    
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
        return 'groups';
    }
    
    public static function getByID($id)
    {
        return self::getByAnyField('Wub_Group', 'id', (int)$id);
    }
}
