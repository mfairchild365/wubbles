<?php
class Wub_Comment_Edit extends Wub_Comment
{
    function __construct($options = array())
    {
        //We need the comment class...
        if (!isset($_POST['class']) || empty($_POST['class'])) {
            throw new Exception("You need to select and object to comment on.");
        }
        
        //We need the comment class...
        if (!isset($_POST['reference_id']) || empty($_POST['reference_id'])) {
            throw new Exception("You need to select and object to comment on.");
        }
        
        $this->class        = $_POST['class'];
        $this->reference_id = $_POST['reference_id'];
        
        parent::__construct($options);
    }
    
    function handlePost($options = array())
    {
        //Make sure everything is filled out.
        if (!isset($_POST['comment']) || empty($_POST['comment'])) {
            throw new Exception("No comment provided.");
        }
        
        parent::handlePost($options);
    }
}