<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('id')){
            redirect('login');
        }
		$this->load->library('form_validation');
		$this->load->model('product_model');
	}

   
	public function index()
	{
        $data["products"]=$this->product_model->get_products();
		$this->load->view('products',$data);
	}


    public function product_details()
	{   
        $pid=$this->uri->segment(2);
        $data["product"]=$this->product_model->get_product_byid($pid);
		$this->load->view('product_details',$data);
	}



}
