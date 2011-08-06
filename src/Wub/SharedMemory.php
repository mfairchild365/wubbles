<?php
class Wub_SharedMemory extends Wub_Editable implements Wub_Notifiable
{
    public $memory_id;
    
    public $account_id;
    
    public $permission;

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
        return 'shared_memory';
    }
    
    public static function getByID($id)
    {
        return self::getByAnyField('Wub_SharedMemory', 'id', (int)$id);
    }
    
    function getName()
    {
        return 'Shared Memory';
    }
    
    function getMemory() {
        return Wub_Memory::getByID($this->memory_id);
    }
    
    public function getEditURL()
    {
        $id = "";
        if (isset($this->id)) {
            $id = $this->id . "/";
        }
        
        return Wub_Memory::getByID($this->memory_id)->getURL() . "/share/".$id."edit";
    }
    
    public static function getByAccountAndMemory($account_id, $memory_id)
    {
        $mysqli = Wub_Controller::getDB();
        $sql    = "SELECT id FROM shared_memory 
                   WHERE (account_id = " . (int)$account_id . " AND memory_id = " . (int)$memory_id . ")
                   LIMIT 1;";
        
        if (!$result = $mysqli->query($sql)) {
            return false;
        }
        
        $row = $result->fetch_array(MYSQLI_ASSOC);
        
        return self::getByID($row['id']);
    }
    
    public function canView() {
        return true;
    }
    
    function delete()
    {
        //Delete all notifiactions
        foreach (Wub_Notification_List::getAllByClassAndID($this->getNotifyClass(), $this->getNotifyReferenceID()) as $notification) {
            $notification->delete();
        }
        
        parent::delete();
    }
    
    public function getNotifyMembersList()
    {
        $options['array'][] = $this->account_id;
        return new Wub_Account_List($options);
    }
    
    public function getNotifyClass()
    {
        return 'Wub_SharedMemory';
    }
    
    public function getNotifyReferenceID() {
        return $this->id;
    }
    
    public function getNotifyText($saveType, $toID)
    {
        switch ($saveType) {
            case 'create':
                return Wub_Account::getByID($this->getMemory()->owner_id)->getFullName() . " has shared their memory '" . $this->getMemory()->subject . "' with you!";
        }
    }
    
    public function getURL()
    {
        return $this->getMemory()->getURL();
    }
}
