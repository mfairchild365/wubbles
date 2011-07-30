<div id='success' class="ui-widget">
    <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
        <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
        <strong>Success!</strong> <?php echo $context->message; ?></p>
        <?php
        if (!empty($context->saveType)) {
            if ($context->saveType == "create") {
                echo "<p><div class='created'>Created</div></p>";
            }
            
            if ($context->saveType == "save") {
                echo "<p><div class='edited'>Edited</div></p>";
            }
        }
        
        if (!empty($context->ajaxRedirect)) {
            echo "<div id='ajaxRedirect' style='visibility:hidden;'>".$context->ajaxRedirect."</div>";
        }
        
        if (!empty($context->continueURL)) {
            echo "<div id='continueURL' style='visibility:hidden;'>".$context->continueURL."</div>";
        }
        ?>
        
    </div>
</div>