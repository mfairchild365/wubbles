<h4><?php echo $context->title; ?></h4>
<div class='options'>
    <a href='<?php echo $context->getMemory()->getURL();?>' class='button'>Back to Memory</a>
    <?php 
    if (Wub_Controller::getAccount() && $context->canEdit()) {
        ?>
        <a href='<?php echo $context->getEditURL();?>' class='button'>Edit</a>
        <?php 
    }
    ?>
</div>
<div class='picture'>
    <img src='<?php echo $context->getPictureURL(); ?>' />
</div>

<div class='pictureCaption'>
    <?php echo $context->caption;?>
</div>