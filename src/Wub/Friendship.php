<?php
class Wub_Friendship extends Wub_Record implements Wub_Notifiable
{
    public $id;
    
    public $sender_id;
    
    public $reciever_id;
    
    public $date_sent;
    
    public $status;
    
    public $date_edited;
    
    public static function getByID($id)
    {
        return self::getByAnyField('Wub_Friendship', 'id', (int)$id);
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
        return 'friends';
    }
    
    function getName()
    {
        return 'Friend';
    }
    
    public static function getFriendship($first_id, $second_id)
    {
        $mysqli = Wub_Controller::getDB();
        $sql    = "SELECT id FROM friends 
                  WHERE (sender_id = " . (int)$first_id . " AND reciever_id = " . (int)$second_id . ") 
                  OR (sender_id = " . (int)$second_id . " AND reciever_id = " . (int)$first_id . ") 
                  LIMIT 1;";
        
        if (!$result = $mysqli->query($sql)) {
            return false;
        }
        
        $row = $result->fetch_array(MYSQLI_ASSOC);
        
        return self::getByID($row['id']);
        
    }
    
    function getFriendForAccount($account_id)
    {
        $friend_id = NULL;
        
        if ($this->reciever_id == $account_id) {
            $friend_id = $this->sender_id;
        }
        
        if ($this->sender_id == $account_id) {
            $friend_id = $this->reciever_id;
        }
        
        return Wub_Account::getByID($friend_id);
    }
    
    public function getNotifyMembersList()
    {
        return new ArrayIterator(array(Wub_Account::getByID($this->sender_id), Wub_Account::getByID($this->reciever_id)));
    }
    
    public function getNotifyClass()
    {
        return 'Wub_Friendship';
    }
    
    public function getNotifyReferenceID() {
        return $this->id;
    }
    
    public function getNotifyText($saveType)
    {
        switch ($saveType) {
            case 'save':
                return "Friendship has been updated.";
            case 'create':
                return "A Friend request has been sent!";
        }
    }
    
    function getURL()
    {
        return Wub_Controller::$url . "friendship/" . $this->id;
    }
}
