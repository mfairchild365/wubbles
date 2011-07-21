<form class='ajaxForm' id='loginform' name="input" action="<?php echo Wub_Controller::$url; ?>login" method="post">
    <fieldset>
        <legend>Login</legend>
        <p>Username or email: <br /><input type="text" name="email" /></p>
        <p>password  <br /><input type="password" name="password" /></p>
        <input type="hidden" name="_type" value='login'/>
        <input type="hidden" name="_class" value='<?php echo get_class($context->getRawObject()); ?>'/>
        <input type="submit" value="Submit" />
    </fieldset>
</form> 