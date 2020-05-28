<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ibm_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}



public function insertData($data)
{

 $this->db->insert('ibm_storage',$data);

}

function getData(){
  $query = $this->db->get('ibm_storage');
  return $query->result();
 }

 public function deleteContent($id)
	{	
		 $this->db->where('storageName',$id);
		 
		 $this->db->delete('ibm_storage',array('storageName'=>$id));
     if (unlink("upload/Ibm/".$id) ) {
        redirect($_SERVER['HTTP_REFERER']);
     }
          //return true;
	}


	function getDataById($id)
    {
        $query = $this->db
            ->select('*')
            ->from('ibm_storage')
            ->where('storageId',$id)
            ->get();
        return $query->row_array();
    }


    function updateStorage($id,$Array)
    {
        $this->db->set( $Array);
        $this->db->where( 'storageId', $id);
        $ret = $this->db->update( 'ibm_storage');
        return $ret;

    }

}
