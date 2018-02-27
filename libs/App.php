<?php

class App {
    public static $db;
    protected static $router;

    public static function getRouter() {
        return self::$router;
    }

    public static function run($uri) {
        self::$db = new Db(Config::DB_HOST, Config::DB_USER, Config::DB_PASS, Config::DB_NAME);
        self::$router = new Router($uri);

        $controllerClass = ucfirst(self::$router->getController()) . 'Controller';
        $controllerMethod = self::$router->getMethodPrefix() . self::$router->getAction();

        // call controller method
        $controllerObject = new $controllerClass();
        if (method_exists($controllerObject, $controllerMethod)) {

            // Controller's method can return view path or not
            $viewPath = $controllerObject->$controllerMethod();

            // get content of view for action - html with data is content for main layout
            $viewObject = new View($controllerObject->getData(), $viewPath);
            $content = $viewObject->render();
        } else {
            throw new Exception("Method $controllerMethod of $controllerClass does not exist!");
        }

        // get layout for admin or user default
        $layout = self::getRouter()->getRoute();
        $layoutPath = VIEW_PATH . DS . $layout . EXT_VIEW_FILE;

        // display content data from action to layout
        $layoutObject = new View(compact('content'), $layoutPath);
        echo $layoutObject->render();
    }
}