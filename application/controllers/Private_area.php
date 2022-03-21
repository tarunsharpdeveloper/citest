<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Private_area extends CI_Controller
{
    //Cunstructor//
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            redirect('login');
        }
        $this->load->model('product_model');
        $this->load->model('register_model');
        $this->load->model('cart_model');
    }

    //Load Dashboard Counts and data //
    public function index()
    {
        $userCounts = $this->register_model->getUserCounts();
        $data['total_user'] = $userCounts['total'];
        $data['total_verified'] = $userCounts['verified'];
        $data['total_unverified'] = $userCounts['unverified'];
        $data['total_hasproduct'] = $userCounts['hasproducts'];


        $productCounts = $this->product_model->getProductCounts();
        $data['total_product'] = $productCounts['total'];
        $data['total_active_product'] = $productCounts['active'];
        $data['notattached'] = $productCounts['notattached'];

        $data['activeProductsTotalAmount'] = $this->cart_model->get_active_products_amount();

        $verifiedUsers = $this->register_model->getVerifiedUsers();
        $user_amounts = array();
        foreach ($verifiedUsers as $user) {
            $amount = $this->cart_model->get_userwise_products_amount($user->id);
            array_push($user_amounts, [
                'username' => $user->name,
                'amount' => $amount,
            ]);
        }
        $data['userwiseProductsTotalAmount'] = $user_amounts;

        // set API Endpoint and API key
        $endpoint = 'latest';
        $access_key = '691de305e7fa8787584d251b22982d07';

        // Initialize CURL:
        $ch = curl_init('http://api.exchangeratesapi.io/v1/' . $endpoint . '?access_key=' . $access_key . '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $exchangeRates = json_decode($json, true);

        // Access the exchange rate values, e.g. GBP:
        $data['exchangeRates'] = $exchangeRates;


        $this->load->view('header');
        $this->load->view('private_area', $data);
    }

    //Logout//
    public function logout()
    {
        $data = $this->session->all_userdata();
        foreach ($data as $row => $rows_value) {
            $this->session->unset_userdata($row);
        }
        redirect('login');
    }
}
