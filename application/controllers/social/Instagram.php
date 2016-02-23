<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instagram extends MY_Controller {

    private $API_KEY = null;
    private $API_SECRET = null;
    private $REDIRECT_URL = null;

    function __construct(){
        parent::__construct();
        $this->API_KEY = INSTAGRAM_API_KEY;
        $this->API_SECRET = INSTAGRAM_API_SECRET;
        $this->REDIRECT_URL = base_url().'social/instagram/authorize/';
    }

	public function index(){
        redirect(base_url()."social/instagram/connect/");
	}

    public function connect(){
        $instagram = new MetzWeb\Instagram\Instagram(array(
            'apiKey'      => $this->API_KEY,
            'apiSecret'   => $this->API_SECRET,
            'apiCallback' => $this->REDIRECT_URL
        ));
        $loginUrl = $instagram->getLoginUrl();
        redirect($loginUrl);
    }

    function authorize(){
        if(!empty($_GET['code'])){
            $instagram = new MetzWeb\Instagram\Instagram(array(
                'apiKey'      => $this->API_KEY,
                'apiSecret'   => $this->API_SECRET,
                'apiCallback' => $this->REDIRECT_URL
            ));
            $accessToken = $instagram->getOAuthToken($_GET['code']);
            if(!empty($accessToken->access_token)){
                $response = $this->wavelabs->social->instagramConnect($accessToken->access_token);
                setAPIMessages();
                if(!empty($response->token)){
                    $this->session->set_userdata("token", $response->token);
                    $this->session->set_userdata("member", $response->member);
                    redirect(base_url("member/"));
                }else{
                    redirect(base_url()."home/login/");
                }
            }
        }
    }

    public function login(){
        $response = $this->wavelabs->social->instagramLogin();
        if(!empty($response->url)){
            redirect($response->url);
        }
    }
}
