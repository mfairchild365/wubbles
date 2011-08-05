<?php
function get_var($var, $context) {
    if (isset($context->$var)) {
        return $context->$var;
    }
    
    return null;
}

$code = "";
if (isset($_GET['code'])) {
    $code = "?code=" . $_GET['code'];
}

if (!empty($context->id) && Wub_Controller::getAccount() && $context->canEdit()) {
    ?>
    <div class='options'>
        <a href='<?php echo $context->getURL();?>/edit' class='button'>Edit Account</a>
        <div style='clear:both'></div>
    </div>
    <?php 
}
?>

<form  name="input" class='ajaxForm' action="<?php echo $context->getEditURL(); ?>/password<?php echo $code ?>" method="post">
    <fieldset>
    <legend>Edit Password</legend>
        <ul>
            <li>
                <label>password:</label> <input type="password" name="password" value=""/>
            </li>
            <li>
                <label>retype pssword:</label><input type="password" name="password2" value=""/>
            </li>
        </ul>
    <input type="hidden" name="id" value='<?php echo $context->id;?>'/>
    <input type="hidden" name="_class" value='<?php echo get_class($context->getRawObject()); ?>'/>
    <input type="submit" value="Submit" class='submit' />
    </fieldset>
</form> 