<?php

class Cart_model extends CI_Model{ 

    function insert($data){

        $this->db->insert('cart',$data);
        return $this->db->insert_id();
    }


    function get_carts(){

      
        $query=$this->db->get('cart');
      
            
            return $query->result();  
    }

    function get_user_carts($uid){

        $this->db->where('user_id',$uid);
        $query=$this->db->get('cart');
      
            
            return $query->result();  
    }

    function get_cart_byid($cid){

        $this->db->where('id',$cid);
        $query=$this->db->get('cart');
      
            
            return $query->result();
        
    }


}
