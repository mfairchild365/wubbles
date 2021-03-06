<?php
class Wub_Comment_Edit extends Wub_Comment
{
    function __construct($options = array())
    {
        //We need the comment class...
        if (!isset($_POST['class']) || empty($_POST['class'])) {
            throw new Exception("You need to select and object to comment on.", 400);
        }
        
        //We need the comment class...
        if (!isset($_POST['reference_id']) || empty($_POST['reference_id'])) {
            throw new Exception("You need to select and object to comment on.", 400);
        }
        
        if (!Wub_Controller::getAccount()) {
            throw new Exception("You must be logged in to do this.", 400);
        }
        
        $this->class        = $_POST['class'];
        $this->reference_id = $_POST['reference_id'];
        
        parent::__construct($options);
    }
    
    function handlePost($options = array())
    {
        //Make sure everything is filled out.
        if (!isset($_POST['comment']) || empty($_POST['comment'])) {
            throw new Exception("No comment provided.", 400);
        }
        
        parent::handlePost($options);
    }
}