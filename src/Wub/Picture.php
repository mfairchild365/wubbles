<?php
class Wub_Picture extends Wub_Editable
{
    public $title;
    
    public $caption;
    
    public $path;
    
    public $memory_id;
    
    public $primary;
    
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
    
    public function getPictureURL() 
    {
        return Wub_Controller::$uploadURL . $this->path;
    }
    
    public function getThumbURL() 
    {
        return Wub_Controller::$uploadURL . $this->getFileName() . '-thumb' . $this->getExtension();
    }
    
    public function getFileName()
    {
        if (isset($this->path[4])) {
            return substr($this->path, 0, strlen($this->path) -4);
        }
        
        return false;
    }
    
    public function getExtension() 
    {
        if (isset($this->path[4])) {
            return substr($this->path, -4);
        }
        
        return false;
    }
    
    function canEdit()
    {
        if (!$memory = Wub_Memory::getByID($this->memory_id)) {
            return false;
        }
        
        return $memory->canEdit();
    }
    
    function getMemory()
    {
        return Wub_Memory::getByID($this->memory_id);
    }
    
    function canView()
    {
        return $this->getMemory()->canView();
    }

}
