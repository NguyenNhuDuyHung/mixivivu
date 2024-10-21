<?php
define('_DIR_ROOT', __DIR__);

// handle http root
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $web_root = 'https://' . $_SERVER['HTTP_HOST'];
} else {
    $web_root = 'http://' . $_SERVER['HTTP_HOST'];
}

$docRoot = str_replace('\\', '/', strtolower(realpath($_SERVER['DOCUMENT_ROOT'])));
$dirRoot = str_replace('\\', '/', strtolower(realpath(_DIR_ROOT)));

$folder = str_replace($docRoot, '', $dirRoot);

if (!empty($folder)) {
    $web_root .= $folder;
}

define('_WEB_ROOT', $web_root);

// Autoload config

$configs_dir = scandir('configs');
if (!empty($configs_dir)) {
    foreach ($configs_dir as $item) {
        if ($item != '.' && $item != '..' && file_exists('configs/' . $item)) {
            require_once 'configs/' . $item;
        }
    }
}

require_once 'configs/routes.php'; // load routes config
require_once 'core/Route.php'; // load route class
require_once 'app/App.php'; // load app

// load database
if (!empty($config['database'])) {
    $db_config = array_filter($config['database'], function ($value) {
        return $value !== null;
    });

    if (!empty($db_config)) {
        require_once 'core/Connection.php';
        require_once 'core/Database.php';
    }
}

require_once 'core/Model.php'; // load model
require_once 'core/Controller.php'; // load base controller