<?php
class Wub_Account extends Wub_Editable
{
    public $email;
    
    public $username;
    
    public $password;
    
    public $activated;
    
    public $role;
    
    public $firstname;
    
    public $lastname;
    
    public $email_notifications;
    
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
    
    function getMemories($options = array())
    {
        return Wub_Memory_List::getAllByAccount($this->id, $options);
    }
    
    public function getURL()
    {
        if (isset($this->id)) {
            return Wub_Controller::$url . "account/" . $this->id;
        }
        return false;
    }
    
    public function getEditURL()
    {
        $id = "";
        if (!empty($this->id)) {
            $id = $this->id . "/";
        }
        
        return Wub_Controller::$url . "account/".$id."edit";
    }
    
    function getFriendsListURl()
    {
        if(empty($this->id)) {
            return false;
        }
        
        return $this->getURL() . "/friends";
    }
    
    public function getFullName()
    {
        return ucwords(trim($this->firstname) . ' ' .  trim($this->lastname));
    }
    
    public function canView() {
        return true;
    }
}
