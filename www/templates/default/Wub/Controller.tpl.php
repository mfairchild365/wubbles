<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="Description" content="A place for you to upload and share your memories.">
<title>Wubbles Memories</title>
<link type="text/css" href="<?php echo Wub_Controller::$url?>www/css/main.css" rel="stylesheet" />
<link type="text/css" href="<?php echo Wub_Controller::$url?>www/css/ajaxForm.css" rel="stylesheet" />
<link type="text/css" href="<?php echo Wub_Controller::$url?>www/css/commentForm.css" rel="stylesheet" />
<link type="text/css" href="<?php echo Wub_Controller::$url?>www/css/Comments.css" rel="stylesheet" />
<link type="text/css" href="<?php echo Wub_Controller::$url?>www/css/Notifications.css" rel="stylesheet" />
<link type="text/css" href="<?php echo Wub_Controller::$url?>www/css/dot-luv/jquery-ui-1.8.12.custom.css" rel="stylesheet" />
<link type="text/css" href="<?php echo Wub_Controller::$url?>www/css/jquery.wysiwyg.css" rel="stylesheet" />
<link type="text/css" href="<?php echo Wub_Controller::$url?>www/js/chosen/chosen.css" rel="stylesheet" />
<link type="text/css" href="<?php echo Wub_Controller::$url?>www/css/Timeglider.css" rel="stylesheet" />
<link type="text/css" href="<?php echo Wub_Controller::$url?>www/css/Timeline.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo Wub_Controller::$url?>www/js/jquery-1.6.min.js"></script>
<script type="text/javascript" src="<?php echo Wub_Controller::$url?>www/js/jquery-ui-1.8.12.custom.min.js"></script>
<script type="text/javascript" src="<?php echo Wub_Controller::$url?>www/js/chosen/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Wub_Controller::$url?>www/js/jquery.form.js"></script> 
<script type="text/javascript" src="<?php echo Wub_Controller::$url?>www/js/confirmLinks.js"></script>
<script type="text/javascript" src="<?php echo Wub_Controller::$url?>www/js/ui.spinner.min.js"></script>
<script type="text/javascript" src="<?php echo Wub_Controller::$url?>www/js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="<?php echo Wub_Controller::$url?>www/js/controls/wysiwyg.image.js"></script>
<script type="text/javascript" src="<?php echo Wub_Controller::$url?>www/js/controls/wysiwyg.link.js"></script>
<script type="text/javascript" src="<?php echo Wub_Controller::$url?>www/js/controls/wysiwyg.table.js"></script>
<script type="text/javascript" src="<?php echo Wub_Controller::$url?>www/js/confirmDeleteForm.js"></script>
<script type="text/javascript">var switchTo5x=true;</script><script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script><script type="text/javascript">stLight.options({publisher:'7c3847b8-c7c5-44cc-9bce-f65fa168f4b9'});</script>
</head>
<body>
    <?php echo Wub_Controller::$analytics;?>
    <script type="text/javascript">
    $(function() {
        $( "#dialog-message" ).dialog({
            autoOpen: false,
            modal: true,
            minWidth: 600,
        });
        $('.ui-state-default').hover(
                function(){ $(this).addClass('ui-state-hover'); }, 
                function(){ $(this).removeClass('ui-state-hover'); }
        );
        $('.ui-state-default').click(function(){ $(this).toggleClass('ui-state-active'); });
        initAjaxForms();
        initConfirmLinks();
        initDeleteForms();
        
        $('.wysiwyg').wysiwyg();
        
        $("#dialog").dialog({
            autoOpen: false,
            modal: true
        });
    });

    function initAjaxForms()
    {
        if ($('.ajaxForm').length > 0) {
            var options = { 
                    success: showResponse,  // post-submit callback 
                    error: showResponse
            }
            
            $('.ajaxForm').ajaxForm(options); 
        }
    }
    
    function showResponse(responseText, statusText, xhr, $form)
    {
        if (typeof(responseText) == "object") {
            responseText = responseText.responseText;
        }
        /*
        This is kinda tricky.  We have to grab the content, which is pure html (html tags and all)
        and get the #maincontent area.  THEN we have to set the contents of the dialog-message to
        the content of the maincontent area.  o.O
        */
        var div = ($(responseText).find('#maincontent')[0]);
        $( "#dialog-message" ).html($(div).html());
        $( "#dialog-message" ).dialog( "open" );

        if ($(div).find('#ajaxRedirect').length > 0) {
            $("#dialog-message").dialog("option", "buttons", [
                {
                    text: "Continue",
                    click: function() {
                        window.location.replace($(div).find('#ajaxRedirect').html());
                    }
                }
            ]);
            window.setTimeout(function() {
                window.location.replace($(div).find('#ajaxRedirect').html());
            }, 5000);
        }
        
        if ($(div).find('#continueURL').length > 0) {
            $("#dialog-message").dialog("option", "buttons", [
                {
                    text: "Continue",
                    click: function() {
                        window.location.replace($(div).find('#continueURL').html());
                    }
                }
            ]);
        }
        
        if ($(div).find('#success').length > 0
            && $(div).find('.created').length > 0) {
            $('.ajaxForm').clearForm();
            $('.wysiwyg').wysiwyg('clear');
        }
        return false;
    }
    </script>
    <div class='userinfo'>
        <?php 
        if ($user) {
            require_once('UserInfo/Loggedin.tpl.php');
        } else {
            require_once('UserInfo/Loggedout.tpl.php');
        }
        ?>
    </div>
    <div id='contentwraper'>
        <div class='topbar'>
            <div class='title'>
                <h2>Wubbles Memories</h2>
            </div>
            
        </div>
        <?php 
        if ($user) {
            require_once('Navigation/NavigationLoggedIn.tpl.php');
        } else {
            require_once('Navigation/NavigationLoggedOut.tpl.php');
        }
        ?>
        <hr />
        <div id='maincontent'>
            <?php 
            switch ($context->options['view']) {
                default: 
                    echo $savvy->render($context->actionable);
                    break;
            }
            if (in_array('Wub_Commentable', class_implements($context->actionable->getRawObject()))) {
                echo "<div style='clear:both'></div>";
                require dirname(__FILE__) . '/Comment/Edit.tpl.php';
            }
            ?>
        </div>
        <div style='clear:both'></div>
        <div id="dialog-message" title="Dialog">
        </div>
        <div id="dialog" title="Dialog">
        </div>
    </div>
    <div class='footer'>
        <div class='ad'>
            <?php echo Wub_Controller::$footerAd; ?> 
        </div>
        <div class='text'>
            <p>This site was originally created by Michael Fairchild.  Please know that no warranty of any kind is provided.  If you find any bugs or have any questions, please send an email to the <a href='mailto:mfairchild365+wubbles@gmail.com'>web master</a> </p> 
            <p>This site was inspired by Amy and it is the result of a birthday present to her. <span style='font-size:50%'>&lt;3</span></p>
        </div>
        <div style='clear:both'></div>
    </div>
</body>
</html>