<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class Careers extends BaseController
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('careers_model');
        $this->isLoggedIn();
    }    
  
    public function index()
    {
        $this->global['pageTitle'] = APP_NAME.' : Dashboard';
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }    
  
    function careers_listing()
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

            $count = $this->careers_model->careers_ListingCount($searchText);
            //echo "<pre>";print_r($count);die;
			$returns = $this->paginationCompress ( "careers_listing/", $count, 10 );
			//echo "<pre>";print_r($returns);die;
            $data['servicesRecords'] = $this->careers_model->careers_Listing($searchText, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = APP_NAME.' : Careers Listing';
            $this->loadViews("careers_list_view", $this->global, $data, NULL);
        //}
    }
   
    function contact_us_reply()
    {
            if($this->input->post())
            {
                $value=$this->input->post();
                //echo "<pre>";print_r($value);die;
                //$result = $this->careers_model->send_mail($value);
                $result = $this->careers_model->update_values($value);
                redirect('contact_us_listing');
            }
            else
            {

                $last = $this->uri->total_segments();
                $id = $this->uri->segment($last);
                $data['list'] = $this->careers_model->get_info($id);
                $data['action']='contact_us_reply';
                $this->global['pageTitle'] = APP_NAME.' : Reply Contact Us';
                //echo "<pre>";print_r($data);die;
                $this->loadViews("contact_us_reply", $this->global, $data, NULL);
            }           
    }    
    
    function delete_careers()
    {        
        $last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
        $result = $this->careers_model->delete_careers($record_num);
        $this->session->set_flashdata('message','Record succsfully Deleted.');
        redirect('careers_listing');
    }    
 
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }   
}
?>