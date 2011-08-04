<?php 
class Wub_Picture_View extends Wub_Picture implements Wub_Commentable
{
    function __construct($options = array())
    {
        parent::__construct($options);
        
        if ($options['memory_id'] != $this->memory_id) {
            throw new Exception("That picture does not belong to this memory.");
        }
        
        if (!$this->canView()) {
            throw new Exception("You do not have permission to view this.");
        }
    }
}