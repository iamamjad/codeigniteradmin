<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OperationTo3DModel extends CI_Controller {



    function __construct()
    {
        parent::__construct();

        $this->load->model('QueryTo3dModel');
        $this->load->model('CategoryModel','category');
        $this->load->helper(array('form', 'url'));
        $this->load->library('zip');
    }

	public function index()
	{

		$this->load->view('template/header');
		$this->load->view('template/menu');
	$data['records'] = $this->QueryTo3dModel->getData();
     $this->load->view('3dmodels/3dModelView',$data);
		$this->load->view('template/footer');
	}



	public  function downlodFiles($type = '')
	{
		if ($type == '')

		{
			$records =$this->QueryTo3dModel->getData();

			if($this->input->post('exportToZip') != NULL) {
				foreach ($records as $record) {
					$fileName = FCPATH . "upload/3DModules/" . $record->model_fileName;
					$this->zip->read_file($fileName);
				}
				// Download
				$filename = "3Dmodels.zip";
				$this->zip->download($filename);

			}
		}

		if ($type!=='')
		{
			$id = $this->uri->segment(3);
			$records = $this->QueryTo3dModel->getDataAllCategoryById($id);

			if($this->input->post('exportToZip') != NULL) {
				foreach ($records as $record) {
					$fileName = FCPATH . "upload/3DModules/" . $record->model_fileName;
					$this->zip->read_file($fileName);
				}
				// Download
				$filename = "3Dmodels.zip";
				$this->zip->download($filename);

			}
		}


	}





	public function testZiper($id=3)
	{
		$records = $this->QueryTo3dModel->getDataAllCategoryById($id);


		foreach ($records as $row)
		{
			$fileName = base_url().'upload/3DModules/'.$row->model_fileName;

			$this->zip->add_data($fileName);
		}
		$this->zip->download('3dmodules.zip');
	}


	public function add()
	{
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$data['categories'] = $this->category->getData();
       $this->load->view('3dmodels/3dModelAdd',$data);
		$this->load->view('template/footer');

    }


      public function doUpload()
        {
         
         $modelTitle   = $this->input->post('3ModelTitle',TRUE);
         $modelTags    = $this->input->post('3DModelTags',TRUE);
         $modelStatus    = $this->input->post('modelStatus',TRUE);
         $modelCategory    = $this->input->post('modelCategory',TRUE);

         $config = array(
        'upload_path' => "./upload/3DModules/",
        'allowed_types' => '*',
        'overwrite' => TRUE
        );

        $this->load->library('upload', $config);
    
        if($this->upload->do_upload('3DModelfileUpload'))
        {

        $dataofArrays    = array('upload_data' => $this->upload->data());

        $addrecordArrays = array(

                      'title'         => $modelTitle,
                      'tags'          => $modelTags,
                      'status'		  => $modelStatus,
                      'model_url'     =>base_url('upload/3DModules/'.$dataofArrays['upload_data']['file_name']),
                      'size'          => $dataofArrays['upload_data']['file_size'],
                      'model_fileName'=> $dataofArrays['upload_data']['file_name'],
                      'idCategory'    => $modelCategory );                          
         $this->QueryTo3dModel->insertData($addrecordArrays);
         $this->session->set_flashdata('msg', '3DModules added Successfully');

         }
         redirect('OperationTo3DModel/add');          
        
        }


        public function delete($id)
        {
        
         $segmentUri = $this->uri->segment('3');
          if ($segmentUri) {
             $this->QueryTo3dModel->deleteContent($id);
             $data['records'] = $this->QueryTo3dModel->getData();
             $this->load->view('3dmodels/3dModelView',$data);
           } 

        }



        function edit ($id) {

    
        if($_POST)
        {

         $ModelTitle    = $this->input->post('3DModelTitle',TRUE);
         $ModelTags     = $this->input->post('3DModelTags',TRUE); 
         $modelCategory = $this->input->post('modelCategory',TRUE);
         $modelStatus    = $this->input->post('modelStatus',TRUE);

     
          $config = array(
        'upload_path' => "./upload/3DModules/",
        'allowed_types' => '*',
        'overwrite' => TRUE
            );
            $this->load->library('upload', $config);
            //$new_name               = time().$shaderName;
            //$config['file_name']    = $new_name;

            $this->upload->initialize($config);
            $this->upload->do_upload('3DModelfileUpload');


            if($_FILES['3DModelfileUpload']['name'] != ''){

                $ImageArray  = array('upload_data' => $this->upload->data());

                $filePathtoSave = base_url('upload/3DModules/'.$ImageArray['upload_data']['file_name']);

                $add = array(
                    'title'         => $ModelTitle,
                    'tags'          =>$ModelTags,
                    'idCategory'    =>$modelCategory,      
                    'model_url'     => $filePathtoSave,
                    'model_fileName'=>$ImageArray['upload_data']['file_name'],
					'status' => $modelStatus
                );

            }

            if ($_FILES['3DModelfileUpload']['name'] == ''){

                $add = array(
                     'title'       => $ModelTitle,
                     'tags'        => $ModelTags,
                     'idCategory'    =>$modelCategory,
					'status'=> $modelStatus
                );
            }
            
            if($this->QueryTo3dModel->updateAssetbundles($id,$add))
            
            {
                $this->session->set_flashdata('editSuccess', 'Succesfully Updated');
                redirect($_SERVER['HTTP_REFERER']);

            }
            else
            {
                $this->session->set_flashdata('editFail', 'Failed Try Again');
            }

        }

          $data['categories'] = $this->category->getData(); 
          $data['record'] = $this->QueryTo3dModel->getDataById($id);
         
          $this->load->view('3dmodels/3dModelEdit',$data);
    }

    public function getAllCategory()
    {
		$this->load->view('template/header');
		$this->load->view('template/menu');
     $data['categories'] = $this->category->getActivedata();    
     $this->load->view('3dmodels/modelviews',$data);

		$this->load->view('template/footer');
    }

    public function getEachCategoryById($id)
    {
		$this->load->view('template/header');
		$this->load->view('template/menu');

    	$data['records'] = $this->QueryTo3dModel->getDataByIdCategory($id);
         
        $this->load->view('3dmodels/3dModelView',$data);

		$this->load->view('template/footer');

    }


}
