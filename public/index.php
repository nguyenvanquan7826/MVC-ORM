<?php

define('DS', DIRECTORY_SEPARATOR);
define('BR', "<br>");

define('ROOT', dirname(dirname(__FILE__)));
define('FOLDER_PATH', explode($_SERVER['DOCUMENT_ROOT'], ROOT)[1]);
define('URI', explode(FOLDER_PATH, $_SERVER['REQUEST_URI'])[1]);
define('VIEW_PATH', ROOT . DS . 'views');
define('EXT_VIEW_FILE', '.php');

require_once(ROOT . DS . 'config' . DS . 'config.php');
require_once(ROOT . DS . 'libs' . DS . 'init.php');

App::run(URI);