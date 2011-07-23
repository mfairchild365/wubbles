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
    </ul>
</div>