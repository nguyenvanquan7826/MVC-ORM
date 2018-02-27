<?php

class Config {
    const DEBUG = true;

    const DB_HOST = "localhost";
    const DB_USER = "vietlach_app";
    const DB_PASS = "WTFapp";
    const DB_NAME = "vietlach_app";

    const SITE_NAME = "MVC ORM";

    public static $routes = array(
        'default' => '',
        'admin' => 'admin_',
    );

    public static $default = array(
        'route' => 'default',
        'controller' => 'users',
        'action' => 'index',
    );
}