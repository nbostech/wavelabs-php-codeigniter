<?php
include_once APPPATH."third_party/Twitter/twitteroauth.php";

class Twitter extends MY_Controller
{
    private $CONSUMER_KEY = null;
    private $CONSUMER_SECRET = null;
    private $OAUTH_CALLBACK = null;

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->CONSUMER_KEY = TWITTER_CONSUMER_KEY;
        $this->CONSUMER_SECRET = TWITTER_CONSUMER_SECRET;
        $this->OAUTH_CALLBACK = base_url()."social/twitter/authorize/";
    }

    function connect(){
        $connection = new TwitterOAuth($this->CONSUMER_KEY, $this->CONSUMER_SECRET);
        $request_token = $connection->getRequestToken($this->OAUTH_CALLBACK);
        if(!empty($request_token)){
            $token = $request_token['oauth_token'];
            $_SESSION['request_token'] = $token;
            $_SESSION['request_token_secret'] = $request_token['oauth_token_secret'];

            $login_url = $connection->getAuthorizeURL($token);
            redirect($login_url);
        }
    }

    function authorize(){
        if(isset($_GET['oauth_token'])){
            $connection = new TwitterOAuth($this->CONSUMER_KEY, $this->CONSUMER_SECRET, $_SESSION['request_token'], $_SESSION['request_token_secret']);
            $access_token = $connection->getAccessToken($_GET['oauth_verifier']);
            if(!empty($access_token)){
                $response = $this->nbos->social->twitterConnect($access_token);
                setAPIMessages();
                if($this->nbos->social->getLastHttpCode() == 200){
                    redirect(base_url()."home/login/");
                }
                redirect(base_url()."home/login/");
                /*$connection = new TwitterOAuth($this->CONSUMER_KEY, $this->CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
                $params = ['include_entities' => false];
                $data = $connection->get("account/verify_credentials", $params);
                if($data){
                    $_SESSION['data'] = $data;
                }*/
            }
        }
    }

    function index(){

        if(isset($_GET['logout'])){
            session_unset();
            redirect(base_url()."social/twitter/");
        }

        if(!isset($_SESSION['data']) && !isset($_GET['oauth_token'])){
            $connection = new TwitterOAuth($this->CONSUMER_KEY, $this->CONSUMER_SECRET);
            $request_token = $connection->getRequestToken($this->OAUTH_CALLBACK);
            if(!empty($request_token)){
                $token = $request_token['oauth_token'];
                $_SESSION['request_token'] = $token;
                $_SESSION['request_token_secret'] = $request_token['oauth_token_secret'];

                $login_url = $connection->getAuthorizeURL($token);
            }
        }

        if(isset($_GET['oauth_token'])){
            $connection = new TwitterOAuth($this->CONSUMER_KEY, $this->CONSUMER_SECRET, $_SESSION['request_token'], $_SESSION['request_token_secret']);
            $access_token = $connection->getAccessToken($_GET['oauth_verifier']);
            if(!empty($access_token)){
                $connection = new TwitterOAuth($this->CONSUMER_KEY, $this->CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
                $params = ['include_entities' => false];
                $data = $connection->get("account/verify_credentials", $params);
                if($data){
                    $_SESSION['data'] = $data;
                    redirect("http://ci.local/social/twitter/");
                }
            }
        }

        if(!empty($login_url)){
            echo '<a href="'.$login_url.'"><img src="/images/sign-in-with-twitter.png" width="151" height="24" border="0" /></a>';
        }else{
            $data = $_SESSION['data'];
            echo '<div class="container">';
            echo "ID ".$data->id;
            echo "Screen Name ".$data->screen_name;
            echo "Name ".$data->name;
            //print_r($data);
            echo '</div>';
        }

    }
}