<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class QueryTo3dModel extends CI_Model
{

public function insertData($data)
{

 $this->db->insert('asset_management_models',$data);

}

function getData(){
	$this->db->where('status','active');
  $query = $this->db->get('asset_management_models');
  return $query->result();
 }

 public function deleteContent($id)
	{	
		 $this->db->where('model_fileName',$id);
		 //unlink("upload/3DModules/".$id);
		 $this->db->delete('asset_management_models',array('model_fileName'=>$id));
         if (unlink("upload/3DModules/".$id)) {
        
        redirect($_SERVER['HTTP_REFERER']);
            
        }
		 //return true;
	}


	function getDataById($id)
    {
        $query = $this->db
            ->select('*')
            ->from('asset_management_models')
            ->where('id',$id)
			->where('status','active')
            ->get();
        return $query->row_array();
    }


    function updateAssetbundles($id,$Array)
    {
        $this->db->set( $Array);
        $this->db->where( 'id', $id);
        $ret = $this->db->update( 'asset_management_models');
        return $ret;

    }

    function getDataByIdCategory($id)
    {
        $query = $this->db
            ->select('*')
            ->from('asset_management_models')
            ->where('idCategory',$id)
			->where('status','active')
            ->get();
        return $query->result();
    }

    function getCountOfEachCategory($id)
    {
  
    $this->db->where('idCategory',$id);
    $this->db->from("asset_management_models");
    echo $this->db->count_all_results();
    
    }

	function getDataAllCategoryById($id)
	{
		$query = $this->db
			->select('*')
			->from('asset_management_models')
			->where('idCategory',$id)
			->get();
		return $query->result();
	}


}
