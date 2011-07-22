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
        <p>First Name: <br /><input type="text" name="firstname" value="<?php echo get_var('firstname', $context);?>"/></p>
        <p>Last Name: <br /><input type="text" name="lastname" value="<?php echo get_var('lastname', $context);?>"/></p>
        <p>email: <br /><input type="text" name="email" value="<?php echo get_var('email', $context);?>"/></p>
        <p>retype email: <br /><input type="text" name="email2" value="<?php echo get_var('email', $context);?>"/></p>
        <p>username: <br /><input type="text" name="username" value="<?php echo get_var('username', $context);?>"/></p>
        <p>password: <br /><input type="password" name="password" value="<?php echo get_var('password', $context);?>"/></p>
        <p>retype pssword: <br /><input type="password" name="password2" value="<?php echo get_var('password', $context);?>"/></p>
    <input type="hidden" name="id" value='<?php echo $context->id;?>'/>
    <input type="hidden" name="_class" value='<?php echo get_class($context->getRawObject()); ?>'/>
    <input type="submit" value="Submit" />
    </fieldset>
</form> 