<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fuzzy_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}



public function insertData($data)
{

 $this->db->insert('fuzzy_query_search',$data);

}

function getData(){
  $query = $this->db->get('fuzzy_query_search');
  return $query->result();
 }

 public function deleteContent($id)
	{	
		 $this->db->where('name',$id);
		 
		 $this->db->delete('fuzzy_query_search',array('name'=>$id));
     if (unlink("upload/Ibm/".$id) ) {
        redirect($_SERVER['HTTP_REFERER']);
     }
          //return true;
	}


	function getDataById($id)
    {
        $query = $this->db
            ->select('*')
            ->from('fuzzy_query_search')
            ->where('id',$id)
            ->get();
        return $query->row_array();
    }


    function updateStorage($id,$Array)
    {
        $this->db->set( $Array);
        $this->db->where( 'id', $id);
        $ret = $this->db->update( 'fuzzy_query_search');
        return $ret;
    }

}
