<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shaders extends CI_Controller {



    function __construct()
    {
        parent::__construct();

        $this->load->model('ShaderModel');
        $this->load->helper(array('form', 'url'));
    }

	public function index()
	{
	
     $data['records'] = $this->ShaderModel->getData();

     $this->load->view('admin/shaderView',$data);		
	
	}

	public function add()
	{

	$this->load->view('admin/shaderAdd');

	}

      public function doUpload()
        {
         $shaderName    = $this->input->post('shaderName',TRUE);   
         $config = array(
        'upload_path' => "./upload/shaders/",
        'allowed_types' => '*',
        'overwrite' => TRUE
        );

        $this->load->library('upload', $config);
        
        if($this->upload->do_upload('fileUpload'))
        {

        $data = array('upload_data' => $this->upload->data());

       $filePathtoSave = base_url('upload/shaders/'.$data['upload_data']['file_name']);

        $addrecord     = array(
                    'name'        => $shaderName,
                    'shaders_path'=>$filePathtoSave,
                    'shaderFileName'=> $data['upload_data']['file_name']
                              );
         $this->ShaderModel->insertData($addrecord);
         $this->session->set_flashdata('msg', 'Shaders added Successfully');

         }
         redirect('Shaders/add');          
        
        }

}
