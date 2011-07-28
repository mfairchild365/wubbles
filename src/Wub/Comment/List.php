<?php
class Wub_Comment_List extends Wub_List
{
    function __construct($options = array())
    {
         if (!isset($options['model']) || $options['model'] != 'Wub_Comment_List') {
            parent::__construct($options);
            return;
        }
        
        if (!isset($options['class']) || empty($options['class'])) {
            throw new Exception("No reference class provided!");
        }
        
        if (!isset($options['reference_id']) || empty($options['reference_id'])) {
            throw new Exception("No reference ID provided!");
        }
        
        $options['returnArray'] = true;
        
        $options['array'] = self::getAllCommentsByClassAndID($options['class'], $options['reference_id'], $options);
        
        parent::__construct($options);
    }
    
    function getDefaultOptions()
    {
        $options = array();
        $options['itemClass'] = 'Wub_Comment';
        $options['listClass'] = 'Wub_Comment_List';
        
        return $options;
    }
    
    public static function getAllCommentsByClassAndID($class, $id, $options = array())
    {
        $db = Wub_Controller::getDB();
        $options        = $options + self::getDefaultOptions();
        $options['sql'] = "SELECT id FROM comments WHERE class = '" . $db->escape_string($class) . "' AND reference_id = " . (int)$id . " ORDER BY date_created ASC";
        return self::getBySql($options);
    }

}