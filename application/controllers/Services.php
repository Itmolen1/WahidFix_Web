<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Services extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('global_model');
        //$this->isLoggedIn();
    }
	public function index()
	{
		$data['services']=$this->global_model->get_service_list();
		$data['slider']=$this->global_model->get_slider_list();
		//echo "<pre>";print_r($data);die;
		$this->load->view('inc/header');
		$this->load->view('services_view',$data);
		$this->load->view('inc/footer');
	}

	public function service_taken()
	{
		$user_id=$this->session->userdata('user');
		$data['services']=$this->global_model->service_taken($user_id['tbl_user_id']);
		//echo "here<pre>";print_r($data);die;
		$this->load->view('inc/header');
		$this->load->view('services_taken_view',$data);
		$this->load->view('inc/footer');
	}
}
