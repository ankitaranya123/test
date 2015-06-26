<?php

/**
 * Created by PhpStorm.
 * User: ankit
 * Date: 6/3/2015
 * Time: 11:05 PM
 */
class Login extends CI_Controller
{

    public function index()
    {
        $this->form_validation->set_error_delimiters('<p class="bg-danger text-center">', '</p>');
        $this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'password', 'trim|required|md5|xss_clean|callback_check_Login');
        if ($this->form_validation->run() == FALSE && $this->session->userdata('logged_in') == FALSE) {
            $this->load->view('common/login_header');
            $this->load->view('login/index');
            $this->load->view('common/login_footer');
        } else {
            redirect('dashboard', 'refresh');
        }
    }

    public function check_Login($password)
    {
        $this->load->model('login_model');
        $username = $this->input->post('username');
        $res = $this->login_model->check_login($username, $password);
        if ($res) {
            $this->session->set_userdata('logged_in', $res[0]);

            return TRUE;
        } else {
            $this->session->set_userdata('logged_in', FALSE);

            $this->form_validation->set_message('check_Login', 'Email or Password is incorrect.');
            return FALSE;
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('login','refresh');
    }

    public function forgot_password(){

    }

}