<?php

class Product_model extends CI_Model
{
    //Cunstructor//
    public function __construct()
    {
        $this->load->database();
        $this->table = 'products';
    }

    //Insert Product//
    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
        $qry = $this->db->insert_id();
        return $qry;
    }

    //get all active products//
    function get_products()
    {
        $this->db->where('status', 1);
        $query = $this->db->get('products');
        return $query->result();
    }

    //product by id//
    function get_product_byid($pid)
    {
        $this->db->where('id', $pid);
        $query = $this->db->get('products');
        return $query->result();
    }

    //get all products list for admin//
    public function getRecords($table)
    {

        $this->db->select('*');

        $this->db->from($table);

        $qry = $this->db->get();

        return $qry->result();
    }

    //get single product for edit//
    public function getRecord($id, $table)
    {

        $this->db->select('*');

        $this->db->from($table);

        $this->db->where('id', $id);

        $qry = $this->db->get();

        return $qry->result();
    }

    //delete product//
    public function delete($id, $table)
    {

        $this->db->where('id', $id);

        $query = $this->db->delete($table);

        return $query;
    }

    //update product//
    public function update($id, $data, $table)
    {

        $this->db->where("id", $id);

        $query = $this->db->update($table, $data);

        return $query;
    }


    //get product count//
    function getProductCounts()
    {


        $query = $this->db->get('products');
        $total = $query->num_rows();

        $this->db->where('status', 1);
        $query1 = $this->db->get('products');
        $active = $query1->num_rows();

        $this->db->where("id NOT IN (select distinct(product_id) from cart)");
        $query2 = $this->db->get('products');
        $notattached = $query2->num_rows();

        return $data = array(
            'total' => $total,
            'active' => $active,
            'notattached' => $notattached,

        );
    }

    //check product is active?//
    function is_product_active($pid)
    {
        $this->db->where('status', 1);
        $this->db->where('id', $pid);
        $query = $this->db->get('products');
        return $query->result();
    }
}
