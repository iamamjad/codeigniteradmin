<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SoundsEffects extends CI_Controller {



    function __construct()
    {
        parent::__construct();
        $this->load->model('SoundsModel','sound');
        $this->load->helper(array('form', 'url'));
    }

	public function index()
	{
		$data['page_title'] = 'Sounds effects';
		$this->load->view('template/header');
		$this->load->view('template/menu');
	 	$data['records'] = $this->sound->getData();
     	$this->load->view('soundseffects/soundsView',$data);
		$this->load->view('template/footer');
	}

	public function add()
	{
	$data['page_title'] = 'Add Sounds Effects';
	$this->load->view('template/header');
	$this->load->view('template/menu');
	$this->load->view('soundseffects/soundsAdd',$data);
	$this->load->view('template/footer');
    }

      public function doUpload()
        {
            
         $soundsTitle   = $this->input->post('soundsTitle',TRUE);
         $soundsTags    = $this->input->post('soundsTags',TRUE);   
         $config = array(
        'upload_path' => "./upload/Sounds/",
        'allowed_types' => '*',
        'overwrite' => TRUE
        );

        $this->load->library('upload', $config);
    
        if($this->upload->do_upload('soundsFileToUpload'))
        {

        $dataofArrays    = array('upload_data' => $this->upload->data());

        $addrecordArrays = array(

                      'title'               => $soundsTitle,
                      'tags'                =>$soundsTags,
                      'soundsFilePath'=>base_url('upload/Sounds/'.$dataofArrays['upload_data']['file_name']),
                      'size'                => $dataofArrays['upload_data']['file_size'],
                      'soundsFileName'=> $dataofArrays['upload_data']['file_name']    
                              );                          
         $this->sound->insertData($addrecordArrays);
         $this->session->set_flashdata('msg', 'Sounds added Successfully');

         }
         
         redirect('SoundsEffects/add');          
        
        }

        function edit ($id) {

    
        if($_POST)
        {

         $soundsTitle   = $this->input->post('soundsTitle',TRUE);
         $soundsTags    = $this->input->post('soundsTags',TRUE); 

     
          $config = array(
        'upload_path' => "./upload/Sounds/",
        'allowed_types' => '*',
        'overwrite' => TRUE
            );
            $this->load->library('upload', $config);
            //$new_name               = time().$shaderName;
            //$config['file_name']    = $new_name;

            $this->upload->initialize($config);
            $this->upload->do_upload('soundsFileToUpload');


            if($_FILES['soundsFileToUpload']['name'] != ''){

                $ImageArray  = array('upload_data' => $this->upload->data());

                $filePathtoSave = base_url('upload/Sounds/'.$ImageArray['upload_data']['file_name']);

                $add = array(
                    'title'                => $soundsTitle,
                    'tags'                 =>$soundsTags,  
                    'soundsFilePath' => $filePathtoSave,
                    'soundsFileName'=>$ImageArray['upload_data']['file_name']
                );

            }

            if ($_FILES['soundsFileToUpload']['name'] == ''){

                $add = array(
                     'title'       => $soundsTitle,
                     'tags'        => $soundsTags 
                );
            }
            
            if($this->sound->updateAssetbundles($id,$add))
            
            {
                $this->session->set_flashdata('editSuccess', 'Succesfully Updated');
                redirect($_SERVER['HTTP_REFERER']);

            }
            else
            {
                $this->session->set_flashdata('editFail', 'Failed Try Again');
            }

        }

          $data['record'] = $this->sound->getDataById($id);
         
          $this->load->view('soundseffects/soundsEdit',$data);
    }

        public function delete($id)
        {
        
         $segmentUri = $this->uri->segment('3');
          if ($segmentUri) {
             $this->sound->deleteContent($id);
             $data['records'] = $this->sound->getData();
             $this->load->view('soundseffects/soundsView',$data);
           } 

        }


}
