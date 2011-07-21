<?php
function get_var($var, $context) {
    if (isset($context->$var)) {
        return $context->$var;
    }
    
    return null;
}
?>

<form name="input" class="ajaxForm" id='memoryForm' action="<?php echo $context->getEditURL(); ?>" method="post">
    <fieldset>
        <legend>Create/Edit Memory</legend>
            <p>
                <label for="name">Subject</label>
                <input type="text" name="subject" value="<?php echo get_var('subject', $context);?>"/>
            </p>
            <p>
                <label for="description">Details</label>
                <textarea rows="10" cols="20" name="details"><?php echo get_var('details', $context);?></textarea>
            </p>
        <input type="hidden" name="id" value='<?php echo $context->id;?>'/>
        <input type="hidden" name="_class" value='<?php echo get_class($context->getRawObject()); ?>'/>
        <input type="submit" value="Submit" />
    </fieldset>
</form>