<?php
class Wub_Timeline
{
    public $account;
    
    function __construct($options = array())
    {
        if (!isset($options['account_id'])) {
            throw new Exception("You must select an account.");
        }
        
        if (!$this->account = Wub_Account::getByID($options['account_id'])) {
            throw new Exception("That account does not exist!");
        }
    }
    
    function getJSONurl()
    {
        return  $this->account->getURL() . "/memories/timeline?format=json";
    }
}