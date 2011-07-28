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
        if (!isset($_POST['comment']) || empty($_POST['comment'])) {
            throw new Exception("No comment provided.");
        }
        
        parent::handlePost($options);
    }
}