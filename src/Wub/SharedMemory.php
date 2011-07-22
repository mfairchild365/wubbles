<?php
class Wub_SharedMemory extends Wub_Editable
{
    public $memory_id;
    
    public $account_id;
    
    public $permission;

    function insert()
    {
        return parent::insert();
    }
    
    function keys()
    {
        return array('id');
    }
    
    public static function getTable()
    {
        return 'shared_memory';
    }
    
    public static function getByID($id)
    {
        return self::getByAnyField('Wub_SharedMemory', 'id', (int)$id);
    }
    
    function getName()
    {
        return 'Shared Memory';
    }
    
    public function getEditURL()
    {
        $id = "";
        if (isset($this->id)) {
            $id = $this->id . "/";
        }
        
        return Wub_Memory::getByID($this->memory_id)->getURL() . "/share/".$id."edit";
    }
    
    public static function getByAccountaAndMemory($account_id, $memory_id)
    {
        $mysqli = Wub_Controller::getDB();
        $sql    = "SELECT id FROM shared_memory 
                   WHERE (account_id = " . (int)$account_id . " AND memory_id = " . (int)$memory_id . ")
                   LIMIT 1;";
        
        if (!$result = $mysqli->query($sql)) {
            return false;
        }
        
        $row = $result->fetch_array(MYSQLI_ASSOC);
        
        return self::getByID($row['id']);
    }
}
