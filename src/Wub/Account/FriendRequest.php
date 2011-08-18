<?php
class Wub_Account_FriendRequest extends Wub_Account
{
    function __construct($options = array())
    {
        parent::__construct($options);
        
        Wub_Controller::requireLogin();
        
        $this->password = NULL;
        
        if (Wub_Controller::getAccount()->id == $this->id) {
            throw new Exception("You can not preform this action on yourself", 400);
        }
        
        switch($options['type']) {
            case 'send':
                $this->sendFriendReqest();
                break;
            case 'accept':
                $this->acceptFriendRequest();
                break;
            case 'reject':
                $this->rejectFriendRequest();
                break;
            case 'block':
            default:
                throw new Exception("Unknown type of friend request was sent.", 500);
        }
    }
    
    function sendFriendReqest()
    {
        if ($friendship = Wub_Friendship::getFriendship(Wub_Controller::getAccount()->id, $this->id)) {
            switch ($friendship->status) {
                case 'sent':
                    throw new Exception("A request has already been sent.  Please wait for the chap to respond.", 400);
                    break;
                case 'accepted':
                    throw new Exception("You are already friends with this person, silly.", 400);
                    break;
                case 'blocked':
                    throw new Exception("You can not friend request this person.", 403);
                    break;
                default:
                    throw new Exception("You can not friend request this person.", 403);
            }
        }
        
        $friendship = new Wub_Friendship();
        $friendship->sender_id   = Wub_Controller::getAccount()->id;
        $friendship->reciever_id = $this->id;
        $friendship->date_sent   = time();
        $friendship->date_edited = time();
        $friendship->status      = "sent";
        
        if (!$friendship->save()) {
            throw new Exception("There was an error saving.", 500);
        }
        
        Wub_Controller::redirect(Wub_Controller::$url . 'success?for=friendship_sent');
    }
    
    function acceptFriendRequest()
    {
        if (!$friendship = Wub_Friendship::getFriendship(Wub_Controller::getAccount()->id, $this->id)) {
            throw new Exception("Friend request not found.", 400);
        }
        
        if ($friendship->reciever_id != Wub_Controller::getAccount()->id) {
            throw new Exception("You can only accept this if you are the reciever, silly.", 400);
        }
        
        if ($friendship->status != 'sent') {
            throw new Exception("You can not accept this request", 400);
        }
        
        $friendship->status = 'accepted';
        $friendship->date_edited = time();
        $friendship->save();
        
        Wub_Controller::redirect(Wub_Controller::$url . 'success?for=friendship_accepted');
    }
    
    function rejectFriendRequest()
    {
        if (!$friendship = Wub_Friendship::getFriendship(Wub_Controller::getAccount()->id, $this->id)) {
            throw new Exception("Friend request not found.", 400);
        }
        
        if ($friendship->reciever_id != Wub_Controller::getAccount()->id) {
            throw new Exception("You can only reject this if you are the reciever, silly.", 400);
        }
        
        if ($friendship->status != 'sent') {
            throw new Exception("You can not reject this request", 400);
        }
        
        $friendship->status = 'rejected';
        $friendship->date_edited = time();
        $friendship->save();
        
        Wub_Controller::redirect(Wub_Controller::$url . 'success?for=friendship_rejected');
    }
}