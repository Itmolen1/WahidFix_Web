<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('register_model');
        //$this->isLoggedIn();
    }

	public function index()
	{
		$data['action']='register/add';
		$this->load->view('inc/header');
		$this->load->view('register_view',$data);
		$this->load->view('inc/footer');
	}

	public function add()
	{
		//echo "<pre>hi";print_r($this->input->post());die;
		if($this->input->post())
            {
                $value=$this->input->post();
                //echo "<pre>";print_r($value);die;
                $tbl_user_name=$this->security->xss_clean($this->input->post('tbl_user_name'));
                $tbl_user_mobile=$this->security->xss_clean($this->input->post('tbl_user_mobile'));
                $tbl_user_email=$this->security->xss_clean($this->input->post('tbl_user_email'));
                $tbl_user_password=$this->security->xss_clean($this->input->post('password'));
               	$value = array('tbl_user_name'=>$tbl_user_name,'tbl_user_mobile'=>$tbl_user_mobile,'tbl_user_email'=>$tbl_user_email,'tbl_user_password'=>$tbl_user_password,'tbl_user_platform'=>0,'tbl_user_createdat'=>date('Y-m-d H:i:s'),'tbl_user_updatedat'=>date('Y-m-d H:i:s'),'tbl_user_latitude'=>00.0000,'tbl_user_longitude'=>00.0000,'tbl_user_image'=>'http://wahidfix.com/admin/assets/user_profile/default.jpg');
               	//echo "<pre>";print_r($value);die;
                $result = $this->register_model->add($value);
                //echo "fasd<pre>";print_r($result);die;
                $this->session->set_userdata('suc_register', 'Successfully Registered.');
                //echo "<pre>";print_r($this->session->userdata);die;
                redirect('login');
            }
            else
            {
	            redirect('register');
	        }
	}
}
