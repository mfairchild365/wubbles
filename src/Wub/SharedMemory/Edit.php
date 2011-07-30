<?php
class Wub_SharedMemory_Edit extends Wub_SharedMemory
{
    function __construct($options = array())
    {
        if (!isset($options['memory_id'])) {
            throw new Exception("You must select a memory!");
        }
        
        $this->memory_id = $options['memory_id'];
        
        if (!$memory = Wub_Memory::getByID($options['memory_id'])) {
            throw new Exception("Could not find that memory!");
        }
        
        if ($memory->owner_id != Wub_Controller::getAccount()->id) {
            throw new Exception("You do not have permission to share this.");
        }
        
        parent::__construct($options);
    }
    
    function handlePost($options = array())
    {
        //Make sure everything is filled out.
        if (!isset($_POST['memory_id']) || empty($_POST['memory_id'])) {
            throw new Exception("No memory was selected");
        } 
        
        if (!isset($_POST['account_id']) || empty($_POST['account_id'])) {
            throw new Exception("no account was selected");
        }
        
        if (!isset($_POST['permission']) || empty($_POST['permission'])) {
            throw new Exception("no permission was set.");
        }
        
        if (!$memory = Wub_Memory::getByID($_POST['memory_id'])) {
            throw new exception("Could not find the memory to share!");
        }
        
        if ($memory->owner_id != Wub_Controller::getAccount()->id) {
            throw new Exception("You do not have permission to share this.");
        }
        
        $shared = Wub_SharedMemory::getByAccountAndMemory($_POST['account_id'], $_POST['memory_id']);
        
        if (empty($this->id) && $shared) {
            throw new Exception("A record already exists for this!");
        }
        
        parent::handlePost($options);
    }
}