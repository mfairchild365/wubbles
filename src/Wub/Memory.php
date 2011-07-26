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
    
    public function getMembersList()
    {
        return Wub_SharedMemory_List::getByMemory($this->id);
    }
    
    public function getMembersListIDs()
    {
        $list = Wub_SharedMemory_List::getByMemory($this->id);
        $array = array($this->owner_id);
        foreach($list as $member) {
            $array[] =  $member->account_id;
        }
        
        return new ArrayIterator($array);
    }
    
    public function getPictures($limit = 0)
    {
        return Wub_Picture_List::getAllByMemory($this->id, $limit);
    }
    
    public function getAddPhotoURL()
    {
        return $this->getURL() . '/picture/edit';
    }
    
    function canView()
    {
        switch ($this->permission) {
        case 'public':
            return true;
        case 'friends':
            //TODO: add friend permission.
            return false;
        case 'private':
        default:
            if (!Wub_Controller::getAccount()) {
                return false;
            }
            
            if (in_array(Wub_Controller::getAccount()->id, iterator_to_array($this->getMembersListIDs()))) {
                return true;
            }
            
            return false;
        }
    }
}
