<h3><?php echo $context->getFullName();?></h3>
<?php 
if (Wub_Controller::getAccount() && $context->id != Wub_Controller::getAccount()->id) {
    if (!$friendship = Wub_Friendship::getFriendship(Wub_Controller::getAccount()->id, $context->id)) {
        echo "<a href='" . $context->getURL() . "/request/send'>Send a friend request</a>";
    } else if ($friendship->status == 'sent') {
        if ($friendship->reciever_id == Wub_Controller::getAccount()->id) {
            echo "<a href='" . $context->getURL() . "/request/accept'>Accept</a> or <a href='" . $context->getURL() . "/request/reject'>Reject</a> the friendship request";
        } else {
            echo "Your friendship is pending";
        }
    }
    
}
?>
