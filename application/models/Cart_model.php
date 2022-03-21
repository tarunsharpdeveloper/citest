<?php

class Cart_model extends CI_Model
{
    //Insert Cart//
    function insert($data)
    {
        $this->db->insert('cart', $data);
        return $this->db->insert_id();
    }

    //get all carts//
    function get_carts()
    {
        $query = $this->db->get('cart');
        return $query->result();
    }
    //get user wise carts//
    function get_user_carts($uid)
    {
        $this->db->where('user_id', $uid);
        $query = $this->db->get('cart');
        return $query->result();
    }
    //get cart by id//
    function get_cart_byid($cid)
    {
        $this->db->where('id', $cid);
        $query = $this->db->get('cart');
        return $query->result();
    }
    //get active products amount//
    function get_active_products_amount()
    {

        $query = $this->db->get('cart');
        $carts = $query->result();
        $amount = 0;
        foreach ($carts as $cart) {
            $this->db->where('status', 1);
            $this->db->where('id', $cart->product_id);
            $query1 = $this->db->get('products');

            $rs = $query1->result();
            if ($rs) {
                $finalprice = $cart->price * $cart->qty;
                $amount = $amount + $finalprice;
            }
        }

        return "$" . $amount;
    }
    //get user wise amounts//
    function get_userwise_products_amount($uid)
    {

        $this->db->where('user_id', $uid);
        $query = $this->db->get('cart');
        $carts = $query->result();
  
        $amount = 0;
        foreach ($carts as $cart) {
            $this->db->where('status', 1);
            $this->db->where('id', $cart->product_id);
            $query1 = $this->db->get('products');

            $rs = $query1->result();
            if ($rs) {
                $finalprice = $cart->price * $cart->qty;
                $amount = $amount + $finalprice;
            }
        }

        return "$" . $amount;
    }
}
