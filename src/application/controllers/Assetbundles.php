<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assetbundles extends CI_Controller {



	function __construct()
	{
		parent::__construct();

		$this->load->model('Assets_model');
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$data['page_title'] = 'AssetsBundles';
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$data['records'] = $this->Assets_model->getData();
		$this->load->view('assetbundles/assetsView',$data);
		$this->load->view('template/footer');
	}

	public function add()
	{
		$data['page_title'] = 'Add Asset bundles';
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('assetbundles/assetsAdd',$data);
		$this->load->view('template/footer');
	}


	public function doUpload()
	{
		$assetBundleTitle   = $this->input->post('assetBundleTitle',TRUE);
		$assetBundleTags    = $this->input->post('assetBundleTags',TRUE);
		$config = array(
			'upload_path' => "./upload/Assetbundles/",
			'allowed_types' => '*',
			'overwrite' => TRUE
		);
		$this->load->library('upload', $config);
		$this->upload->do_upload('assetBundlefileUpload');
		$dataofArrays         = array('upload_data' => $this->upload->data());
		$addrecordArrays      = array(
			'title'               => $assetBundleTitle,
			'tags'                =>$assetBundleTags,
			'assetBundlesFilePath'=>base_url('upload/Assetbundles/'.$dataofArrays['upload_data']['file_name']),
			'size'                => $dataofArrays['upload_data']['file_size'],
			'assetBundlesFileName'=> $dataofArrays['upload_data']['file_name']);

		if ($_FILES['assetBundlefileUpload']['name'] == '')
		{
			$addrecordArrays = array('title'=> $assetBundleTitle,'tags'=> $assetBundleTags);
		}
		$this->Assets_model->insertData($addrecordArrays);
		$this->session->set_flashdata('msg', 'Assetbundles added Successfully');
		redirect('Assetbundles/add');
	}


	public function delete($id)
	{
		$segmentUri = $this->uri->segment('3');
		if ($segmentUri) {
			$this->Assets_model->deleteContent($id);
			$data['records'] = $this->Assets_model->getData();
			$this->load->view('assetbundles/assetsView',$data);
		}
	}

	public function edit ($id) {
		if($_POST)
		{
			$assetBundleTitle = $this->input->post('assetBundleTitle',TRUE);
			$assetBundleTags  = $this->input->post('assetBundleTags',TRUE);
			$config = array( 'upload_path' => "./upload/Assetbundles/",
							'allowed_types' => '*', 'overwrite' => TRUE);
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload('assetBundlefileUpload');

			if($_FILES['assetBundlefileUpload']['name'] != '')
			{

			$ImageArray  = array('upload_data' => $this->upload->data());
			$filePathtoSave = base_url('upload/Assetbundles/'.$ImageArray['upload_data']['file_name']);
			$add = array('title' => $assetBundleTitle,'tags'=>$assetBundleTags,
			'assetBundlesFilePath'=>$filePathtoSave,'assetBundlesFileName' =>$ImageArray['upload_data']['file_name'],
			'size' => $ImageArray['upload_data']['file_size']);

			}

			if ($_FILES['assetBundlefileUpload']['name'] == '')
			{
				$add = array('title'=> $assetBundleTitle, 'tags'=> $assetBundleTags);
			}
			if($this->Assets_model->updateAssetbundles($id,$add))
			{
				$this->session->set_flashdata('editSuccess', 'Succesfully Updated');
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				$this->session->set_flashdata('editFail', 'Failed Try Again');
			}
		}
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$data['record'] = $this->Assets_model->getDataById($id);
		$this->load->view('assetbundles/assetsEdit',$data);
		$this->load->view('template/footer');
	}

	public function callPythonScript()
	{

		$command = escapeshellcmd('python readJson.py');
		$output  = shell_exec($command);
		//echo '<pre>';
		print_r($output);

	}
}
