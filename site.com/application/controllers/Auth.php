<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
			// if user logged in, redirect to home page; if not - redirect to login page
		if($this->session->userdata('logged_in')) {
			$this->load->view('home');
		}
		else {
			$this->load->view('main');
		}
	}

	public function login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
			// check password
		$res = $this->user->checkPassword($email, $password);
		echo $res;
	}

	public function showRegisrtationForm()
	{
		$this->load->view('register');
	}

	public function showEditForm()
	{
		$this->load->view('profile');
	}

	public function getUserData()
	{
			//getting user data for edit page
		$id = $this->session->userdata('id');
		$content = $this->user->getUserPrivateData($id);
		$res = json_encode($content);
		echo $res;
	}

	public function regisrtationSubmit()
	{
			//registration new user
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$res = $this->user->createUser($email, $password);
			//login new user
		if ($res === TRUE) {
			$tryToLodin = $this->user->checkPassword($email, $password);
			if($tryToLodin === TRUE) {
				$this->index();
			}
		}
		else {
			echo $res;
		}
	}

	public function editSubmit()
	{
		$this->user->updateUser();
		echo "successfully updated";
	}

	public function logout()
	{
		$this->user->deleteSession();	
		$this->index();
	}

	public function getCaptcha()
	{
			//generating captcha image
		$code=rand(1000,9999);
		$this->session->set_userdata('secureCode', $code);
		$im = imagecreatetruecolor(50, 12);
		$bg = imagecolorallocate($im, 243, 201, 5);
		$fg = imagecolorallocate($im, 216, 83, 15);
		imagefill($im, 0, 0, $bg);
		imagestring($im, 5, 8, -2,  $code, $fg);
		header("Cache-Control: no-cache, must-revalidate");
		header('Content-type: image/png');

		ob_start();
		imagepng($im);
		$imagedata = ob_get_contents();
		ob_end_clean();
		imagedestroy($im);

		echo base64_encode($imagedata);
	}

	public function checkCaptcha()
	{
			//checking captcha for correct code
		$inputCode = $this->input->post('inputCode');
		$realCode = $this->session->userdata('secureCode');
		if ($inputCode == $realCode) {
			$this->session->set_userdata('logged_in', TRUE);
			echo 'success';	
		}
		else {
			$newCaptcha = $this->getCaptcha();
			echo $newCaptcha;
		}
	}

	public function uploadUserPhoto()
	{	
		$this->user->saveImage();
	}
}