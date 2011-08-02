<h3><?php echo $context->getFullName();?></h3>

<div class='options'>
    <?php
    if (Wub_Controller::getAccount() && $context->canEdit()) {
        ?>
        <a href='<?php echo $context->getURL();?>/edit' class='button'>Edit Account</a>
        <a href='<?php echo $context->getURL();?>/edit/password' class='button'>Change Passwordt</a>
        <?php 
    }
    ?>
    <a href='<?php echo $context->getURL();?>/timeline' class='button'>Timeline</a>
</div>
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
<div class='sharedMemories'>
    <h4>Memories shared with you:</h4>
    <ul>
        <?php 
        if (Wub_Controller::getAccount()) {
            foreach (Wub_SharedMemory_List::getByAccountAndOwner(Wub_Controller::getAccount()->id, $context->id) as $sharedMemory) {
                $memory = $sharedMemory->getMemory();
                echo "<li><a href='" . $memory->getURL() . "'>" . $memory->subject . "</a></li>";
            }
        }
        ?>
    </ul>
</div>
