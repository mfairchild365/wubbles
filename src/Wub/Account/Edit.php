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
        
        if (empty($this->id) && Wub_Account::getByAnyField('Wub_Account', 'email', $_POST['email'])){
            throw new Exception("This email address is already in use.");
        }
        
        if (empty($this->id) && Wub_Account::getByAnyField('Wub_Account', 'username', $_POST['username'])){
            throw new Exception("This username is already in use.");
        }
        
        $_POST['activated']    = false;
        $_POST['role']         = 'user';
        $_POST['date_created'] = time();
        $_POST['password']     = sha1($_POST['password']);
        
        parent::handlePost($options);
    }
}