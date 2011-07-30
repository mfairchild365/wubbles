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
                        <b><?php echo $reference->getName();?></b>
                        <em><?php echo Wub_Utilities::formatTime($notification->date_created);?></em>
                        <a href='<?php echo Wub_Controller::$url . "notification/" . $notification->id?>/delete' class='confirmLink ajaxDelete'>delete</a>
                    </li>
                    <li class='notificationDetails'>
                        <?php echo $reference->getNotifyText($notification->save_type);?> <br/>
                        <a href='<?php echo $reference->getURL();?>'>View it now!</a>
                    </li>
                </ul>
            </li>
            <?php
        }
        ?>
    </ul>
</div>