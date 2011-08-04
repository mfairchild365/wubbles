<?php 
class Wub_Account_ForgotPassword extends Wub_Account
{
    function __construct($options = array()) {
        
    }
    
    public function handlePost()
    {
        if (!isset($_POST['username'])) {
            throw new Exception("invalid email address or password");
            return false;
        }
        
        if (!$account = $this->getByAnyField('Wub_Account', 'email', $_POST['username'])) {
            if (!$account = $this->getByAnyField('Wub_Account', 'username', $_POST['username'])) {
                throw new Exception("Could not retrieve account, please make sure the username or email is correct.");
            }
        }
        
        $account->sendResetPassword();
        
        Wub_Controller::redirect(Wub_Controller::$url."success?for=forgot_password");
    }
}