<?php
function get_var($var, $context) {
    if (isset($context->$var)) {
        return $context->$var;
    }
    
    return null;
}
?>

<?php 
if (!empty($context->id)) {
    ?>
    <div class='options'>
        <a href='<?php echo $context->getURL();?>' class='button'>View</a>
        <a href='<?php echo $context->getURL();?>/delete' class='button'>Delete</a>
    </div>
    <?php 
}
?>

<form name="input" class="ajaxForm" id='memoryForm' action="<?php echo $context->getEditURL(); ?>" method="post">
    <fieldset>
        <legend>Create/Edit Memory</legend>
        <ul>
            <li>
                <label for="subject">Subject</label>
                <input type="text" name="subject" value="<?php echo get_var('subject', $context);?>"/>
            </li>
            <li>
                <label for="details">Details</label>
                <textarea rows="15" cols="60" name="details" class="wysiwyg"><?php echo get_var('details', $context);?></textarea>
            </li>
            <li>
                <label for="permission">Permission:</label>
                <span class='helper'><em>Select the scope of the visibility for this memory.</em></span>
                <select name="permission">
                    <option value="private">private</option>
                </select>
            </li>
        </ul>
        <input type="hidden" name="id" value='<?php echo $context->id;?>'/>
        <input type="hidden" name="_class" value='<?php echo get_class($context->getRawObject()); ?>'/>
        <input type="submit" value="Submit" class='submit'/>
    </fieldset>
</form>