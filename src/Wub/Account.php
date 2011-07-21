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
    
    public $firstname;
    
    public $lastname;
    
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
}
