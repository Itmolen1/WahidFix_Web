<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Guest_service_request extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('guest_service_request_model');
        $this->isLoggedIn();
    }    
  
    public function index()
    {
        $this->global['pageTitle'] = APP_NAME.'guest service request';
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }

    function get_guest_suborder_details()
    {
        $value=$this->input->post();
        $result=$this->guest_service_request_model->get_guest_suborder_details($value['data']);
        $data['finalresult']=$this->get_suborder_final_list_string($result);
        $data['sr_id']='<a href="'.base_url().'edit_service_request/'.$value['data'].'"'.'<button type="button" value="Assign" class="btn btn-success test">Assign</button></a>';
        echo json_encode($data);
    }

    function get_suborder_final_list_string($rows)
    {
        $finalresult='';
        for($i=0;$i<count($rows);$i++)
        {
            $finalresult.='<div class="row"><div class="col-md-8">Service Name : '.$rows[$i]['service_name'].'</div></div>';
        }
        return $finalresult;
    }    
  
    function guest_service_request_listing()
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

            $count = $this->guest_service_request_model->guest_service_requestListingCount($searchText);
            //echo "<pre>";print_r($count);die;
			$returns = $this->paginationCompress ( "sub_service_listing/", $count, 10 );
			//echo "<pre>";print_r($returns);die;
            $data['servicesRecords'] = $this->guest_service_request_model->guest_service_requestListing($searchText, $returns["page"], $returns["segment"]);
            //echo "<pre>";print_r($data);die;
            $this->global['pageTitle'] = APP_NAME.' : Sub services Listing';
            $this->loadViews("guest_service_request", $this->global, $data, NULL);
        //}
    }

    function edit_service_request()
    {
            if($this->input->post())
            {
                $value=$this->input->post();
                //echo "<pre>";print_r($value);die;
                $result = $this->guest_service_request_model->edit_service_request($value);
                redirect('service_request_listing');
            }
            else
            {
                $last = $this->uri->total_segments();
                $id = $this->uri->segment($last);
                $data['sr'] = $this->guest_service_request_model->get_service_request_info($id);
                //echo "<pre>";print_r($data);die;
                $data['emp'] = $this->guest_service_request_model->get_eligible_emp_list($data['sr']['service_id']);
                $data['action']='edit_service_request';
                $this->global['pageTitle'] = APP_NAME.' : Edit service request';
                //echo "<pre>";print_r($data);die;
                $this->loadViews("add_new_guest_service_request", $this->global, $data, NULL);
            }           
    }    
    
    function delete_service_request()
    {       
        $last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
        $result = $this->guest_service_request_model->delete_service_request($record_num);
        redirect('service_request_listing');        
    }    
 
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }   
}
?>