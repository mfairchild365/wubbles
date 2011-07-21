<form class='ajaxform' name="input" action="<?php echo Wub_Controller::$url; ?>register" method="post">
    <fieldset>
    <legend>Register</legend>
        <p>First Name: <br /><input type="text" name="firstname" /></p>
        <p>Last Name: <br /><input type="text" name="lastname" /></p>
        <p>email: <br /><input type="text" name="email" /></p>
        <p>retype email: <br /><input type="text" name="email2" /></p>
        <p>username: <br /><input type="text" name="username" /></p>
        <p>password: <br /><input type="password" name="password" /></p>
        <p>retype pssword: <br /><input type="password" name="password2" /></p>
    <input type="hidden" name="_type" value='register'/>
    <input type="hidden" name="_class" value='<?php echo get_class($context->getRawObject()); ?>'/>
    <input type="submit" value="Submit" />
    </fieldset>
</form> 