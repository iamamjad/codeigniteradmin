<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends CI_Controller {



	function __construct()
	{
		parent::__construct();

		$this->load->model('MaterialModel','material');
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$data['records'] = $this->material->getData();
		$this->load->view('material/materialView',$data);
		$this->load->view('template/footer');
	}

	public function add()
	{

		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('material/materialAdd');
		$this->load->view('template/footer');

	}


	public function doUpload()
	{

		$materialTitle   = $this->input->post('materialTitle',TRUE);
		$materialTags    = $this->input->post('materialTags',TRUE);
		$config = array(
			'upload_path' => "./upload/Material/",
			'allowed_types' => '*',
			'overwrite' => TRUE
		);

		$this->load->library('upload', $config);

		if($this->upload->do_upload('materialFileToUpload'))
		{

			$dataofArrays    = array('upload_data' => $this->upload->data());

			$addrecordArrays = array(

				'title'               => $materialTitle,
				'tags'                =>$materialTags,
				'materialFilePath'=>base_url('upload/Material/'.$dataofArrays['upload_data']['file_name']),
				'size'                => $dataofArrays['upload_data']['file_size'],
				'materialFileName'=> $dataofArrays['upload_data']['file_name']
			);
			$this->material->insertData($addrecordArrays);
			$this->session->set_flashdata('msg', 'Sounds added Successfully');

		}

		redirect('Material/add');

	}

	function edit ($id) {


		if($_POST)
		{

			$materialTitle   = $this->input->post('materialTitle',TRUE);
			$materialTags    = $this->input->post('materialTags',TRUE);


			$config = array(
				'upload_path' => "./upload/Material/",
				'allowed_types' => '*',
				'overwrite' => TRUE
			);
			$this->load->library('upload', $config);
			//$new_name               = time().$shaderName;
			//$config['file_name']    = $new_name;

			$this->upload->initialize($config);
			$this->upload->do_upload('materialFileToUpload');


			if($_FILES['materialFileToUpload']['name'] != ''){

				$ImageArray  = array('upload_data' => $this->upload->data());

				$filePathtoSave = base_url('upload/Material/'.$ImageArray['upload_data']['file_name']);

				$add = array(
					'title'                => $materialTitle,
					'tags'                 =>$materialTags,
					'materialFilePath' => $filePathtoSave,
					'materialFileName'=>$ImageArray['upload_data']['file_name']
				);

			}

			if ($_FILES['materialFileToUpload']['name'] == ''){

				$add = array(
					'title'       => $materialTitle,
					'tags'        => $materialTags
				);
			}

			if($this->material->updateAssetbundles($id,$add))

			{
				$this->session->set_flashdata('editSuccess', 'Succesfully Updated');
				redirect($_SERVER['HTTP_REFERER']);

			}
			else
			{
				$this->session->set_flashdata('editFail', 'Failed Try Again');
			}

		}

		$data['record'] = $this->material->getDataById($id);

		$this->load->view('material/materialEdit',$data);
	}


	public function delete($id)
	{

		$segmentUri = $this->uri->segment('3');
		if ($segmentUri)
		{
			$this->material->deleteContent($id);
			$data['records'] = $this->material->getData();
			$this->load->view('material/materialView',$data);
		}

	}

}
