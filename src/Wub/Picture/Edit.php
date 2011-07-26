<?php
class Wub_Picture_Edit extends Wub_Picture
{
    function __construct($options = array())
    {
        parent::__construct($options);
    }
    
    function handlePost($options = array())
    {
        echo "here"; exit();
        //Make sure everything is filled out.
        if (!isset($_POST['title']) || empty($_POST['title'])) {
            throw new Exception("No title provided");
        }
        
        parent::handlePost($options);
    }
}