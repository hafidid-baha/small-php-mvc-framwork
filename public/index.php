<?php

use  MVCF\CONTROLLERS\frontController;
use MVCF\LIB\template;
use MVCF\LIB\language;
use MVCF\LIB\messanger;
use MVCF\LIB\sessions;


require_once '..'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'config.'.DIRECTORY_SEPARATOR.'config.php';
require_once '..'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'autoload.php';

$sessions = new sessions;
$sessions->start();

$messanger = new messanger();
$language = new language();
$template = new template();


$controller = new frontController($template,$language,$messanger);
$controller->dispatch();

