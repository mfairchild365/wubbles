<?php
class Wub_Memory_Edit extends Wub_Memory
{
    function __construct($options = array())
    {
        parent::__construct($options);
    }
    
    function handlePost($options = array())
    {
        //Make sure everything is filled out.
        if (!isset($_POST['subject']) || empty($_POST['subject'])) {
            throw new Exception("No subject provided");
        } 
        
        if(!isset($_POST['details']) || empty($_POST['details'])) {
            throw new Exception("no details provided");
        } 
        
        $_POST['owner_id']        = $_SESSION['account_id'];
        $_POST['date_created']    = time();
        
        parent::handlePost($options);
    }
}