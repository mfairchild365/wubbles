<?php
class Wub_Comment extends Wub_Editable implements Wub_Notifiable
{
    public $class;
    
    public $reference_id;
    
    public $comment;
    
    public static function getByID($id)
    {
        return self::getByAnyField('Wub_Comment', 'id', (int)$id);
    }
    
    function __construct($options = array()) {
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
        return 'comments';
    }
    
    function getName()
    {
        return $this->getReference()->getName();
    }
    
    public function getURL()
    {
        return $this->getReference()->getURL();
    }
    
    public function getEditURL()
    {
        $id = "";
        if (empty($this->id)) {
            $id = $this->id . "/";
        }
        
        return Wub_Controller::$url . "comment/".$id."edit";
    }
    
    public function getReference()
    {
        return call_user_func($this->class . "::getByID", $this->reference_id);
    }
    
    public function canEdit()
    {
        if (!$class = $this->getReference()) {
            return false;
        }
        
        return $class->canView();
    }
    
    public function canView()
    {
        return $this->canEdit();
    }
    
    public function getNotifyMembersList()
    {
        return $this->getReference()->getNotifyMembersList();
    }
    
    public function getNotifyClass()
    {
        return 'Wub_Comment';
    }
    
    public function getNotifyReferenceID() {
        return $this->id;
    }
    
    public function getNotifyText($saveType, $toID)
    {
        switch ($saveType) {
            case 'create':
                switch ($this->class) {
                    case 'Wub_Memory':
                        $post = "the memory - " . $this->getReference()->subject;
                        break;
                    case 'Wub_Picture':
                        $post = "the picture - " . $this->getReference()->title;
                        break;
                    default:
                        $post = 'a post that you are part of.';
                }
                return Wub_Account::getByID($this->owner_id)->getFullName() . " has posted a comment on $post";
        }
    }
    
    function delete()
    {
        //Delete all notifiactions
        foreach (Wub_Notification_List::getAllByClassAndID($this->getNotifyClass(), $this->getNotifyReferenceID()) as $notification) {
            $notification->delete();
        }
        
        parent::delete();
    }
}
