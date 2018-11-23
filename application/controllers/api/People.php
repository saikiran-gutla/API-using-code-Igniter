<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');
class People extends CI_Controller
{
	
	function __construct() 
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('peoplemodel');
	}

	public function index()
	{
		$this->load->model('peoplemodel');
		$this->data['names'] = $this->peoplemodel->getPeoples();
		$this->load->view('name_display', $this->data);
	}


					/**********###############*******REGISTER MODULE GOES HERE********#################***********/
	
	public function register()
	{		
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			
			$fullname = $this->input->post('fullname');
			$email = $this->input->post('email');
			$mobile = $this->input->post('mobile');	
			$gender = $this->input->post('gender');
			$dob = $this->input->post('dob');
			$pass = $this->input->post('pass');	
			if(!empty($fullname) && !empty($email) && !empty($mobile) && !empty($gender) && !empty($dob) && !empty($pass))
			{
			$data = $this->peoplemodel->insertperson($fullname, $email, $mobile, $gender, $dob, $pass);
			if($data)
			{
				echo "user registration failed....";				
			}
			else
			{
				echo "user registered succesfully.....";
			}
			//echo json_encode($data);			
		}
		else
		{
				echo "please enter all details........";
		}
	}
}


	public function delete()
	{	
		if ($this->input->server('REQUEST_METHOD') == 'POST') 
		{
		     
			 $email = $this->input->get('email');			 
			 $deleted = $this->peoplemodel->deleteperson($email);
			 echo json_encode($deleted);
		
		}
	}
	
	
	 			/**********########@@@@@#########*******UPDATE MODULE GOES HERE********#########@@@@@########***********/

	public function update() 
	{		
		if ($this->input->server('REQUEST_METHOD') == 'POST') 
		{			
			$fullname = $this->input->post('fullname');
			$email = $this->input->post('email');
			$mobile = $this->input->post('mobile');	
			$gender = $this->input->post('gender');
			$dob = $this->input->post('dob');
			$pass = $this->input->post('pass');	
			if(!empty($fullname) && !empty($email) && !empty($mobile) && !empty($gender) && !empty($dob) && !empty($pass))
			{			
			$update = $this->peoplemodel->updatePerson($fullname, $email, $mobile, $gender, $dob, $pass);
			echo json_encode($update);
			echo "Updated succesfully";
			}
			else
			{
				echo "enter complete data";
			}
		}
	}
		
				/**********########@@@@@#########*******DISPLAY MODULE GOES HERE********#########@@@@@########***********/


	public function show()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') 
		{		     
			 $email = $this->input->POST('email');	
			 if(!empty($email))
			 {
			 $data= $this->peoplemodel->getPerson($email);		 
			 if(empty($data))
			 {
			 	echo "Details found";
			 }
			 else
			 {
			 	echo "Details Not found";
			 }
			 }
			 else
			 {
			 	echo "Please enter email id to show the details of a person";
			 }
			// print_r($r);
			 //echo json_encode($r);
           	 //$this->response($r); 
			 /*if(!empty($email))
			 {		 
			 $edit = $this->peoplemodel->getPerson($email);
			 echo json_encode($edit);
			 echo "Details found";
			 echo $admin;
			 }
			else
			 {
				echo "details not found";
			 }
			/*else
			{
			echo "enter email id to check whether user is found or not";
			}*/
		}	
	}
}
