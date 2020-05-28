<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MusicModel extends CI_Model
{

public function insertData($data)
{

 $this->db->insert('asset_management_music_track',$data);

}

function getData(){
  $query = $this->db->get('asset_management_music_track');
  return $query->result();
 }

 public function deleteContent($id)
	{	
		 $this->db->where('musicFileName',$id);
		 //unlink("upload/MusicTrack/".$id);
         
		 $this->db->delete('asset_management_music_track',array('musicFileName'=>$id));
         if (unlink("upload/MusicTrack/".$id)) {
        
        redirect($_SERVER['HTTP_REFERER']);
            
        }
		 //return true;
	}


	function getDataById($id)
    {
        $query = $this->db
            ->select('*')
            ->from('asset_management_music_track')
            ->where('id',$id)
            ->get();
        return $query->row_array();
    }


    function updateAssetbundles($id,$Array)
    {
        $this->db->set( $Array);
        $this->db->where( 'id', $id);
        $ret = $this->db->update( 'asset_management_music_track');
        return $ret;

    }

}
