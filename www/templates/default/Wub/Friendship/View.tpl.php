<h3>Friendship</h3>
<b>Friendship between: <?php echo Wub_Account::getByID($context->sender_id)->getFullName();?> 
                  and <?php echo Wub_Account::getByID($context->reciever_id)->getFullName();?></b>

<div class='details'>
    <?php 
    switch ($context->status) {
        case 'sent':
            if ($context->reciever_id == Wub_Controller::getAccount()->id) {
                echo "<a href='" . Wub_Controller::$url . 'account/' . $context->sender_id . "/request/accept'>Accept</a> or <a href='". Wub_Controller::$url . 'account/' . $context->sender_id .  "/request/reject'>Reject</a> the friendship request";
            } else {
                echo "Your friendship is pending";
            }
            break;
        case 'accepted':
            echo "Status: Accepted";
            break;
        default:
            break;
    }
    ?>
</div>