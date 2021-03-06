<h4><?php echo $context->getMemory()->subject . ": " . $context->title; ?></h4>
<div class='options'>
    <a href='<?php echo $context->getMemory()->getURL();?>' class='button'>Back to Memory</a>
    <?php 
    if (Wub_Controller::getAccount() && $context->canEdit()) {
        ?>
        <a href='<?php echo $context->getEditURL();?>' class='button'>Edit</a>
        <?php 
    }
    ?>
    <div style='clear:both'></div>
</div>
<div class='picture'>
    <img src='<?php echo $context->getPictureURL(); ?>' />
    <div class='pictureCatpion'>
        <?php echo $context->caption;?>
    </div>
</div>

<?php if ($context->getMemory()->permission == 'public'):?>
    <div class='share'>
       <?php echo Wub_Controller::$share?>
    </div>
<?php endif;?>
