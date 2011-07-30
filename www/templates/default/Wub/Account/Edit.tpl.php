<?php
function get_var($var, $context) {
    if (isset($context->$var)) {
        return $context->$var;
    }
    
    return null;
}
?>

<form class='ajaxForm' name="input" action="<?php echo $context->getEditURL(); ?>" method="post">
    <fieldset>
    <legend>Create/Edit Account</legend>
        <ul>
            <li>
                <label>First Name:</label> <input type="text" name="firstname" value="<?php echo get_var('firstname', $context);?>"/>
            </li>
            <li>
                <label>Last Name:</label> <input type="text" name="lastname" value="<?php echo get_var('lastname', $context);?>"/>
            </li>
            <li>
                <label>email:</label> <input type="text" name="email" value="<?php echo get_var('email', $context);?>"/>
            </li>
            <li>
                <label>retype email:</label> <input type="text" name="email2" value="<?php echo get_var('email', $context);?>"/>
            </li>
            <li>
                <label>username:</label> <input type="text" name="username" value="<?php echo get_var('username', $context);?>"/>
            </li>
            <li>
                <label>password:</label> <input type="password" name="password" value="<?php echo get_var('password', $context);?>"/>
            </li>
            <li>
                <label>retype pssword:</label><input type="password" name="password2" value="<?php echo get_var('password', $context);?>"/>
            </li>
            <li>
                <label>Recieve Notification Emails:</label>
                <span class='helper'><em>You can can choose to opt-out of them here.</em></span>
                <select name="email_notifications">
                    <option value="1" <?php echo (get_var('email_notifications', $context) == 1)?"selected='selected'":"";?>>Yes please</option>
                    <option value="0" <?php echo (get_var('email_notifications', $context) == 0)?"selected='selected'":"";?>>No way</option>
                </select>
            </li>
        </ul>
    <input type="hidden" name="id" value='<?php echo $context->id;?>'/>
    <input type="hidden" name="_class" value='<?php echo get_class($context->getRawObject()); ?>'/>
    <input type="submit" value="Submit" class='submit' />
    </fieldset>
</form> 