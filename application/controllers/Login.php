<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    //Cunstructor//
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('id')) {
            redirect('private_area');
        }
        $this->load->library('form_validation');
        $this->load->model('login_model');
    }

    //Default Index Function to load login page//
    public function index()
    {
        $this->load->view('login');
    }
    //submit Login form and Validation//
    public function validation()
    {
        $this->form_validation->set_rules('user_email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('user_password', 'Password', 'required');
        if ($this->form_validation->run()) {
            $result = $this->login_model->can_login($this->input->post('user_email'), $this->input->post('user_password'));
            if ($result == '') {
                redirect('private_area');
            } else {
                $this->session->set_flashdata('message', $result);
                redirect('login');
            }
        } else {

            $this->index();
        }
    }
}
