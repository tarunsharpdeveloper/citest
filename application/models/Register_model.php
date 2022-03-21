<?php

class Register_model extends CI_Model
{
    //register user//
    function insert($data)
    {

        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    //get verified users //
    function getVerifiedUsers()
    {
        $this->db->where('user_type', 0);
        $this->db->where('is_email_verified', 'yes');
        $query1 = $this->db->get('user');
        return $query1->result();
    }

    //verify email//
    function verify_email($key)
    {

        $this->db->where('verification_key', $key);
        $this->db->where('is_email_verified', 'no');
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {

            $data = array(
                'is_email_verified' => 'yes'
            );
            $this->db->where('verification_key', $key);
            $this->db->update('user', $data);
            return true;
        } else {
            return false;
        }
    }

    //get all user count//
    function getUserCounts()
    {
        $query = $this->db->get('user');
        $total = $query->num_rows();

        $this->db->where('is_email_verified', 'yes');
        $query1 = $this->db->get('user');
        $verified = $query1->num_rows();
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('cart', 'cart.user_id=user.id');
        $this->db->group_by('cart.user_id');
        $query2 = $this->db->get();
        $hasproducts = $query2->num_rows();

        return $data = array(
            'total' => $total,
            'verified' => $verified,
            'unverified' => $total - $verified,
            'hasproducts' => $hasproducts,
        );
    }
}
