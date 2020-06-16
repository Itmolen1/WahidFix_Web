<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booknow extends CI_Controller {

	public function __construct()
    {

        parent::__construct();
        $this->load->model('global_model');
        //$this->isLoggedIn();
    }

	public function index()
	{
		$data['action']='Booknow/add';
        $data['services']=$this->global_model->get_service_list();
        $data['time_slots']=$this->global_model->get_time_slots();
		$this->load->view('inc/header');
		$this->load->view('Booknow_view',$data);
		$this->load->view('inc/footer');
	}

	public function add()
	{
		//echo "<pre>hi";print_r($this->input->post());die;
		if($this->input->post())
        {
            $value=$this->input->post();
            if(isset($value['tbl_user_id']))
            {
                $result = $this->global_model->add_service_request($value);
                $this->session->set_userdata('suc_service', 'Successfully Registered.');
                redirect(base_url().'service_taken','refresh');
            }
            else
            {
                $result = $this->global_model->add_guest_request($value);
                $this->session->set_userdata('suc_service', 'Successfully Registered.');
                redirect('Booknow','refresh');
            }
            
        }
        else
        {
            redirect('Booknow','refresh');
        }
	}
}
