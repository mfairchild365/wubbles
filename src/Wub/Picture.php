<?php
class Wub_Picture extends Wub_Editable
{
    public $title;
    
    public $caption;
    
    public $path;
    
    function __construct($options = array())
    {
        if (!isset($options['memory_id'])) {
            throw new Exception("No memory ID was passed!");
        }
        
        $this->memory_id = $options['memory_id'];
        
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
        return 'pictures';
    }
    
    public static function getByID($id)
    {
        return self::getByAnyField('Wub_Picture', 'id', (int)$id);
    }
    
    function getName()
    {
        return 'Picture';
    }
    
    public function getEditURL()
    {
        $id = "";
        if (isset($this->id)) {
            $id = $this->id . "/";
        }
        
        return Wub_Controller::$url . "memory/" . $this->memory_id . "/picture/".$id."edit";
    }
    
    public function getURL()
    {
        if (isset($this->id)) {
            return Wub_Controller::$url . "memory/" . $this->memory_id . "/picture/" . $this->id;
        }
        
        return false;
    }

}
