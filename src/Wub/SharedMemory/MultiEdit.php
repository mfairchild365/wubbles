<?php
class Wub_SharedMemory_MultiEdit extends Wub_SharedMemory
{
    function __construct($options = array())
    {
        if (!isset($options['memory_id'])) {
            throw new Exception("You must select a memory!", 400);
        }
        
        $this->memory_id = $options['memory_id'];
        
        if (!$memory = Wub_Memory::getByID($options['memory_id'])) {
            throw new Exception("Could not find that memory!", 400);
        }
        
        if (!$this->getMemory()->canEdit()) {
            throw new Exception("You do not have permission to share this.", 401);
        }
        
        parent::__construct($options);
    }
    
    function handlePost($options = array())
    {
        $sharedWith = array();
        foreach (Wub_SharedMemory_List::getByMemory($this->memory_id) as $shared) {
            $sharedWith[] = $shared->account_id;
        }
        
        foreach ($_POST['sharewith'] as $friendID) {
            //check if it is already shared with them.
            if (!in_array($friendID, $sharedWith)) {
                //share with them.
                $this->shareMemory($friendID);
                $sharedWith[] = $friendID;
            }
            
        }
        
        //remove everyone that wasn't shared with.
        foreach ($sharedWith as $accountID) {
            if (!in_array($accountID, $_POST['sharewith'])) {
                $this->removeSharedMemory($accountID);
            }
        }
        
        Wub_Controller::redirect(Wub_Controller::$url . "success?for=multishare");
    }
    
    private function removeSharedMemory($accountID) {
        $sharedMemory = Wub_SharedMemory::getByAccountAndMemory($accountID, $this->memory_id);
        $sharedMemory->delete();
    }
    
    private function shareMemory($accountID) {
        $sharedMemory = new Wub_SharedMemory();
        $sharedMemory->memory_id    = $this->memory_id;
        $sharedMemory->account_id   = $accountID;
        $sharedMemory->permission   = 'view';
        $sharedMemory->owner_id     = Wub_Controller::getAccount()->id;
        $sharedMemory->date_created = time();
        $sharedMemory->date_edited  = time();
        
        $sharedMemory->save();
        
    }
}