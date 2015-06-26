<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function check_login($username, $password) {

        $this->db->where(array("username" => $username, "password" => $password));
        $this->db->select('*');
        $this->db->from('user');
        $res = $this->db->get();
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return FALSE;
        }
    }


    public function getAcessLevel() {

        $this->db->select('access_id,access_name');
        $this->db->from('access_level');
        $this->db->where('status', 1);
        $res = $this->db->get();
        if ($res->num_rows() > 0) {
          return $res->result_array();
        } else {
            return false;
        }
    }

}

?>
