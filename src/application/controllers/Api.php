<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Assets_model');
		$this->load->model('Users_model');
		$this->load->model('Ibm_model');
	}


	public function getIbmStorage()
	{
		$assetsinfo = $this->Ibm_model->getData();
		if($assetsinfo)
		{
			$data['request_status']  = true;
			$data['message']         = $assetsinfo;
		}
		else
		{
			$data['request_status']  = false;
			$data['message']         = 'Data Not Found';
		}
		header('Content-Type: application/json');
		$json_response = json_encode($data);
		echo $json_response;
	}



	public function getAssetBundles()
	{
		$assetsinfo = $this->Assets_model->getData();
		if($assetsinfo)
		{
			$data['request_status']  = true;
			$data['message']         = $assetsinfo;
		}
		else
		{
			$data['request_status']  = false;
			$data['message']         = 'Data Not Found';
		}
		header('Content-Type: application/json');
		$json_response = json_encode($data);
		echo $json_response;
	}

	public function importUserConfigFile()
	{
		$data = array();
		$userIdForConfigJson = $this->input->post('userId', TRUE);
		$userConfigJsonFile  = $this->input->post('base64String', TRUE);
		if (empty($userIdForConfigJson) || empty($userConfigJsonFile))
		{
			$result  = array('message'  => 'The request url is not Found at a moment');
			$data['request_status']   = false;
			$data['request_response'] = $result;
		}
		else
		{
			$gamedata            = 'profile_'.date('YmdHis').'.json';
			file_put_contents('upload/Game/'.$gamedata , base64_decode($userConfigJsonFile));
			$arrayofdata = array(
				'file_storage'=> base_url('upload/Game/').$gamedata,
				'idAppUser'=> $userIdForConfigJson
			);
			$this->Users_model->importConfigFileByUserId($arrayofdata);
			$data['request_status']  = true;
			$data['message']         = 'User games data inserted successfully';
		}
		header('Content-Type: application/json');
		$json_response = json_encode($data);
		echo $json_response;


	}

	public function exportUserConfigFile()
	{

		$userid      = $_GET['userid'];

		//$userid = $this->input->post('userid', TRUE);

		$configFiles = $this->Users_model->getConfigFileUserIdBy($userid);

		if(!empty($configFiles))
		{
			$data['request_status'] = true;
			$data['message']        = $configFiles;
		}
		else
		{
			$data['request_status']  = false;
			$data['message']         = 'Data Not Found';
		}

		header('Content-Type: application/json');
		$json_response = json_encode($data);
		echo $json_response;
	}



	public  function getUserId()
	{
		$userName    = $_GET['user'];
		$assetsinfo = $this->Users_model->getUserIdByUserName($userName);
		if($assetsinfo)
		{
			$data['request_status']         = true;
			$data['message']                = $assetsinfo;
		}
		else
		{
			$data['request_status']  = false;
			$data['message']         = 'Data Not Found';
		}
		header('Content-Type: application/json');
		$json_response = json_encode($data);
		echo $json_response;
	}

	public function login()
	{

		$data = array();
		$personUserName = $this->input->post('userName',True);
		$personPassword = $this->input->post('password',True);

		if (empty($personUserName) || empty($personPassword))
		{
			$result  = array('message'  => 'request failed');
			$data['request_status']   = false;
			$data['request_response'] = $result;
		}
		else
		{

			$hashArray  =  $this->Users_model->checkPasswordHash($personUserName);

			$hashString = implode(" ",$hashArray);

			if (!password_verify($personPassword,$hashString))
			{
				$result  = array('message'  => 'password is invalid');
				$data['request_status']   = false;
				$data['request_response'] = $result;
			}
			else
			{
				$confirm  = $this->Users_model->checkLogin($personUserName,$hashString);

				if($confirm)
				{
					$data['request_status']    = True;
					$data['request_response']  = $confirm;
				}
				else
				{
					$result = array('message'  => 'Invalid email or password.');
					$data['request_status']    = false;
					$data['request_response']  = $result;
				}
			}

		}
		header('Content-Type: application/json');
		$json_response = json_encode($data);
		echo $json_response;
	}


	public function register()
	{
		$user           = $this->input->post('user', TRUE);
		$password       = $this->input->post('password', TRUE);
		$passwordHash   = password_hash($password,PASSWORD_BCRYPT);
		$email          = $this->input->post('email', TRUE);
		if (empty($user) || empty($password) || empty($email)){
			$result  = array('message'  => 'request failed');
			$data['request_status']   = false;
			$data['request_response'] = $result;
		}
		else
		{
			$checkUserName  = $this->Users_model->checkUserName($user);
			$checkUserEmail = $this->Users_model->checkUserEmail($email);
			if(!empty($checkUserName))
			{
				$data['request_status']   = false;
				$data['request_response'] = 'Username already exist';
			}
			elseif (!empty($checkUserEmail))
			{
				$data['request_status']   = false;
				$data['request_response'] = 'Email already exist';
			}

			else
			{
				$randomString = '';
				$randomString = random_string('alnum', 40);
				$data = array(
					'userName' => $user,'password' => $passwordHash,
					'email'=>$email,'verification_hash'=>$randomString);
				// email
				$config = [
					'protocol' => 'mail',
					'smtp_host' => 'dontbelieveinstyle-com.mail.protection.outlook.com',
					'smtp_user' => 'lab@dontbelieveinstyle.com',
					'smtp_pass' => 'Tay71465',
					'smtp_crypto' => 'tls',
					'newline' => "\r\n", //REQUIRED! Notice the double quotes!
					'smtp_port' => 587,
					'mailtype' => 'html'
				];
				$this->load->library('email', $config);

				$message = 'This is an automatic email, please do not reply. Welcome to Your Game, '.ucfirst($data['userName']).
					'!Your account has been created, you can login with the credentials that you have inserted in the registration after you have activated your account by pressing the url below.
				Please click this link to activate your account:' .''. base_url('Api/verifiedUserAccount/?user='.$data['userName'].'&code='.$data['verification_hash']);
				$this->email->from('noreply@dontbelieveinstyle.com');// no reply email address
				$this->email->to($data['email']);
				$this->email->subject('Account verification');
				$this->email->message($message);
				$send =$this->email->send();

				$this->Users_model->insertAppUser($data);
				$data['request_status']  = true;
				$data['message']         = 'User Register Successfully';
				$data['email_status'] = $send;
			}
		}
		header('Content-Type: application/json');
		$json_response = json_encode($data);
		echo $json_response;
	}


	public function changePassword()
	{
		$userregiserid = $this->input->post('userid',True);
		$oldPassword   = $this->input->post('oldPassword', TRUE);
		$hashArray     =  $this->Users_model->getPasswordHashByUserId($userregiserid);
		$hashString    = implode(" ",$hashArray);
		if(!password_verify($oldPassword,$hashString))
		{
			$data['request_status']   = false;
			$data['request_response'] = 'old password is invalid';
		}
		else
		{
			$newPassword = $this->input->post('newPassword', TRUE);
			$confirmPassword = $this->input->post('confirmPassword', TRUE);
			if ($newPassword !== $confirmPassword)
			{
				$data['request_status'] = false;
				$data['request_response'] = 'New password and confirm password not matched';
			}
			else
			{
				$data = array('password' => password_hash($newPassword,PASSWORD_BCRYPT), 'idAppUser' => $userregiserid);
				$this->Users_model->updateUserPassword($userregiserid, $data);
				$data['request_status'] = true;
				$data['message'] = 'Password has been changed Successfully';
			}
		}

		header('Content-Type: application/json');
		$json_response = json_encode($data);
		echo $json_response;
	}


	public function verifiedUserAccount()
	{
		$verifiedUser = '';
		$verifiedCode = '';
		$verifiedUser = $_GET['user'];
		$verifiedCode = $_GET['code'];
		if(empty($this->Users_model->verifiedUserInfo($verifiedUser, $verifiedCode))) {
			$data['request_status'] = false;
			$data['message'] = 'Your not authorized user';

		}
		else
		{
			$data = array(
				'status' => 1
			);
			$this->Users_model->approvedUser($data);
			$data['request_status'] = true;
			$data['message'] = 'Congratulation your account has been Activated';
		}
		header('Content-Type: application/json');
		$json_response = json_encode($data);
		echo $json_response;
	}




	public function hello()
	{
		//show_404();

		//echo random_string('alnum', 40);

		//$st = 'LSWPXwV4URcOrhts8Dxa0jHo3Cn1p9fgNMdJblYk';
		//echo strlen($st);
	}


	public function insert_fuzzy_query()
	{
		
		$name           = $this->input->post('name', TRUE);
		$description    = $this->input->post('description', TRUE);
		if (empty($name) || empty($description)){
			$result  = array('message'  => 'request failed');
			$data['request_status']   = false;
			$data['request_response'] = $result;
		}
		else
		{

		$data = array('name' => $name,'description'=>$description);
		$this->fuzzy->insertData($data);
		$data['request_status']  = true;
		$data['message']         = 'Data inserted Successfully';
		}
		header('Content-Type: application/json');
		$json_response = json_encode($data);
		echo $json_response;
	}



	public function randomHash()
	{
		$length = 32;
		$token = bin2hex(random_bytes($length));
		echo $token;
	}


	public  function backgroundPython()

	{
		$command = escapeshellcmd('python readJson.py');
		$output  = shell_exec($command);
		//echo '<pre>';
		print_r($output);
	}

}
