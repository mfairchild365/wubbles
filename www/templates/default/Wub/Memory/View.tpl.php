<div class='memorySubject'><h4>Subject: <?php echo $context->subject;?></h4></div>
<?php 
if (Wub_Controller::getAccount() && Wub_Controller::getAccount()->id == $context->owner_id) {
    ?>
    <div class='options'>
        <a href='<?php echo $context->getURL();?>/share/edit' class='button'>Share</a>
        <a href='<?php echo $context->getEditURL();?>' class='button'>Edit</a>
    </div>
    <?php 
}
?>

<div class='colleft'>
    <h4>Pictures</h4>
    <ul>
        <?php 
        foreach ($context->getPictures(10) as $picture) {
            echo "<li><img src='" . $picture->getThumbURL() . "' title='" . $picture->title . "' /></li>";
        }
        ?>
    </ul>
</div>

<div class='colmid'>
    <h4>Details:</h4>
    <div class='memoryDetails'><?php echo html_entity_decode($context->details)?></div>
    
</div>

<div class='colright'>
    <h4>Info</h4>
    <ul>
        <li><b>Permission:</b> <?php echo $context->permission;?></li>
        <li><b>created:</b> <?php echo date("F j, Y, g:i a", $context->date_created);?></li>
        <li><b>edited:</b> <?php echo date("F j, Y, g:i a", $context->date_edited);?></li>
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
                        foreach($context->getMembersListIDs() as $member) {
                            //echo $member;
                            echo "<li>" . Wub_Account::getByID($member)->getFullName() . "</li>";
                        }
                        break;
                }
                
                ?>
            </ul>
        </li>
    </ul>
</div>