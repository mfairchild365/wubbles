Register.
<form name="input" action="<?php echo Wub_Controller::$url; ?>register" method="post">
    <ul>
        <li>
            email: <input type="text" name="email" />
        </li>
        <li>
            retype email: <input type="text" name="email2" />
        </li>
        <li>
            username  <input type="text" name="username" />
        </li>
        <li>
            password  <input type="password" name="password" />
        </li>
        <li>
            retype pssword  <input type="password" name="password2" />
        </li>
    </ul>
    <input type="hidden" name="_type" value='register'/>
    <input type="hidden" name="_class" value='<?php echo get_class($context->getRawObject()); ?>'/>
    <input type="submit" value="Submit" />
</form> 