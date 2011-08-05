<script type="text/javascript" src="<?php echo Wub_Controller::$url?>www/js/timeglider.min.js"></script>

<h3><?php echo $context->account->getFullName();?>: Timeline</h3>

<div class='options'>
    <a href='<?php echo $context->account->getURL();?>' class='button'>Back to profile</a>
    <div style='clear:both'></div>
</div>

<script type="text/javascript">
$(document).ready(function () { 
    var tg1 = $("#timeline").timeline({
        "data_source":"<?php echo $context->getJSONurl();?>",
        "min_zoom":15,
        "max_zoom":60, 
        "icon_folder": "<?php echo Wub_Controller::$url?>www/images/icons/",
        "show_footer": false,
    });
});
</script>

<div id='timeline'></div>