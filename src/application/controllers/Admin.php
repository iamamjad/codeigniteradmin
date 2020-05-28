<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('AdminModel');
		
	}

	public function index()

	{
		$this->load->view('admin/login');
	}



	public function doLogin()

	{
		$personEmail 	 = $this->input->post('email');
		$personPassword  = $this->input->post('password');
		$hashArray  	 =  $this->AdminModel->checkPasswordHash($personEmail);
		$hashString      = implode(" ",$hashArray);
		if (password_verify($personPassword,$hashString))
		{
			$check_login     = $this->AdminModel->checkLogin($personEmail, $hashString);

			
			if(!empty($check_login))
			{
				$records = array(
					'PersonName'=> $check_login[0]['name'],
					'personEmail'=> $check_login[0]['email'],
					'personRole'=>$check_login[0]['roles']
								);
				$this->session->set_userdata($records,true);
				redirect(base_url().'admin/welcome');
			}
		}
		else
		{
			$this->session->set_flashdata('msg', 'Email and password is Invalid');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


	public function welcome()
	{
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('admin/dashboard');
		$this->load->view('template/footer');
	}

	public function logout()
	{
		$this->session->unset_userdata('personEmail');
		redirect(base_url(),'refresh');
	}


	public function registrationView()
	{

		$this->load->view('admin/register');

	}

	public function registerNewUser()
	{
		$personName	 	 = $this->input->post('fullName');
		$personEmail	 = $this->input->post('email');
		$personPassword  = $this->input->post('password');
		$roles           = $this->input->post('roles');
		$passwordHash    = password_hash($personPassword,PASSWORD_BCRYPT);
		$csrf_token      = $this->security->get_csrf_hash();
		$data 		     = array('csrf_token'=>$csrf_token);
		$registerUser 	 = array('name'=>$personName, 'email'=>$personEmail, 'password'=>$passwordHash,'roles'=>$roles);
		$this->AdminModel->insertData($registerUser);
		$data['response']  = $registerUser;
		echo json_encode($data);
	}

	public function changeAdminPassword()
	{
		$dummyValueOfAdmin  = $this->input->post('dummy');
		$oldPassword	 	= $this->input->post('oldPassword');
		$newPassword 		= $this->input->post('newPassword');
    	$confirmNewPassword = $this->input->post('confirmNewPassword');
    	$verifyOldPassword  = password_hash($oldPassword, PASSWORD_BCRYPT);
		$getPasswordFromDb  = $this->AdminModel->checkPasswordHash($dummyValueOfAdmin);
		$hashString 		= implode(" ",$getPasswordFromDb);

		if (!password_verify($oldPassword,$hashString))
		{

			$this->session->set_flashdata('invalidPassword', 'old Password is Invalid.....!');
			redirect($_SERVER['HTTP_REFERER']);
		}
		else
		{
			$data = array('password' => password_hash($confirmNewPassword, PASSWORD_BCRYPT), 'email' => $dummyValueOfAdmin);
			$success =$this->AdminModel->updateAdminPassword($dummyValueOfAdmin, $data);
			if ($success)
			{
				echo 'password has been updated....!';

			}
		}
	}
	public function db_backup()
	{
		$this->load->helper('url');
		$this->load->helper('file');
		$this->load->helper('download');
		$this->load->library('zip');
		$this->load->dbutil();
		$db_format=array('format'=>'zip','filename'=>'my_db_backup.sql');
		$backup = $this->dbutil->backup($db_format);
		$dbname='backup-on-'.date('Y-m-d').'.zip';
		$save='assets/db_backup/'.$dbname;
		write_file($save,$backup);
		force_download($dbname,$backup);
	}
}


