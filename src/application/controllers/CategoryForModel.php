<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryForModel extends CI_Controller {



    function __construct()
    {
        parent::__construct();

        $this->load->model('CategoryModel','category');
        $this->load->helper(array('form', 'url'));

    }

	public function index()
	{
	 $this->load->view('template/header');
	 $this->load->view('template/menu');
     $data['records'] = $this->category->getData();    
     $this->load->view('category/categoryView',$data);
     $this->load->view('template/footer');

	}

	public function add()
	{
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('category/categoryAdd');
		$this->load->view('template/footer');
    }


    public function insert()
      {
         $categoryName    = ucfirst($this->input->post('categoryName',TRUE));
         $categoryStatus  = $this->input->post('categoryStatus',TRUE);
         if(!empty($this->category->checkCategoryName($categoryName)))
         {
            $this->session->set_flashdata('exist', 'Category Name already exist');
            redirect($_SERVER['HTTP_REFERER']); 
         }
         else 
         {  
         $dataOfInputPost = array('name'=> $categoryName, 'status'=> $categoryStatus);                        
         $this->category->insertData($dataOfInputPost);
         $this->session->set_flashdata('msg', 'Category added Successfully');
         redirect('CategoryForModel/add');
         }          
        
      }

        public function delete($id)
        {
        
         $segmentUri = $this->uri->segment('3');
          if ($segmentUri) {
             $this->category->deleteContent($id);
             $data['records'] = $this->category->getData();
             $this->load->view('category/categoryView',$data);
           } 

        }



        function edit ($id) {

    
        if($_POST)
        {

         $categoryName   = $this->input->post('categoryName',TRUE);
         $categoryStatus = $this->input->post('categoryStatus',TRUE);
         $data           = array('name'=> $categoryName, 'status'=> $categoryStatus);  
        
        if($this->category->updateAssetbundles($id,$data))
            
            {
                $this->session->set_flashdata('msg', 'Succesfully Updated');
                redirect($_SERVER['HTTP_REFERER']);
            }
            else
            {
                $this->session->set_flashdata('editFail', 'Failed Try Again');
            }
        }

          $data['record'] = $this->category->getDataById($id);

         
          $this->load->view('category/categoryEdit',$data);
    }

}
