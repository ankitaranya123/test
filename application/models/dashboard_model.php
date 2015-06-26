<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Dashboard_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function addExpenses($data) {

        $res = $this->db->insert('expenses', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getExpense() {
        $res = $this->db->get('expenses');
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return FALSE;
        }
    }

    public function getCustomer() {
        $res = $this->db->get('customer');
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return FALSE;
        }
    }

    public function getSale() {

        $res = $this->db->select('i.*,c.name,c.address,c.email,us.name as sale_by')
                ->from('invoice as i')
                ->join('customer as c', 'i.customer_id = c.id')
                ->join('user as us', 'i.sale_by = us.user_id')
                ->limit(10)
                ->get();
        $sum_res = $this->db->select_sum('total')->get('invoice');
        if ($res->num_rows() > 0) {
            return array('sale' => $res->result_array(), 'totalsum' => $sum_res->result_array());
        } else {
            return FALSE;
        }
    }

    public function createPurchaseEntry($data) {

        $this->db->insert('purchase', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getPurchased() {
        $res = $this->db->get('purchase');
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return FALSE;
        }
    }

    public function createPaidPaymentEntry($data) {

        $this->db->insert('payment', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getPaidEntry() {
        $res = $this->db->get('payment');
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return FALSE;
        }
    }

    public function getProfitLoss($today, $month, $year) {
        $this->db->select('i.id,i.quantity,i.price,i.created_at');
        $this->db->from('invoice_product as i');

        if ($today != NULL) {
            $this->db->where('i.created_at >= CURDATE()');
        }
        if ($month != NULL) {
            $this->db->where('month(i.created_at) >=', date('m', strtotime('-3 month')));
        }
        if ($month != NULL) {
            $this->db->where('YEAR(i.created_at) >=', date('Y', strtotime('now')));
        }
        $res = $this->db->get();
        if ($res->num_rows() > 0) {
            $data = $res->result_array();
            $final = array();
            foreach ($data as $val) {
                $this->db->where('pfd.product_id', $val['id']);
                $this->db->select('pf.name,pfd.value,pfd.product_id');
                $this->db->from('product_fields_data as pfd');
                $this->db->join('product_fields as pf', 'pf.id = pfd.fields_id');
                $res1 = $this->db->get();
                foreach ($res1->result_array() as $val1) {
                    $val[$val1['name']] = $val1['value'];
                }

                $final[] = $val;
            }
            return $final;
        } else {

            return FALSE;
        }
    }

    public function getProfitLossByDate($date) {
        $this->db->select('i.id,i.quantity,i.price,i.created_at');
        $this->db->from('invoice_product as i');
            $this->db->where('DATE(i.created_at)', $date);
        $res = $this->db->get();
        if ($res->num_rows() > 0) {
            $data = $res->result_array();
            $final = array();
            foreach ($data as $val) {
                $this->db->where('pfd.product_id', $val['id']);
                $this->db->select('pf.name,pfd.value,pfd.product_id');
                $this->db->from('product_fields_data as pfd');
                $this->db->join('product_fields as pf', 'pf.id = pfd.fields_id');
                $res1 = $this->db->get();
                foreach ($res1->result_array() as $val1) {
                    $val[$val1['name']] = $val1['value'];
                }

                $final[] = $val;
            }
            return $final;
        } else {

            return FALSE;
        }
    }

}
