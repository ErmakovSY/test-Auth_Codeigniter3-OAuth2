<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Google_auth extends CI_Controller
{
	function __construct() {
			parent::__construct();
	}

	function glogin()
	{
			// Fill CLIENT ID, CLIENT SECRET ID, REDIRECT URI from Google Developer Console
		$client_id = '772773387714-e8taqmq5337aaaqlp199e299n0ql4i1p.apps.googleusercontent.com';
		$client_secret = 'LJIbYzW2YXSieBTyrvak4x-n';
		$redirect_uri = base_url('callback-google');

			//Create Client Request to access Google API
		$client = new Google_Client();
		$client->setApplicationName("TestProject");
		$client->setClientId($client_id);
		$client->setClientSecret($client_secret);
		$client->setRedirectUri($redirect_uri);
		$client->addScope("https://www.googleapis.com/auth/userinfo.email");
		$client->addScope("https://www.googleapis.com/auth/userinfo.profile");

			//Send Client Request
		$objOAuthService = new Google_Service_Oauth2($client);
		$authUrl = $client->createAuthUrl();
		header('Location: '.$authUrl);
	}

	function gcallback()
	{
			// Fill CLIENT ID, CLIENT SECRET ID, REDIRECT URI from Google Developer Console
		$client_id = '772773387714-e8taqmq5337aaaqlp199e299n0ql4i1p.apps.googleusercontent.com';
		$client_secret = 'LJIbYzW2YXSieBTyrvak4x-n';
		$redirect_uri = base_url('callback-google');

			//Create Client Request to access Google API
		$client = new Google_Client();
		$client->setApplicationName("TestProject");
		$client->setClientId($client_id);
		$client->setClientSecret($client_secret);
		$client->setRedirectUri($redirect_uri);
		$client->addScope("email");
		$client->addScope("profile");

			//Send Client Request
		$google_oauthV2 = new Google_Service_Oauth2($client);

		if (isset($_REQUEST['code'])) {
            $client->authenticate($_REQUEST['code']);
            $this->session->set_userdata('token', $client->getAccessToken());
            redirect($redirect_uri);
        }
        $token = $this->session->userdata('token');
        if (!empty($token)) {
            $client->setAccessToken($token);
		}
		if ($client->getAccessToken()) {
            $userProfile = $google_oauthV2->userinfo->get();
            // Preparing data for database insertion
            $userData['oauth_provider'] = 'google';
            $userData['oauth_uid'] = $userProfile['id'];
            $userData['first_name'] = $userProfile['given_name'];
            $userData['last_name'] = $userProfile['family_name'];
            $userData['email'] = $userProfile['email'];
            $userData['gender'] = $userProfile['gender'];
            $userData['locale'] = $userProfile['locale'];
            $userData['profile_url'] = $userProfile['link'];
			$userData['picture_url'] = $userProfile['picture'];
            // Insert or update user data
			$userID = $this->user->checkUser($userData);

            if(!empty($userID)){
				$userData['id'] = $userID;
				$data['userData'] = $userData;
				$this->session->set_userdata($userData);
				$this->session->set_userdata('logged_in', TRUE);
            } else {
               $data['userData'] = array();
            }
        } else {
            $data['authUrl'] = $client->createAuthUrl();
        }

		$this->load->view('home');
		
	}
}