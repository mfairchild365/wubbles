<?php
class Wub_Account_EditPassword extends Wub_Account
{
    function __construct($options = array())
    {
         parent::__construct($options);
         
         if (!isset($options['code']) || $options['code'] != $this->activation_code) {
             Wub_Controller::requireLogin();
             
             if (!$this->canEdit()) {
                 throw new Exception("You do not have permission to edit this!", 401);
             }
         }
    }
    
    function handlePost($options = array())
    {
        //check passwords
        if($_POST['password'] != $_POST['password2']) {
            throw new Exception("Passwords do not match", 400);
        }
        
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            throw new Exception("You must fill out your password", 400);
        }
        
        $this->password = sha1($_POST['password']);
        $this->activation_code = md5(time() . rand(1,300));
        $this->save();
        
        Wub_Controller::redirect(Wub_Controller::$url."success?for=reset_password");
    }
}