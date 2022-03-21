<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{

	//Cunstructor//

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id')) {
			redirect('login');
		}
		$this->load->library('form_validation');
		$this->load->model('cart_model');
	}

	//Default Load Function and get all carts//
	public function index()
	{
		if ($this->session->userdata('usertype') == '1') {
			$data["carts"] = $this->cart_model->get_carts();
		} else {
			$data["carts"] = $this->cart_model->get_user_carts($this->session->userdata('id'));
		}

		$this->load->view('header');
		$this->load->view('cart', $data);
	}


	//Function Add Cart Item//
	public function validation()
	{

		$this->form_validation->set_rules('price', 'price', 'required|numeric|greater_than[0.99]');
		if ($this->form_validation->run()) {

			$user_id = $this->input->post('user_id');
			$product_id = $this->input->post('product_id');
			$qty = $this->input->post('qty');
			$title = $this->input->post('title');
			$price = $this->input->post('price');

			$data = array(
				'user_id' => $user_id,
				'product_id' => $product_id,
				'qty' => $qty,
				'title' => $title,
				'price' => $price,

			);
			// insert user data
			$id = $this->cart_model->insert($data);

			if ($id > 0) {
				$this->session->set_flashdata('message', 'Added to Cart!');
				redirect('cart');
			}
		} else {

			redirect('product/' . $this->input->post('product_id'));
		}
	}

	//Get Cart Details//
	public function cart_details()
	{

		$cid = $this->uri->segment(2);
		$data["cart"] = $this->cart_model->get_cart_byid($cid);
		$this->load->view('header');
		$this->load->view('cart_details', $data);
	}
}
