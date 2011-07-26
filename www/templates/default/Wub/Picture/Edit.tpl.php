<?php
function get_var($var, $context) {
    if (isset($context->$var)) {
        return $context->$var;
    }
    
    return null;
}
?>

<form name="input"  id='memoryForm' action="<?php echo $context->getEditURL(); ?>" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>Create/Edit Picture</legend>
        <ul>
            <li>
                <label for="title">Title</label>
                <input type="text" name="title" value="<?php echo get_var('title', $context);?>"/>
            </li>
            <li>
                <label for="picture">Picture</label>
                <span class='helper'><em>The file must be under 2mb and a jpg or png.</em></span>
                <input type="file" name="picture" id="file" /> 
            </li>
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