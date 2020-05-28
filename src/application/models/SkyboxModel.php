<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SkyboxModel extends CI_Model
{

public function insertData($data)
{

 $this->db->insert('asset_management_skybox',$data);

}

function getData(){
  $query = $this->db->get('asset_management_skybox');
  return $query->result();
 }

 public function deleteContent($id)
	{	
		 $this->db->where('skyboxFileName',$id);
		 //unlink("upload/Skybox/".$id);
		 $this->db->delete('asset_management_skybox',array('skyboxFileName'=>$id));
         if (unlink("upload/Skybox/".$id)) {
        
        redirect($_SERVER['HTTP_REFERER']);
            
        }
		 //return true;
	}


	function getDataById($id)
    {
        $query = $this->db
            ->select('*')
            ->from('asset_management_skybox')
            ->where('id',$id)
            ->get();
        return $query->row_array();
    }


    function updateAssetbundles($id,$Array)
    {
        $this->db->set( $Array);
        $this->db->where( 'id', $id);
        $ret = $this->db->update( 'asset_management_skybox');
        return $ret;

    }

}
