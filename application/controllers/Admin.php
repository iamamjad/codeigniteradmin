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
	
		$personEmail 	= $this->input->post('email');

    	$personPassword = $this->input->post('password');

    
        $check_login = $this->AdminModel->checkLogin($personEmail, $personPassword);
        
        
        if ($check_login) {
           
            $this->session->set_userdata('logged_in', true);
            redirect(base_url().'admin/welcome');
        } 
        else {
            
            $this->session->set_userdata('logged_in', false);
            
           
            $this->session->set_flashdata('msg', 'Email and password is Invalid');
            redirect(base_url(),'refresh');
            //redirect(base_url().'Admin','refresh');            
        } 

	}


	public function welcome(){

	$this->load->view('admin/dashboard');	
	}


	public function registrationView(){

	$this->load->view('admin/register');	
	}
	
	public function registerNewUser() 
	{
	
	$personName		= $this->input->post('fullName');
    $personEmail	= $this->input->post('email');
    $personPassword = $this->input->post('password');
  
    $data = array

    (
        'name'=>$personName,
        'email'=>$personEmail,
        'password'=>$personPassword
    );
		
	$this->AdminModel->insertData($data);
    $this->session->set_flashdata('registerSuccess', 'User is register successfully');

    $this->load->view('admin/register');
	
	}

	public function logout() {
       
        $this->session->unset_userdata('logged_in');
        redirect(base_url(),'refresh');
    }

}
	

