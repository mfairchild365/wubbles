<?php 
class Wub_Account_Activate
{
    function __construct($options = array()) {
        if (!isset($options['account_id']) || empty ($options['account_id'])) {
            throw new Exception("No account was selected.!");
        }
        
        if (!$account = Wub_Account::getByID($options['account_id'])) {
            throw new Exception("No account was selected.!");
        }
        
        if (!isset($options['code']) || empty ($options['code'])) {
            throw new Exception("You must give me a code for this to work!");
        }
        
        if ($account->activated) {
            throw new Exception("This account has already been activated.");
        }
        
        if ($options['code'] != $account->activation_code) {
            throw new Exception("Wrong code.  :(");
        }
        
        $account->activated = 1;
        $account->save();
        
        //Set the id.
        $_SESSION['account_id'] = $account->id;
        
        //Go to the homepage.
        Wub_Controller::redirect(Wub_Controller::$url."success?for=activate");
    }
}