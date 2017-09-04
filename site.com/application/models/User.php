<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model 
{
	function __construct()
	{
		$this->tableName = 'users';
		$this->primaryKey = 'id';
	}

	public function createUser($email, $password) 
	{
			//check if email already exists. if not, create new user
		$isUnique = $this->checkUserEmail($email);
		if($isUnique == TRUE) {
			$data = array(
				'email' => $email,
				'password' => $password
			);
			$this->db->insert('users', $data);

			$userID = $this->getUserID($email);
			
			$privateTableData = array(
				'user_id' => $userID
			);
			$this->db->insert('private', $privateTableData);

			return TRUE;
		}
		else {
			return "email already exist";
		}    
	}

	public function updateUser() 
	{
			//update table 'users'
		$newPrivateData = array(
			'birth' => $this->input->post('birth'),
			'phone' => $this->input->post('phone'),
			'country' => $this->input->post('country'),
			'city' => $this->input->post('city'),
			'adress' => $this->input->post('adress'),
			'post_index' => $this->input->post('post_index')
		);
		
		$this->db->where('user_id', $this->session->userdata('id'));
		$this->db->update('private', $newPrivateData); 

			//update table 'private'
		$newUserData = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('second_name'),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password')
		);
		$this->db->where('id', $this->session->userdata('id'));
		$this->db->update('users', $newUserData); 

			//update session
		$this->session->set_userdata('email', $this->input->post('email'));
		$this->session->set_userdata('first_name', $this->input->post('first_name'));
	}

	public function checkUserEmail($email) 
	{ 
			//check if email exists
		$sql = "SELECT * FROM users WHERE email='$email'";
		$res = $this->db->query($sql)->result_array();

		if(isset($res[0])) {
			return FALSE;
		}
		else {
			return TRUE;
		}
	}
			
	public function checkPassword($email, $password) 
	{
			//get real password
		$sql = "SELECT * FROM users WHERE email='$email'";
		$userReal = $this->db->query($sql)->result_array();
		if(isset($userReal[0]['password'])) {
			if ($userReal[0]['password'] == $password) {
					//if password is correct - create session
				$userData['id'] = $userReal[0]['id'];
				$userData['email'] = $userReal[0]['email'];
				$userData['logged_in'] = FALSE;

				if(isset($userReal[0]['first_name'])) {
					$userData['first_name'] = $userReal[0]['first_name'];
					$this->createSession($userData);
				}
				else {
					$userData['first_name'] = 'Guest';
					$this->createSession($userData);
				}
				return TRUE;
			}
			else{
				return "password incorrect";
			}
		}
		else {
			return "email incorrect";
		}
	}
	
	public function getUserPrivateData($id)
	{
			//getting user data
		$sql = "SELECT private.birth,
						private.phone, 
						private.country,
						private.city,
						private.adress,
						private.post_index, 
						private.image,
						users.first_name,
						users.last_name,
						users.email,
						users.password
						FROM users 
						JOIN private ON users.id=private.user_id 
						WHERE users.id='$id'";
		$res = $this->db->query($sql)->result_array();

		if(isset($res[0])) {
			return $res;
		}
		else 
		{
			return "nothing to show";
		}
	}

	public function getUserID($email)
	{
			//getting user id
		$sql = "SELECT id FROM users WHERE email='$email'";
		$res = $this->db->query($sql)->result_array();

		if(isset($res[0])) {
			return $res[0]['id'];
		}
		else 
		{
			return "nothing to show";
		}
	}

	public function createSession($userData) 
	{
		$this->session->set_userdata($userData);
	}

	public function deleteSession() 
	{
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('first_name');
		$this->session->unset_userdata('last_name');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('gender');
		$this->session->unset_userdata('locale');
		$this->session->unset_userdata('profile_url');
		$this->session->unset_userdata('picture_url');
		$this->session->unset_userdata('oauth_provider');
		$this->session->unset_userdata('oauth_uid');
		$this->session->unset_userdata('token');
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('secureCode');
		$this->session->sess_destroy();
	}

	public function saveImage() 
	{	
			//load image from google
		if (!is_null($this->session->userdata('picture_url'))) {
			$location = $this->session->userdata('picture_url');
			echo $location;
		}
		else {
				//load image from request
			$filename = $_FILES['file']['name'];
			
			$type = explode(".", $filename);
			$location = "uploads/".strval(time()).".".$type[1];
			$uploadOk = 1;
			$imageFileType = pathinfo($location, PATHINFO_EXTENSION);
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
				$uploadOk = 0;
			}
			if($uploadOk == 0) {
				echo 0;
			}
			else {
				if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){
					$this->saveLocationOfImage($location);
					echo $location;
				}
				else {
					echo 0;
				}
			}
		}
	}	

	private function saveLocationOfImage($location)
	{
			//saving name of image to DB
		$id = $this->session->userdata('id');
		$newPrivateData = array(
			'image' => $location
		);
		
		$this->db->where('user_id', $id);
		$this->db->update('private', $newPrivateData);
	}

	public function checkUser($data = array()){
			//check google user if already registered
		$this->db->select($this->primaryKey);
		$this->db->from($this->tableName);
		$this->db->where(array('oauth_provider'=>$data['oauth_provider'],'oauth_uid'=>$data['oauth_uid']));
		$prevQuery = $this->db->get();
		$prevCheck = $prevQuery->num_rows();
		
		if($prevCheck > 0){
				$prevResult = $prevQuery->row_array();
				$data['modified'] = date("Y-m-d H:i:s");
				$update = $this->db->update($this->tableName, $data, array('id'=>$prevResult['id']));
				$userID = $prevResult['id'];
		}else{
				$data['created'] = date("Y-m-d H:i:s");
				$data['modified'] = date("Y-m-d H:i:s");
				$insert = $this->db->insert($this->tableName, $data);
				$userID = $this->db->insert_id();

				$privateTableData = array(
					'user_id' => $userID
				);
				$this->db->insert('private', $privateTableData);
		}

		return $userID?$userID:FALSE;
}



}