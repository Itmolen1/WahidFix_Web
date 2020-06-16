<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Vehicle extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('vehicle_model');
        $this->isLoggedIn();   
    }

    public function index()
    {
        $this->global['pageTitle'] = APP_NAME.' : Vehicle Listing';
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }

    function vehicle_listing()
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
            $count = $this->vehicle_model->vehicle_listing_count($searchText);
			$returns = $this->paginationCompress ( "vehicle_listing/", $count, 10 );
			//echo "<pre>";print_r($returns);die;
            $data['vehicles'] = $this->vehicle_model->vehicle_listing($searchText, $returns["page"], $returns["segment"]);
            //echo "<pre>";print_r($data);die;
            $this->global['pageTitle'] = APP_NAME.' : Vehicle Listing';
            $this->loadViews("vehicle_list_view", $this->global, $data, NULL);
        //}
    }  

    function add_new_vehicle()
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
                $this->add_new_vehicle();
            }
            else
            {*/
                //$un=unserialize($se);
                //echo "<pre>";print_r($se);die;

                 /*insurance upload*/
                $dir='assets/vehicle/';
                $n=pathinfo($_FILES['vehicle_insurance_img']['name']);
                $ex=$n['extension'];
                $uid=uniqid('insu_');
                $tfile=$dir.$uid.'.'.$ex;
                $img=array();
                $imageFileType = strtolower(pathinfo($_FILES['vehicle_insurance_img']['name'],PATHINFO_EXTENSION));   
                if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
                {
                    if ( move_uploaded_file($_FILES['vehicle_insurance_img']['tmp_name'],$tfile))
                    {
                        $img['vehicle_insurance_img']=ADMIN_PATH.$tfile;
                    }
                    else
                    {
                        $this->add_new_vehicle();
                    }
                }
                /*insurance upload*/

                /*mulkia front image upload*/
                $dir='assets/vehicle/';
                $n=pathinfo($_FILES['vehicle_mulkia_front_img']['name']);
                $ex=$n['extension'];
                $uid=uniqid('mf_');
                $tfile=$dir.$uid.'.'.$ex;
                $img1=array();
                $imageFileType = strtolower(pathinfo($tfile,PATHINFO_EXTENSION));   
                if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
                {
                    if ( move_uploaded_file($_FILES['vehicle_mulkia_front_img']['tmp_name'],$tfile))
                    {
                        $img1['vehicle_mulkia_front_img']=ADMIN_PATH.$tfile;
                    }
                    else
                    {
                        $this->add_new_vehicle();
                    }
                }
                /*mulkia front image upload*/

                /*mulkia back image upload*/
                $dir='assets/vehicle/';
                $n=pathinfo($_FILES['vehicle_mulkia_back_img']['name']);
                $ex=$n['extension'];
                $uid=uniqid('mb_');
                $tfile=$dir.$uid.'.'.$ex;
                $img2=array();
                $imageFileType = strtolower(pathinfo($tfile,PATHINFO_EXTENSION));   
                if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
                {
                    if ( move_uploaded_file($_FILES['vehicle_mulkia_back_img']['tmp_name'],$tfile))
                    {
                        $img2['vehicle_mulkia_back_img']=ADMIN_PATH.$tfile;
                    }
                    else
                    {
                        $this->add_new_vehicle();
                    }
                }
                /*mulkia back image upload*/

                $value['vehicle_insurance_img']=$img['vehicle_insurance_img'];
                $value['vehicle_mulkia_front_img']=$img1['vehicle_mulkia_front_img'];
                $value['vehicle_mulkia_back_img']=$img2['vehicle_mulkia_back_img'];
                $result = $this->vehicle_model->add_new_vehicle($value);
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Employee created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Vehicle creation failed');
                }                
                redirect('vehicle_listing');
           // }
        }
        else
        {
            $data['action']='add_new_vehicle';
            //echo "<pre>";print_r($data);die;
            $this->global['pageTitle'] = APP_NAME.' : Add New Vehicle';
            $this->loadViews("add_new_vehicle_view", $this->global, $data, NULL);
        }
    }
    
    function edit_vehicle()
    {
        if($this->input->post())
        {
        	$value=$this->input->post();
        	 /*Insurance Image upload*/
            if(isset($_FILES) && $_FILES['vehicle_insurance_img']['name']!='')
            {
               	$dir='assets/vehicle/';
                $n=pathinfo($_FILES['vehicle_insurance_img']['name']);
                $ex=$n['extension'];
                $uid=uniqid('insu_');
                $tfile=$dir.$uid.'.'.$ex;
                $img=array();
                $imageFileType = strtolower(pathinfo($tfile,PATHINFO_EXTENSION));   
                if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
                {
                    if ( move_uploaded_file($_FILES['vehicle_insurance_img']['tmp_name'],$tfile))
                    {
                        $img['vehicle_insurance_img']=ADMIN_PATH.$tfile;
                    }
                    else
                    {
                        if($this->session->userdata('referred_from'))
						{
							$referred_from = $this->session->userdata('referred_from');
							redirect($referred_from, 'refresh');
						}
						else
						{
							redirect('vehicle_listing','refresh');
						}
                    }
                }
                $value['vehicle_insurance_img']=$img['vehicle_insurance_img'];                
                $un=str_replace(FRONT_PATH,'',$value['vehicle_insurance_img_old']);
                //echo $_SERVER['DOCUMENT_ROOT'].'/karigar/'.$un;die;
                $u=unlink($_SERVER['DOCUMENT_ROOT'].'/karigar/'.$un);
            }
            else
            {
                $value['vehicle_insurance_img']=$value['vehicle_insurance_img_old'];
            }
            /*Insurance Image upload*/


            /*Mulkia Front Image upload*/
            if(isset($_FILES) && $_FILES['vehicle_mulkia_front_img']['name']!='')
            {
                $dir='assets/vehicle/';
                $n=pathinfo($_FILES['vehicle_mulkia_front_img']['name']);
                $ex=$n['extension'];
                $uid=uniqid('emp_');
                $tfile=$dir.$uid.'.'.$ex;
                $img1=array();
                $imageFileType = strtolower(pathinfo($tfile,PATHINFO_EXTENSION));   
                if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
                {
                    if ( move_uploaded_file($_FILES['vehicle_mulkia_front_img']['tmp_name'],$tfile))
                    {
                        $img1['vehicle_mulkia_front_img']=ADMIN_PATH.$tfile;
                    }
                    else
                    {
                        if($this->session->userdata('referred_from'))
						{
							$referred_from = $this->session->userdata('referred_from');
							redirect($referred_from, 'refresh');
						}
						else
						{
							redirect('vehicle_listing','refresh');
						}
                    }
                }
                $value['vehicle_mulkia_front_img']=$img1['vehicle_mulkia_front_img'];                
                $un=str_replace(FRONT_PATH,'',$value['vehicle_mulkia_front_img_old']);
                //echo $_SERVER['DOCUMENT_ROOT'].'/karigar/'.$un;die;
                $u=unlink($_SERVER['DOCUMENT_ROOT'].'/karigar/'.$un);
            }
            else
            {
                $value['vehicle_mulkia_front_img']=$value['vehicle_mulkia_front_img_old'];
            }
            /*Mulkia Front Image upload*/

            /*Mulkia Front Image upload*/
            if(isset($_FILES) && $_FILES['vehicle_mulkia_back_img']['name']!='')
            {
                $dir='assets/vehicle/';
                $n=pathinfo($_FILES['vehicle_mulkia_back_img']['name']);
                $ex=$n['extension'];
                $uid=uniqid('emp_');
                $tfile=$dir.$uid.'.'.$ex;
                $img2=array();
                $imageFileType = strtolower(pathinfo($tfile,PATHINFO_EXTENSION));   
                if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
                {
                    if ( move_uploaded_file($_FILES['vehicle_mulkia_back_img']['tmp_name'],$tfile))
                    {
                        $img2['vehicle_mulkia_back_img']=ADMIN_PATH.$tfile;
                    }
                    else
                    {
                        if($this->session->userdata('referred_from'))
                        {
                            $referred_from = $this->session->userdata('referred_from');
                            redirect($referred_from, 'refresh');
                        }
                        else
                        {
                            redirect('vehicle_listing','refresh');
                        }
                    }
                }
                $value['vehicle_mulkia_back_img']=$img2['vehicle_mulkia_back_img'];                
                $un=str_replace(FRONT_PATH,'',$value['vehicle_mulkia_back_img_old']);
                //echo $_SERVER['DOCUMENT_ROOT'].'/karigar/'.$un;die;
                $u=unlink($_SERVER['DOCUMENT_ROOT'].'/karigar/'.$un);
            }
            else
            {
                $value['vehicle_mulkia_back_img']=$value['vehicle_mulkia_back_img_old'];
            }
            /*Mulkia Front Image upload*/       


            //echo "inside edit if";die;
            //echo "<pre>";print_r($value);die;
            $result = $this->vehicle_model->update_vehicle($value);
            redirect('vehicle_listing');
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
            //$result = $this->vehicle_model->edit_vehicle($userInfo, $userId);
            $last = $this->uri->total_segments();
            $record_num = $this->uri->segment($last);
            if(is_numeric($record_num))
            {
                $data['vehicle'] = $this->vehicle_model->get_vehicle_by_id($record_num);
            }
            $data['action']='edit_vehicle';
            //echo "<pre>";print_r($data);die;
            $this->global['pageTitle'] = APP_NAME.' : Edit Vehicle';
            $this->loadViews("add_new_vehicle_view", $this->global, $data, NULL);
            //}
        }
    }

    function delete_vehicle()
    {
        $last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
        $result = $this->vehicle_model->delete_vehicle($record_num);
        redirect('vehicle_listing','refresh');        
    }

    function vehicle_no_exists()
    {
        $vehicle_id = $this->input->post("vehicle_id");
        $vehicle_no = $this->input->post("vehicle_no");
        if(empty($vehicle_id)){
            $result = $this->vehicle_model->vehicle_no_exists($vehicle_no);
        } else {
            $result = $this->vehicle_model->vehicle_no_exists($vehicle_no, $vehicle_id);
        }
        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }
    
    function pageNotFound()
    {
        $this->global['pageTitle'] = APP_NAME.' : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }

    /*function emailExists($email)
    {
        $userId = $this->vendorId;
        $return = false;

        if(empty($userId)){
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if(empty($result)){ $return = true; }
        else {
            $this->form_validation->set_message('emailExists', 'The {field} already taken');
            $return = false;
        }

        return $return;
    }*/
}

?>