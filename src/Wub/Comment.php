<?php
class Wub_Comment extends Wub_Editable
{
    public $class;
    
    public $reference_id;
    
    public $comment;
    
    public static function getByID($id)
    {
        return self::getByAnyField('Wub_Comment', 'id', (int)$id);
    }

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
        return 'comments';
    }
    
    function getName()
    {
        return 'Comment';
    }
    
    public function getURL()
    {
        if (isset($this->id)) {
            return Wub_Controller::$url . "comment/" . $this->id;
        }
        return false;
    }
    
    public function getEditURL()
    {
        $id = "";
        if (empty($this->id)) {
            $id = $this->id . "/";
        }
        
        return Wub_Controller::$url . "comment/".$id."edit";
    }
}
