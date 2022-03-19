<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if($this->session->userdata('id')){
            redirect('private_area');
        }
		$this->load->library('form_validation');
		$this->load->model('register_model');
	}

   
	public function index()
	{
		$this->load->view('register');
	}

	public function validation()
	{
	
     $this->form_validation->set_rules('user_name', 'Name', 'required|trim');
	 $this->form_validation->set_rules('user_email', 'Email', 'required|valid_email');
	 $this->form_validation->set_rules('user_password', 'Password', 'required');


	 if($this->form_validation->run()){
       $encPass=md5($this->input->post('user_password'));
	   $verification_key=md5(rand());
	   $data= array(
		'name'=> $this->input->post('user_name'),
		'email'=>$this->input->post('user_email'),
		'password'=>$encPass,
		'verification_key'=>$verification_key,

	   );
        // insert user data
     $id=$this->register_model->insert($data);

	 if($id>0){
	 
		// send verification email
       $subject="Email Verification";
	   $message="
	   Your Account Has beed created successfully by Admin:
	  Username: ".$this->input->post('user_name')." <br><br>
	  Email: ".$this->input->post('user_email')." <br><br>
	  Click Link to Verify: <a href='".base_url()."register/verify_email/".$verification_key."'>Link</a>. <br><br>
	  Regargs<br>
	  <div class='background-color:#666;color:#fff;padding:6px;
	  text-align:center;'>
		   Bookly Admin.
	  </div>";

	   $config = Array(
		'protocol' => 'smtp',
		'smtp_host' => 'ssl://smtp.googlemail.com',
		'smtp_port' => 465,
		'smtp_user' => 'abhishekjoshi.eway@gmail.com', // change it to yours
		'smtp_pass' => 'sky#1234', // change it to yours
		'mailtype' => 'html',
		'charset' => 'iso-8859-1',
		'wordwrap' => TRUE
	  );

	  $this->load->library('email', $config);
	$this->email->set_newline("\r\n");
	$this->email->from('tarunsharpdeveloper@gmail.com'); // change it to yours
	$this->email->to($this->input->post('user_email'));// change it to yours
	$this->email->subject($subject);
	$this->email->message($message);
	if($this->email->send())
   {
	$this->session->set_flashdata('message','Please Check in You email for Verification!');
	redirect('register');
   }


	}


	 }else{

$this->index();
	 }

	}


	function verify_email(){

		if($this->uri->segment(3)){
			$key=$this->uri->segment(3);

			if($this->register_model->verify_email($key)){
				$data["message"]='<h1>Email Verified</h1>';
			}else{
				$data["message"]='<h1>Invalid Link</h1>';
			}
          $this->load->view('email_verification',$data);
		}


	}
}
