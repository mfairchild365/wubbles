<?php
class Wub_Picture extends Wub_Editable implements Wub_Notifiable
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
        return $this->getMemory()->getName();
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
    
    public function getFullPath()
    {
        return Wub_Controller::$uploadDir . $this->path;
    }
    
    public function getThumbURL() 
    {
        return Wub_Controller::$uploadURL . $this->getFileName() . '-thumb' . $this->getExtension();
    }
    
    public function getFullThumbPath()
    {
        return Wub_Controller::$uploadDir . $this->getFileName() . '-thumb' . $this->getExtension();
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

    public function getCommentableClass()
    {
        return 'Wub_Picture';
    }
    
    function delete()
    {
        //Delete the pictures on the file system.
        unlink($this->getFullPath());
        unlink($this->getFullThumbPath());
        
        //Delete all the comments for this picture.
        foreach (Wub_Comment_List::getAllCommentsByClassAndID($this->getCommentableClass(), $this->id) as $comment) {
            $comment->delete();
        }
        
        //Delete all notifiactions
        foreach (Wub_Notification_List::getAllByClassAndID($this->getNotifyClass(), $this->getNotifyReferenceID()) as $notification) {
            $notification->delete();
        }
        
        parent::delete();
    }
    
    public function getNotifyMembersList()
    {
        return $this->getMemory()->getMembersList();
    }
    
    public function getNotifyClass()
    {
        return 'Wub_Picture';
    }
    
    public function getNotifyReferenceID() {
        return $this->id;
    }
    
    public function getNotifyText($saveType)
    {
        switch ($saveType) {
            case 'save':
                return "Picture has been updated.";
            case 'create':
                return "A Picture has been added!";
        }
    }
}
