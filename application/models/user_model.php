<?php

/**
 * Created by PhpStorm.
 * User: ankit
 * Date: 6/6/2015
 * Time: 4:43 PM
 */
class User_model extends CI_Model {

    public function registerUser($arrData = array(), $username) {

        $res = $this->db->get_where('user', array("username" => $username));
        if ($res->num_rows() > 0) {
            return FALSE;
        } else {
            $res1 = $this->db->insert('user', $arrData);
            return $res1;
        }
    }

    public function username_check($user_id, $username) {
        $this->db->where('user_id !=', $user_id);
        $this->db->where('username', $username);
        $res = $this->db->get('user');
        
        if ($res->num_rows() == 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function updateuser($user_id, $data) {
        
        $this->db->where('user_id', $user_id);
        $this->db->update('user', $data);
        
    }

    public function getUser($id) {
        $this->db->select('user_id,shopname,username,password,name,email,dob,profile_pic as image');
        $res = $this->db->get_where('user', array("user_id" => $id));
        if ($res->num_rows() < 0) {
            return FALSE;
        } else {
            return $res->result_array();
        }
    }

}
