<?php
abstract class Wub_Editable extends Wub_Record implements Wub_Permissionable
{
    //Require these for every Wub_Editable class.
    public $id;
    
    public $date_created;
    
    public $date_edited;
    
    public $owner_id;
    
    function __construct($options = array())
    {
        //Check to see if we are editing this bro.
        if (isset($options['model']) && get_called_class() != $options['model']) {
            //We are not viewing this model, return.
            return;
        }
        
        //An Id was not passed, so we are just making a new one.
        if (!isset($options['id'])) {
            return;
        }
        
        if (!$class = $this->getByID($options['id'])) {
            throw new Exception("Could not find that", 400);
        }
        
        $this->synchronizeWithArray($class->toArray());
        
        if (isset($options['model']) && substr($options['model'], -5) != '_Edit') {
            //We are not viewing the Edit model for this class, return.
            return;
        }
        
        //We are editing... require login.
        Wub_Controller::requireLogin();
        
        if (!$this->canEdit()) {
            throw new Exception("You do not have permission to edit this.", 401);
        }
    }
    
    function handlePost($options = array())
    {
        //check if the id was changed via post.  This is a big no no.
        if (isset($this->id) && !empty($this->id) && ($this->id != $_POST['id'])) {
            throw new Exception("Id was changed in POST, record not saved.", 400);
        }
        
        if (!$this->canEdit()) {
            throw new Exception("You do not have permission to edit this!", 401);
        }
        
        $this->synchronizeWithArray($_POST);
        
        //set the owner if not set.
        if (empty($this->owner_id)) {
            $this->owner_id = Wub_Controller::getAccount()->id;
        }
        
        $this->date_edited = time();
        
        $saveType = 'create';
        if (isset($this->id) && !empty($this->id)) {
            $saveType = 'save';
        }
        
        if ($saveType == 'create') {
            //set the date_created if not set.
            $this->date_created = time();
            
            if ($this->isDuplicate()) {
                return;
            }
        }
        
        if (!$this->save()) {
            throw new Exception("There was an error saving this.", 500);
        }
        
        $redirectURL = Wub_Controller::$url.'success?for='.$this->getTable().'&saveType=' . $saveType;
        
        //check if a continue url was passed.
        if (isset($options['continueURL'])) {
            $redirectURL .= "&continueURL=";
            
            switch($options['continueURL']) {
                case "edit":
                    $redirectURL .= $this->getURL() . "/edit";
                    break;
                case "view":
                    $redirectURL .= $this->getURL();
                    break;
                default:
                    $redirectURL .= $options['onCreate']['continueURL'];
                    break;
            }
            
        }
        
        Wub_Controller::redirect($redirectURL);
    }
    
    //This function attempts to check if the save button was pressed twice (or more) when creating.
    function isDuplicate()
    {
        if (!isset($this->owner_id)) {
            return false;
        }
        
        if (!isset($this->date_created)) {
            return false;
        }
        
        //See if anything exists by the person creating the object in the same table within the last 3 seconds.
        $sql = "SELECT id FROM " . $this->getTable() . " WHERE owner_id = " . (int)$this->owner_id . " AND date_created >= " . ((int)$this->date_created - 3 . " LIMIT 1");
        $mysqli = Wub_Controller::getDB();
        $result = $mysqli->query($sql);
        if ($result->num_rows) {
            return true;
        }
        return false;
    }
    
    function canEdit()
    {
        //We are creating a new one here...
        if (!isset($this->id) || empty($this->id)) {
            return true;
        }
        
        //for accoutns.
        if ($this->owner_id == NULL && $this->id == Wub_Controller::getAccount()->id && $this->getTable() == 'accounts') {
            return true;
        }
        
        if (isset($this->owner_id) && $this->owner_id == Wub_Controller::getAccount()->id) {
            return true;
        }
        
        if (Wub_Controller::isAdmin(Wub_Controller::getAccount()->id)) {
            return true;
        }
        
        return false;
    }
    
    function canDelete()
    {
        if (!$account = Wub_Controller::getAccount()) {
            return false;
        }
        
        if ($account->isAdmin()) {
            return true;
        }
        
        if ($account->id == $this->owner_id) {
            return true;
        }
        
        return false;
    }
    
    function handleDelete() {
        if (isset($_POST['action']) && $_POST['action'] == 'delete') {
            if (!$this->canDelete()) {
                throw new Exception("You do not have permission to delete this.", 401);
            }
            
            $this->delete();
            
            Wub_Controller::redirect(Wub_Controller::$url . "success?for=".$this->getTable()."_delete");
        }
    }
}