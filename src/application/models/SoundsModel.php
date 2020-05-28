<?php

/**
 * 
 */
class SoundsModel extends CI_Model
{

public function insertData($data)
{

 $this->db->insert('asset_management_sound_effects',$data);

}

function getData(){
  $query = $this->db->get('asset_management_sound_effects');
  return $query->result();
 }

 public function deleteContent($id)
	{	
		 $this->db->where('soundsFileName',$id);
		 //unlink("upload/Sounds/".$id);
         
		 $this->db->delete('asset_management_sound_effects',array('soundsFileName'=>$id));

         if (unlink("upload/Sounds/".$id)) {
        
            redirect($_SERVER['HTTP_REFERER']);
            
        }
		 //return true;
	}


	function getDataById($id)
    {
        $query = $this->db
            ->select('*')
            ->from('asset_management_sound_effects')
            ->where('id',$id)
            ->get();
        return $query->row_array();
    }


    function updateAssetbundles($id,$Array)
    {
        $this->db->set( $Array);
        $this->db->where( 'id', $id);
        $ret = $this->db->update( 'asset_management_sound_effects');
        return $ret;

    }

}