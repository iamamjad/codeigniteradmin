<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MaterialModel extends CI_Model
{

public function insertData($data)
{

 $this->db->insert('asset_management_materials',$data);

}

function getData(){
  $query = $this->db->get('asset_management_materials');
  return $query->result();
 }

 public function deleteContent($id)
	{	
		 $this->db->where('materialFileName',$id);
		 //unlink("upload/Material/".$id);
		 $this->db->delete('asset_management_materials',array('materialFileName'=>$id));
         if (unlink("upload/Material/".$id)) {
        
        redirect($_SERVER['HTTP_REFERER']);
            
        }
		 //return true;
	}


	function getDataById($id)
    {
        $query = $this->db
            ->select('*')
            ->from('asset_management_materials')
            ->where('id',$id)
            ->get();
        return $query->row_array();
    }


    function updateAssetbundles($id,$Array)
    {
        $this->db->set( $Array);
        $this->db->where( 'id', $id);
        $ret = $this->db->update( 'asset_management_materials');
        return $ret;

    }

}
