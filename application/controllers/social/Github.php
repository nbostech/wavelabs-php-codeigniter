<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Github extends MY_Controller {

    private $OAUTH2_CLIENT_ID = null;
    private $OAUTH2_CLIENT_SECRET = null;
    private $REDIRECT_URL = null;
    private $authorizeURL = 'https://github.com/login/oauth/authorize';
    private $tokenURL = 'https://github.com/login/oauth/access_token';
    private $apiURLBase = 'https://api.github.com/';

    function __construct(){
        parent::__construct();
        $this->OAUTH2_CLIENT_ID = GITHUB_OAUTH2_CLIENT_ID;
        $this->OAUTH2_CLIENT_SECRET = GITHUB_OAUTH2_CLIENT_SECRET;
        $this->REDIRECT_URL = base_url().'social/github/authorize/';
    }

	public function index(){
        redirect(base_url()."social/github/connect/");
	}

    public function connect(){
        $_SESSION['github_state'] = hash('sha256', microtime(TRUE).rand().$_SERVER['REMOTE_ADDR']);
        if(isset($_SESSION['github_access_token'])){
            unset($_SESSION['github_access_token']);
        }
        $params = array(
            'client_id' => $this->OAUTH2_CLIENT_ID,
            'redirect_uri' => $this->REDIRECT_URL,
            'scope' => 'user',
            'state' => $_SESSION['github_state']
        );
        // Redirect the user to Github's authorization page
        $loginUrl = $this->authorizeURL . '?' . http_build_query($params);
        redirect($loginUrl);
    }

    function authorize(){
        // When Github redirects the user back here, there will be a "code" and "state" parameter in the query string
        if(!empty($_GET['code'])){

            $accessToken = $this->apiRequest($this->tokenURL, array(
                'client_id' => $this->OAUTH2_CLIENT_ID,
                'client_secret' => $this->OAUTH2_CLIENT_SECRET,
                'redirect_uri' => $this->REDIRECT_URL,
                'state' => $_SESSION['github_state'],
                'code' => $_GET['code']
            ));
            if(!empty($accessToken->access_token)){
                $_SESSION['github_access_token'] = $accessToken->access_token;

                $response = $this->nbos->social->gitHubConnect($accessToken->access_token);
                setAPIMessages();
                if(!empty($response->token)){
                    $this->session->set_userdata("token", $response->token);
                    $this->session->set_userdata("member", $response->member);
                    redirect(base_url("member/"));
                }else{
                    redirect(base_url()."home/login/");
                }

                /*if($_SESSION['github_access_token']) {
                    $user = $this->apiRequest($this->apiURLBase . 'user');
                    echo '<h3>Logged In</h3>';
                    echo '<h4>' . $user->name . '</h4>';
                    echo '<pre>';
                    print_r($user);
                    echo '</pre>';
                }*/
            }
        }
    }

    public function login(){
        $response = $this->nbos->social->gitHubLogin();
        if(!empty($response->url)){
            redirect($response->url);
        }
    }

    private function apiRequest($url, $post=FALSE, $headers=array()) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        if($post){
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        }
        $headers[] = 'Accept: application/json';

        if(!empty($_SESSION['github_access_token'])){
            $headers[] = 'Authorization: Bearer ' . $_SESSION['github_access_token'];
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        return json_decode($response);
    }

}
