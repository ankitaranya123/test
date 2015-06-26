<?php

/**
 * Created by PhpStorm.
 * User: ankit
 * Date: 6/5/2015
 * Time: 12:22 AM
 */
class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->user_detail = $this->session->userdata('logged_in');

        if (!$this->user_detail) {
            redirect('login', 'refresh');
        }

        $user_allow = array();

        $action = $this->router->fetch_method();

        if($this->user_detail['access_level'] == 'user' && !in_array($action,$user_allow))
        {
            redirect('dashboard/index');
        }
    }

    public function index() {
        $this->load->view('common/header');
        $this->load->view('common/nav', array('user_data' => $this->user_detail));
        $this->load->view('common/sidebar', array('user_data' => $this->user_detail,'active'=>'user','activesub'=>'userlist'));
        $this->load->view('user/index');
        $this->load->view('common/footer');
    }

    public function add() {

        $this->load->helper(array('form', 'html', 'file'));
        $this->load->model('user_model');

        $this->form_validation->set_error_delimiters('<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> ', '</label>');
//        $this->form_validation->set_rules('name', 'name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('name', 'name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'email', 'trim|required|email|xss_clean');
        $this->form_validation->set_rules('shopname', 'shopname', 'trim|required|email|xss_clean');
        $this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean|is_unique[user.username]');
        $this->form_validation->set_rules('password', 'password', 'trim|required|md5|xss_clean');
        $this->form_validation->set_rules('dob', 'dob', 'trim|required');
        $this->form_validation->set_rules('image', 'Image', 'callback_handle_upload');
        $this->form_validation->set_message('is_unique', '%s is all ready exist.');
        $config['upload_path'] = './assets/userimage';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);

        if ($this->input->post() && $this->form_validation->run() == TRUE) {
            $data = $this->input->post();
            $data['profile_pic'] = $data['image'];
            $data['access_level'] = 'user';
            $data['dob'] = date("Y-m-d", strtotime($data['dob']));
            $data['date'] = date("Y-m-d H:i:s", time());
            $data['created_by'] = $this->user_detail['user_id'];
            unset($data['image']);

            $this->user_model->registerUser($data, $data['username']);

            $this->load->view('common/header');
            $this->load->view('common/nav', array('user_data' => $this->user_detail,'active'=>'user','activesub'=>'useradd'));
            $this->load->view('common/sidebar', array('user_data' => $this->user_detail));
            $this->load->view('user/added_success');
            $this->load->view('common/footer');
        } else {
            $this->load->view('common/header');
            $this->load->view('common/nav', array('user_data' => $this->user_detail));
            $this->load->view('common/sidebar', array('user_data' => $this->user_detail,'active'=>'user','activesub'=>'useradd'));
            $this->load->view('user/add');
            $this->load->view('common/footer');
        }
    }

    public function edit_user($id = FALSE) {
        $this->load->helper(array('form', 'html', 'file'));
        $this->load->model('user_model');

        $this->form_validation->set_error_delimiters('<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> ', '</label>');
//        $this->form_validation->set_rules('name', 'name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('name', 'name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'email', 'trim|required|email|xss_clean');
        $this->form_validation->set_rules('shopname', 'shopname', 'trim|required|email|xss_clean');
        $this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean|callback_checkusername');
        $this->form_validation->set_rules('password', 'password', 'trim|md5|xss_clean');
        $this->form_validation->set_rules('dob', 'dob', 'trim|required');
        $this->form_validation->set_rules('image', 'Image', 'callback_handle_upload');
        $this->form_validation->set_message('is_unique', '%s is all ready exist.');
        $config['upload_path'] = './assets/userimage';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);

        if ($this->input->post() && $this->form_validation->run() == TRUE) {
            $data = $this->input->post();
            
            if($data['password'] == ''){
                unset($data['password']);
            }
            if(!empty($_FILES['image']['name']))
            {
                $data['profile_pic'] = $data['image'];
            }
            
            $data['access_level'] = 'user';
            $data['dob'] = date("Y-m-d", strtotime($data['dob']));
            $data['date'] = date("Y-m-d H:i:s", time());
            $data['created_by'] = $this->user_detail['user_id'];
            unset($data['image']);

            $this->user_model->updateuser($data['user_id'], $data);

            $this->load->view('common/header');
            $this->load->view('common/nav', array('user_data' => $this->user_detail));
            $this->load->view('common/sidebar', array('user_data' => $this->user_detail,'active'=>'user','activesub'=>''));
            $this->load->view('user/update_success');
            $this->load->view('common/footer');
        } else {
            
            $data = $this->user_model->getUser($id);
            if($data)
            {
            $this->load->view('common/header');
            $this->load->view('common/nav', array('user_data' => $this->user_detail));
            $this->load->view('common/sidebar', array('user_data' => $this->user_detail,'active'=>'user','activesub'=>''));
            $this->load->view('user/edit',array('data'=>$data[0]));
            $this->load->view('common/footer');
            }
            else{
                redirect('user/add', 'refresh');
            }
        }
    }

    public function delete_user($id) {
        $this->load->model('user_model');
        if($id != ''){
            $this->user_model->db->delete('user', array('user_id' => $id)); 
        }
        echo 'yes';
    }

    public function user_list() {
        
        $this->load->model('user_model');
        
        $sLimit = "";
        $lenght = 10;
        $str_point = 0;
      
        $col_sort = array("user_id", "username", "name", "shopname","email", "dob");
        $order_by = "user_id";
        $temp = 'asc';
        if (isset($_GET['iSortCol_0'])) {
            $index = $_GET['iSortCol_0'];
            $temp = $_GET['sSortDir_0'] === 'asc' ? 'asc' : 'desc';
            $order_by = $col_sort[$index];
        }
        $this->user_model->db->select($col_sort);
        $this->user_model->db->where('access_level','user');
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
            $records = $this->user_model->db->get("user", $lenght, $str_point);
        } else {
            $records = $this->user_model->db->get("user");
        }
        $total_record = $this->db->count_all('user');
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
            $output['aaData'][] = array("DT_RowId" => $val['user_id'], $val['username'], $val['name'], $val['shopname'], $val['email'], $val['dob'],'<div class="text-center"><div class="col-offset-4 col-md-2 col-sm-6 col-xs-6"><a href="#" class="delete"><i class="glyphicon glyphicon-trash"></i></a></div><div class="col-offset-4 col-md-2 col-sm-6 col-xs-6"><a href="'.  base_url('index.php/user/edit_user/'.$val['user_id']).'" ><i class="glyphicon glyphicon-edit"></i></a></div></div>');
        }


        echo json_encode($output);
        die;
    }

    function checkDateFormat($date) {
        if (preg_match("/[0-31]{2}\/[0-12]{2}\/[0-9]{4}/", $date)) {
            if (checkdate(substr($date, 3, 2), substr($date, 0, 2), substr($date, 6, 4)))
                return true;
            else
                return false;
        } else {
            return false;
        }
    }

    function checkusername(){
        $this->load->model('user_model');
        $user_id = $this->input->post('user_id');
        $username = $this->input->post('username');
        
        if($this->user_model->username_check($user_id,$username)){
            $this->form_validation->set_message('checkusername', 'Username is all ready exist.');
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
            
    function handle_upload() {
        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
            if ($this->upload->do_upload('image')) {
                // set a $_POST value for 'image' that we can use later
                $upload_data = $this->upload->data();
                $_POST['image'] = $upload_data['file_name'];
                return true;
            } else {
                // possibly do some clean up ... then throw an error
                $this->form_validation->set_message('handle_upload', $this->upload->display_errors());
                return false;
            }
        } else {
            // throw an error because nothing was uploaded
//            $this->form_validation->set_message('handle_upload', "You must upload an image!");
            return true;
        }
    }

}
