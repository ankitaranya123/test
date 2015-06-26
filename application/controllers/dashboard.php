<?php

/**
 * Created by PhpStorm.
 * User: ankit
 * Date: 6/4/2015
 * Time: 12:31 AM
 */
class Dashboard extends CI_Controller {

    public $user_detail;

    public function __construct() {
        parent::__construct();
        $this->user_detail = $this->session->userdata('logged_in');
        if (!$this->user_detail) {
            redirect('login', 'refresh');
        }

        $user_allow = array('index','sale','sale_list','customerList','paydue','due_list','customer_due');

        $action = $this->router->fetch_method();

        if($this->user_detail['access_level'] == 'user' && !in_array($action,$user_allow))
        {
            redirect('dashboard/index');
        }
        $this->load->model('dashboard_model');
    }

    public function index() {

//        $this->db->where('account_status', $i);
        $today = date('Y-m-d h:m:s',strtotime('now'));
        $sale = $this->dashboard_model->getSale();

        $profitLossToday = $this->dashboard_model->getProfitLoss('today','','');
        $profitLossMonth = $this->dashboard_model->getProfitLoss('','month','');
        $profitLossYear = $this->dashboard_model->getProfitLoss('','','year');


        $data['product'] = $this->db->count_all_results('products');
        $data['customer'] = $this->db->count_all_results('customer');
        $data['user'] = $this->db->count_all_results('user');
        $data['sale'] = $sale['sale'];
//        $product = $this->db->count_all_results('products');

        $this->load->view('common/header');
        $this->load->view('common/nav', array('user_data' => $this->user_detail));
        $this->load->view('common/sidebar', array('user_data' => $this->user_detail, 'active' => 'dashboard', 'activesub' => ''));
        $this->load->view('dashboard/index',array('data'=>$data,'profitLossToday'=>$profitLossToday,"profitLossMonth"=>$profitLossMonth,"profitLossYear"=>$profitLossYear));
        $this->load->view('common/footer');
    }

    public function expenses() {

        if ($this->input->post()) {
            $data = array(
                "person_name" => $this->input->post('person_name'),
                "expenses_type" => $this->input->post('expenses_type'),
                "total" => number_format($this->input->post('total'),2),
                "date" => date('Y-m-d h:i:s',  strtotime($this->input->post('date'))),
            );
            
            $res = $this->dashboard_model->addExpenses($data);
            if($res){
                $this->session->set_flashdata('success','Expenses entry created successfully.');
                redirect('dashboard/expenses');
            }else{
                $this->session->set_flashdata('error','Something went wrong.. Please try again.');
                redirect('dashboard/expenses');
            }
        } else {
            $expense = $this->dashboard_model->getExpense();
            $this->load->view('common/header');
            $this->load->view('common/nav', array('user_data' => $this->user_detail));
            $this->load->view('common/sidebar', array('user_data' => $this->user_detail, 'active' => 'expenses', 'activesub' => ''));
            $this->load->view('dashboard/expenses',array('expenses'=>$expense));
            $this->load->view('common/footer');
        }
    }
    public function customerList() {


            $customer = $this->dashboard_model->getCustomer();
            $this->load->view('common/header');
            $this->load->view('common/nav', array('user_data' => $this->user_detail));
            $this->load->view('common/sidebar', array('user_data' => $this->user_detail, 'active' => 'customer', 'activesub' => ''));
            $this->load->view('dashboard/customer',array('customer'=> $customer));
            $this->load->view('common/footer');
    }


    public function sale(){
        $data = $this->dashboard_model->getSale();
        $this->load->view('common/header');
        $this->load->view('common/nav', array('user_data' => $this->user_detail));
        $this->load->view('common/sidebar', array('active' => 'sale', 'activesub' => ''));
        $this->load->view('dashboard/sale',array('sale'=>$data));
        $this->load->view('common/footer');

    }

    public function customer_due(){

        $this->load->view('common/header');
        $this->load->view('common/nav', array('user_data' => $this->user_detail));
        $this->load->view('common/sidebar', array('active' => 'customerdue', 'activesub' => ''));
        $this->load->view('dashboard/customerdue');
        $this->load->view('common/footer');

    }

    public function due_list(){
        $this->load->model('user_model');

        $sLimit = "";
        $lenght = 10;
        $str_point = 0;

        $col_sort = array( "i.total", "us.name", "i.created","c.*");
        $order_by = "user_id";
        $temp = 'asc';
        if (isset($_GET['iSortCol_0'])) {
            $index = $_GET['iSortCol_0'];
            $temp = $_GET['sSortDir_0'] === 'asc' ? 'asc' : 'desc';
            $order_by = $col_sort[$index];
        }
        $this->user_model->db->select(array( "i.invoice_no","i.due as due", "us.name as sale_by", "i.created","c.*"))
//            ->from('invoice as i')
            ->join('customer as c','i.customer_id = c.id')
            ->join('user as us','i.sale_by = us.user_id');
        if($this->user_detail['access_level'] == 'user')
        $this->user_model->db->where('sale_by',$this->user_detail['user_id']);

        $this->user_model->db->where('due > ',0);

        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $words = $_GET['sSearch'];
            for ($i = 0; $i < count($col_sort); $i++) {
                $this->user_model->db->or_like($col_sort[$i], $words, "both");
            }
        }
        $this->user_model->db->order_by($order_by, $temp);
        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $str_point = intval($_GET['iDisplayStart']);
            $lenght = intval($_GET['iDisplayLength']);
            $records = $this->user_model->db->get("invoice as i", $lenght, $str_point);
        } else {
            $records = $this->user_model->db->get("invoice as i");
        }

        $total_record = $this->db->count_all('invoice');

        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $total_record,
            "iTotalDisplayRecords" => $total_record,
            "aaData" => array()
        );
        $result = $records->result_array();

        $i = 0;
        $final = array();
        foreach ($result as $val) {
            $output['aaData'][] = array("DT_RowId" => $val['id'], $val['invoice_no'], $val['name'],$val['MobileNumber'], $val['address'], $val['email'], $val['due'], $val['sale_by'],'<button class="btn btn-primary pay" id="pay" data-pay="'.$val['due'].'" data-id="'.$val['invoice_no'].'">Pay</button>');
        }


        echo json_encode($output);
        die;
    }

    public function paydue(){
        $data = $this->input->post();

        $res = $this->db->get_where('invoice',array('invoice_no' => $data['invoice_no']));

        if($res->num_rows()){
            $row = $res->result_array();

            $due =  $row[0]['due'] - $data['due'] ;
            $payed = $data['due'] + $row[0]['payed'];

            $this->db->where(array('invoice_no' => $data['invoice_no']))
                ->update('invoice', array('due'=>$due,'payed'=>$payed));
            $this->session->set_flashdata('done', 'Paymet done succesfully.');
        }

        redirect('dashboard/customer_due');
    }

    public function sale_list(){
        $this->load->model('user_model');

        $sLimit = "";
        $lenght = 10;
        $str_point = 0;

        $col_sort = array("i.invoice_no", "i.total", "us.name", "i.created","c.email", "c.name" , "c.address");
        $order_by = "user_id";
        $temp = 'asc';
        if (isset($_GET['iSortCol_0'])) {
            $index = $_GET['iSortCol_0'];
            $temp = $_GET['sSortDir_0'] === 'asc' ? 'asc' : 'desc';
            $order_by = $col_sort[$index];
        }
        $this->user_model->db->select(array("i.invoice_no", "i.total", "us.name as sale_by", "i.created","c.email", "c.name" , "c.address"))
//            ->from('invoice as i')
            ->join('customer as c','i.customer_id = c.id')
            ->join('user as us','i.sale_by = us.user_id');

        if($this->user_detail['access_level'] == 'user')
            $this->user_model->db->where('sale_by',$this->user_detail['user_id']);

        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $words = $_GET['sSearch'];
            for ($i = 0; $i < count($col_sort); $i++) {
                $this->user_model->db->or_like($col_sort[$i], $words, "both");
            }
        }
        $this->user_model->db->order_by($order_by, $temp);
        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $str_point = intval($_GET['iDisplayStart']);
            $lenght = intval($_GET['iDisplayLength']);
            $records = $this->user_model->db->get("invoice as i", $lenght, $str_point);
        } else {
            $records = $this->user_model->db->get("invoice as i");
        }
        $total_record = $this->db->count_all('invoice');

        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $total_record,
            "iTotalDisplayRecords" => $total_record,
            "aaData" => array()
        );
        $result = $records->result_array();
        $i = 0;
        $final = array();
        foreach ($result as $val) {
            $output['aaData'][] = array("DT_RowId" => $val['invoice_no'],$val['invoice_no'], $val['name'], $val['address'], $val['email'], $val['total'], $val['sale_by'],date('d-m-Y',strtotime($val['created'])));
        }


        echo json_encode($output);
        die;
    }

   function purchase(){
       
        if ($this->input->post()) {
            $data = array(
                "purchased_item" => $this->input->post('purchased_item'),
                "total" => $this->input->post('total'),
                "date" => date('Y-m-d h:i:s',  strtotime($this->input->post('date'))),
            );
            
            $res = $this->dashboard_model->createPurchaseEntry($data);
            if($res){
                $this->session->set_flashdata('success','Purchased entry created successfully.');
                redirect('dashboard/purchase');
            }else{
                $this->session->set_flashdata('error','Something went wrong.. Please try again.');
                redirect('dashboard/purchase');
            }
        } else {
            $purchase = $this->dashboard_model->getPurchased();
            $this->load->view('common/header');
            $this->load->view('common/nav', array('user_data' => $this->user_detail));
            $this->load->view('common/sidebar', array('user_data' => $this->user_detail, 'active' => 'expenses', 'activesub' => ''));
            $this->load->view('dashboard/purchase',array('purchase'=>$purchase));
            $this->load->view('common/footer');
        }
   } 
   function payment(){
       
        if ($this->input->post()) {
            $data = array(
                "person_name" => $this->input->post('person_name'),
                "email" => $this->input->post('email'),
                "contact" => $this->input->post('contact'),
                "address" => $this->input->post('address'),
                "total_paid" => $this->input->post('total_paid'),
                "total_due" => $this->input->post('total_due'),
                "date" => date('Y-m-d h:i:s',  strtotime($this->input->post('date'))),
            );
            
            $res = $this->dashboard_model->createPaidPaymentEntry($data);
            if($res){
                $this->session->set_flashdata('success','Purchased entry created successfully.');
                redirect('dashboard/payment');
            }else{
                $this->session->set_flashdata('error','Something went wrong.. Please try again.');
                redirect('dashboard/purchase');
            }
        } else {
            $payment = $this->dashboard_model->getPaidEntry();
            $this->load->view('common/header');
            $this->load->view('common/nav', array('user_data' => $this->user_detail));
            $this->load->view('common/sidebar', array('user_data' => $this->user_detail, 'active' => 'payment', 'activesub' => ''));
            $this->load->view('dashboard/payment',array('payment'=>$payment));
            $this->load->view('common/footer');
        }
   } 
  
   function profitLoss(){
       $date = NULL;
       if($this->input->post()){
           
           $date = date('Y-m-d',strtotime($this->input->post('dateFilter')));
           
       }
       $today = date('Y-m-d h:m:s',strtotime('now'));
       
       $profitLossDate = $this->dashboard_model->getProfitLossByDate($date);
//       var_dump($profitLossDate);
       $profitLossToday = $this->dashboard_model->getProfitLoss('','today','','');
       $profitLossMonth = $this->dashboard_model->getProfitLoss('','','month','');
       $profitLossYear = $this->dashboard_model->getProfitLoss('','','','year');
            $this->load->view('common/header');
            $this->load->view('common/nav', array('user_data' => $this->user_detail));
            $this->load->view('common/sidebar', array('user_data' => $this->user_detail, 'active' => 'payment', 'activesub' => ''));
            $this->load->view('dashboard/profitLoss',array('profitLossToday'=>$profitLossToday,"profitLossMonth"=>$profitLossMonth,"profitLossYear"=>$profitLossYear,"profitLossDate"=>$profitLossDate));
            $this->load->view('common/footer');
       
       
   }
    
}
