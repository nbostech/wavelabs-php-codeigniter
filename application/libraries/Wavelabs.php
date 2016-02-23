<?php

//include_once(APPPATH . "/third_party/wavelabs-php-client-api/src/Wavelabs/Autoloader.php");

class Wavelabs{

    public $user = null;
    public $auth = null;
    public $social = null;
    public $response = null;
    public static $errors = [];
    public static $fields = [];

    function __construct(){
        //Wavelabs\Autoloader::register();
        $this->auth = new Wavelabs\core\Auth();
        $this->user = new Wavelabs\core\User();
        $this->social = new Wavelabs\core\Social();
    }



}
