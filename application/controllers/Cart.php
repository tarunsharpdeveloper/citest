<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('id')){
            redirect('login');
        }
		$this->load->library('form_validation');
		$this->load->model('cart_model');
	}

   
	public function index()
	{

        $data["carts"]=$this->cart_model->get_user_carts($this->session->userdata('id'));
		$this->load->view('cart',$data);
	}

	public function validation()
	{

     $this->form_validation->set_rules('qty', 'Quantity', 'required|trim');
	 if($this->form_validation->run()){

       $user_id=$this->input->post('user_id');
	   $product_id=$this->input->post('product_id');
       $qty=$this->input->post('qty');
       $title=$this->input->post('title');
       $price=$this->input->post('price');

	   $data= array(
		'user_id'=> $user_id,
		'product_id'=>$product_id,
		'qty'=>$qty,
		'title'=>$title,
        'price'=>$price,

	   );
        // insert user data
     $id=$this->cart_model->insert($data);

	 if($id>0){
	$this->session->set_flashdata('message','Added to Cart!');
	redirect('cart');

	}

	 }else{

$this->index();
	 }

	}

    
    public function cart_details()
	{   
        
        $cid=$this->uri->segment(2);
        $data["cart"]=$this->cart_model->get_cart_byid($cid);
		$this->load->view('cart_details',$data);
	}



}
