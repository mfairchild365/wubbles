<?php
class Wub_Account_FriendRequest extends Wub_Account
{
    function __construct($options = array())
    {
        parent::__construct($options);
        $this->password = NULL;
    }
    
    function sendFriendReqest()
    {

    }
}