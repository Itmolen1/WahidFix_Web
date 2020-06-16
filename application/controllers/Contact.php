<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

	
	public function index()
	{
		$this->load->model('global_model');
		$data['action']='contact/add';
		$this->load->view('inc/header');
		$this->load->view('contact_view',$data);
		$this->load->view('inc/footer');
	}

	public function add()
	{
		//echo "<pre>hi";print_r($this->input->post());die;
		$input=$this->input->post();
		$val=array('name'=>$input['name'],'email'=>htmlentities($input['email']),'mobile_number'=>$input['mobile_number'],'comments'=>htmlentities($input['comments']),'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'),'status'=>'0');
		$result=$this->contact_model->add($val);
		$tarray=array('message'=>'Your query recorded with us we will contact you as soon as possible.','success'=>'true');
		echo json_encode($tarray);
	}

	public function get_guest_user_vals()
	{
		$data['services']=$this->global_model->get_service_list();
		echo json_encode($data);
	}

	public function Partner()
	{
		$this->load->model('global_model');
		$data['action']='Partner_add';
		$this->load->view('inc/header');
		$this->load->view('partner_view',$data);
		$this->load->view('inc/footer');
	}

	public function Partner_add()
	{
		$input=$this->input->post();
		$val=array('partner_name'=>$input['partner_name'],'partner_email'=>htmlentities($input['partner_email']),'partner_mobile'=>$input['partner_mobile'],'partner_message'=>htmlentities($input['partner_message']),'partner_careatedat'=>date('Y-m-d H:i:s'));
		$result=$this->contact_model->partner_add($val);
		$this->session->set_flashdata('pmessage','Your request is recorded with us, Thank you.');
        redirect('Partner');
	}

	public function Careers()
	{
		$this->load->model('global_model');
		$data['action']='Careers_add';
		$this->load->view('inc/header');
		$this->load->view('careers_view',$data);
		$this->load->view('inc/footer');
	}

	public function Careers_add()
	{
		$input=$this->input->post();

		$input['careers_cv']='N.A.';
        if(isset($_FILES) && $_FILES['careers_cv']['error']==0)
        {
            //image upload//
            $dir='admin/assets/CV/';
            $n=pathinfo($_FILES['careers_cv']['name']);
            $ex=$n['extension'];
            $uid=uniqid('CV_');
            $tfile=$dir.$uid.'.'.$ex;
            $img=array();
            $imageFileType = strtolower(pathinfo($_FILES['careers_cv']['name'],PATHINFO_EXTENSION));   
            if($imageFileType == "pdf" || $imageFileType == "doc" || $imageFileType == "docx")
            {
                if ( move_uploaded_file($_FILES['careers_cv']['tmp_name'],$tfile))
                {
                    $img['careers_cv']=base_url().$tfile;
                    $input['careers_cv']=$img['careers_cv'];
                }
            }
            else
            {
            	$this->session->set_flashdata('cmessage','Only .PDF or .Doc file allowed please try again.');
            	redirect('Careers');
            }
            //image upload//
        }

		$val=array('careers_name'=>$input['careers_name'],'careers_email'=>htmlentities($input['careers_email']),'careers_mobile'=>$input['careers_mobile'],'careers_message'=>htmlentities($input['careers_message']),'careers_createdat'=>date('Y-m-d H:i:s'),'careers_cv'=>$input['careers_cv']);
		$result=$this->contact_model->careers_add($val);
		$this->session->set_flashdata('cmessage','Your request is recorded with us, Thank you.');
        redirect('Careers');
	}


}
