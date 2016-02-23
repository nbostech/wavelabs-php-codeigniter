<?php
include_once APPPATH."third_party/google-api-php-client/vendor/autoload.php";

class Google extends MY_Controller
{
    public $CLIENT_ID = null;
    public $CLIENT_SECRET = null;
    public $REDIRECT_URI = null;

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->CLIENT_ID = GOOGLE_CLIENT_ID;
        $this->CLIENT_SECRET = GOOGLE_CLIENT_SECRET;
        $this->REDIRECT_URI = base_url()."social/google/authorize/";
    }

    function index(){
        redirect(base_url()."social/google/connect/");
    }

    function connect(){
        $client = new Google_Client();
        $client->setClientId($this->CLIENT_ID);
        $client->setClientSecret($this->CLIENT_SECRET);
        $client->setRedirectUri($this->REDIRECT_URI);
        $client->setScopes("email");

        $authUrl = $client->createAuthUrl();
        redirect($authUrl);
    }

    function authorize(){
        if(isset($_GET['code'])){
            $client = new Google_Client();
            $client->setClientId($this->CLIENT_ID);
            $client->setClientSecret($this->CLIENT_SECRET);
            $client->setRedirectUri($this->REDIRECT_URI);
            $client->setScopes("email");

            $client->authenticate($_GET['code']);
            $access_token = $client->getAccessToken();

            if(!empty($access_token['access_token'])){
                $response = $this->wavelabs->social->googleConnect($access_token['access_token']);
                setAPIMessages();
                if(!empty($response->token)){
                    $this->session->set_userdata("token", $response->token);
                    $this->session->set_userdata("member", $response->member);
                    redirect(base_url("member/"));
                }else{
                    redirect(base_url()."home/login/");
                }
            }
            $_SESSION['access_token'] = $access_token;
            redirect(base_url()."social/google/");
        }
    }

    /*function index(){
        $client = new Google_Client();
        $client->setClientId($this->CLIENT_ID);
        $client->setClientSecret($this->CLIENT_SECRET);
        $client->setRedirectUri($this->REDIRECT_URI);
        $client->setScopes("email");

        $plus = new Google_Service_Plus($client);

        if(isset($_REQUEST['logout'])){
            session_destroy();
        }

        if(isset($_GET['code'])){
            $client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $client->getAccessToken();
            redirect(base_url()."social/google/");
        }
        if(!empty($_SESSION['access_token'])){
            $client->setAccessToken($_SESSION['access_token']);
            $me = $plus->people->get("me");
            echo "<pre>";
            print_r($me);
            echo "</pre>";
        }else{
            $authUrl = $client->createAuthUrl();
            echo '<a href="'.$authUrl.'">Login with google</a>';
        }

    }*/


}