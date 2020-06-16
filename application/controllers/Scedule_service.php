<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Scedule_service extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('global_model');
        $this->isLoggedIn();
    }
	public function index()
	{
		//echo "hie";die;
		$last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
		$data['sr']=$this->global_model->get_service_id($record_num);
		$data['action']='Scedule_service/add';
		$data['services']=$this->global_model->get_service_list();
		$data['time_slot']=$this->global_model->get_time_slot_list();
		$data['slider']=$this->global_model->get_slider_list();
		//echo "<pre>";print_r($data);die;
		$this->load->view('inc/header');
		$this->load->view('Schedule_service_view',$data);
		$this->load->view('inc/footer');
	}

	public function add()
	{
		if($this->input->post())
        {
            $value=$this->input->post();
            //echo "<pre>";print_r($value);die;
            $result = $this->global_model->add_service_request($value);
            $this->session->set_userdata('suc_service', 'Successfully Registered.');
            redirect(base_url().'service_taken','refresh');
        }
        else
        {
        	$this->session->set_flashdata('message','Your service request successfully submitted, We will contact you as soon as possible. ');
            redirect(base_url(),'refresh');
        }
	}

	public function isLoggedIn()
	{
		$this->global_model->isLoggedIn();
	}
}
