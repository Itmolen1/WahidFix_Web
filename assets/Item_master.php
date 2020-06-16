<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Item_master extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('item_master_model');
        $this->isLoggedIn();
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-cache, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }    
  
    public function index()
    {
        $this->global['pageTitle'] = APP_NAME.': Item Master';
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }    
  
    function item_master_listing()
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
            $count = $this->item_master_model->item_masterListingCount($searchText);
            //echo "<pre>";print_r($count);die;
			$returns = $this->paginationCompress ( "item_master_listing/", $count, 10 );
			//echo "<pre>";print_r($returns);die;
            $data['servicesRecords'] = $this->item_master_model->item_masterListing($searchText, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = APP_NAME.' : Item Master Listing';
            $data['unit']=$this->item_master_model->get_all_units();
            $data['category']=$this->item_master_model->get_all_category();
            //echo "<pre>";print_r($data);die;
            $this->loadViews("item_master", $this->global, $data, NULL);
        //}
    }
   
    function add_new_item_master()
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
               	//echo "<pre>";print_r($value);die;
                $value['item_master_logo']='N.A.';
                if(isset($_FILES) && $_FILES['item_master_logo']['error']==0)
                {
                    /*image upload*/
                    $dir='assets/item/';
                    $n=pathinfo($_FILES['item_master_logo']['name']);
                    $ex=$n['extension'];
                    $uid=uniqid('item_');
                    $tfile=$dir.$uid.'.'.$ex;
                    $img=array();
                    $imageFileType = strtolower(pathinfo($_FILES['item_master_logo']['name'],PATHINFO_EXTENSION));   
                    if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
                    {
                        if ( move_uploaded_file($_FILES['item_master_logo']['tmp_name'],$tfile))
                        {
                            $img['item_master_logo']=ADMIN_PATH.$tfile;
                            $value['item_master_logo']=$img['item_master_logo'];
                        }                        
                    }
                    /*image upload*/
                }

                $vals = array('item_master_name'=>$value['item_master_name'],'item_master_desc'=>$value['item_master_desc'],'item_master_stock'=>$value['item_master_stock'],'item_master_price'=>$value['item_master_price'],'item_master_unit'=>$value['item_master_unit'],'item_master_created_at'=>date('Y-m-d H:i:s'),'item_master_update_at'=>date('Y-m-d H:i:s'),'item_master_logo'=>$value['item_master_logo'],'item_master_category'=>$value['item_master_category']);
                $result = $this->item_master_model->add_new_item_master($vals);

                redirect('item_master_listing');
            }
            else
            {
	            $data['action']='add_new_item_master';
	            $data['unit']=$this->item_master_model->get_all_units();
                $data['category']=$this->item_master_model->get_all_category();
	            $this->global['pageTitle'] =APP_NAME. ' : Add New Item Unit';
	            $this->loadViews("add_new_item_master_view", $this->global, $data, NULL);
	        }
        }
    }

    function edit_item_master()
    {
            if($this->input->post())
            {
                $value=$this->input->post();
                //echo "<pre>";print_r($value);die;
                /*Image upload*/
                if(isset($_FILES) && $_FILES['item_master_logo']['name']!='')
                {
                    $dir='assets/item/';
                    $n=pathinfo($_FILES['item_master_logo']['name']);
                    $ex=$n['extension'];
                    $uid=uniqid('item_');
                    $tfile=$dir.$uid.'.'.$ex;
                    $img=array();
                    $imageFileType = strtolower(pathinfo($tfile,PATHINFO_EXTENSION));   
                    if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
                    {
                        if ( move_uploaded_file($_FILES['item_master_logo']['tmp_name'],$tfile))
                        {
                            $img['item_master_logo']=ADMIN_PATH.$tfile;
                        }
                        else
                        {
                            redirect('purchase_order_listing','refresh');
                        }
                    }
                    $value['item_master_logo']=$img['item_master_logo'];                
                    $un=str_replace(FRONT_PATH,'',$value['item_master_logo_old']);
                    //echo $_SERVER['DOCUMENT_ROOT'].'/karigar/'.$un;die;
                    $u=unlink($_SERVER['DOCUMENT_ROOT'].'/'.$un);
                }
                else
                {
                    $value['item_master_logo']=$value['item_master_logo_old'];
                }
                /*Image upload*/

                $result = $this->item_master_model->edit_item_master($value);
                redirect('item_master_listing');
            }
            else
            {
                $last = $this->uri->total_segments();
                $id = $this->uri->segment($last);
                $data['unit']=$this->item_master_model->get_all_units();
                $data['category']=$this->item_master_model->get_all_category();
                $data['list'] = $this->item_master_model->get_item_unit_info($id);
                $data['action']='edit_item_master';
                $this->global['pageTitle'] = APP_NAME.' : Edit Item ';
                //echo "<pre>";print_r($data);die;
                $this->loadViews("add_new_item_master_view", $this->global, $data, NULL);
            }           
    }    
    
    function delete_item_master()
    {
            $last = $this->uri->total_segments();
            $record_num = $this->uri->segment($last);
            $result = $this->item_master_model->delete_item_master($record_num);
            redirect('item_master_listing');
    }    
 
    function pageNotFound()
    {
        $this->global['pageTitle'] = APP_NAME.' : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }   
}
?>