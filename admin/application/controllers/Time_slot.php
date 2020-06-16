<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Time_slot extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('time_slot_model');
        $this->isLoggedIn();
    }    
  
    public function index()
    {
        $this->global['pageTitle'] = APP_NAME.': Dashboard';
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }    
  
    function time_slot_listing()
    {
        // if($this->isAdmin() == TRUE)
        // {
        //     $this->loadThis();
        // }
        // else
        // {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            $this->load->library('pagination');
            $count = $this->time_slot_model->time_slotListingCount($searchText);
            //echo "<pre>";print_r($count);die;
			$returns = $this->paginationCompress ( "time_slot_listing/", $count, 10 );
			//echo "<pre>";print_r($returns);die;
            $data['servicesRecords'] = $this->time_slot_model->time_slotListing($searchText, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = APP_NAME.' : Sub services Listing';
            $this->loadViews("time_slot", $this->global, $data, NULL);
        //}
    }
   
    function add_new_time_slot()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
        	if($this->input->post())
            {
                $value=$this->input->post();
                $time_slot_name=$this->security->xss_clean($this->input->post('time_slot_name'));
               	$vals = array('time_slot_name'=>$time_slot_name,'time_slot_created_at'=>date('Y-m-d H:i:s'),'time_slot_updated_at'=>date('Y-m-d H:i:s'));
                //echo "<pre>";print_r($vals);die;
                $result = $this->time_slot_model->add_new_time_slot($vals);
                redirect('time_slot_listing');
            }
            else
            {

	            $this->load->model('time_slot_model');
	            $data['action']='add_new_time_slot';
	            $this->global['pageTitle'] =APP_NAME. ' : Add New Item Unit';
	            $this->loadViews("add_new_time_slot", $this->global, $data, NULL);
	        }
        }
    }

    function edit_time_slot()
    {
            if($this->input->post())
            {
                $value=$this->input->post();
                //echo "<pre>";print_r($value);die;
                $result = $this->time_slot_model->edit_time_slot($value);
                redirect('time_slot_listing');
            }
            else
            {
                $last = $this->uri->total_segments();
                $id = $this->uri->segment($last);
                $data['list'] = $this->time_slot_model->get_time_slot_info($id);
                $data['action']='edit_time_slot';
                $this->global['pageTitle'] = APP_NAME.' : Edit Item Unit';
                //echo "<pre>";print_r($data);die;
                $this->loadViews("add_new_time_slot", $this->global, $data, NULL);
            }           
    }    
    
    function delete_time_slot()
    {
            $last = $this->uri->total_segments();
            $record_num = $this->uri->segment($last);
            $result = $this->time_slot_model->delete_time_slot($record_num);
            redirect('time_slot_listing');
    }    
 
    function pageNotFound()
    {
        $this->global['pageTitle'] = APP_NAME.' : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }   
}
?>