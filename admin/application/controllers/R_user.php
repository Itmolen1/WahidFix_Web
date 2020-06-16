<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class R_user extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('r_user_model');
        $this->isLoggedIn();
    }    
  
    public function index()
    {
       $this->global['pageTitle'] = APP_NAME.': Item Master';
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    } 

    function r_user_listing()
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
            $count = $this->r_user_model->r_userListingCount($searchText);
            //echo "<pre>";print_r($count);die;
			$returns = $this->paginationCompress ( "r_user_listing/", $count, 10 );
			//echo "<pre>";print_r($returns);die;
            $data['servicesRecords'] = $this->r_user_model->r_userListing($searchText, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = APP_NAME.' : Item Master Listing';
            $this->loadViews("r_user", $this->global, $data, NULL);
        //}
    }
   
    function add_new_r_user()
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
               	$vals = array('tbl_user_name'=>$value['tbl_user_name'],'tbl_user_mobile'=>$value['tbl_user_mobile'],'tbl_user_email'=>$value['tbl_user_email'],'tbl_user_password'=>$value['tbl_user_password'],'tbl_user_platform'=>0,'tbl_user_createdat'=>date('Y-m-d H:i:s'),'tbl_user_updatedat'=>date('Y-m-d H:i:s'));
                $result = $this->r_user_model->add_new_r_user($vals);
                redirect('r_user_listing');
            }
            else
            {
	            $data['action']='add_new_r_user';
	            $this->global['pageTitle'] =APP_NAME. ' : Add New Registered User';
	            $this->loadViews("add_new_r_user_view", $this->global, $data, NULL);
	        }
        }
    }

    function edit_r_user()
    {
            if($this->input->post())
            {
                $value=$this->input->post();
                //echo "<pre>";print_r($value);die;
                $result = $this->r_user_model->edit_r_user($value);
                redirect('r_user_listing');
            }
            else
            {
                $last = $this->uri->total_segments();
                $id = $this->uri->segment($last);
                $data['list'] = $this->r_user_model->get_r_user_info($id);
                $data['action']='edit_r_user';
                $this->global['pageTitle'] = APP_NAME.' : Edit Registered User';
                //echo "<pre>";print_r($data);die;
                $this->loadViews("add_new_r_user_view", $this->global, $data, NULL);
            }           
    }    
    
    function delete_r_user()
    {
            $last = $this->uri->total_segments();
            $record_num = $this->uri->segment($last);
            $result = $this->r_user_model->delete_r_user($record_num);
            redirect('r_user_listing');
    }    
 
    function pageNotFound()
    {
        $this->global['pageTitle'] = APP_NAME.' : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }   
}
?>