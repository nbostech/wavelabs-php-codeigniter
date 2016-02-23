<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH."third_party/Facebook/autoload.php";

class Facebook extends MY_Controller {

    private $APP_ID = null;
    private $APP_SECRET = null;
    private $REDIRECT_URL = null;

    function __construct(){
        parent::__construct();
        $this->APP_ID = FACEBOOK_APP_ID;
        $this->APP_SECRET = FACEBOOK_APP_SECRET;
        $this->REDIRECT_URL = base_url().'social/facebook/authorize/';
    }

	public function index()
	{
        redirect(base_url()."social/facebook/connect/");
	}

    public function connect(){
        $fb = new Facebook\Facebook([
            'app_id' => $this->APP_ID,
            'app_secret' => $this->APP_SECRET,
            'default_graph_version' => 'v2.5',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email']; // Optional permissions
        $loginUrl = $helper->getLoginUrl($this->REDIRECT_URL, $permissions);
        redirect($loginUrl);
    }

    function authorize(){
        $fb = new Facebook\Facebook([
            'app_id' => $this->APP_ID,
            'app_secret' => $this->APP_SECRET,
            'default_graph_version' => 'v2.5',
        ]);
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email']; // optional

        try {
            if (isset($_SESSION['facebook_access_token'])) {
                $accessToken = $_SESSION['facebook_access_token'];
            } else {
                $accessToken = $helper->getAccessToken();
            }
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        if (isset($accessToken)) {
            if (isset($_SESSION['facebook_access_token'])) {
                $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
            } else {
                // getting short-lived access token
                $_SESSION['facebook_access_token'] = (string) $accessToken;
                // OAuth 2.0 client handler
                $oAuth2Client = $fb->getOAuth2Client();
                // Exchanges a short-lived access token for a long-lived one
                $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
                $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
                // setting default access token to be used in script
                $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
            }

            // redirect the user back to the same page if it has "code" GET variable
            if (isset($_GET['code'])) {
                header('Location: ./');
            }

            $response = $this->wavelabs->social->facebookConnect($accessToken);
            setAPIMessages();
            if(!empty($response->token)){
                $this->session->set_userdata("token", $response->token);
                $this->session->set_userdata("member", $response->member);
                redirect(base_url("member/"));
            }else{
                redirect(base_url()."home/login/");
            }
            // getting basic info about user
            /*try {
                $profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
                $profile = $profile_request->getGraphNode()->asArray();
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
                // When Graph returns an error
                echo 'Graph returned an error: ' . $e->getMessage();
                session_destroy();
                // redirecting user back to app login page
                header("Location: ./");
                exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                // When validation fails or other local issues
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }

            // printing $profile array on the screen which holds the basic info about user
            print_r($profile);
            // Now you can redirect to another page and use the access token from $_SESSION['facebook_access_token']
            */
        }
    }

    public function login(){
        $response = $this->wavelabs->social->facebookLogin();
        if(!empty($response->url)){
            redirect($response->url);
        }
    }
}
