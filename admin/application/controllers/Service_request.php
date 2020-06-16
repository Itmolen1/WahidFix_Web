<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Service_request extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service_request_model');
        $this->isLoggedIn();
    }    
  
    public function index()
    {
        $this->global['pageTitle'] = APP_NAME.'service request';
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }    
  
    function service_request_listing()
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

            $count = $this->service_request_model->service_requestListingCount($searchText);
            //echo "<pre>";print_r($count);die;
			$returns = $this->paginationCompress ( "service_requestListing/", $count, 10 );
			//echo "<pre>";print_r($returns);die;
            $data['servicesRecords'] = $this->service_request_model->service_requestListing($searchText, $returns["page"], $returns["segment"]);
            //echo "<pre>";print_r($data);die;
            $this->global['pageTitle'] = APP_NAME.' : Sub services Listing';
            $this->loadViews("service_request", $this->global, $data, NULL);
        //}
    }

    function get_suborder_details()
    {
        $value=$this->input->post();
        $result=$this->service_request_model->get_suborder_details($value['data']);
        $data['finalresult']=$this->get_suborder_final_list_string($result);
        $data['sr_id']='<a href="'.base_url().'sr_admin_accept/'.$value['data'].'"'.'<button type="button" value="Assign" class="btn btn-success test">Accept</button></a><a href="'.base_url().'sr_admin_reject/'.$value['data'].'"'.'<button type="button" value="Assign" class="btn btn-danger test">Reject</button></a>';
        echo json_encode($data);
    }

    function sr_admin_accept()
    {
        $last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
        $result=$this->service_request_model->update_one_to_sr_id($record_num);
        redirect('service_request_listing');
    }

    function sr_admin_reject()
    {
        $last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
        $result=$this->service_request_model->update_two_to_sr_id($record_num);
        redirect('service_request_listing');
    }

    function get_suborder_final_list_string($rows)
    {
        $finalresult='';
        for($i=0;$i<count($rows);$i++)
        {
            $finalresult.='<div class="row"><div class="col-md-4">Service Name : '.$rows[$i]['service_name'].'</div><div class="col-md-6">Service Desc. : '.$rows[$i]['service_desc'].'</div></div>';
        }
        return $finalresult;
    }

    function track_service_request()
    {
        $last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
        if(is_numeric($record_num))
        {
            $data['sr_id']=$record_num;
            $data['action']='track_service_request';
            $this->global['pageTitle'] = APP_NAME.' : Tracking';
            $this->loadViews("service_request_track_view",$this->global,$data,NULL);
        }
        else
        {
            redirect('service_request_listing');
        }
    }

    function detailed_status_service_request()
    {
        $last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
        if(is_numeric($record_num))
        {
            $data['sr_id']=$record_num;
            $data['sr_details']=$this->service_request_model->get_details_by_sr_id($record_num);
            //echo "<pre>";print_r($data);die;
            $this->global['pageTitle'] = APP_NAME.' : Status';
            $this->loadViews("detailed_status_service_request_view",$this->global,$data,NULL);
        }
        else
        {
            redirect('service_request_listing');
        }
    }

    function get_latest_cordinates()
    {
        $value=$this->input->post();
        $result=$this->service_request_model->get_latest_cordinates($value['data']);
        echo json_encode($result);
    }

    function edit_service_request()
    {
            if($this->input->post())
            {
                $value=$this->input->post();
                //echo "<pre>sss";print_r($value);die;
                $result = $this->service_request_model->edit_service_request($value);
                // send notification to only android devices
                if($value['assigned_emp_id'])
                {
                    $data['emp']=$this->service_request_model->get_emp_details($value['assigned_emp_id']);
                    $data['user']=$this->service_request_model->get_user_details($value['sr_id']);
                    //echo "<pre>";print_r($data);die;
                    $this->Android($data['user'],$data['emp'],$value['sr_id'],$value['service_request_ref']);
                    //$this->send_mail();
                }
                redirect('service_request_listing');
            }
            else
            {
                $last = $this->uri->total_segments();
                $id = $this->uri->segment($last);
                $result=$this->service_request_model->get_service_request_info($id);
                $data['sr'] = $result['sr'];
                $data['result'] = $result['service_ids'];
                $data['emp'] = $this->service_request_model->get_eligible_emp_list($result['service_ids'][0]['service_id']);
                $data['action']='edit_service_request';
                $this->global['pageTitle'] = APP_NAME.' : Edit service request';
                //echo "<pre>";print_r($data);die;
                $this->loadViews("add_new_service_request", $this->global, $data, NULL);
            }           
    }

    public function Android($row,$row1,$sr_id,$service_request_ref)
    {
        $token_id=$row['tbl_user_device_token'];
        //echo "<pre>";print_r($token_id);die;
        $registrationIds = array($token_id);
        // prep the bundle
        $msg = array
        (
            'message'   => 'Hello '.$row['tbl_user_name'].' Our employee '.$row1['tbl_employee_name'].' is Assigned for your service order no '.$service_request_ref.'. He will reach you ASAP',
            'title'     => 'Notification',
            'subtitle'  => '',
            'vibrate'   => 1,
            'sound'     => 1,
            'largeIcon' => $row1['tbl_employee_image']
        );
        //echo "<pre>";print_r($msg);die;
        $this->service_request_model->insert_user_notification($sr_id,$msg['message']);
        
        $fields = array
        (
            'registration_ids'  => $registrationIds,
            'data'          => $msg
        );
         
        $headers = array
        (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );
        //echo "<pr>";print_r($fields);die;
         
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
       /* $url = "https://fcm.googleapis.com/fcm/send";
        $token = "c6oLVdlscYA:APA91bE0LdRHfjt8bFZGBsB2B0ebLyaIyvJKA9KaHqCqs6S-zjKxpObE94Ff8g2vq5Bt14D__md9RF4ffCsl4je8spyoNEypplz85tn1rEU3QYS4iZnuJsYdqwIkmS20SitWuz-a4QOr";
        $serverKey = 'AIzaSyBOn4grawQIG57LDxgIN-JELOnbVLesDl4';
        $title = "Notification title";
        $body = "Hello I am from Your php server";
        $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1');
        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        //Send the request
        $response = curl_exec($ch);
        //Close request
        if ($response === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);*/
        //echo $result;die;
    }    
    
    function delete_service_request()
    {       
        $last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
        $result = $this->service_request_model->delete_service_request($record_num);
        redirect('service_request_listing');        
    }    
 
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }   
}
?>