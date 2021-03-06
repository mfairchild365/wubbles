<div class='memorySubject'><h4><?php echo $context->subject;?></h4></div>
<?php 
if (Wub_Controller::getAccount() && $context->canEdit()) {
    ?>
    <div class='options'>
        <a href='<?php echo $context->getURL();?>/share/multiedit' class='button'>Share</a>
        <a href='<?php echo $context->getEditURL();?>' class='button'>Edit</a>
        <a href='<?php echo $context->getAddPhotoURL();?>' class='button'>Add A Photo</a>
        <div style='clear:both'></div>
    </div>
    <?php 
}
?>

<div class='colleft'>
    <h4>Pictures</h4>
    <div class='photoList'>
        <ul>
            <?php 
            foreach ($context->getPictures(10) as $picture) {
                echo "<li><a href='" . $picture->getURL() . "'><img src='" . $picture->getThumbURL() . "' title='" . $picture->title . "' /></a></li>";
            }
            ?>
        </ul>
    </div>
</div>

<div class='colmid'>
    <div class='memoryDate'>
        From: <?php echo date('M-d-Y',  $context->start_date);?> 
        To:  <?php 
        if ($context->end_date == 1) {
            echo " Ongoing";
        } else {
            echo date('M-d-Y', $context->end_date);
        }
        ?>
    </div>
    <h4>Details:</h4>
    <div class='memoryDetails'><?php echo html_entity_decode($context->details)?></div>
    
</div>

<div class='colright'>
    <h4>Info</h4>
    <ul>
        <li>
            <b>Posted By:</b> <a href='<?php echo $context->getAccount()->getURL(); ?>'><?php echo $context->getAccount()->getFullName(); ?></a>
        </li>
        <li><b>Permission:</b> <?php echo $context->permission;?></li>
        <li><b>created:</b> <?php echo Wub_Utilities::formatTime($context->date_created);?></li>
        <li><b>edited:</b> <?php echo Wub_Utilities::formatTime($context->date_edited);?></li>
        <li>
            <b>People who can view this:</b>
            <ul>
                <?php 
                switch ($context->permission) {
                    case 'public':
                        echo "<li>Anyone</li>";
                        break;
                    case 'friends':
                        echo "<li>Friends</li>";
                        break;
                    case 'private':
                    default:
                        foreach($context->getMembersList() as $member) {
                            //echo $member;
                            echo "<li>" . $member->getFullName() . "</li>";
                        }
                        break;
                }
                
                ?>
            </ul>
        </li>
    </ul>
</div>

<div style='clear:both'></div>

<?php if ($context->permission == 'public'):?>
    <div class='share'>
       <?php echo Wub_Controller::$share?>
    </div>
<?php endif;?>