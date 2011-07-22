<?php
class Wub_Account_FriendRequest extends Wub_Account
{
    function __construct($options = array())
    {
        parent::__construct($options);
        
        Wub_Controller::requireLogin();
        
        $this->password = NULL;
        
        if (Wub_Controller::getAccount()->id == $this->id) {
            throw new Exception("You can not preform this action on yourself");
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
                throw new Exception("Unknown type of friend request was sent.", 404);
        }
    }
    
    function sendFriendReqest()
    {
        if ($friendship = Wub_Friendship::getFriendship(Wub_Controller::getAccount()->id, $this->id)) {
            switch ($friendship->status) {
                case 'sent':
                    throw new Exception("A request has already been sent.  Please wait for the chap to respond.");
                    break;
                case 'accepted':
                    throw new Exception("You are already friends with this person, silly.");
                    break;
                case 'blocked':
                    throw new Exception("You can not friend request this person.");
                    break;
                default:
                    throw new Exception("You can not friend request this person.");
            }
        }
        
        $friendship = new Wub_Friendship();
        $friendship->sender_id   = Wub_Controller::getAccount()->id;
        $friendship->reciever_id = $this->id;
        $friendship->date_sent   = time();
        $friendship->date_edited = time();
        $friendship->status      = "sent";
        
        if (!$friendship->insert()) {
            throw new Exception("There was an error saving.");
        }
        
        Wub_Controller::redirect(Wub_Controller::$url . 'success?for=friendship_sent');
    }
}