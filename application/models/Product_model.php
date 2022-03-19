<?php

class Product_model extends CI_Model{ 

    function insert($data){

        $this->db->insert('user',$data);
        return $this->db->insert_id();
    }


    function get_products(){

        $this->db->where('status',1);
        $query=$this->db->get('products');
      
            
            return $query->result();  
    }

    function get_product_byid($pid){

        $this->db->where('id',$pid);
        $query=$this->db->get('products');
      
            
            return $query->result();
        
    }


}
