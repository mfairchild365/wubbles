<?php
class Wub_Account extends Wub_Record
{
    public $id;
    
    public $email;
    
    public $date_created;
    
    public $username;
    
    public $password;
    
    public $activated;
    
    public $role;
    
    public $default_character;
    
    public static function getByID($id)
    {
        return self::getByAnyField('Wub_Account', 'id', (int)$id);
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
        return 'accounts';
    }
    
    function getName()
    {
        return 'Account';
    }
    
    function isAdmin()
    {
        if ($this->role == 'admin') {
            return true;
        }
        
        return false;
    }
    
    function getAllCampaigns($options = array())
    {
        return Wub_Campaign_List::getAllForAccount($this->id, $options);
    }
    
    function getOwnedCampaigns($options = array())
    {
        return Wub_Campaign_List::getByAccount($this->id, $options);
    }
    
    function getAllToInvites($options = array())
    {
        return Wub_Campaign_Invite_List::getAllToAccount($this->id, $options);
    }
    
    function getAllFromInvites($options = array())
    {
        return Wub_Campaign_Invite_List::getAllFromAccount($this->id, $options);
    }
}
