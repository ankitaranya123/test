<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Category extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->user_detail = $this->session->userdata('logged_in');
        if (!$this->user_detail) {
            redirect('login', 'refresh');
        }
        $user_allow = array('productList');

        $action = $this->router->fetch_method();

        if($this->user_detail['access_level'] == 'user' && !in_array($action,$user_allow))
        {
            redirect('dashboard/index');
        }

//        $this->load->model('category_model');
    }

    public function addCategory() {

        $this->form_validation->set_error_delimiters('<p class="bg-danger text-center">', '</p>');
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|xss_clean');

        if ($this->input->post() && $this->form_validation->run() == TRUE) {
            $res = $this->category_model->addCategory($this->input->post('category_name'));
            if ($res) {
                $this->session->set_flashdata('success', 'Category has been added');
                redirect('category/addCategory');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.. Please try again');
                redirect('category/addCategory');
            }
        } else {
            $this->load->view('common/header');
            $this->load->view('common/nav', array('user_data' => $this->user_detail));
            $this->load->view('common/sidebar', array('user_data' => $this->user_detail, 'active' => 'category', 'activesub' => 'addcategory'));
            $this->load->view('category/addCategory');
            $this->load->view('common/footer');
        }
    }

    public function categoryList() {

        $category = $this->category_model->categoryList();

        $this->load->view('common/header');

        $this->load->view('common/nav', array('user_data' => $this->user_detail));
        $this->load->view('common/sidebar', array('user_data' => $this->user_detail, 'active' => 'category', 'activesub' => 'categorylist'));
        $this->load->view('category/categoryList', array('category' => $category));

        $this->load->view('common/footer');
    }

    public function editCategory($id = NULL) {



        $this->form_validation->set_error_delimiters('<p class="bg-danger text-center">', '</p>');
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|xss_clean');

        if ($this->input->post() && $this->form_validation->run() == TRUE) {
            $res = $this->category_model->updateCategory($this->input->post('category_name'), $this->input->post('id'));
            if ($res) {
                $this->session->set_flashdata('success', 'Category has been updated');
                redirect('category/categoryList');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.. Please try again');
                redirect('category/categoryList');
            }
        } else {
            $category = $this->category_model->getCategory($id);
            $this->load->view('common/header');
            $this->load->view('common/nav', array('user_data' => $this->user_detail, 'active' => 'category', 'activesub' => 'addcategory'));
            $this->load->view('common/sidebar', array('user_data' => $this->user_detail));
            $this->load->view('category/editCategory', array('category' => $category));
            $this->load->view('common/footer');
        }
    }

    function deleteCat($id) {
        $res = $this->category_model->deleteCat($id);
        if ($res) {
            echo '1';
            die;
        } else {
            echo '0';
            die;
        }
    }

    function addFields() {

        $res = $this->category_model->addFields($this->input->post('fields_name'), $this->input->post('category_id'));
        if ($res) {
            echo $res;
            die;
        } else {
            echo "0";
            die;
        }
    }

    function deleteFields() {
        $res = $this->category_model->deleteFields($this->input->post('fields_id'));
        if ($res) {
            echo "1";
            die;
        } else {
            echo "0";
            die;
        }
    }

    function addProduct($categoryId = NULL) {


        if ($this->input->post()) {
            $category_id = $this->input->post('category_id');
            
            $product_id = $this->category_model->addProduct($this->input->post('1'), $category_id);
            $this->category_model->addHistory($this->input->post('7'),$this->input->post('8'), $category_id,$product_id);
            $arr = $_POST;
            foreach ($arr as $key => $val) {
                if ($key != "category_id") {
                    $productData[] = array(
                        "product_id" => $product_id,
                        "fields_id" => $key,
                        "value" => $val,
                        "category_id" => $category_id
                    );
                }
            }
//              var_dump($productData);die;
            $res = $this->category_model->addProductFieldsData($productData);
            if ($res) {
                $this->session->set_flashdata('success', 'product has been added');
                redirect('category/productList/'.$category_id.'');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.. Please try again');
                redirect('category/productList/'.$category_id.'');
            }
        } else {
            $productFields = $this->category_model->getproductField($categoryId);
            $this->load->view('common/header');
            $this->load->view('common/nav', array('user_data' => $this->user_detail, 'active' => 'category', 'activesub' => ''));
            $this->load->view('common/sidebar', array('user_data' => $this->user_detail));
            $this->load->view('category/addProduct', array('productFields' => $productFields, 'categoryId' => $categoryId));
            $this->load->view('common/footer');
        }
    }

    public function productList($category_id = NULL) {
//        $category_id = NULL;
//        if ($this->input->post('category_id')) {
//
//            $category_id = $this->input->post('category_id');
//        }
//        $category = $this->category_model->categoryList();
        $product = $this->category_model->productList($category_id);

        $this->load->view('common/header');

        $this->load->view('common/nav', array('user_data' => $this->user_detail));
        $this->load->view('common/sidebar', array('user_data' => $this->user_detail, 'active' => 'category', 'activesub' => ''));
        $this->load->view('category/productList', array('product' => $product,'categoryId'=>$category_id));

        $this->load->view('common/footer');
    }

    public function viewProduct($product_id = NULL) {

        $productDetails = $this->category_model->getProductDetails($product_id);

        $this->load->view('common/header');

        $this->load->view('common/nav', array('user_data' => $this->user_detail));
        $this->load->view('common/sidebar', array('user_data' => $this->user_detail, 'active' => 'category', 'activesub' => 'productList'));
        $this->load->view('category/productDetails', array('productDetails' => $productDetails));

        $this->load->view('common/footer');
    }

    function editProduct($productId = NULL) {


        if ($this->input->post()) {
            $product_id = $this->input->post('product_id');
            $res = $this->category_model->updateProduct($this->input->post('1'), $product_id);

            $arr = $_POST;
            foreach ($arr as $key => $val) {
                if ($key != "product_id") {
                    $productData[] = array(
                        "fields_id" => $key,
                        "value" => $val,
                        "product_id" => $product_id,
                    );
                }
            }
//              var_dump($productData);die;
            $res1 = $this->category_model->updateProductFieldsData($productData);
            if ($res1) {
                $this->session->set_flashdata('success', 'product has been updated');
                redirect('category/productList');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.. Please try again');
                redirect('category/productList');
            }
        } else {
            $productData = $this->category_model->getProductDetails($productId);
            $this->load->view('common/header');
            $this->load->view('common/nav', array('user_data' => $this->user_detail, 'active' => 'category', 'activesub' => 'productList'));
            $this->load->view('common/sidebar', array('user_data' => $this->user_detail));
            $this->load->view('category/editProduct', array('productFields' => $productData, 'productId' => $productId));
            $this->load->view('common/footer');
        }
    }

    function deleteProduct() {
        $res = $this->category_model->deleteProduct($this->input->post('product_id'));
        if ($res) {
            echo "1";
            die;
        } else {
            echo "0";
            die;
        }
    }

}

?>
