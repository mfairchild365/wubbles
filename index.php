<?php
if (file_exists(dirname(__FILE__) . '/config.inc.php')) {
    require_once dirname(__FILE__) . '/config.inc.php';
} else {
    require dirname(__FILE__) . '/config.sample.php';
}

session_start();

$routes = include __DIR__ . '/data/Routes.php';
Wub_Router::setRoutes($routes);
if (isset($_GET['model'])) {
    unset($_GET['model']);
}

$wub = new Wub_Controller(Wub_Router::route($_SERVER['REQUEST_URI'], $_GET));

$savvy = new Wub_OutputController();


if ($wub->options['format'] != 'html') {
    switch($wub->options['format']) {
        case 'partial':
            Savvy_ClassToTemplateMapper::$output_template['Wub_Controller'] = 'Wub/Controller-partial';
        case 'text':
        case 'json':
            //echo $wub->options['format'];  exit();
            //echo dirname(__FILE__).'/www/templates/'.$wub->options['format']; exit();
            $savvy->addTemplatePath(dirname(__FILE__).'/www/templates/'.$wub->options['format']);
            break;
        default:
            header('Content-type:text/html;charset=UTF-8');
    }
}

// Always escape output, use $context->getRaw('var'); to get the raw data.
$savvy->setEscape('htmlentities');

//add the user
$savvy->addGlobal('user', Wub_Controller::getAccount());

echo $savvy->render($wub);
