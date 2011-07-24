<?php 
class Wub_Memory_View extends Wub_Memory
{
    function __construct($options = array())
    {
        parent::__construct($options);
        
        switch ($this->permission) {
            case 'public':
                break;
            case 'friends':
                throw new exception('This function does not work yet.');
            case 'private':
            default:
                if (!Wub_Controller::getAccount() || Wub_Controller::getAccount()->id != $this->owner_id) {
                    throw new Exception("You do not have permission to view this.");
                }
        }
    }
}