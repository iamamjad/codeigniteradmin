<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skybox extends CI_Controller {



	function __construct()
	{
		parent::__construct();

		$this->load->model('SkyboxModel','skybox');
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{

		$this->load->view('template/header');
		$this->load->view('template/menu');
		$data['records'] = $this->skybox->getData();
		$this->load->view('skybox/skyboxView',$data);
		$this->load->view('template/footer');

	}

	public function add()
	{
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('skybox/skyboxAdd');
		$this->load->view('template/footer');
	}

	public function doUpload()
	{

		$skyboxTitle   = $this->input->post('skyboxTitle',TRUE);
		$skyboxTags    = $this->input->post('skyboxTags',TRUE);
		$config = array(
			'upload_path' => "./upload/Skybox/",
			'allowed_types' => '*',
			'overwrite' => TRUE
		);

		$this->load->library('upload', $config);

		if($this->upload->do_upload('skyboxFileToUpload'))
		{

			$dataofArrays    = array('upload_data' => $this->upload->data());

			$addrecordArrays = array(

				'title'               => $skyboxTitle,
				'tags'                =>$skyboxTags,
				'skyboxFilePath'=>base_url('upload/Skybox/'.$dataofArrays['upload_data']['file_name']),
				'size'                => $dataofArrays['upload_data']['file_size'],
				'skyboxFileName'=> $dataofArrays['upload_data']['file_name']
			);
			$this->skybox->insertData($addrecordArrays);
			$this->session->set_flashdata('msg', 'Sounds added Successfully');

		}

		redirect('Skybox/add');

	}

	function edit ($id) {


		if($_POST)
		{

			$skyboxTitle   = $this->input->post('skyboxTitle',TRUE);
			$skyboxTags    = $this->input->post('skyboxTags',TRUE);


			$config = array(
				'upload_path' => "./upload/Skybox/",
				'allowed_types' => '*',
				'overwrite' => TRUE
			);
			$this->load->library('upload', $config);
			//$new_name               = time().$shaderName;
			//$config['file_name']    = $new_name;

			$this->upload->initialize($config);
			$this->upload->do_upload('skyboxFileToUpload');


			if($_FILES['skyboxFileToUpload']['name'] != ''){

				$ImageArray  = array('upload_data' => $this->upload->data());

				$filePathtoSave = base_url('upload/Skybox/'.$ImageArray['upload_data']['file_name']);

				$add = array(
					'title'                => $skyboxTitle,
					'tags'                 =>$skyboxTags,
					'skyboxFilePath' => $filePathtoSave,
					'skyboxFileName'=>$ImageArray['upload_data']['file_name']
				);

			}

			if ($_FILES['skyboxFileToUpload']['name'] == ''){

				$add = array(
					'title'       => $skyboxTitle,
					'tags'        => $skyboxTags
				);
			}

			if($this->skybox->updateAssetbundles($id,$add))

			{
				$this->session->set_flashdata('editSuccess', 'Succesfully Updated');
				redirect($_SERVER['HTTP_REFERER']);

			}
			else
			{
				$this->session->set_flashdata('editFail', 'Failed Try Again');
			}

		}

		$data['record'] = $this->skybox->getDataById($id);

		$this->load->view('skybox/skyboxEdit',$data);
	}


	public function delete($id)
	{

		$segmentUri = $this->uri->segment('3');
		if ($segmentUri)
		{
			$this->skybox->deleteContent($id);
			$data['records'] = $this->skybox->getData();
			$this->load->view('skybox/skyboxView',$data);
		}

	}

}
