<?php
class Wub_Memory extends Wub_Editable implements Wub_Notifiable
{
    public $subject;
    
    public $details;
    
    public $permission;
    
    public $start_date;
    
    public $end_date;
    
    public $importance;  //scale of 1 to 100.
    
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
        return 'Memory: '. $this->subject;
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
        $list = array();
        switch ($this->permission) {
            case 'public':
                break;
            case 'friends':
                //TODO
                break;
            case 'private':
                $shared = Wub_SharedMemory_List::getByMemory($this->id);
                $options['array'] = array();
                foreach ($shared as $item) {
                    $options['array'][] =  $item->account_id;
                }
                $options['array'][] = $this->owner_id;
                return new Wub_Account_List($options);
        }
        return $list;
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
    
    public function getCommentableClass()
    {
        return 'Wub_Memory';
    }
    
    function delete()
    {
        //Delete all the comments for this memory.
        foreach (Wub_Comment_List::getAllCommentsByClassAndID($this->getCommentableClass(), $this->id) as $comment) {
            $comment->delete();
        }
        
        //Delete all the pictures for this memory.
        foreach (Wub_Picture_List::getAllByMemory($this->id) as $picture) {
            $picture->delete();
        }
        
        //Delete all shared memories.
        foreach (Wub_SharedMemory_List::getByMemory($this->id) as $shared) {
            $shared->delete();
        }
        
        //Delete all notifiactions
        foreach (Wub_Notification_List::getAllByClassAndID($this->getNotifyClass(), $this->getNotifyReferenceID()) as $notification) {
            $notification->delete();
        }
        
        parent::delete();
    }
    
    public function getNotifyMembersList()
    {
        return $this->getMembersList();
    }
    
    public function getNotifyClass()
    {
        return 'Wub_Memory';
    }
    
    public function getNotifyReferenceID()
    {
        return $this->id;
    }
    
    public function getNotifyText($saveType, $toID)
    {
        switch ($saveType) {
            case 'save':
                return "Memory has been updated.";
            case 'create':
                return "A Memory has been created!";
        }
    }
    
    public function getAccount()
    {
        static $account = NULL;
        
        if (empty($account)) {
            $account = Wub_Account::getByID($this->owner_id);
        }
        
        return $account;
    }
}
