<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Animation extends CI_Controller {



    function __construct()
    {
        parent::__construct();

        $this->load->model('AnimationModel','animation');
        $this->load->helper(array('form', 'url'));
    }

	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('template/menu');
     $data['records'] = $this->animation->getData();    
     $this->load->view('animation/animationView',$data);
		$this->load->view('template/footer');

	
	}

	public function add()
	{
		$this->load->view('template/header');
		$this->load->view('template/menu');
	    $this->load->view('animation/animationAdd');
		$this->load->view('template/footer');

    }


      public function doUpload()
        {
            
         $animationTitle   = $this->input->post('animationTitle',TRUE);
         $animationTags    = $this->input->post('animationTags',TRUE);   
         $config = array(
        'upload_path' => "./upload/Animation/",
        'allowed_types' => '*',
        'overwrite' => TRUE
        );

        $this->load->library('upload', $config);
    
        if($this->upload->do_upload('animationFileToUpload'))
        {

        $dataofArrays    = array('upload_data' => $this->upload->data());

        $addrecordArrays = array(

                      'title'               => $animationTitle,
                      'tags'                =>$animationTags,
                      'animationFilePath'=>base_url('upload/Animation/'.$dataofArrays['upload_data']['file_name']),
                      'size'                => $dataofArrays['upload_data']['file_size'],
                      'animationFileName'=> $dataofArrays['upload_data']['file_name']    
                              );                          
         $this->animation->insertData($addrecordArrays);
         $this->session->set_flashdata('msg', 'Sounds added Successfully');

         }
         
         redirect('Animation/add');          
        
        }

        function edit ($id) {

    
        if($_POST)
        {

         $animationTitle   = $this->input->post('animationTitle',TRUE);
         $animationTags    = $this->input->post('animationTags',TRUE); 

     
          $config = array(
        'upload_path' => "./upload/Animation/",
        'allowed_types' => '*',
        'overwrite' => TRUE
            );
            $this->load->library('upload', $config);
            //$new_name               = time().$shaderName;
            //$config['file_name']    = $new_name;

            $this->upload->initialize($config);
            $this->upload->do_upload('animationFileToUpload');


            if($_FILES['animationFileToUpload']['name'] != ''){

                $ImageArray  = array('upload_data' => $this->upload->data());

                $filePathtoSave = base_url('upload/Animation/'.$ImageArray['upload_data']['file_name']);

                $add = array(
                    'title'                => $animationTitle,
                    'tags'                 =>$animationTags,  
                    'animationFilePath' => $filePathtoSave,
                    'animationFileName'=>$ImageArray['upload_data']['file_name']
                );

            }

            if ($_FILES['animationFileToUpload']['name'] == ''){

                $add = array(
                     'title'       => $animationTitle,
                     'tags'        => $animationTags 
                );
            }
            
            if($this->animation->updateAssetbundles($id,$add))
            
            {
                $this->session->set_flashdata('editSuccess', 'Succesfully Updated');
                redirect($_SERVER['HTTP_REFERER']);

            }
            else
            {
                $this->session->set_flashdata('editFail', 'Failed Try Again');
            }

        }

          $data['record'] = $this->animation->getDataById($id);
         
          $this->load->view('animation/animationEdit',$data);
    }


        public function delete($id)
        {
        
         $segmentUri = $this->uri->segment('3');
          if ($segmentUri) 
          {
             $this->animation->deleteContent($id);
             $data['records'] = $this->animation->getData();
             $this->load->view('animation/animationView',$data);
           } 

        }

}
