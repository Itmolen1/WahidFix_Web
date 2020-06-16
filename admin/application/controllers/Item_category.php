<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Item_category extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('item_category_model');
        $this->isLoggedIn();
    }    
  
    public function index()
    {
        $this->global['pageTitle'] = APP_NAME.': Item Category';
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }    
  
    function item_category_listing()
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
            $count = $this->item_category_model->item_categoryListingCount($searchText);
            //echo "<pre>";print_r($count);die;
			$returns = $this->paginationCompress ( "item_category_listing/", $count, 10 );
			//echo "<pre>";print_r($returns);die;
            $data['servicesRecords'] = $this->item_category_model->item_categoryListing($searchText, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = APP_NAME.' : Item Category Listing';
            $this->loadViews("item_category", $this->global, $data, NULL);
        //}
    }
   
    function add_new_item_category()
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
                $item_category_name=$this->security->xss_clean($this->input->post('item_category_name'));
               	$vals = array('item_category_name'=>$item_category_name,'item_category_created_at'=>date('Y-m-d H:i:s'),'item_category_updated_at'=>date('Y-m-d H:i:s'));
                //echo "<pre>";print_r($vals);die;
                $result = $this->item_category_model->add_new_item_category($vals);
                redirect('item_category_listing');
            }
            else
            {
	            $this->load->model('item_category_model');
	            $data['action']='add_new_item_category';
	            $this->global['pageTitle'] =APP_NAME. ' : Add New Item Unit';
	            $this->loadViews("add_new_item_category", $this->global, $data, NULL);
	        }
        }
    }

    function edit_item_category()
    {
            if($this->input->post())
            {
                $value=$this->input->post();
                //echo "<pre>";print_r($value);die;
                $result = $this->item_category_model->edit_item_category($value);
                redirect('item_category_listing');
            }
            else
            {
                $last = $this->uri->total_segments();
                $id = $this->uri->segment($last);
                $data['list'] = $this->item_category_model->get_item_category_info($id);
                $data['action']='edit_item_category';
                $this->global['pageTitle'] = APP_NAME.' : Edit Item Unit';
                //echo "<pre>";print_r($data);die;
                $this->loadViews("add_new_item_category", $this->global, $data, NULL);
            }           
    }    
    
    function delete_item_category()
    {
            $last = $this->uri->total_segments();
            $record_num = $this->uri->segment($last);
            $result = $this->item_category_model->delete_item_category($record_num);
            redirect('item_category_listing');
    }    
 
    function pageNotFound()
    {
        $this->global['pageTitle'] = APP_NAME.' : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }   
}
?>