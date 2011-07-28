<?php
class Wub_Comment_Edit extends Wub_Comment
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
        
        if (!isset($_POST['details']) || empty($_POST['details'])) {
            throw new Exception("no details provided");
        }
        
        if (!isset($_POST['permission']) || empty($_POST['permission'])) {
            throw new Exception("no permission provided");
        }
        
        parent::handlePost($options);
    }
}