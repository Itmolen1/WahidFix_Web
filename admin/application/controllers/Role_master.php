<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Role_master extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('role_master_model');
        $this->isLoggedIn();
    }    
  
    public function index()
    {
        $this->global['pageTitle'] = APP_NAME.': Dashboard';
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }    
  
    function role_master_listing()
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
            $count = $this->role_master_model->role_masterListingCount($searchText);
            //echo "<pre>";print_r($count);die;
			$returns = $this->paginationCompress ( "role_master_listing/", $count, 10 );
			//echo "<pre>";print_r($returns);die;
            $data['servicesRecords'] = $this->role_master_model->role_masterListing($searchText, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = APP_NAME.' : Role Master Listing';
            $this->loadViews("role_master_list_view", $this->global, $data, NULL);
        //}
    }
   
    function add_new_role_master()
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
                $role=$this->security->xss_clean($this->input->post('role'));
               	$vals = array('role'=>$role);
                //echo "<pre>";print_r($vals);die;
                $result = $this->role_master_model->add_new_role_master($vals);
                redirect('role_master_listing');
            }
            else
            {
	            $this->load->model('role_master_model');
	            $data['action']='add_new_role_master';
	            $this->global['pageTitle'] =APP_NAME. ' : Add New Role';
	            $this->loadViews("add_new_role_master", $this->global, $data, NULL);
	        }
        }
    }

    function AssignRightsRole()
    {
        if($this->input->post())
        {
            $value=$this->input->post();
            if(isset($value['update']) && $value['update']=='update')
            {
                //echo "<pre>";print_r($value);die;
                $this->role_master_model->update_rights($value,$this->role_master_model->get_modules());
            }
            else
            {
                $this->role_master_model->add_rights($value);
            }
            redirect('role_master_listing');
            //echo "<pre>";print_r($value);die;
        }
        else
        {
            $data=array();
            $data['action']='AssignRightsRole';
            $data['modules']=$this->role_master_model->get_modules();
            //check if user has entry in rights table///
            $result=$this->role_master_model->check_role_existance($this->uri->segment(2));
            //echo "<pre>";print_r($data);die;
            if(!empty($result))
            {
                $data['existing_rights']=$result;
                //echo "<pre>";print_r($data);die;
                //$data['action']='UpdateRights';
            }
            //echo "<pre>";print_r($data);die;
            $this->global['pageTitle'] = APP_NAME.' : Assign Rights to Role';
            $this->loadViews("add_new_assign_rights_torole_view", $this->global, $data, NULL);
        }
    }

    function edit_role_master()
    {
            if($this->input->post())
            {
                $value=$this->input->post();
                //echo "<pre>";print_r($value);die;
                $result = $this->role_master_model->edit_role_master($value);
                redirect('role_master_listing');
            }
            else
            {
                $last = $this->uri->total_segments();
                $id = $this->uri->segment($last);
                $data['list'] = $this->role_master_model->get_role_master_info($id);
                $data['action']='edit_role_master';
                $this->global['pageTitle'] = APP_NAME.' : Edit Role';
                //echo "<pre>";print_r($data);die;
                $this->loadViews("add_new_role_master", $this->global, $data, NULL);
            }           
    }    
    
    function delete_role_master()
    {
            $last = $this->uri->total_segments();
            $record_num = $this->uri->segment($last);
            $result = $this->role_master_model->delete_role_master($record_num);
            redirect('role_master_listing');
    }    
 
    function pageNotFound()
    {
        $this->global['pageTitle'] = APP_NAME.' : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }   
}
?>