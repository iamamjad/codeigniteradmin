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
		$data['page_title'] = 'Page title';
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$data['records'] = $this->ShaderModel->getData();
        $this->load->view('shaders/shaderView',$data);
		$this->load->view('template/footer');
	}

	public function add()
	{

		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('shaders/shaderAdd');
		$this->load->view('template/footer');

	}

      public function doUpload()
        {
         $shaderTitle    = $this->input->post('shaderTitle',TRUE); 
         $shaderTags    = $this->input->post('shaderTags',TRUE);   
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
                    'title'          => $shaderTitle,
                    'tags'           => $shaderTags,
                    'shaderFilePath' => $filePathtoSave,
                    'shaderFileName' => $data['upload_data']['file_name']
                              );
         $this->ShaderModel->insertData($addrecord);
         $this->session->set_flashdata('msg', 'Shaders added Successfully');

         }
         redirect('Shaders/add');          
        
        }


        public function delete($id)
        {
        
         $segmentUri = $this->uri->segment('3');
          if ($segmentUri) {
             $this->ShaderModel->deleteContent($id);
             $data['records'] = $this->ShaderModel->getData();
             $this->load->view('shaders/shaderView',$data);
           } 

        }



        function edit ($id) {

    
        if($_POST)
        {

        $shaderTitle = $this->input->post('shaderTitle',TRUE); 
        $shaderTags  = $this->input->post('shaderTags',TRUE);   

     
          $config = array(
        'upload_path' => "./upload/shaders/",
        'allowed_types' => '*',
        'overwrite' => TRUE
            );
            $this->load->library('upload', $config);
            //$new_name               = time().$shaderName;
            //$config['file_name']    = $new_name;

            $this->upload->initialize($config);
            $this->upload->do_upload('fileUpload');


            if($_FILES['fileUpload']['name'] != ''){

                $ImageArray  = array('upload_data' => $this->upload->data());

                $filePathtoSave = base_url('upload/shaders/'.$ImageArray['upload_data']['file_name']);

                $add = array(
                    'title'             => $shaderTitle,
                    'tags'              => $shaderTags, 
                    'shaderFilePath'    => $filePathtoSave,
                    'shaderFileName'=>$ImageArray['upload_data']['file_name']
                );

            }

            if ($_FILES['fileUpload']['name'] == ''){


                $add = array(
                    'title'  => $shaderTitle,
                    'tags'   => $shaderTags
                );

            }


            if($this->ShaderModel->updateShader($id,$add))
            {
                $this->session->set_flashdata('UpdateSuccess', 'Succesfully Updated');
                redirect($_SERVER['HTTP_REFERER']);

            }
            else
            {
                $this->session->set_flashdata('UpdateFail', 'Failed Try Again');
            }

        }

          $data['record'] = $this->ShaderModel->getDataById($id);
         
          $this->load->view('shaders/shaderEdit',$data);

    }


}
