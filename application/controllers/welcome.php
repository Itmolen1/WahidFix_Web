<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		$this->load->view('home',$data);
		$this->load->view('inc/footer');
	}

	public function add_guest()
	{		
        $value=$this->input->post();
        //echo "<pre>";print_r($value);die;
        $result = $this->global_model->add_guest_request($value);
        redirect(base_url(),'refresh');        
	}

	function get_guest_user_vals()
	{
		$data['services']=$this->global_model->get_service_list();
		echo json_encode($data['services']);
	}
}
