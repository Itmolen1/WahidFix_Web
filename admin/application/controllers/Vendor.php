<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Vendor extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('vendor_model');
        $this->isLoggedIn();   
    }

    public function index()
    {
        $this->global['pageTitle'] = APP_NAME.' : Vendor Listing';
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }

    function vendor_listing()
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
            $count = $this->vendor_model->vendor_listing_count($searchText);
			$returns = $this->paginationCompress ( "vendor_listing/", $count, 10 );
			//echo "<pre>";print_r($returns);die;
            $data['vendors'] = $this->vendor_model->vendor_listing($searchText, $returns["page"], $returns["segment"]);
            $data['services'] = $this->vendor_model->get_service_list();
            //echo "<pre>";print_r($data);die;
            $this->global['pageTitle'] = APP_NAME.' : Vendor Listing';
            $this->loadViews("vendor_list_view", $this->global, $data, NULL);
        //}
    }  

    function add_new_vendor()
    {
        if($this->input->post())
        {
            $value=$this->input->post();
            //echo "<pre>";print_r($value);print_r($_FILES);die;
            /*$this->load->library('form_validation');
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
            if($this->form_validation->run() == FALSE)
            {
                echo "validation false";die;
                $this->add_new_vendor();
            }
            else
            {*/
                //$un=unserialize($se);
                //echo "<pre>";print_r($se);die;
                //$value['tbl_vendor_id_card']=$img['tbl_vendor_id_card'];
                //$value['tbl_vendor_image']=$img1['tbl_vendor_image'];
                $result = $this->vendor_model->add_new_vendor($value);
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Vendor created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Vendor creation failed');
                }                
                redirect('vendor_listing');
           // }
        }
        else
        {
            $data['action']='add_new_vendor';
            //echo "<pre>";print_r($data);die;
            $this->global['pageTitle'] = APP_NAME.' : Add New Vendor';
            $this->loadViews("add_new_vendor_view", $this->global, $data, NULL);
        }
    }
    
    function edit_vendor()
    {
        if($this->input->post())
        {
        	$value=$this->input->post();              
            $result = $this->vendor_model->update_vendor($value);
            redirect('vendor_listing');
            //$this->loadThis();
        }
        else
        {
            /*$this->load->library('form_validation');
            $userId = $this->input->post('userId');
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','matches[cpassword]|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($userId);
            }
            else
            {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->security->xss_clean($this->input->post('mobile'));
               */ 
            //$result = $this->vendor_model->edit_vendor($userInfo, $userId);
            $last = $this->uri->total_segments();
            $record_num = $this->uri->segment($last);
            if(is_numeric($record_num))
            {
                $data['vendor'] = $this->vendor_model->get_vendor_by_id($record_num);
            }
            else
            {
                redirect('vendor_listing');
            }
            //$data['services'] = $this->vendor_model->get_service_list();
            $data['action']='edit_vendor';
            //echo "<pre>";print_r($data);die;
            $this->global['pageTitle'] = APP_NAME.' : Edit Vendor';
            $this->loadViews("add_new_vendor_view", $this->global, $data, NULL);
            //}
        }
    }

    function delete_vendor()
    {
        $last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
        $result = $this->vendor_model->delete_vendor($record_num);
        redirect('vendor_listing','refresh');
    }

    function vendor_email_exists()
    {
        $vendor_id = $this->input->post("vendor_id");
        $vendor_email = $this->input->post("vendor_email");
        if(empty($userId)){
            $result = $this->vendor_model->vendor_email_exists($vendor_email);
        } else {
            $result = $this->vendor_model->vendor_email_exists($vendor_email, $vendor_id);
        }
        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }
    
    function pageNotFound()
    {
        $this->global['pageTitle'] = APP_NAME.' : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}
?>