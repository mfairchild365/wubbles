<h3>Memory</h3>
<?php 
if (Wub_Controller::getAccount() && Wub_Controller::getAccount()->id == $context->owner_id) {
    ?>
    <div class='ownerOptions'>
        <a href='<?php echo $context->getURL();?>/share/edit'>Share this memory</a>
    </div>
    <?php 
}
?>
<div class='memorySubject'><h4><?php echo $context->subject;?></h4></div>
<div class='memoryDetails'><?php echo $context->details?></div>