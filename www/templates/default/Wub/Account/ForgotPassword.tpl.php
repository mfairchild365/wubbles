<form class='ajaxForm' name="input" action="<?php echo Wub_Controller::$url; ?>resetPassword" method="post">
    <fieldset>
        <legend>Reset Password</legend>
        <ul>
            <li>
                <label>Username or Email:</label>
                <span class='helper'>Enter your username or email address to reset your password.</span>
                <input type="text" name="username" value=""/>
            </li>
        </ul>
        <input type="hidden" name="_type" value='resetPassword'/>
        <input type="hidden" name="_class" value='<?php echo get_class($context->getRawObject()); ?>'/>
        <input type="submit" value="Submit" class='submit' />
    </fieldset>
</form> 