<h3>Notifications</h3>
<div class='notificationList'>
    <ul>
        <?php 
        foreach ($context as $notification) {
            $reference = $notification->getReference();
            ?>
            <li>
                <ul class='notification'>
                    <li class='notificationHeader'>
                        <form class='deleteForm ajaxDelete' action='<?php echo Wub_Controller::$url . "notification/" . $notification->id . "/delete";?>' method='post'>
                            <input type='hidden' name='action' value='delete'/>
                            <input type='hidden' name='_class' value='Wub_Notification'/>
                            <input type='hidden' name='id' value='<?php echo $notification->id;?>'/>
                            <input type='submit' value='Delete' class='ajaxDeleteButton'/>
                        </form>
                        <b><?php echo $reference->getName();?></b>
                        <em><?php echo Wub_Utilities::formatTime($notification->date_created);?></em>
                    </li>
                    <li class='notificationDetails'>
                        <?php echo $reference->getNotifyText($notification->save_type, $notification->to_id);?> <br/>
                        <a href='<?php echo $reference->getURL();?>'>View it now!</a>
                    </li>
                </ul>
            </li>
            <?php
        }
        ?>
    </ul>
</div>