<?php

class App
{
    protected $controller = 'home';
    protected $method     =  'index';
    protected $params     = [];
    public function __construct()
    {
        session_start();
        define("PUBLIC_PATH", 'http://localhost/monitor/public/');
        define("BASE_PATH", 'http://localhost/monitor/');
        $current_url = $this->url();
        date_default_timezone_set("Asia/tehran");
        $url = $this->parseUrl();
        $this->check_login($url);
        if (file_exists('../app/controllers/' . $url[0] .  '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }
        require_once '../app/controllers/' . $this->controller  . '.php';
        $this->controller = new $this->controller;
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

    public function url()
    {
        return sprintf(
            "%s://%s%s",
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['SERVER_NAME'],
            $_SERVER['REQUEST_URI']
        );
    }

    public function check_login($url)
    {

        if (!empty($url[0]) && !empty($url[1])) {
            if ($url[0] == 'login' && $url[1] == 'attemp' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                // attemp to login
                require_once '../app/controllers/login.php';
                $login = new Login;
                call_user_func_array([$login, 'attemp'], $this->params);
                return '';
            }
        }

        if(isset($_COOKIE['user_name']) && !isset($_POST['logout']) ){
            if($_COOKIE['user_name']){
                // echo 'coockie user is isset';
                $_SESSION['user_name'] = $_COOKIE['user_name'];
            }
        }

        // check logged in
        if (!isset($_SESSION['user_name']) ) {
            // not logged in
            require_once '../app/controllers/login.php';
            $login = new Login;

            call_user_func_array([$login, 'index'], $this->params);
            die();
            return '';
        }
    }
}
