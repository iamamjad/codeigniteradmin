<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function insertData($data)
	{

		$this->db->insert('Account',$data);

	}

	public function insertForgetUsePassword($data)
	{

		$this->db->insert('forget_user_password',$data);

	}


	function getData()
	{

		$q=$this->db->get('appusers');
		return $q->result();

	}


	public function deleteContent($id)
	{
		$this->db->where('idAppUser',$id);

		if ($this->db->delete('appusers',array('idAppUser'=>$id))){

			redirect($_SERVER['HTTP_REFERER']);

		}

	}

	function userName_exists($username)
	{
		$this->db->select('userName');
		$this->db->from('appusers');
		$this->db->where('userName', $username);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}


	public function checkUserName($userName)
	{
		$query  = $this->db->select('userName')->from('appusers')->where('userName' , $userName)->get();
		$result = $query->row_array();
		return $result;
	}
	public function checkUserEmail($userEmail)
	{
		$query  = $this->db->select('email')->from('appusers')->where('email',$userEmail)->get();
		$result = $query->row_array();
		return $result;
	}

	public function validatekUserEmail($userEmail)
	{
		$query  = $this->db->select('email,idAppUser')->from('appusers')->where('email',$userEmail)->get();
		$result = $query->row_array();
		return $result;
	}


	public function checkUserPassword($id,$password)
	{
		$query  = $this->db->select('password,idAppUser')->from('appusers')
			->where('idAppUser',$id)
			->where('password',$password)
			->get();
		$result = $query->row_array();
		return $result;
	}

	public function checkPasswordHash($userName)
	{
		$query  = $this->db->select('password')->from('appusers')
			->where('userName',$userName)
			->get();
		$result = $query->row_array();
		return $result;
	}

	public function getPasswordHashByUserId($userid)
	{
		$query  = $this->db->select('password')->from('appusers')
			->where('idAppUser',$userid)
			->get();
		$result = $query->row_array();
		return $result;
	}

	public function verifiedUserInfo($userName,$emailHash)
	{
		$query  = $this->db->select('userName,verification_hash')->from('appusers')
			->where('userName',$userName)
			->where('verification_hash',$emailHash)
			->get();
		$result = $query->row_array();
		return $result;
	}

	public function verifiedUserInfoForgetPassword($emailHash,$userid)
	{
		$query  = $this->db->select('idAppUser,forget_password_hash')->from('forget_user_password')
			->where('forget_password_hash',$emailHash)
			->where('idAppUser',$userid)
			->order_by('idAppUser',"desc")->limit(1)
			->get();
		$result = $query->row_array();
		return $result;
	}


	public function approvedUser($data)
	{
		//$this->db->set('status', 1);
		//$this->db->where( 'userName', $userName);
		$ret=$this->db->update( 'appusers',$data);
		return $ret;
	}





	public function updateUserPassword($userId,$data)
	{

		return $this->db
			->where('idAppUser', $userId)
			->update('appusers', $data);
	}

	public function importConfigFileByUserId($data)
	{

		$this->db->insert('Gamedata',$data);

	}

	public  function insertAppUser($data)
	{
		$this->db->insert('appusers',$data);
	}

	public function checkLogin($email, $password) {

		$sql = "SELECT status,idAppUser,userName,email FROM appusers WHERE userName = ? 
				AND password = ? AND status = 1";

		$query =$this->db->query($sql, array($email,$password ));
		return $query->row_array();
	}


	function getUserIdByUserName($user)
	{
		$query = $this->db->select('idAppUser')
			->from('appusers')
			->where('userName' , $user)->get();
		$result = $query->row_array();
		return $result;
	}

	function getConfigFileUserIdBy($userid)
	{
		$query = $this->db->select('idAppUser,file_storage,dateofCreated,idgamedata')
			->from('Gamedata')
			->order_by('idgamedata',"desc")->limit(1)
			->where('idAppUser' , $userid)->get();
		$result = $query->result_array();
		return $result;
	}


	function getUserGameSave($userid)
	{
		$query = $this->db->select('*')
			->from('Gamedata')
			->order_by('idgamedata','DESC')
			->where('idAppUser' , $userid)->get();
		$result = $query->result_array();
		return $result;
	}
}
