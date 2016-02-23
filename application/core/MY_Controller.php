<?php (defined('BASEPATH')) OR exit('No direct script access allowed');


class MY_Controller extends MX_Controller {

    public $theme = "default";
    public $header_data = [];

    public function __construct(){
        parent::__construct();
        $this->load->helper('common');
        $this->load->library("Wavelabs", "wavelabs");
    }


    public function _template($page_name, $data = []){

        $data = $data + $this->header_data;
        $this->load->view($this->theme."/header", $data);
        $this->load->view($this->theme."/".$page_name, $data);
        $this->load->view($this->theme."/footer");
    }

}