<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    function __construct(){
        parent::__construct();
    }

	public function index()
	{
        $data = [];
        $this->_template("test", $data);
	}



}
