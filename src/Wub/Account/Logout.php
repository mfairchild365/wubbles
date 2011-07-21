<?php
class Wub_Account_Logout extends Wub_Account
{
    function __construct()
    {
        $this->logout();
    }
    
    function logout()
    {
        session_destroy();
        Wub_Controller::redirect('home');
    }
}