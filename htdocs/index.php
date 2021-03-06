<?php

/**
 * index.php
 *
 * @author  Zhang Yi <loeyae@gmail.com>
 * @version 2019-02-25 11:23:17
 */
mb_internal_encoding('UTF-8');

define('APP_BASE_DIR', dirname(__DIR__));
define('PROJECT_NAMESPACE', 'app');
define('PROJECT_DIR', realpath(APP_BASE_DIR . '/' . PROJECT_NAMESPACE));

require_once APP_BASE_DIR . DIRECTORY_SEPARATOR .'vendor'. DIRECTORY_SEPARATOR .'autoload.php';

define('LOEYE_MODE', LOEYE_MODE_DEV);

$dispatcher = new loeye\web\SimpleDispatcher();
$dispatcher->init($setting = ["rewrite"=> ['/<module:\w+>/<controller:\w+>/<action:\w+>.html' => '{module}/{controller}/{action}']]);
$dispatcher->dispatche();
