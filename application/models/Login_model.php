<?php

class Login_model extends CI_Model
{

    //Login Logic//
    function can_login($email, $password)
    {

        $this->db->where('email', $email);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {

            foreach ($query->result() as $row) {
                if ($row->is_email_verified == 'yes') {

                    $pass = md5($password);

                    if ($row->password == $pass) {
                        $this->session->set_userdata('id', $row->id);
                        $this->session->set_userdata('usertype', $row->user_type);
                        $this->session->set_userdata('username', $row->name);
                    } else {
                        return 'Wrong Password';
                    }
                } else {
                    return 'Please Verify Your Email!';
                }
            }
        } else {
            return 'Wrong Email Address';
        }
    }

    //Verify Email//
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
}
