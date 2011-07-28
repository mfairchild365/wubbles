<?php 
class Wub_Memory_View extends Wub_Memory implements Wub_Commentable
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
                if (!Wub_Controller::getAccount()) {
                    throw new Exception("You must be logged in to view this.");
                }
                
                if (in_array(Wub_Controller::getAccount()->id, iterator_to_array($this->getMembersListIDs()))) {
                    return;
                }
                
                throw new Exception("You do not have permission to view this.");
        }
    }
}