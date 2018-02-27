<?php

if (Config::DEBUG) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

/**
 * Auto load and requite file name for any class name when called
 * @param $className
 * @throws Exception
 */
function __autoload($className) {
    $fileName = $className . '.php';
    $libPath = ROOT . DS . 'libs' . DS . $fileName;
    $controllerPath = ROOT . DS . 'controllers' . DS . $fileName;
    $modelPath = ROOT . DS . 'models' . DS . $fileName;

    if (file_exists($libPath)) {
        require_once($libPath);
    } elseif (file_exists($controllerPath)) {
        require_once($controllerPath);
    } elseif (file_exists($modelPath)) {
        require_once($modelPath);
    } else {
        echo $libPath . BR;
        echo $controllerPath . BR;
        echo $modelPath . BR;
        throw new Exception("Fail to include class: $className");
    }
}

function url($str) {
    echo getUrl($str);
}

function getUrl($str) {
    return HOME_URL . $str;
}