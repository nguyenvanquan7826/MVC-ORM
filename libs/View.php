<?php

class View {
    protected $data;
    protected $path;

    public static function getDefaultViewPath() {
        $router = App::getRouter();
        if (!$router) {
            return false;
        }
        $controllerDir = $router->getController();
        $templateName = $router->getMethodPrefix() . $router->getAction() . EXT_VIEW_FILE;
        return VIEW_PATH . DS . $controllerDir . DS . $templateName;
    }

    public function __construct($data = array(), $path = null) {
        if (!$path) {
            $path = self::getDefaultViewPath();
        }
        if (!file_exists($path)) {
            throw new Exception('Template file not found in path' . $path);
        }
        $this->path = $path;
        $this->data = $data;
    }

    public function render() {
        $data = $this->data;
        ob_start();
        include($this->path);
        $content = ob_get_clean();
        return $content;
    }
}