<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assets_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}



public function insertData($data)
{

 $this->db->insert('all_asset_bundles',$data);

}

function getData(){
  $query = $this->db->get('all_asset_bundles');
  return $query->result();
 }

 public function deleteContent($id)
	{	
		 $this->db->where('assetBundlesFileName',$id);
		 
		 $this->db->delete('all_asset_bundles',array('assetBundlesFileName'=>$id));
     if (unlink("upload/Assetbundles/".$id) ) {
        redirect($_SERVER['HTTP_REFERER']);
     }
          //return true;
	}


	function getDataById($id)
    {
        $query = $this->db
            ->select('*')
            ->from('all_asset_bundles')
            ->where('id',$id)
            ->get();
        return $query->row_array();
    }


    function updateAssetbundles($id,$Array)
    {
        $this->db->set( $Array);
        $this->db->where( 'id', $id);
        $ret = $this->db->update( 'all_asset_bundles');
        return $ret;

    }

}
