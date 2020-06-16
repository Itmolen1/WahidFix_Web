<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Slider extends BaseController
{
    public function __construct()
    {
       parent::__construct();
        $this->load->model('slider_model');
        $this->isLoggedIn();   
    }    
  
    public function index()
    {
        //echo "<pre>";print_r('here');die;
        $this->global['pageTitle'] = APP_NAME.' : Dashboard';
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }    
  
    function sliderListing()
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
            
            $count = $this->slider_model->sliderListingCount($searchText);

			$returns = $this->paginationCompress ( "sliderListing/", $count, 10 );
            
            $data['sliderRecords'] = $this->slider_model->sliderListing($searchText, $returns["page"], $returns["segment"]);
            //echo "<pre>";print_r($data);die;
            $this->global['pageTitle'] =  APP_NAME.' : slider Listing';
            
            $this->loadViews("slider", $this->global, $data, NULL);
        //}
    }

   
    function addNewslider()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('slider_model');
            $data['action']='addNewSliders';
            $this->global['pageTitle'] = APP_NAME.' : Add New slider';
            $this->loadViews("addNewSlider", $this->global, $data, NULL);
        }
    }
    
    function addNewSliders()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {           
            /*logo upload*/
            $dir='assets/slider/';
            $tfile=$dir.$_FILES['slider_image']['name'];
            //echo "<pre>";print_r($_FILES);die;
            $img=array();
            $imageFileType = strtolower(pathinfo($tfile,PATHINFO_EXTENSION));   
            if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
            {
                if ( move_uploaded_file($_FILES['slider_image']['tmp_name'],$tfile))
                {
                    $img['slider_image']=ADMIN_PATH.$tfile;
                }
                else
                {
                    $this->addNewslider();
                }
            }
            /*logo upload*/
            $slider_image_alt = ucwords(strtolower($this->security->xss_clean($this->input->post('slider_image_alt'))));
           
            $sliderInfo = array('slider_image_alt'=>$slider_image_alt,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'),'slider_image'=>$img['slider_image']); 
            //echo "<pre>";print_r($sliderInfo);die;               
            $this->load->model('slider_model');
            $result = $this->slider_model->addNewslider($sliderInfo);
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'New slider created successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'slider creation failed');
            }                
            redirect('sliderListing');            
        }
    }


    function editSlider()
    {
            if($this->input->post())
            {
                $value=$this->input->post();

                 /*logo upload*/
                if(isset($_FILES) && $_FILES['slider_image']['name']!='')
                {
                    $dir='assets/slider/';
                    $tfile=$dir.$_FILES['slider_image']['name'];
                    $img=array();
                    $imageFileType = strtolower(pathinfo($tfile,PATHINFO_EXTENSION));   
                    if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
                    {
                        if ( move_uploaded_file($_FILES['slider_image']['tmp_name'],$tfile))
                        {
                            $img['slider_image']=ADMIN_PATH.$tfile;
                        }
                        else
                        {
                            $this->addNewslider();
                        }
                    }
                    $value['slider_image']=$img['slider_image'];
                    /*logo upload*/
                    
                    $un=str_replace(FRONT_PATH,'',$value['slider_image_old']);
                    //echo $_SERVER['DOCUMENT_ROOT'].'/karigar/'.$un;die;
                    $u=unlink($_SERVER['DOCUMENT_ROOT'].'/karigar/'.$un);
                }
                else
                {
                    $value['slider_image']=$value['slider_image_old'];
                }
                //echo "<pre>";print_r($u);die;
                $result = $this->slider_model->editslider($value);
                redirect('sliderListing');
            }
            else
            {
                $last = $this->uri->total_segments();
                $record_num = $this->uri->segment($last);
                $data['sliderInfo'] = $this->slider_model->getsliderInfo($record_num);
                $data['action']='editSlider';
                $this->global['pageTitle'] = APP_NAME.' : Edit slider';
                $this->loadViews("addNewSlider", $this->global, $data, NULL);
            }           
    }
    
    function deleteslider()
    {        
        $last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
        $result = $this->slider_model->deleteslider($record_num);
        redirect('sliderListing');
    }    
 
    function pageNotFound()
    {
        $this->global['pageTitle'] = APP_NAME.' : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }   
}
?>