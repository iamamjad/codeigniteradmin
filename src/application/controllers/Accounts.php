<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('AdminModel');
		$this->load->library('form_validation');

	}

	public function index()

	{
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$data['records'] = $this->AdminModel->getData();
		$this->load->view('accounts/view',$data);
		$this->load->view('template/footer');
	}

	public function add()
	{
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('accounts/add');
		$this->load->view('template/footer');

	}
	public function insert()
	{

		$this->form_validation->set_rules('fullName', 'fullName', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required',
			array('required' => 'You must provide a %s.')
		);

		$this->form_validation->set_rules('email', 'Email', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('template/header');
			$this->load->view('template/menu');
			$this->load->view('Accounts/add');
			$this->load->view('template/footer');
		}
		else
		{
			$personName	 	 = $this->input->post('fullName');
			$personEmail	 = $this->input->post('email');
			$personPassword  = $this->input->post('password');
			$roles           = $this->input->post('roles');
			$passwordHash    = password_hash($personPassword,PASSWORD_BCRYPT);
			$registerUser 	 = array('name'=>$personName, 'email'=>$personEmail, 'password'=>$passwordHash,'roles'=>$roles);
			$this->AdminModel->insertData($registerUser);
			$this->session->set_flashdata('msg', 'Account has been created Successfully');
			redirect('Accounts/add');
		}

	}

	public function delete($id){

		$segmentUri = $this->uri->segment('3');
		if ($segmentUri) {
			$this->AdminModel->removeAccount($id);
			$data['records'] = $this->AdminModel->getData();
			$this->load->view('Accounts/view',$data);
		}

	}

}


