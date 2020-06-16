<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class contact_us extends BaseController
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('contact_us_model');
        $this->isLoggedIn();
    }    
  
    public function index()
    {
        $this->global['pageTitle'] = APP_NAME.' : Dashboard';
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }    
  
    function contact_us_listing()
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

            $count = $this->contact_us_model->contact_usListingCount($searchText);
            //echo "<pre>";print_r($count);die;
			$returns = $this->paginationCompress ( "sub_service_listing/", $count, 10 );
			//echo "<pre>";print_r($returns);die;
            $data['servicesRecords'] = $this->contact_us_model->contact_usListing($searchText, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = APP_NAME.' : Sub services Listing';
            $this->loadViews("contact_us", $this->global, $data, NULL);
        //}
    }
   
    function contact_us_reply()
    {
            if($this->input->post())
            {
                $value=$this->input->post();
                //echo "<pre>";print_r($value);die;
                //$result = $this->contact_us_model->send_mail($value);
                $result = $this->contact_us_model->update_values($value);
                redirect('contact_us_listing');
            }
            else
            {

                $last = $this->uri->total_segments();
                $id = $this->uri->segment($last);
                $data['list'] = $this->contact_us_model->get_info($id);
                $data['action']='contact_us_reply';
                $this->global['pageTitle'] = APP_NAME.' : Reply Contact Us';
                //echo "<pre>";print_r($data);die;
                $this->loadViews("contact_us_reply", $this->global, $data, NULL);
            }           
    }    
    
    function delete_contact_us()
    {        
        $last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
        $result = $this->contact_us_model->delete_contact_us($record_num);
        $this->session->set_flashdata('message','Record succsfully Deleted.');
        redirect('contact_us_listing');
    }    
 
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }   
}
?>