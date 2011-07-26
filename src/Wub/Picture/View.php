<?php 
class Wub_Picture_View extends Wub_Picture
{
    function __construct($options = array())
    {
        parent::__construct($options);
        
        if (!$this->canView()) {
            throw new Exception("You do not have permission to view this.");
        }
    }
}