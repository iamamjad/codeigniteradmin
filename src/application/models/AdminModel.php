<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminModel extends CI_Model
{

public function insertData($data)
{

 $this->db->insert('super_admin',$data);

}

	function getData()
	{
		$query = $this->db->get('super_admin');
		return $query->result();
	}

public function checkLogin($email, $password) {
        
        // $this->db->where('email', $email);
        // $this->db->where('password', $password);
        // $query = $this->db->get('super_admin');
 
        // return $query->result_array();


        $sql = "SELECT * FROM super_admin WHERE email = ? AND password = ?";
		$query =$this->db->query($sql, array($email,$password ));

		return $query->result_array();
}

	public function checkPasswordHash($email)
	{
		$query  = $this->db->select('password')->from('super_admin')
			->where('email',$email)
			->get();
		$result = $query->row_array();
		return $result;
	}

	public function updateAdminPassword($userEmail,$data)
	{

		return $this->db
			->where('email', $userEmail)
			->update('super_admin', $data);
	}


	public function getUserCount()
    {
  
    $this->db->select('idAppUser');
    $this->db->from("appusers");
    echo $this->db->count_all_results();
    
    }


	public function removeAccount($id)
	{
		$this->db->where('id',$id);

		if ($this->db->delete('super_admin',array('id'=>$id))){

			redirect($_SERVER['HTTP_REFERER']);

		}

	}




}
