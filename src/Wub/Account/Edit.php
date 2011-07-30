<?php
class Wub_Account_Edit extends Wub_Account
{
    function __construct($options = array())
    {
        parent::__construct($options);
    }
    
    function handlePost($options = array())
    {
        //Check emails
        if($_POST['email'] != $_POST['email2']) {
            throw new Exception("Emails do not match");
        } 
        
        //check passwords
        if($_POST['password'] != $_POST['password2']) {
            throw new Exception("Passwords do not match");
        }
        
        if (!isset($_POST['firstname']) || empty($_POST['firstname'])) {
            throw new Exception("You must fill out your name");
        }
        
        if (!isset($_POST['lastname']) || empty($_POST['lastname'])) {
            throw new Exception("You must fill out your name");
        }
        
        if (!isset($_POST['email']) || empty($_POST['email'])) {
            throw new Exception("You must fill out your email");
        }
        
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            throw new Exception("You must fill out your password");
        }
        
        if (!isset($_POST['username']) || empty($_POST['username'])) {
            throw new Exception("You must fill out your username");
        }
        
        if (!isset($_POST['email_notifications']) && in_array($_POST['email_notifications'], array(1,0))) {
            throw new Exception("You must select your email notification settings");
        }
        
        if (empty($this->id) && Wub_Account::getByAnyField('Wub_Account', 'email', $_POST['email'])){
            throw new Exception("This email address is already in use.");
        }
        
        if (empty($this->id) && Wub_Account::getByAnyField('Wub_Account', 'username', $_POST['username'])){
            throw new Exception("This username is already in use.");
        }
        
        $this->email_notifications = 0;
        if ((int)$_POST['email_notifications'] == 1) {
            $this->email_notifications = 1;
        }
        unset($_POST['email_notifications']);
        
        $_POST['activated']          = false;
        $_POST['role']               = 'user';
        $_POST['date_created']       = time();
        $_POST['password']           = sha1($_POST['password']);
        
        parent::handlePost($options);
    }
}