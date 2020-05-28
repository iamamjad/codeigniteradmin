
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AnimationModel extends CI_Model
{

public function insertData($data)
{

 $this->db->insert('asset_management_animations',$data);

}

function getData(){
  $query = $this->db->get('asset_management_animations');
  return $query->result();
 }

 public function deleteContent($id)
	{	
		 $this->db->where('animationFileName',$id);
		 //unlink("upload/Animation/".$id);
		 $this->db->delete('asset_management_animations',array('animationFileName'=>$id));

        if (unlink("upload/Animation/".$id) ) 
        {
        
        redirect($_SERVER['HTTP_REFERER']);
            
        }
		 //return true;
	}


	function getDataById($id)
    {
        $query = $this->db
            ->select('*')
            ->from('asset_management_animations')
            ->where('id',$id)
            ->get();
        return $query->row_array();
    }


    function updateAssetbundles($id,$Array)
    {
        $this->db->set( $Array);
        $this->db->where( 'id', $id);
        $ret = $this->db->update( 'asset_management_animations');
        return $ret;

    }

}
