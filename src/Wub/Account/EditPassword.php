<?php
class Wub_Account_EditPassword extends Wub_Account
{
    function __construct($options = array())
    {
         parent::__construct($options);
         
         Wub_Controller::requireLogin();
         
         if (!$this->canEdit()) {
             throw new Exception("You do not have permission to edit this!");
         }
    }
    
    function handlePost($options = array())
    {
        //check passwords
        if($_POST['password'] != $_POST['password2']) {
            throw new Exception("Passwords do not match");
        }
        
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            throw new Exception("You must fill out your password");
        }
        
        $_POST['password'] = sha1($_POST['password']);
        
        parent::handlePost($options);
    }
}