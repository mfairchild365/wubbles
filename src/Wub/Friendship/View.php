<?php 
class Wub_Friendship_View extends Wub_Friendship
{
    function __construct($options = array())
    {
        Wub_Controller::requireLogin();
        
        if (!isset($options['id']) || empty($options['id'])) {
            throw new Exception("No id was set.", 400);
        }
        
        $this->synchronizeWithArray(Wub_Friendship::getbyID($options['id'])->toArray());
        
        if (!($this->sender_id == Wub_Controller::getAccount()->id || $this->reciever_id == Wub_Controller::getAccount()->id)) {
            throw new Exception("You do not have permission to view this.", 400);
        }
        
        parent::__construct($options);
    }
}