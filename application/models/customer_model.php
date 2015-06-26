<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Customer_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function add($data) {
        $res = $this->db->insert('customer', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }
    
    public function getdetial($id){
        $res = $this->db->get_where('customer',array('id'=>$id));
        
        return $res->result_array();
    }

    public function addinvoice($data){
        $res = $this->db->insert('invoice', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    public function addinvoiceproduct($data){
        $res = $this->db->insert_batch('invoice_product', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    function updatequa($id,$val){
        $res = $this->db->get_where('product_fields_data',array('fields_id' => 7,'product_id'=>$id));

        if($res->num_rows())
        {
            $result_array = $res->result_array();

            $quantity = $result_array[0]['value'];

            $final = $quantity - $val;

            $this->db->update('product_fields_data', array('value'=>$final),array('fields_id'=> 7,'product_id'=>$id));
        }


    }

}

?>
