<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class peoplemodel extends CI_Model {

	public function getPeoples()
	{
		$this->db->select("*");
		$this->db->from('admin');		
		$query = $this->db->get();	
		return $query->result();		
		$num_data_returned = $query->num_rows;		
		if ($num_data_returned < 1)
		{			
			echo "There is no data in the database";
			exit();
	 }
	}
	
	 			 /****************@@@@@@@@@@@@***************REGISTRATION CODE GOES HERE ************@@@@@@@@@@@************/


	public function insertPerson($fullname, $email, $mobile, $gender, $dob, $pass) 
	{
		
		$this->db->set('fullname', $fullname);
		$this->db->set('email', $email);
		$this->db->set('mobile', $mobile);
		$this->db->set('gender', $gender);
		$this->db->set('dob', $dob);
		$this->db->set('pass', $pass);
		$this->db->insert('admin');
	}
	

			 /****************@@@@@@@@@@@@***************DELETION CODE GOES HERE ************@@@@@@@@@@@************/

	public function deletePerson($email) 
	{
		$this->db->where('email', $email);
		$this->db->delete('admin');
	}
	
			 /****************@@@@@@@@@@@@***************GETDETAILS CODE GOES HERE ************@@@@@@@@@@@************/

	public function getPerson($email) {
        /* $query = $this->db->select("*");
         $this->db->from("admin");
		 $this->db->where('email', $email);
		// $query = $this->db->get('admin');
		 
		 if($query->result()) {
		
		$result = $query->result();
		
		foreach ($result as $row) {
			
			$admin[$row->email] = array($row->fullname, $row->mobile, $row->dob);	
		}
		return $admin;	 
		}*/
		 $query = $this->db->query("select fullname,mobile,dob from admin where email='$email'"); 
      	 echo json_encode($query->result_array());
 
		 
	}
	
			 /****************@@@@@@@@@@@@***************UPDATION CODE GOES HERE ************@@@@@@@@@@@************/
	
		public function updatePerson($fullname, $email, $mobile, $gender, $dob, $pass) 
		{		
		$update = $this->db->query("update admin set fullname='$fullname',mobile='$mobile', gender='$gender',dob='$dob',pass='$pass' where email='$email'"); 
		echo json_encode($update->result_array());
		/*$this->db->where('email', $email);
		$this->db->set('fullname', $fullname);
		$this->db->set('mobile', $mobile);
		$this->db->set('dob', $dob);
		$this->db->set('pass', $pass);
		$this->db->update('admin');*/
		}
	
	
}
