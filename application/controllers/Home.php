<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

    function __construct(){
        parent::__construct();
    }

	public function index()
	{
        $data = [];
        $sample = new \Wavelabs\core\Sample();
        $data['response'] = $sample->about();
        $this->_template("home", $data);
	}

    public function login(){
        $data = [];
        if($this->input->post()){
            $response = $this->wavelabs->auth->login($this->input->post("username"), $this->input->post("password"));
            if(!empty($response->token)){
                setMessage(\Wavelabs\core\ApiBase::getMessage());
                $this->session->set_userdata("token", $response->token);
                $this->session->set_userdata("member", $response->member);
                redirect(base_url()."member/");
            }else{
                setFormErrors(\Wavelabs\core\ApiBase::getErrors());
                setError(\Wavelabs\core\ApiBase::getError());
            }
        }
        $this->_template("login", $data);
    }

    public function signup(){
        $data = [];
        if($this->input->post("username") !== null){
            $this->wavelabs->auth->signup($this->input->post());
            if($this->wavelabs->auth->getLastHttpCode() == 200){
                redirect(base_url("home/login/"));
            }else{
                setFormErrors(\Wavelabs\core\ApiBase::getErrors());
                setError(\Wavelabs\core\ApiBase::getError());
            }
        }
        $this->_template("signup", $data);
    }

    public function forgot_password(){
        $data = [];
        if($this->input->post("email") !== null){
            $response = $this->wavelabs->auth->forgotPassword($this->input->post("email"));
            if(!empty($response->message)){
                redirect(base_url("home/login/"));
            }else{
                setFormErrors(\Wavelabs\core\ApiBase::getErrors());
                setError(\Wavelabs\core\ApiBase::getError());
            }
        }
        $this->_template("forgot_password", $data);
    }

    public function logout(){
        $response = $this->wavelabs->auth->logout();
        if(!empty($response->error_description)){
            setError($response->error_description);
        }
        $this->session->unset_userdata("member");
        $this->session->unset_userdata("token");
        redirect(base_url("home/login/"));
    }

}
