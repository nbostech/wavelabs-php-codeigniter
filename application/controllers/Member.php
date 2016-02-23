<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("token") === null) {
            redirect(base_url("home/login/"));
        }else{
            $token = $this->session->userdata("token");
        }
    }

    public function index()
    {
        $data = [];
        $data['member'] = $this->session->userdata("member");
        $this->_template("member/home", $data);
    }

    public function profile()
    {
        $data = [];
        if($this->input->post("id") !== null){
            $member = $this->wavelabs->user->update($this->input->post());
            if(!empty($member->id)){
                $this->session->set_userdata("member", $member);
            }
            redirect(base_url("member/profile/"));
        }
        $data['member'] = $this->session->userdata("member");
        $this->_template("member/profile", $data);
    }

    public function change_password()
    {
        $data = [];
        if (!empty($_POST)) {
            $response = $this->wavelabs->auth->changePassword($this->input->post("password"), $this->input->post("newPassword"));
            if (!empty($response->message)) {
                setMessage($response->message);
                redirect(base_url()."member/change_password/");
            }else{
                setFormErrors(\Wavelabs\core\ApiBase::getErrors());
                setError(\Wavelabs\core\ApiBase::getError());
            }
        }
        $this->_template("member/change_password", $data);
    }

    public function profile_img()
    {
        $data = [];
        if($this->input->post("id") !== null){
            $response = $this->wavelabs->user->updateProfileImage($this->input->post());
            redirect(base_url("member/profile_img/"));
        }
        $data['member'] = $this->session->userdata("member");
        $data['profile_img'] = $this->wavelabs->user->getProfileImage($data['member']->id, "original");
        print_r($data['profile_img']);
        $data['profile_img'] = str_replace("localhost", "starterapp.com", $data['profile_img']);
        $this->_template("member/profile_img", $data);
    }
}
