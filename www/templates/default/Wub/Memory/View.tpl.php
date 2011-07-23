<h3>Memory</h3>
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
<div class='memorySubject'><h4><?php echo $context->subject;?></h4></div>
<div class='memoryDetails'><?php echo html_entity_decode($context->details)?></div>