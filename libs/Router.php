<?php

class Router {
    protected $uri;
    protected $controller;
    protected $action;
    protected $params;
    protected $route;
    protected $methodPrefix;


    public function getController() {
        return $this->controller;
    }

    public function getAction() {
        return $this->action;
    }

    public function getParams() {
        return $this->params;
    }

    public function getRoute() {
        return $this->route;
    }

    public function getMethodPrefix() {
        return $this->methodPrefix;
    }

    public function __construct($uri) {
        $this->uri = urldecode(trim($uri, '/'));

        $routers = Config::$routes;

        $this->route = Config::$default['route'];
        $this->methodPrefix = isset($routers[$this->route]) ? $routers[$this->route] : '';
        $this->controller = Config::$default['controller'];
        $this->action = Config::$default['action'];

        $uriParts = explode('?', $this->uri);

        // get path like /controller/action/var1/var2/...
        $path = strtolower($uriParts[0]);
        $pathParts = explode('/', $path);

        if (count($pathParts)) {

            // get route for admin or default
            if (in_array(current($pathParts), array_keys(Config::$routes))) {
                $this->route = current($pathParts);
                $this->methodPrefix = isset($routers[$this->route]) ? $routers[$this->route] : '';
                array_shift($pathParts);
            }

            // get controller
            if (current($pathParts)) {
                $this->controller = current($pathParts);
                array_shift($pathParts);
            }

            // get action
            if (current($pathParts)) {
                $this->action = current($pathParts);
                array_shift($pathParts);
            }

            // get params - all after action
            $this->params = $pathParts;
        }
    }
}