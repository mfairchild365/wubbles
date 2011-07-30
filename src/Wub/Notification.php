<?php
class Wub_Notification extends Wub_Record implements Wub_Permissionable
{
    public $id;
    
    public $reference_class;
    
    public $reference_id;
    
    public $to_id;
    
    public $read;
    
    public $date_created;
    
    public $save_type;
    
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
        return 'notifications';
    }
    
    public static function getByID($id)
    {
        return self::getByAnyField('Wub_Notification', 'id', (int)$id);
    }
    
    function getName()
    {
        return 'Notification';
    }
    
    public function getURL()
    {
        if (isset($this->id)) {
            return Wub_Controller::$url . "notification/" . $this->id;
        }
        return false;
    }
    
    function canEdit()
    {
        return false;
    }
    
    function canDelete()
    {
        return false;
    }
    
    function canView()
    {
        return false;
    }
    
    private function createNotification($referenceClass, $referenceID, $saveType, $toID) {
        $notification = new Wub_Notification();
        $notification->reference_class = $referenceClass;
        $notification->reference_id    = $referenceID;
        $notification->save_type     = $saveType;
        $notification->to_id           = $toID;
        $notification->date_created    = time();
        $notification->read            = 0;
        
        $notification->save();
    }
    
    static function createNotifications($referenceClass, $referenceID, $saveType)
    {
        $class = call_user_func($referenceClass. "::getByID", $referenceID);
        foreach($class->getNotifyMembersList() as $member) {
            if (Wub_Controller::getAccount() && Wub_Controller::getAccount()->id !== $member->id) {
                self::createNotification($referenceClass, $referenceID, $saveType, $member->id);
            }
        }
    }
    
    public function getReference()
    {
        return call_user_func($this->reference_class . "::getByID", $this->reference_id);
    }

}