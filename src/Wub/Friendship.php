<?php
class Wub_Friendship extends Wub_Record
{
    public $id;
    
    public $sender_id;
    
    public $reciever_id;
    
    public $date_sent;
    
    public $status;
    
    public $date_edited;
    
    public static function getByID($id)
    {
        return self::getByAnyField('friends', 'id', (int)$id);
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
        return 'friends';
    }
    
    function getName()
    {
        return 'Friend';
    }
}
