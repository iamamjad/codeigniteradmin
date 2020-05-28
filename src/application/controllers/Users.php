<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {



	function __construct()
	{
		parent::__construct();

		$this->load->model('Users_model','UsersModel');
	}

	public function index()

	{
		$data['page_title'] = 'All Register Users';
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$data['records']=$this->UsersModel->getData();
		$this->load->view('user/usersView',$data);
		$this->load->view('template/footer');
	}

	public function profile()
	{

		$this->load->view('template/header');
		$this->load->view('template/menu');
		$data['page_title'] = 'Gamesave';
		$id = $this->uri->segment('3');
		$data['records']=$this->UsersModel->getUserGameSave($id);
		$this->load->view('user/profile',$data);
		$this->load->view('template/footer');
	}

	public function delete($id){

		$segmentUri = $this->uri->segment('3');
		if ($segmentUri) {
			$this->UsersModel->deleteContent($id);
			$data['records'] = $this->UsersModel->getData();
			$this->load->view('user/usersView',$data);
		}

	}


	public function forgetPasswordView()
	{
		$this->load->view('user/resetpassword');
	}

	public function forgetPassword()
	{

		$userRegiserEmail = $this->input->post('emailInput',TRUE);
		$checkUserinfo    = $this->UsersModel->validatekUserEmail($userRegiserEmail);

		if (empty($checkUserinfo))
		{
			$this->session->set_flashdata('exist', 'Email not exist');
			redirect($_SERVER['HTTP_REFERER']);
		}
		else
		{
			$userId       = $checkUserinfo['idAppUser'];
			$userEmail    = $checkUserinfo['email'];
			$randomString = random_string('alnum', 40);
			$arrayofData  = array('forget_password_hash'=> $randomString,'idAppUser' => $userId);
			$config 	  = [
				'protocol' => 'mail',
				'smtp_host' => 'smtp.office365.com',
				'smtp_user' => 'lab@dontbelieveinstyle.com',
				'smtp_pass' => 'Tay71465',
				'smtp_crypto' => 'tls',
				'newline' => "\r\n", //REQUIRED! Notice the double quotes!
				'smtp_port' => 587,
				'mailtype' => 'html'
			];
			$this->load->library('email', $config);
			$message = 'This is an automatic email, please do not reply. Welcome , '.$checkUserinfo['email'].', Please click the below link to generate your New Password:
					' .''. base_url('Users/enterNewPassword/'.$arrayofData['forget_password_hash'].'/'.$userId);
			$this->email->from('lab@dontbelieveinstyle.com'); // no reply email address
			$this->email->to($userEmail);
			$this->email->subject('Forget Password');
			$this->email->message($message);
			$this->email->send();
			$this->UsersModel->insertForgetUsePassword($arrayofData);
			$this->session->set_flashdata('msg', 'Verification Code has been send Please check your mail');
			redirect('Users/forgetPasswordView');
		}
	}


	public function enterNewPassword()
	{


		$segments = $this->uri->segment(3);
		$segmentsforId = $this->uri->segment(4);

		$resultArray =$this->UsersModel->verifiedUserInfoForgetPassword($segments,$segmentsforId);
		$NEWQ =$segmentsforId == $resultArray['idAppUser'];

		if($_POST){

			$userNewPassword     = $this->input->post('newPassword',TRUE);
			$userConfirmPassword = $this->input->post('confirmNewPassword',TRUE);

			if ($userNewPassword !== $userConfirmPassword)
			{
				$this->session->set_flashdata('exist', 'Password not matched');
				redirect($_SERVER['HTTP_REFERER']);
			}

			else
			{
				$data = array('password' => password_hash($userConfirmPassword, PASSWORD_BCRYPT), 'idAppUser' => $NEWQ);
				$this->UsersModel->updateUserPassword($NEWQ, $data);
				$this->session->set_flashdata('msg', ' Your password has been update successfully');
				redirect('Users/success');
			}


		}
		$this->load->view('user/addNewPassword');

	}

	public function success()
	{
		$this->load->view('user/welcome');
	}

	public function registration()
	{
		$this->load->view('user/register');
	}

	public function insert()
	{
		$name	 	   = $this->input->post('personName',true);
		$checkUserName = $this->input->post('personUsername',true);
		$email	       = $this->input->post('personEmail',true);
		$password      = $this->input->post('personPassword',true);
		$categories    = $this->input->post('categories',true);
		$datepicker    = $this->input->post('datepicker',true);
		$gender    	   = $this->input->post('gender',true);
		$passwordHash  = password_hash($password,PASSWORD_BCRYPT);
		$csrf_token    = $this->security->get_csrf_hash();
		$data 		   = array('csrf_token'=>$csrf_token);
		$randomString = '';
		$randomString = random_string('alnum', 40);

		$registerUser  = array('name'=>$name,'userName'=>$checkUserName, 'email'=>$email,'dateofbirth'=>$datepicker,'gender'=>$gender,
			'password'=>$passwordHash,'categories'=>$categories,'verification_hash'=>$randomString);
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

		$message = 'This is an automatic email, please do not reply. Welcome to Your Game, '.ucfirst($registerUser['userName']).
			'!Your account has been created, you can login with the credentials that you have inserted in the registration after you have activated your account by pressing the url below.
				Please click this link to activate your account:' .''. base_url('Api/verifiedUserAccount/?user='.$registerUser['userName'].'&code='.$registerUser['verification_hash']);
		$this->email->from('noreply@dontbelieveinstyle.com');// no reply email address
		$this->email->to($registerUser['email']);
		$this->email->subject('Account verification');
		$this->email->message($message);
		$this->email->send();

		$this->UsersModel->insertAppUser($registerUser);
		$data['response']  = $registerUser;
		echo json_encode($data);

	}

	public  function  personUsername()
	{

		$username = $this->input->post('personUsername',true);
		$exists   = $this->UsersModel->checkUserName($username);
		if (is_array($exists))
		{
			echo '1';
		}
		else
		{
			echo '0';
		}
	}

	public  function  personEmail()
	{
		$username = $this->input->post('personEmail',true);
		$exists   = $this->UsersModel->checkUserEmail($username);
		if (is_array($exists))
		{
			echo '1';
		}
		else
		{
			echo '0';
		}
	}

	public function login()
	{
		$this->load->view('user/login');
	}
}


