<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IbmWaston extends CI_Controller {



	function __construct()
	{
		parent::__construct();

		$this->load->model('Ibm_model');
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$data['page_title'] = 'Ibm Watson';
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$data['records'] = $this->Ibm_model->getData();
		$this->load->view('ibmwatson/view',$data);
		$this->load->view('template/footer');
	}

	public function add()
	{
		$data['page_title'] = 'add storage';
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('ibmwatson/add',$data);
		$this->load->view('template/footer');
	}

	public function doUpload()
	{

		$storageTitle   = $this->input->post('title',TRUE);

		$config = array(
			'upload_path' => "./upload/Ibm/",
			'allowed_types' => '*',
			'overwrite' => TRUE
		);
		$this->load->library('upload', $config);
		$this->upload->do_upload('fileStorage');
		$dataofArrays         = array('upload_data' => $this->upload->data());
		$addrecordArrays      = array('storageTitle' => $storageTitle, 'storagePath'=>base_url('upload/Ibm/'.$dataofArrays['upload_data']['file_name']),
			'storageName'=> $dataofArrays['upload_data']['file_name']);

		if ($_FILES['fileStorage']['name'] == '')
		{
			$addrecordArrays = array('storageTitle'=> $storageTitle);
		}
		$this->Ibm_model->insertData($addrecordArrays);
		$this->session->set_flashdata('storageMessage', 'Storage is  added Successfully');
		redirect('IbmWaston/add');
	}


	public function delete($id)
	{
		$segmentUri = $this->uri->segment('3');
		if ($segmentUri) {
			$this->Ibm_model->deleteContent($id);
			$data['records'] = $this->Ibm_model->getData();
			$this->load->view('ibmwatson/view',$data);
		}
	}

	public function edit ($id) {
		if($_POST)
		{
			$storageTitle   = $this->input->post('title',TRUE);

			$config = array( 'upload_path' => "./upload/Ibm/",
							'allowed_types' => '*', 'overwrite' => TRUE);
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload('fileStorage');

			if($_FILES['fileStorage']['name'] != '')
			{

			$ImageArray  = array('upload_data' => $this->upload->data());
			$filePathtoSave = base_url('upload/Ibm/'.$ImageArray['upload_data']['file_name']);
			$add = array('storageTitle' => $storageTitle,
			'storagePath'=>$filePathtoSave,'storageName' =>$ImageArray['upload_data']['file_name']);
			}

			if ($_FILES['fileStorage']['name'] == '')
			{
				$add = array('storageTitle'=> $storageTitle);
			}
			if($this->Ibm_model->updateStorage($id,$add))
			{
				$this->session->set_flashdata('editSuccess', 'Succesfully Updated');
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				$this->session->set_flashdata('editFail', 'Failed Try Again');
			}
		}
		$data['page_title'] = 'Storage Edit';
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$data['record'] = $this->Ibm_model->getDataById($id);
		$this->load->view('ibmwatson/edit',$data);
		$this->load->view('template/footer');
	}


}
