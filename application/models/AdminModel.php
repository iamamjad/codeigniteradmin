<?php

/**
 * 
 */
class AdminModel extends CI_Model
{

public function insertData($data)
{

 $this->db->insert('super_admin',$data);

}

public function checkLogin($email, $password) {
        
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get('super_admin');
 
        return $query->result_array();
}
}