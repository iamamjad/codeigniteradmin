<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CategoryModel extends CI_Model
{

public function insertData($data)
{

 $this->db->insert('category3Dmodel',$data);

}

function getData()
{
  $query = $this->db->get('category3Dmodel');
  return $query->result();
 }


 function getActivedata(){
          $query = $this->db
            ->select('*')
            ->from('category3Dmodel')
            ->where('status','Active')
            ->get();
        return $query->result();
 }

	function getDataById($id)
    {
        $query = $this->db
            ->select('*')
            ->from('category3Dmodel')
            ->where('idCategory',$id)
            ->get();
        return $query->row_array();
    }


    function updateAssetbundles($id,$Array)
    {
        $this->db->set( $Array);
        $this->db->where( 'idCategory', $id);
        $ret = $this->db->update( 'category3Dmodel');
        return $ret;

    }

     public function deleteContent($id)
    {   
         $this->db->where('idCategory',$id);
        
         if ($this->db->delete('category3Dmodel')){
        
        redirect($_SERVER['HTTP_REFERER']);
            
        }
         
    }

    function checkCategoryName($name)
    {
        $query = $this->db->select('name')
                    ->from('category3Dmodel')
                    ->where('name' , $name)->get();
            $result = $query->row_array();
            return $result;  
    }
  

}
