<?php
class Wub_Account_Login extends Wub_Account
{
    function handlePost($options)
    {
        $this->login($options);
    }
    
    function login($options)
    {
        if (!isset($options['email'], $options['password'])) {
            throw new Exception("invalid email address or password");
            return false;
        }
        
        if (!$account = $this->getByAnyField('Wub_Account', 'email', $options['email'], "password = '".sha1($options['password'])."'")) {
            if (!$account = $this->getByAnyField('Wub_Account', 'username', $options['email'], "password = '".sha1($options['password'])."'")) {
                throw new Exception("Could not retrieve account, please make sure the password is correct.");
            }
        }
        
        if (empty($account->activated) || !$account->activated) {
            $account->sendActivationCode();
            throw new Exception("You must activate your account before you can log in.  Please check your email for an activation link.  We sent the email from " . Wub_Controller::$emailAddress);
        }
        
        //Set the id.
        $_SESSION['account_id'] = $account->id;
        
        //Go to the homepage.
        Wub_Controller::redirect(Wub_Controller::$url."success?for=login&ajaxredirect=" . Wub_Controller::$url . "home");
    }
}