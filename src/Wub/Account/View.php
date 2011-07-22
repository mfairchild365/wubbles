<?php 
class Wub_Account_View extends Wub_Account
{
    function __construct($options = array())
    {
        parent::__construct($options);
        
        $this->password = NULL;
    }
}