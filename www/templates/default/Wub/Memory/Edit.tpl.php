<?php
function get_var($var, $context) {
    if (isset($context->$var)) {
        return $context->$var;
    }
    
    return null;
}

if (!empty($context->id)) {
    ?>
    <div class='options'>
        <a href='<?php echo $context->getURL();?>' class='button'>View</a>
        <form class='deleteForm' action='<?php echo $context->getEditURL();?>' method='post'>
            <input type='hidden' name='action' value='delete'/>
            <input type='hidden' name='_class' value='Wub_Memory_Edit'/>
            <input type='hidden' name='id' value='<?php echo $context->id;?>'/>
            <input type='submit' value='Delete' class='button'/>
        </form>
        <div style='clear:both'></div>
    </div>
    <?php 
}
?>

<script type="text/javascript">
$(function() {
    $(".datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
    });

    $( "#importanceSlider" ).slider({
        range: "min",
        value: 20,
        min: 1,
        max: 100,
        slide: function( event, ui ) {
            $( "#importanceValue" ).val(ui.value);
        }
    });
  
});
</script>

<form name="input" class='ajaxForm' id='memoryForm' action="<?php echo $context->getEditURL(); ?>" method="post">
    <fieldset>
        <legend>Create/Edit Memory</legend>
        <ul>
            <li>
                <label for="subject">Subject</label>
                <input type="text" name="subject" value="<?php echo get_var('subject', $context);?>"/>
            </li>
            <li>
                <label for="subject">Start Date</label>
                <input type="text" class='datepicker' name="start_date" value="<?php echo date('Y-m-d', get_var('start_date', $context));?>"/>
            </li>
            <li>
                <label for="subject">End Date</label>
                <input type="text" class='datepicker' name="end_date" value="<?php echo date('Y-m-d', get_var('end_date', $context));;?>"/>
            </li>
            <li>
                <label for="details">Details</label>
                <textarea rows="15" cols="60" name="details" class="wysiwyg"><?php echo get_var('details', $context);?></textarea>
            </li>
            <li>
                <label for="importance">Importance</label>
                <span class='helper'><em>Overall importance and impact on your life.  1 to 100.</em></span>
                <div id='importanceSlider' style='margin:5px'></div>
                <input type="text" id='importanceValue' name="importance" readonly="readonly" value="<?php echo get_var('importance', $context);?>"/>
            </li>
            <li>
                <label for="permission">Permission:</label>
                <span class='helper'><em>Select the scope of the visibility for this memory.</em></span>
                <select name="permission">
                    <option value="private" <?php echo (get_var('permission', $context) == "private")?"selected='selected'":"";?>>private</option>
                    <option value="public" <?php echo (get_var('permission', $context) == "public")?"selected='selected'":"";?>>public</option>
                </select>
            </li>
        </ul>
        <input type="hidden" name="id" value='<?php echo $context->id;?>'/>
        <input type="hidden" name="_class" value='<?php echo get_class($context->getRawObject()); ?>'/>
        <input type="submit" value="Submit" class='submit'/>
    </fieldset>
</form>