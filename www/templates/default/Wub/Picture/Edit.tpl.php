<?php
function get_var($var, $context) {
    if (isset($context->$var)) {
        return $context->$var;
    }
    
    return null;
}
?>

<h4><?php echo $context->getMemory()->subject . ": " . $context->title; ?></h4>

<div class='options'>
    <a href='<?php echo $context->getMemory()->getURL();?>' class='button'>Back to Memory</a>
    <?php 
    if ($context->getPictureURL()) {
        ?>
        <a href='<?php echo $context->getURL();?>' class='button'>View</a>
        <a href='<?php echo $context->getURL();?>/delete' class='button'>Delete</a>
        <?php 
    }
    ?>
</div>

<form name="input" class='ajaxForm' id='memoryForm' action="<?php echo $context->getEditURL(); ?>" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>Create/Edit Picture</legend>
        <ul>
            <li>
                <label for="title">Title</label>
                <input type="text" name="title" value="<?php echo get_var('title', $context);?>"/>
            </li>
            <?php if (empty($context->id)) {?>
                <li>
                    <label for="picture">Picture</label>
                    <span class='helper'><em>The file must be under 5mb and a jpg or png.</em></span>
                    <input type="file" name="picture" id="file" /> 
                </li>
            <?php }?>
            <li>
                <label for="caption">Caption:</label>
                <input type="text" name="caption" value="<?php echo get_var('caption', $context);?>"/>
            </li>
        </ul>
        <input type="hidden" name="id" value='<?php echo $context->id;?>'/>
        <input type="hidden" name="_class" value='<?php echo get_class($context->getRawObject()); ?>'/>
        <input type="submit" value="Submit" class='submit'/>
    </fieldset>
</form>