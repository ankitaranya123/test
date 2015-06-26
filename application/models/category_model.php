<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Category_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function addCategory($category_name = NULL) {

        $res = $this->db->insert('category', array('name' => $category_name));
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function categoryList() {
        $res = $this->db->get('category');
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return FALSE;
        }
    }

    function getCategory($id) {
        $this->db->where('id', $id);
        $res = $this->db->get('category');
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return FALSE;
        }
    }

    function updateCategory($category_name, $id) {
        $this->db->where('id', $id);
        $res = $this->db->update('category', array('name' => $category_name));
        if ($res) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function deleteCat($id) {
        $this->db->where('id', $id);
        $res = $this->db->delete('category');
        if ($this->db->affected_rows() > 0) {
            $this->db->where('category_id', $id);
            $res1 = $this->db->delete('product_fields');
            if ($res1) {
                $this->db->where('category_id', $id);
                $res2 = $this->db->delete('products');
                if ($res2) {
                    $this->db->where('category_id', $id);
                    $res3 = $this->db->delete('product_fields_data');
                    if ($this->db->affected_rows() > 0) {
                        return TRUE;
                    } else {
                        return FALSE;
                    }
                }
            }

//            return TRUE;
        } else {
            return FALSE;
        }
    }

    function getproductField($categoryId = NULL) {
        $this->db->where('(category_id="0" or category_id = "' . $categoryId . '")');
        $res = $this->db->get('product_fields');
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return FALSE;
        }
    }

    function addFields($fields_name, $category_id) {

        $res = $this->db->insert('product_fields', array("name" => $fields_name, "category_id" => $category_id, "type" => "Input"));
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    function deleteFields($fields_id) {

        $this->db->where('id', $fields_id);
        $res = $this->db->delete('product_fields');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function addProduct($product_name, $category_id) {

        $res = $this->db->insert('products', array("name" => $product_name, "category_id" => $category_id));
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    function updateProduct($product_name, $product_id = NULL) {
        $this->db->where('id', $product_id);
        $res = $this->db->update('products', array("name" => $product_name));
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function addProductFieldsData($productData) {
        $res = $this->db->insert_batch('product_fields_data', $productData);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function updateProductFieldsData($productData) {
        foreach ($productData as $data) {
            $this->db->where('(product_id="' . (int) $data["product_id"] . '" AND fields_id = "' . $data["fields_id"] . '")');
            $this->db->set('value', $data["value"]);
            $res = $this->db->update('product_fields_data');
        }
        return TRUE;
    }

    function deleteProduct($id) {
        $this->db->where('id', $id);
        $res = $this->db->delete('products');
        if ($this->db->affected_rows() > 0) {
            $this->db->where('product_id', $id);
            $res1 = $this->db->delete('product_fields_data');
            if ($this->db->affected_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    function productList($category_id = NULL) {
        if ($category_id != NULL) {
        $this->db->where('category_id', $category_id);
        }
        $this->db->select('*');
        $this->db->from('products');
//        $this->db->join('product_fields_data as pfd', 'pfd.product_id = products.id');
//        $this->db->join('product_fields as pf', 'pf.id = pfd.fields_id');
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

    function getProductDetails($product_id = NULL) {
        $this->db->where('pfd.product_id', $product_id);
        $this->db->select('pfd.value,pfd.value,pf.name,pf.type,pf.id');
        $this->db->from('product_fields_data as pfd');
        $this->db->join('product_fields as pf', 'pf.id = pfd.fields_id');
//       $this->db->join('products','pfd.fields_id = products.id');
        $res = $this->db->get();
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return FALSE;
        }
    }
  
   function addHistory($quantity,$purchased_price,$category_id,$product_id) {
        $total_purchse = (int)$quantity * str_replace(",","",$purchased_price);
        $res = $this->db->insert('product_history',array("total_purchased_price"=>  number_format($total_purchse,2),"purchased_quantity"=>(int)$quantity,"category_id"=>$category_id,"product_id"=>$product_id,"date"=>date('Y-m-d h:i:s',strtotime('now'))));
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function detail($product_id = NULL) {
       
        $final = array();

        $this->db->where('pfd.product_id', $product_id);
        $this->db->select('pf.name,pfd.value,pfd.product_id');
        $this->db->from('product_fields_data as pfd');
        $this->db->join('product_fields as pf', 'pf.id = pfd.fields_id');
        $res1 = $this->db->get();
        foreach ($res1->result_array() as $val1) {
            $final[$val1['name']] = $val1['value'];
        }
        return $final;
    }


}
