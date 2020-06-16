<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class Sub_services extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('sub_services_model');
        $this->isLoggedIn();
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-cache, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }    
  
    public function index()
    {
        $this->global['pageTitle'] = APP_NAME.': Dashboard';
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }    
  
    function sub_service_listing()
    {
    	$value=$this->input->post();
        // if($this->isAdmin() == TRUE)
        // {
        //     $this->loadThis();
        // }
   //      if(isset($value['service_id']))
   //      {
   //      	//echo "<pre>";print_r($value);die;
   //      	$searchText = $this->security->xss_clean($this->input->post('searchText'));
   //          $data['searchText'] = $searchText;
   //          $this->load->library('pagination');

   //          $count = $this->sub_services_model->sub_servicesListingCount($searchText,$value['service_id']);
   //          //echo "<pre>";print_r($count);die;
			// $returns = $this->paginationCompress ( "sub_service_listing/", $count, 10 );
			// //echo "<pre>";print_r($returns);die;
   //          $data['servicesRecords'] = $this->sub_services_model->sub_servicesListing($searchText,$value['service_id'], $returns["page"], $returns["segment"]);
   //          $data['services']=$this->sub_services_model->get_services();
   //          $data['selected_service']=$value['service_id'];
   //          $this->global['pageTitle'] = APP_NAME.' : Sub services Listing';
   //          $this->loadViews("sub_services", $this->global, $data, NULL);
   //      }
   //      else
   //      {      
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $service_id = $this->input->post('service_id');
            //echo "<pre>";print_r($service_id);die;
            $data['searchText'] = $searchText;
            $data['service_id'] = $service_id;
            $this->load->library('pagination');

            $count = $this->sub_services_model->sub_servicesListingCount($searchText,$service_id);
            //echo "<pre>";print_r($count);die;
			$returns = $this->paginationCompress ( "sub_service_listing/", $count, 10 );
			//echo "<pre>";print_r($returns);die;
            $data['servicesRecords'] = $this->sub_services_model->sub_servicesListing($searchText,$service_id, $returns["page"], $returns["segment"]);
            $data['services']=$this->sub_services_model->get_services();
            $this->global['pageTitle'] = APP_NAME.' : Sub services Listing';
            $this->loadViews("sub_services", $this->global, $data, NULL);
        //}
    }
   
    function add_new_subservice()
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
                //echo "<pre>";print_r($value);die;
                /*logo upload*/
                $sub_service_image='';
                //echo "<pre>";print_r($_FILES);die;
                if(isset($_FILES['sub_service_image']) && $_FILES['sub_service_image']['name']!='')
                {
                    $dir='assets/uploads/';
                    $n=pathinfo($_FILES['sub_service_image']['name']);
                    $ex=$n['extension'];
                    $uid=uniqid('sub_');
                    $tfile=$dir.$uid.'.'.$ex;
                    //echo $tfile;die;
                    $imageFileType = strtolower(pathinfo($tfile,PATHINFO_EXTENSION));   
                    if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
                    {
                        if ( move_uploaded_file($_FILES['sub_service_image']['tmp_name'],$tfile))
                        {
                            $sub_service_image=ADMIN_PATH.$tfile;
                        }
                        else
                        {
                            $this->addNewservice();
                        }
                    }
                }
                /*logo upload*/

                $sub_service_name=$this->security->xss_clean($this->input->post('sub_service_name'));
                $service_id=$this->security->xss_clean($this->input->post('service_id'));
               	$vals = array('service_id'=>$value['service_id'],'sub_service_name'=>$value['sub_service_name'],'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'),'isDeleted'=>0,'sub_service_image'=>$sub_service_image);
                //echo "<pre>";print_r($vals);die;
                $result = $this->sub_services_model->add_new_subservice($vals);
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Sub services created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Sub services creation failed');
                }                
                redirect('sub_service_listing');
            }
            else
            {
	            $this->load->model('sub_services_model');
	            $data['services'] = $this->sub_services_model->get_services();
	            $data['action']='add_new_subservice';
	            $this->global['pageTitle'] =APP_NAME. ' : Add New sub services';
	            $this->loadViews("add_new_subservice", $this->global, $data, NULL);
	        }
        }
    }

    function edit_sub_subservice()
    {
            if($this->input->post())
            {
                $value=$this->input->post();
                if(isset($_FILES) && $_FILES['sub_service_image']['name']!='')
                {
                    $dir='assets/uploads/';
                    $n=pathinfo($_FILES['sub_service_image']['name']);
                    $ex=$n['extension'];
                    $uid=uniqid('sub_');
                    $tfile=$dir.$uid.'.'.$ex;
                    $imageFileType = strtolower(pathinfo($tfile,PATHINFO_EXTENSION));   
                    if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
                    {
                        if ( move_uploaded_file($_FILES['sub_service_image']['tmp_name'],$tfile))
                        {
                           $sub_service_image=ADMIN_PATH.$tfile;
                        }
                        else
                        {
                            $this->addNewservice();
                        }
                    }
                    $value['sub_service_image']=$sub_service_image;
                    /*logo upload*/
                    
                    $un=str_replace(ADMIN_PATH,'',$value['sub_service_image_old']);
                    //echo $_SERVER['DOCUMENT_ROOT'].'/karigar/'.$un;die;
                    $u=unlink($_SERVER['DOCUMENT_ROOT'].'/admin/'.$un);
                }
                else
                {
                    $value['sub_service_image']=$value['sub_service_image_old'];
                }
                //echo "<pre>";print_r($value);die;
                $result = $this->sub_services_model->edit_sub_service($value);
                redirect('sub_service_listing');
            }
            else
            {
                $last = $this->uri->total_segments();
                $id = $this->uri->segment($last);
                $data['list'] = $this->sub_services_model->get_sub_service_info($id);
                $data['services']=$this->sub_services_model->get_all_services();
                $data['action']='edit_sub_subservice';
                $this->global['pageTitle'] = APP_NAME.' : Edit services';
                //echo "<pre>";print_r($data);die;
                $this->loadViews("add_new_subservice", $this->global, $data, NULL);
            }           
    }
    
    
    function delete_sub_service()
    {
        $last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
        $result = $this->sub_services_model->delete_sub_service($record_num);
        redirect('sub_service_listing');
    }
    
 
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }

   
}

?>