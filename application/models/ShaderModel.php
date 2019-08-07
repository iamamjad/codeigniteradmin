<?php

/**
 * 
 */
class ShaderModel extends CI_Model
{

public function insertData($data)
{

 $this->db->insert('asset_management_shaders',$data);

}

function getData(){
  $this->db->select("id,name,shaderFileName,shaders_path,date_created"); 
  $this->db->from('asset_management_shaders');
  $query = $this->db->get();
  return $query->result();
 }

}