<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {



    function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$this->load->view('3DModels/add');
	}
	public function assetsManagement()
	{
		print_r($_FILES);
	}

	public function soundeffects()
	{
		echo 'Soundeffects';	
	}
}
