<?php


define('DS', DIRECTORY_SEPARATOR);
define('APP_PATH',realpath(dirname(__FILE__)).DS.'..'.DS);
define('VIEWS_PATH',APP_PATH.DS.'views'.DS);
define('TEMPLATE_PATH',APP_PATH.DS.'template'.DS);
define('LANGUAGE_PATH',APP_PATH.'languages'.DS);
define('SESSION_PATH',APP_PATH.'sessions'.DS);

define('CSS',APP_PATH.'..'.DS.'public'.DS.'style'.DS);
define('JS',APP_PATH.DS.'..'.DS.'public'.DS.'js'.DS);

define('DEFAULT_LANG','en');

define('MESSAGE_SUCCESS',1);
define('MESSAGE_ERROR',0);







