<?php
class Wub_Group extends Wub_Editable
{
    public $name;
    
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
        return 'groups';
    }
    
    public static function getByID($id)
    {
        return self::getByAnyField('Wub_Group', 'id', (int)$id);
    }
    
    public static function getByNameAndAccount($name, $accountID)
    {
        return self::getByAnyField('Wub_Group', 'name', $name, 'owner_id = ' .  (int)$accountID);
    }
    
    function getMembers()
    {
        if ($this->name == 'Friends') {
            return Wub_Friendship_List::getFriendsForAccount($this->owner_id);
        }
        
        return Wub_Group_Member_List::getGroupMembers($this->id);
    }
    
    public function canView()
    {
        return true;
    }
    
    public function canEdit()
    {
        if (!$account = Wub_Controller::getAccount()) {
            return false;
        }
        
        if ($account->isAdmin()) {
            return true;
        }
        
        if ($account->id == $this->owner_id) {
            return true;
        }
        
        return false;
    }
    
    public function canDelete()
    {
        return $this->canEdit();
    }
}
