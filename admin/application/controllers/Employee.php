<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Employee extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('employee_model');
        $this->isLoggedIn();   
    }

    public function index()
    {
        $this->global['pageTitle'] = APP_NAME.' : Employee Listing';
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }

    function employee_listing()
    {
        //if($this->isAdmin() == TRUE)
        //{
           // $this->loadThis();
        //}
        //else
        //{
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            $this->load->library('pagination');
            $count = $this->employee_model->employee_listing_count($searchText);
			$returns = $this->paginationCompress ( "employee_listing/", $count, 10 );
			//echo "<pre>";print_r($returns);die;
            $data['employees'] = $this->employee_model->employee_listing($searchText, $returns["page"], $returns["segment"]);
            $data['services'] = $this->employee_model->get_service_list();
            //echo "<pre>";print_r($data);die;
            $this->global['pageTitle'] = APP_NAME.' : Employee Listing';
            $this->loadViews("employee_list_view", $this->global, $data, NULL);
        //}
    }  

    function add_new_employee()
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
                $this->add_new_employee();
            }
            else
            {*/
                //$un=unserialize($se);
                //echo "<pre>";print_r($se);die;
                 /*id card upload*/
                $dir='assets/employee/';
                $n=pathinfo($_FILES['tbl_employee_id_card']['name']);
                $ex=$n['extension'];
                $uid=uniqid('emp_');
                $tfile=$dir.$uid.'.'.$ex;
                $img=array();
                $imageFileType = strtolower(pathinfo($_FILES['tbl_employee_id_card']['name'],PATHINFO_EXTENSION));   
                if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
                {
                    if ( move_uploaded_file($_FILES['tbl_employee_id_card']['tmp_name'],$tfile))
                    {
                        $img['tbl_employee_id_card']=ADMIN_PATH.$tfile;
                    }
                    else
                    {
                        $this->add_new_employee();
                    }
                }
                /*id card upload*/

                 /*employee image upload*/
                $dir='assets/employee/';
                $n=pathinfo($_FILES['tbl_employee_image']['name']);
                $ex=$n['extension'];
                $uid=uniqid('emp_');
                $tfile=$dir.$uid.'.'.$ex;
                $img1=array();
                $imageFileType = strtolower(pathinfo($_FILES['tbl_employee_image']['name'],PATHINFO_EXTENSION));   
                if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
                {
                    if ( move_uploaded_file($_FILES['tbl_employee_image']['tmp_name'],$tfile))
                    {
                        $img1['tbl_employee_image']=ADMIN_PATH.$tfile;
                    }
                    else
                    {
                        $this->add_new_employee();
                    }
                }
                /*employee image upload*/

                $value['tbl_employee_id_card']=$img['tbl_employee_id_card'];
                $value['tbl_employee_image']=$img1['tbl_employee_image'];
                $result = $this->employee_model->add_new_employee($value);
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Employee created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Employee creation failed');
                }                
                redirect('employee_listing');
           // }
        }
        else
        {
            $data['services'] = $this->employee_model->get_service_list();
            $data['action']='add_new_employee';
            //echo "<pre>";print_r($data);die;
            $this->global['pageTitle'] = APP_NAME.' : Add New Employee';
            $this->loadViews("add_new_employee_view", $this->global, $data, NULL);
        }
    }
    
    function edit_employee()
    {
        if($this->input->post())
        {
        	$value=$this->input->post();
        	 /*Emirates ID upload*/
            if(isset($_FILES) && $_FILES['tbl_employee_id_card']['name']!='')
            {
               	$dir='assets/employee/';
                $n=pathinfo($_FILES['tbl_employee_id_card']['name']);
                $ex=$n['extension'];
                $uid=uniqid('emp_');
                $tfile=$dir.$uid.'.'.$ex;
                $img=array();
                $imageFileType = strtolower(pathinfo($tfile,PATHINFO_EXTENSION));   
                if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
                {
                    if ( move_uploaded_file($_FILES['tbl_employee_id_card']['tmp_name'],$tfile))
                    {
                        $img['tbl_employee_id_card']=ADMIN_PATH.$tfile;
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
							redirect('employee_listing','refresh');
						}
                    }
                }
                $value['tbl_employee_id_card']=$img['tbl_employee_id_card'];
                /*logo upload*/
                
                $un=str_replace(FRONT_PATH,'',$value['tbl_employee_id_card_old']);
                //echo $_SERVER['DOCUMENT_ROOT'].'/karigar/'.$un;die;
                $u=unlink($_SERVER['DOCUMENT_ROOT'].'/'.$un);
            }
            else
            {
                $value['tbl_employee_id_card']=$value['tbl_employee_id_card_old'];
            } 
            /*Employee Image upload*/
            if(isset($_FILES) && $_FILES['tbl_employee_image']['name']!='')
            {
                $dir='assets/employee/';
                $n=pathinfo($_FILES['tbl_employee_image']['name']);
                $ex=$n['extension'];
                $uid=uniqid('emp_');
                $tfile=$dir.$uid.'.'.$ex;
                $img1=array();
                $imageFileType = strtolower(pathinfo($tfile,PATHINFO_EXTENSION));   
                if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
                {
                    if ( move_uploaded_file($_FILES['tbl_employee_image']['tmp_name'],$tfile))
                    {
                        $img1['tbl_employee_image']=ADMIN_PATH.$tfile;
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
							redirect('employee_listing','refresh');
						}
                    }
                }
                $value['tbl_employee_image']=$img1['tbl_employee_image'];
                /*logo upload*/
                
                $un=str_replace(FRONT_PATH,'',$value['tbl_employee_image_old']);
                //echo $_SERVER['DOCUMENT_ROOT'].'/karigar/'.$un;die;
                $u=unlink($_SERVER['DOCUMENT_ROOT'].'/'.$un);
            }
            else
            {
                $value['tbl_employee_image']=$value['tbl_employee_image_old'];
            }
            //echo "inside edit if";die;
            //echo "<pre>";print_r($value);die;
            $result = $this->employee_model->update_employee($value);
            redirect('employee_listing');
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
            //$result = $this->employee_model->edit_employee($userInfo, $userId);
            $last = $this->uri->total_segments();
            $record_num = $this->uri->segment($last);
            if(is_numeric($record_num))
            {
                $data['employee'] = $this->employee_model->get_employee_by_id($record_num);
            }
            $data['services'] = $this->employee_model->get_service_list();
            $data['action']='edit_employee';
            //echo "<pre>";print_r($data);die;
            $this->global['pageTitle'] = APP_NAME.' : Edit Employee';
            $this->loadViews("add_new_employee_view", $this->global, $data, NULL);
            //}
        }
    }

    function delete_employee()
    {
        $last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
        $result = $this->employee_model->delete_employee($record_num);
        redirect('employee_listing','refresh');
        
    }

    function employee_email_exists()
    {
        $tbl_employee_id = $this->input->post("tbl_employee_id");
        $tbl_employee_email = $this->input->post("tbl_employee_email");
        if(empty($tbl_employee_id)){
            $result = $this->employee_model->employee_email_exists($tbl_employee_email);
        } else {
            $result = $this->employee_model->employee_email_exists($tbl_employee_email, $tbl_employee_id);
        }
        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }
    
    function pageNotFound()
    {
        $this->global['pageTitle'] = APP_NAME.' : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }

    function emailExists($email)
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
    }
}

?>