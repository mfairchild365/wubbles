<?php
class Wub_Account_Register extends Wub_Account
{
    function handlePost()
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
            throw new Exception("You must filld out your name");
        }
        
        if (!isset($_POST['lastname']) || empty($_POST['lastname'])) {
            throw new Exception("You must filld out your name");
        }
        
        
        if (!isset($_POST['email'], $_POST['password'], $_POST['username'])) {
            throw new Exception("You did not fill in all of the fields.  :(");
        }
        
        if (Wub_Account::getByAnyField('Wub_Account', 'email', $_POST['email'])){
            throw new Exception("This email address is already in use.");
        }
        
        if (Wub_Account::getByAnyField('Wub_Account', 'username', $_POST['username'])){
            throw new Exception("This username is already in use.");
        }
        
        $_POST['activated']    = false;
        $_POST['role']         = 'user';
        $_POST['date_created'] = time();
        $_POST['password']     = sha1($_POST['password']);
        
        $this->synchronizeWithArray($_POST);
        
        if (!parent::insert()) {
            throw new Exception("There was an error while creating your account.");
        }
        
        Wub_Controller::redirect(Wub_Controller::$url . 'success?for=registration');
    }
}