<?php
class Wub_Account_Edit extends Wub_Account
{
    function __construct($options = array())
    {
        $this->email_notifications = 1;
        parent::__construct($options);
    }
    
    function handlePost($options = array())
    {
        //Check emails
        if($_POST['email'] != $_POST['email2']) {
            throw new Exception("Emails do not match");
        } 
        
        //check passwords
        if(empty($this->id) && $_POST['password'] != $_POST['password2']) {
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
        
        if (empty($this->id) && (!isset($_POST['password']) || empty($_POST['password']))) {
            throw new Exception("You must fill out your password");
        }
        
        if (!isset($_POST['username']) || empty($_POST['username'])) {
            throw new Exception("You must fill out your username");
        }
        
        if (!isset($_POST['email_notifications']) && in_array($_POST['email_notifications'], array(1,0))) {
            throw new Exception("You must select your email notification settings");
        }
        
        if ((empty($this->id) || $_POST['email'] != $this->email) && Wub_Account::getByAnyField('Wub_Account', 'email', $_POST['email'])){
            throw new Exception("This email address is already in use.");
        }
        
        if ((empty($this->id) || $_POST['username'] != $this->username) && Wub_Account::getByAnyField('Wub_Account', 'username', $_POST['username'])){
            throw new Exception("This username is already in use.");
        }
        
        $this->email_notifications = 1;
        if ((int)$_POST['email_notifications'] == 0) {
            $this->email_notifications = 0;
        }
        unset($_POST['email_notifications']);
        
        $_POST['activated']          = false;
        $_POST['role']               = 'user';
        $_POST['date_created']       = time();
        
        if (empty($this->id)) {
            $_POST['password'] = sha1($_POST['password']);
            
            require 'recaptchalib.php';
            
            if (!isset($_POST["recaptcha_response_field"])) {
                throw new Exception("You must fill out the captcha.");
            }
            
            $resp = recaptcha_check_answer(Wub_Controller::$captcha_privateKey,
                                            $_SERVER["REMOTE_ADDR"],
                                            $_POST["recaptcha_challenge_field"],
                                            $_POST["recaptcha_response_field"]);
            
            if (!$resp->is_valid) {
                throw new Exception("Captcha not valid, please try again.");
            }
        }
        
        parent::handlePost($options);
    }
}