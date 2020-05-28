<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ShaderModel extends CI_Model
{

public function insertData($data)
{

 $this->db->insert('asset_management_shaders',$data);

}

function getData(){
 
  $query = $this->db->get('asset_management_shaders');
  return $query->result();
 }

 public function deleteContent($id)
	{	
		 $this->db->where('shaderFileName',$id);
		 //unlink("upload/shaders/".$id);
         
		 $this->db->delete('asset_management_shaders',array('shaderFileName'=>$id));
         if (unlink("upload/shaders/".$id)) {
        
        redirect($_SERVER['HTTP_REFERER']);
            
        }
		 //return true;
	}


	function getDataById($id)
    {
        $query = $this->db
            ->select('*')
            ->from('asset_management_shaders')
            ->where('id',$id)
            ->get();
        return $query->row_array();
    }


    function updateShader($id,$Array)
    {
        $this->db->set( $Array);
        $this->db->where( 'id', $id);
        $ret = $this->db->update( 'asset_management_shaders');
        return $ret;
    }

}
