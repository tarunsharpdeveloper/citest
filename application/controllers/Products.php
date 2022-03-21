<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
	//Cunstructor//
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id')) {
			redirect('login');
		}
		$this->load->library('form_validation');
		$this->load->model('product_model');
	}


	//Default Load all products for user and admin//
	public function index()
	{
		$data['products'] = $this->product_model->getrecords('products');
		$this->load->view('header');
		if ($this->session->userdata('usertype') == '1') {
			$this->load->view('index', $data);
		} else {
			$this->load->view('products', $data);
		}
	}


	//Single Product//
	public function product_details()
	{
		$pid = $this->uri->segment(2);
		$data["product"] = $this->product_model->get_product_byid($pid);
		$this->load->view('header');
		$this->load->view('product_details', $data);
	}

	// functions for admin product crud


	public function add()
	{
		$this->load->view('header');
		$this->load->view('product_view');
	}

	public function add_Product()
	{
		//print_r($_POST);
		//echo $_FILES['file']['name'];
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		if (empty($_FILES['file']['name'])) {
			$this->form_validation->set_rules('file', 'Image', 'required');
		}

		$this->form_validation->set_error_delimiters('<div class="error" >', '</div>');
		if ($this->form_validation->run() === FALSE) {
			echo "false";
			$this->session->set_flashdata("error", "Something went wrong");

			$this->load->view('product_view');
		} else {
			echo "true";
			if (isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])) {
				$config['upload_path'] = './assets/images/';
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
				$new_name = time();
				$image = $new_name . '.' . $ext;
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload("file") && !empty($_FILES['file']['name'])) {
					$error = array('error' => $this->upload->display_errors());
				} else {
					$this->upload->data();
				}
			}
			$data = array(
				'title' => $this->input->post('title'),
				'description'  => $this->input->post('description'),
				'image' => $image,
			);
			$table = 'products';
			$insert = $this->product_model->insert($table, $data);
			// echo $this->db->last_query();
			// echo $insert_id = $this->db->insert_id();
			//die;


			$this->session->set_flashdata("success", "Products added successfully");
			redirect('Products/index');
		}
	}
	//Delete Product//
	public function delete($id)
	{
		$delete = $this->product_model->delete($id, 'products');
		$this->session->set_flashdata("success", "Delete successfully");
		redirect(base_url('index.php/Products/index'));
	}
	//Edit Product//
	public function edit()
	{

		$id = $this->uri->segment(3);
		$data['product'] = $this->product_model->getRecord($id, 'products');
		$this->load->view('header');
		$this->load->view('edit_product', $data);
	}

	public function edit_prod()
	{
		if (isset($_POST['edit_btn'])) {


			$id = $this->input->post('id');
			//echo $id;
			$image = $this->input->post('imagedata');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('title', 'Title', 'required|trim');
			$this->form_validation->set_rules('description', 'Description', 'required|trim');


			$this->form_validation->set_error_delimiters('<div class="error" >', '</div>');

			if ($this->form_validation->run() == TRUE) {

				if (isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])) {
					$config['upload_path'] = './assets/images/';
					$config['allowed_types'] = 'jpg|jpeg|png|gif';
					$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
					$new_name = time();
					$image = $new_name . '.' . $ext;
					$config['file_name'] = $new_name;
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload("file") && !empty($_FILES['file']['name'])) {
						$error = array('error' => $this->upload->display_errors());
					} else {
						$this->upload->data();
					}
				}
				$data = array(
					'title' => $this->input->post('title'),
					'description'  => $this->input->post('description'),
					'image' => $image,
				);

				$update = $this->product_model->update($id, $data, 'products');

				$this->session->set_flashdata("success", "Update successfully");

				redirect('Products/index');
			} else {

				$this->session->set_flashdata("error", "Something went wrong !");
				redirect('Products/index/' . $id);
			}
		}
	}
	//Change Status//
	public function changeStatusproduct()
	{

		$id = $this->input->post('sid');
		$status = $this->input->post('status');
		if ($status == 0) {
			$status = 1;
		} else {
			$status = 0;
		}

		$data = array("status" => $status);
		$update = $this->product_model->update($id, $data, 'products');
		echo json_encode($status);
	}
}
