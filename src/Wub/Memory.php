<?php
class Wub_Memory extends Wub_Editable
{
    public $subject;
    
    public $details;
    
    public $permission;
    
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
        return 'memories';
    }
    
    public static function getByID($id)
    {
        return self::getByAnyField('Wub_Memory', 'id', (int)$id);
    }
    
    function getName()
    {
        return 'Memory';
    }
    
    public function getEditURL()
    {
        $id = "";
        if (isset($this->id)) {
            $id = $this->id . "/";
        }
        
        return Wub_Controller::$url . "memory/".$id."edit";
    }
    
    public function getURL()
    {
        if (isset($this->id)) {
            return Wub_Controller::$url . "memory/" . $this->id;
        }
        return false;
    }

}
