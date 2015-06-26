<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Shopping extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->user_detail = $this->session->userdata('logged_in');
        if (!$this->user_detail) {
            redirect('login', 'refresh');
        }
    }

    public function addtocart() {

        $cart = $this->session->userdata('cart');

        if ($cart) {
            
        } else {
            $cart = array();
        }

        $item = $this->input->post();

        $cart[$item['id']] = $item;

        $this->session->set_userdata('cart', $cart);
    }

    public function removecart() {

        $cart = $this->session->userdata('cart');

        $id = $this->input->post('id');

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }
        $this->session->unset_userdata('cart');
        $this->session->set_userdata('cart', $cart);
    }

    public function cart() {
        $cart = $this->session->userdata('cart');

        $this->load->view('common/header');

        $this->load->view('common/nav', array('user_data' => $this->user_detail));
        $this->load->view('common/sidebar', array('user_data' => $this->user_detail, 'active' => 'category', 'activesub' => 'productlist'));
        $this->load->view('shopping/cart', array('cart' => $cart));

        $this->load->view('common/footer');
    }

    public function removefromcart($id) {
        $cart = $this->session->userdata('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }
        $this->session->unset_userdata('cart');
        $this->session->set_userdata('cart', $cart);
        redirect('shopping/cart', 'refresh');
    }

    public function customer() {


        $this->form_validation->set_rules('name', 'name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'email', 'trim|required|email|xss_clean');
        $this->form_validation->set_rules('PhoneNumber', 'PhoneNumber', 'trim|required|xss_clean');
        $this->form_validation->set_rules('MobileNumber', 'MobileNumber', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address', 'address', 'trim|required|xss_clean');

        if ($this->input->post('form_post') && $this->form_validation->run() == TRUE) {
            $data = $this->input->post();
            unset($data['form_post']);
            $data['created_at'] = date("Y-m-d H:i:s", time());
            $id = $this->customer_model->add($data);
            if ($id) {
                redirect('shopping/invoice/'.$id, 'refresh');
            }
        } else {
            $this->load->view('common/header');
            $this->load->view('common/nav', array('user_data' => $this->user_detail));
            $this->load->view('common/sidebar', array('user_data' => $this->user_detail, 'active' => 'category', 'activesub' => 'productlist'));
            $this->load->view('shopping/customer_detail');
            $this->load->view('common/footer');
        }
    }

    public function customer_list(){
        $product_id = $this->input->post('product_id');
        $product = $this->input->post('product');
        $payed = $this->input->post('payed');

        $this->load->model('customer_model');

        $this->load->model('dashboard_model');

        if ($product && $product_id) {
            $cart = $this->session->userdata('cart');
            $tax = $this->input->post('tax');
            foreach ($product_id as $key => $val) {
                $cart[$val]['quantity'] = $product[$key];
            }

            $this->session->unset_userdata('cart');
            $this->session->set_userdata('tax',$tax);
            $this->session->set_userdata('payed',$payed);
            $this->session->set_userdata('cart', $cart);
        }

        $customer = $this->dashboard_model->getCustomer();
        $this->load->view('common/header');
        $this->load->view('common/nav', array('user_data' => $this->user_detail));
        $this->load->view('common/sidebar', array('user_data' => $this->user_detail, 'active' => 'customer', 'activesub' => ''));
        $this->load->view('shopping/customer',array('customer'=> $customer));
        $this->load->view('common/footer');

    }

    public function invoice($id = FALSE) {
        if(!$id){
            redirect('shopping/customer','refresh');
        }
        
        $cart = $this->session->userdata('cart');
        $tax = $this->session->userdata('tax');
//        $payed = $this->session->userdata('payed');

        $this->load->view('common/header');
        $this->load->view('common/nav', array('user_data' => $this->user_detail));
        $this->load->view('common/sidebar', array('user_data' => $this->user_detail, 'active' => 'category', 'activesub' => 'productlist'));
        $this->load->view('shopping/invoice', array('cart' => $cart,'id'=>$id,'tax'=>$tax));
        $this->load->view('common/footer');
    }

    public function print_invoice(){
        $this->load->model('customer_model');

        $cart = $this->session->userdata('cart');
        $tax = $this->session->userdata('tax');
        if($cart)
        {
        $data =  $this->session->userdata('data');
        $data['created'] = date("Y-m-d H:i:s", time());

            $final = array();

            foreach ($cart as $key => $val) {

                $this->customer_model->updatequa($key, $val['quantity']);

                $final[$key] = $val;
                $final[$key]['invoice_id'] = $data['invoice_no'];
                $final[$key]['created_at'] = date("Y-m-d H:i:s", time());
            }


            $this->customer_model->addinvoice($data);
            $this->customer_model->addinvoiceproduct($final);

            $this->session->unset_userdata('cart');
            $this->session->unset_userdata('tax');
            $this->session->unset_userdata('data');

        $this->load->view('common/header');
//        $this->load->view('common/nav', array('user_data' => $this->user_detail));
//        $this->load->view('common/sidebar', array('user_data' => $this->user_detail, 'active' => 'category', 'activesub' => 'productlist'));
        $this->load->view('shopping/invoice_print', array('cart' => $cart,'user_id'=>'', 'id'=>$data['customer_id'],'tax'=>$tax,'payed'=>$data['payed'],'invoiceid'=>$data['invoice_no']));
        $this->load->view('common/footer');
        }
        else{
            redirect('dashboard/sale', 'refresh');
        }
    }

    public function done($id = false)
    {

        $this->form_validation->set_rules('payed','payed','trim|required|is_natural|numeric');

        if($this->form_validation->run() == TRUE)
        {
        $this->load->model('customer_model');

        $cart = $this->session->userdata('cart');
        $tax = $this->session->userdata('tax');
        if ($cart) {
            $data = $this->input->post();
            $data['created'] = date("Y-m-d H:i:s", time());
//            $final[$key]['payed'] = $data['payed'];
            $data['due'] = $data['total'] - $data['payed'];
            $data['sale_by'] = $this->user_detail['user_id'];
            $this->session->set_userdata('data',$data);
//            $final = array();

//            foreach ($cart as $key => $val) {
//
//                $this->customer_model->updatequa($key, $val['quantity']);
//
//                $final[$key] = $val;
//                $final[$key]['invoice_id'] = $data['invoice_no'];
//                $final[$key]['created_at'] = date("Y-m-d H:i:s", time());
//            }
//
//
//            $this->customer_model->addinvoice($data);
//            $this->customer_model->addinvoiceproduct($final);
//
//            $this->session->unset_userdata('cart');
//            $this->session->unset_userdata('tax');

        }
        redirect('shopping/print_invoice', 'refresh');
        }
        else{
            $cart = $this->session->userdata('cart');
            $tax = $this->session->userdata('tax');
//        $payed = $this->session->userdata('payed');
            $data = $this->input->post();
            $this->load->view('common/header');
            $this->load->view('common/nav', array('user_data' => $this->user_detail));
            $this->load->view('common/sidebar', array('user_data' => $this->user_detail, 'active' => 'category', 'activesub' => 'productlist'));
            $this->load->view('shopping/invoice', array('cart' => $cart,'id'=>$data['customer_id'],'tax'=>$tax));
            $this->load->view('common/footer');
        }

    }

    public function generateRandomString($length = 10) {
        $characters = md5(time());
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


}
