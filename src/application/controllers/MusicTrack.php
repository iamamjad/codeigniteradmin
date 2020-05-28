<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MusicTrack extends CI_Controller {



    function __construct()
    {
        parent::__construct();

        $this->load->model('MusicModel','music');
        $this->load->helper(array('form', 'url'));
    }

	public function index()
	{
		$data['page_title'] = 'page title';
		$this->load->view('template/header');
		$this->load->view('template/menu');
     $data['records'] = $this->music->getData();    
     $this->load->view('musictrack/musicView',$data);
		$this->load->view('template/footer');
	
	}

	public function add()
	{

	$this->load->view('template/header');
	$this->load->view('template/menu');
	$this->load->view('musictrack/musicAdd');
	$this->load->view('template/footer');

    }


      public function doUpload()
        {
            
         $musicTitle   = $this->input->post('musicTitle',TRUE);
         $musicTags    = $this->input->post('musicTags',TRUE);   
         $config = array(
        'upload_path' => "./upload/MusicTrack/",
        'allowed_types' => '*',
        'overwrite' => TRUE
        );

        $this->load->library('upload', $config);
    
        if($this->upload->do_upload('musicFileToUpload'))
        {

        $dataofArrays    = array('upload_data' => $this->upload->data());

        $addrecordArrays = array(

                      'title'               => $musicTitle,
                      'tags'                =>$musicTags,
                      'musicFilePath'=>base_url('upload/MusicTrack/'.$dataofArrays['upload_data']['file_name']),
                      'size'                => $dataofArrays['upload_data']['file_size'],
                      'musicFileName'=> $dataofArrays['upload_data']['file_name']    
                              );                          
         $this->music->insertData($addrecordArrays);
         $this->session->set_flashdata('msg', 'Sounds added Successfully');

         }
         
         redirect('MusicTrack/add');          
        
        }

        function edit ($id) {

    
        if($_POST)
        {

         $musicTitle   = $this->input->post('musicTitle',TRUE);
         $musicTags    = $this->input->post('musicTags',TRUE); 

     
          $config = array(
        'upload_path' => "./upload/MusicTrack/",
        'allowed_types' => '*',
        'overwrite' => TRUE
            );
            $this->load->library('upload', $config);
            //$new_name               = time().$shaderName;
            //$config['file_name']    = $new_name;

            $this->upload->initialize($config);
            $this->upload->do_upload('musicFileToUpload');


            if($_FILES['musicFileToUpload']['name'] != ''){

                $ImageArray  = array('upload_data' => $this->upload->data());

                $filePathtoSave = base_url('upload/MusicTrack/'.$ImageArray['upload_data']['file_name']);

                $add = array(
                    'title'                => $musicTitle,
                    'tags'                 =>$musicTags,  
                    'musicFilePath' => $filePathtoSave,
                    'musicFileName'=>$ImageArray['upload_data']['file_name']
                );

            }

            if ($_FILES['musicFileToUpload']['name'] == ''){

                $add = array(
                     'title'       => $musicTitle,
                     'tags'        => $musicTags 
                );
            }
            
            if($this->music->updateAssetbundles($id,$add))
            
            {
                $this->session->set_flashdata('editSuccess', 'Succesfully Updated');
                redirect($_SERVER['HTTP_REFERER']);

            }
            else
            {
                $this->session->set_flashdata('editFail', 'Failed Try Again');
            }

        }

          $data['record'] = $this->music->getDataById($id);
         
          $this->load->view('musictrack/musicEdit',$data);
    }





        public function delete($id)
        {
        
         $segmentUri = $this->uri->segment('3');
          if ($segmentUri) {
             $this->music->deleteContent($id);
             $data['records'] = $this->music->getData();
             $this->load->view('musictrack/musicView',$data);
           } 

        }


}
