<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Detail_page extends CI_Controller {

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

	public function View()
	{
		$last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
        $row=$this->global_model->get_service_id($record_num);
        if(!empty($row))
        {
        	$data['service']=$row;
			$data['sub_services']=$this->global_model->get_sub_services($data['service']['service_id']);
			$this->load->view('inc/header');
			$this->load->view('service_detail_view',$data);
			$this->load->view('inc/footer');
        }
        else
        {
        	redirect('404_override');
        }
        
	}

	public function ac_service()
	{
		$last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
		$data['service']=$this->global_model->get_service_id($record_num);
		$data['sub_services']=$this->global_model->get_sub_services($data['service']['service_id']);
		$this->load->view('inc/header');
		$this->load->view('detail_page/ac_service_view',$data);
		$this->load->view('inc/footer');
	}

	public function plumbing()
	{
		$last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
		$id=$this->global_model->get_service_id($record_num);
		$data['service']=$this->global_model->get_service_id($record_num);
		$data['sub_services']=$this->global_model->get_sub_services($data['service']['service_id']);
		$this->load->view('inc/header');
		$this->load->view('detail_page/plumbing_view',$data);
		$this->load->view('inc/footer');
	}
	public function electric()
	{
		$last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
		$id=$this->global_model->get_service_id($record_num);
		$data['service']=$this->global_model->get_service_id($record_num);
		$data['sub_services']=$this->global_model->get_sub_services($data['service']['service_id']);
		$this->load->view('inc/header');
		$this->load->view('detail_page/electric_view',$data);
		$this->load->view('inc/footer');
	}
	public function glass_work()
	{
		$last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
		$id=$this->global_model->get_service_id($record_num);
		$data['service']=$this->global_model->get_service_id($record_num);
		$data['sub_services']=$this->global_model->get_sub_services($data['service']['service_id']);
		$this->load->view('inc/header');
		$this->load->view('detail_page/glass_work_view',$data);
		$this->load->view('inc/footer');
	}
	public function gypsum_ceiling()
	{
		$last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
		$id=$this->global_model->get_service_id($record_num);
		$data['service']=$this->global_model->get_service_id($record_num);
		$data['sub_services']=$this->global_model->get_sub_services($data['service']['service_id']);
		$this->load->view('inc/header');
		$this->load->view('detail_page/gypsum_ceiling_view',$data);
		$this->load->view('inc/footer');
	}
	public function painting()
	{
		$last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
		$id=$this->global_model->get_service_id($record_num);
		$data['service']=$this->global_model->get_service_id($record_num);
		$data['sub_services']=$this->global_model->get_sub_services($data['service']['service_id']);
		$this->load->view('inc/header');
		$this->load->view('detail_page/painting_view',$data);
		$this->load->view('inc/footer');
	}
	public function interior_painting()
	{
		$last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
		$id=$this->global_model->get_service_id($record_num);
		$data['service']=$this->global_model->get_service_id($record_num);
		$data['sub_services']=$this->global_model->get_sub_services($data['service']['service_id']);
		$this->load->view('inc/header');
		$this->load->view('detail_page/interior_painting_view',$data);
		$this->load->view('inc/footer');
	}
	public function exterior_painting()
	{
		$last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
		$id=$this->global_model->get_service_id($record_num);
		$data['service']=$this->global_model->get_service_id($record_num);
		$data['sub_services']=$this->global_model->get_sub_services($data['service']['service_id']);
		$this->load->view('inc/header');
		$this->load->view('detail_page/exterior_painting_view',$data);
		$this->load->view('inc/footer');
	}
	public function masonry()
	{
		$last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
		$id=$this->global_model->get_service_id($record_num);
		$data['service']=$this->global_model->get_service_id($record_num);
		$data['sub_services']=$this->global_model->get_sub_services($data['service']['service_id']);
		$this->load->view('inc/header');
		$this->load->view('detail_page/masonry_view',$data);
		$this->load->view('inc/footer');
	}
}
