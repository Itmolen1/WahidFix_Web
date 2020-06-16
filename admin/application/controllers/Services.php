<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class Services extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('services_model');
        $this->isLoggedIn();   
    }    
  
    public function index()
    {
        //echo "<pre>";print_r('here');die;
        $this->global['pageTitle'] = APP_NAME.' : Dashboard';
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }    
  
    function servicesListing()
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
            
            $count = $this->services_model->servicesListingCount($searchText);

			$returns = $this->paginationCompress ( "servicesListing/", $count, 10 );
            
            $data['servicesRecords'] = $this->services_model->servicesListing($searchText, $returns["page"], $returns["segment"]);
            //echo "<pre>";print_r($data);die;
            $this->global['pageTitle'] = APP_NAME.' : services Listing';
            
            $this->loadViews("services", $this->global, $data, NULL);
        //}
    }
   
    function addNewservice()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('services_model');
            $data['roles'] = $this->services_model->getservicesRoles();
            $data['action']='addNewServices';
            $this->global['pageTitle'] = APP_NAME.' : Add New services';
            $this->loadViews("addNewService", $this->global, $data, NULL);
        }
    }
    
    function addNewServices()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('service_name','Service Name','trim|required|max_length[128]');
            if($this->form_validation->run() == FALSE)
            {
                $this->addNewservice();
            }
            else
            {
                /*logo upload*/
                $dir='assets/uploads/';
                $n=pathinfo($_FILES['service_logo']['name']);
                $ex=$n['extension'];
                $uid=uniqid('emp_');
                $tfile=$dir.$uid.'.'.$ex;
                //echo $tfile;die;
                $img=array();
                $imageFileType = strtolower(pathinfo($tfile,PATHINFO_EXTENSION));   
                if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
                {
                    if ( move_uploaded_file($_FILES['service_logo']['tmp_name'],$tfile))
                    {
                        $img['service_logo']=ADMIN_PATH.$tfile;
                    }
                    else
                    {
                        $this->addNewservice();
                    }
                }
                /*logo upload*/
                $service_name = ucwords(strtolower($this->security->xss_clean($this->input->post('service_name'))));
                $detail_page = ucwords(strtolower($this->security->xss_clean($this->input->post('detail_page'))));
               
                $servicesInfo = array('service_name'=>$service_name,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'),'service_logo'=>$img['service_logo'],'detail_page'=>$detail_page,'service_desc'=>$this->input->post('service_desc')); 
                //echo "<pre>";print_r($servicesInfo);die;               
                $this->load->model('services_model');
                $result = $this->services_model->addNewservices($servicesInfo);
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New services created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'services creation failed');
                }                
                redirect('servicesListing');
            }
        }
    }

    function editService()
    {
            if($this->input->post())
            {
                $value=$this->input->post();
                 /*logo upload*/
                if(isset($_FILES) && $_FILES['service_logo']['name']!='')
                {
                    $dir='assets/uploads/';
                    $tfile=$dir.$_FILES['service_logo']['name'];
                    $img=array();
                    $imageFileType = strtolower(pathinfo($tfile,PATHINFO_EXTENSION));   
                    if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
                    {
                        if ( move_uploaded_file($_FILES['service_logo']['tmp_name'],$tfile))
                        {
                            $img['service_logo']=ADMIN_PATH.$tfile;
                        }
                        else
                        {
                            $this->addNewservice();
                        }
                    }
                    $value['service_logo']=$img['service_logo'];
                    /*logo upload*/
                    
                    $un=str_replace(ADMIN_PATH,'',$value['service_logo_old']);
                    //echo $_SERVER['DOCUMENT_ROOT'].'/karigar/'.$un;die;
                    $u=unlink($_SERVER['DOCUMENT_ROOT'].'/admin/'.$un);
                }
                else
                {
                    $value['service_logo']=$value['service_logo_old'];
                }
                //echo "<pre>";print_r($u);die;
                $result = $this->services_model->editservices($value);
                redirect('servicesListing');
            }
            else
            {
                $last = $this->uri->total_segments();
                $record_num = $this->uri->segment($last);
                $data['servicesInfo'] = $this->services_model->getservicesInfo($record_num);
                $data['action']='editService';
                $this->global['pageTitle'] = APP_NAME.' : Edit services';
                $this->loadViews("addNewService", $this->global, $data, NULL);
            }           
    }
    
    function deleteservices()
    {
            $last = $this->uri->total_segments();
            $record_num = $this->uri->segment($last);
            $result = $this->services_model->deleteservices($record_num);
            redirect('servicesListing','refresh');
    }
    
    function pageNotFound()
    {
        $this->global['pageTitle'] = APP_NAME.' : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }  
}
?>