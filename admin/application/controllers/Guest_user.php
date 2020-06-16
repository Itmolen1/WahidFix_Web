<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Guest_user extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('guest_user_model');
        $this->isLoggedIn();
    }    
  
    public function index()
    {
       $this->global['pageTitle'] = APP_NAME.': Item Master';
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    } 

    function guest_user_listing()
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
            $count = $this->guest_user_model->guest_userListingCount($searchText);
            //echo "<pre>";print_r($count);die;
			$returns = $this->paginationCompress ( "guest_user_listing/", $count, 10 );
			//echo "<pre>";print_r($returns);die;
            $data['servicesRecords'] = $this->guest_user_model->guest_userListing($searchText, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = APP_NAME.' : Item Master Listing';
            $this->loadViews("guest_user", $this->global, $data, NULL);
        //}
    }
   
    function add_new_guest_user()
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
                //$item_unit_name=$this->security->xss_clean($this->input->post('item_unit_name'));
               	$vals = array('tbl_guest_user_name'=>$value['tbl_guest_user_name'],'tbl_guest_user_mobile'=>$value['tbl_guest_user_mobile'],'tbl_guest_user_email'=>$value['tbl_guest_user_email'],'tbl_guest_user_createdat'=>date('Y-m-d H:i:s'));
                $result = $this->guest_user_model->add_new_guest_user($vals);
                redirect('guest_user_listing');
            }
            else
            {
	            $data['action']='add_new_guest_user';
	            $this->global['pageTitle'] =APP_NAME. ' : Add New Registered User';
	            $this->loadViews("add_new_guest_user_view", $this->global, $data, NULL);
	        }
        }
    }

    function edit_guest_user()
    {
            if($this->input->post())
            {
                $value=$this->input->post();
                //echo "<pre>";print_r($value);die;
                $result = $this->guest_user_model->edit_guest_user($value);
                redirect('guest_user_listing');
            }
            else
            {
                $last = $this->uri->total_segments();
                $id = $this->uri->segment($last);
                $data['list'] = $this->guest_user_model->get_guest_user_info($id);
                $data['action']='edit_guest_user';
                $this->global['pageTitle'] = APP_NAME.' : Edit Registered User';
                //echo "<pre>";print_r($data);die;
                $this->loadViews("add_new_guest_user_view", $this->global, $data, NULL);
            }           
    }    
    
    function delete_guest_user()
    {
        $last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
        $result = $this->guest_user_model->delete_guest_user($record_num);
        redirect('guest_user_listing');
    }    
 
    function pageNotFound()
    {
        $this->global['pageTitle'] = APP_NAME.' : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }   
}
?>