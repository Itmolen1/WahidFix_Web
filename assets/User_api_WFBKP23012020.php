<?php
//wahidfix
if (!defined('BASEPATH'))

    exit('No direct script access allowed');
class User_api extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('webapi/user_api_model');
    }

    public function UserRegistration()
    {
    	$header=getallheaders();
    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$query = $this->db->get_where('tbl_user', array('tbl_user_email' => $input['tbl_user_email']));
			$row = $query->row_array();			
			if(empty($row))
			{
				$lid=$this->user_api_model->user_add($input);
				$this->user_api_model->user_device_add($input,$lid);
				if(isset($lid) && $lid!='')
				{	
					$rows=$this->user_api_model->user_get($lid,$input['tbl_user_device_id']);
					$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$rows);	
					echo json_encode($body);
				}
				else
				{
					$body=array('message'=>'Opps ! maybe this mobile number is already registered with us.','rstatus'=>0,'status'=>401);	       
					echo json_encode($body);
				}
			}
			else
			{
				$body=array('message'=>'User Already Registered.','rstatus'=>0,'status'=>401);
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function LocationTest()
	{
		$header=getallheaders();
    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);			

			$lid=$this->user_api_model->location_test($input);
			if(isset($lid))
			{	
				//$rows='OK';
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$lid);	
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'something went wrong.','rstatus'=>0,'status'=>401);	       
				echo json_encode($body);
			}						
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function Feedback()
	{
		$header=getallheaders();
    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$lid=$this->user_api_model->insert_feedback($input);			
			$body=array('message'=>'Your valuable Feedback is recorded, Thanks.','rstatus'=>1,'status'=>200,'data'=>$lid);	
			echo json_encode($body);								
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function GetURIs()
	{
		$header=getallheaders();
    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$lid=$this->user_api_model->get_uris();
			$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$lid);	
			echo json_encode($body);								
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function Statistics()
	{
		$header=getallheaders();
    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$emp['total']=$this->user_api_model->get_all_emp_count();
			$emp['available']=$this->user_api_model->get_available_emp_count();
			$emp['busy']=$this->user_api_model->get_busy_emp_count();

			$week['new']=$this->user_api_model->get_weekly_new_order_count();
			$week['inprogress']=$this->user_api_model->get_weekly_inprogress_order_count();
			$week['completed']=$this->user_api_model->get_weekly_completed_order_count();

			$emplist=$this->user_api_model->get_emp_list_order_by_status();

			$data=array('employee'=>$emp,'weekly_orders'=>$week,'emp_list'=>$emplist);
			$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$data);	
			echo json_encode($body);						
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function Ravi1()
	{
		$registrationIds ='caLWvy8WV8o:APA91bG5reh83gwgzkaU6gF7DpVTlEyudugyH3SpoKyMlDy3QkWBM4At916HPWa6pKQW64I8QMQTjk7UdhL2mtjQsxkxW0IrO09dmUoPu_rwcjdJxqpZEpobObptpvS4r7rUI-xvyDfv';

        //$fields = array('to'=>$registrationIds,'notification'=>array('title'=>'wahidfix','body'=>$msg));
        $fields = array('to'=>$registrationIds,'notification'=>array('title'=>'wahidfix','body'=>$msg,'sound'=>'default','sr_id'=>$sr_id));
        //echo json_encode($fields);die;
        $headers = array('Authorization: key=' . API_ACCESS_KEY,'Content-Type: application/json');
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );       
        echo $result;die;
	}

	public function Ravi()
	{
		$header=getallheaders();
    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$registrationIds ='dlbfvmcSi10:APA91bG1NIU_LWrbXPYZBkfuQAmOiLjJAM7Iz88jRctvoe_MxKK-G4rtA281qyX9VTlRkyJAQcI8gNFxaswpweIPIwF_GW48d65zdAvZ7RG3alwtdeJo4roCpAlkj8Xdz9x9mBHnnuT6';
			$msg = array
			(
				'message' 	=> 'Hello wants to hire you please reply here As Soon As Possible...',
				'title'		=> 'Hire Notification',
				'subtitle'	=> '',
				'vibrate'	=> 1,
				'sound'		=> 'default',
				'largeIcon'	=> 'large_icon',
				'smallIcon'	=> 'small_icon'
			);
	        $fields=array('registration_ids'=>array($registrationIds),'data'=>$msg);
			$headers=array('Authorization: key='.API_ACCESS_KEY,'Content-Type: application/json');
	        $ch = curl_init();
	        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
	        curl_setopt( $ch,CURLOPT_POST, true );
	        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
	        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
	        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
	        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
	        $result = curl_exec($ch );
	        curl_close( $ch ); 	
	        echo $result;die;				
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

   	public function UserLogin()
	{
		$header=getallheaders();
    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);			
			$this->db->where('tbl_user_email',$input['tbl_user_email']);
	        $this->db->where('tbl_user_password',$input['tbl_user_password']);
			$query = $this->db->get('tbl_user');
			$row = $query->row_array();
	        if(!empty($row))
	        {
	        	$uid=$this->user_api_model->get_user_id_from_emailid($input['tbl_user_email']);
	        	$device_id=$this->user_api_model->get_device_id_from_user_id($uid['tbl_user_id']);
	        	if($device_id['tbl_user_device_id']==$input['tbl_user_device_id'])
	        	{
	        		$up=$this->user_api_model->updte_user_device_details($uid['tbl_user_id'],$device_id['tbl_user_device_id'],$input);	        		
	        	}
	        	else
	        	{
	        		$ad=$this->user_api_model->user_device_add($input,$uid['tbl_user_id']);
	        	}
	        	/*if we get device id same as previous one get only device info from device table and return else add new device info and return it*/
	        	$vals=$this->user_api_model->user_get($uid['tbl_user_id'],$device_id['tbl_user_device_id']);
	        	//echo "<pre>";print_r($uid);die;
	        	if(!empty($vals))
				{
					$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
					echo json_encode($body);
				}
				else
				{
					$body=array('message'=>'something went wrong please tyr after some time.','rstatus'=>0,'status'=>401);
					echo json_encode($body);
				}
			}
			else
			{
				$body=array('message'=>'Invalid user name of password please retry with right credentials.','rstatus'=>0,'status'=>401);
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}
	
	public function EmployeeLogin()
	{
		$header=getallheaders();
		//$token=$header['tbl_user_comm_token'];
		//$token_result=$this->user_api_model->token_validation($token);
    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);


			//check in admin users table
			$this->db->select('userId,email,password');
			$this->db->where('email',$input['tbl_employee_email']);
			$query = $this->db->get('tbl_users');
			$row = $query->row_array();
			$result = $this->user_api_model->loginMe($input['tbl_employee_email'], $input['tbl_employee_password']);
			//echo "<pre>";print_r($result);die;
			if(!empty($result))
			{
				//device entry 
				//check for existance
				$this->db->select('tbl_users_devices_id,userId,tbl_users_device_id,tbl_users_platform,tbl_users_device_token');
				$this->db->where('tbl_users_device_id',$input['tbl_emp_device_id']);
				$this->db->where('userId',$result['userId']);
				$query=$this->db->get('tbl_users_devices');
				$row=$query->row_array();
				//echo "<pre>";print_r($row);die;
				//update existing record
				if($row)
				{
					$this->db->set('tbl_users_platform',$input['tbl_emp_device_type']);
					$this->db->set('tbl_users_device_token',$input['tbl_emp_device_token']);
					$this->db->where('tbl_users_device_id',$row['tbl_users_device_id']);
					$this->db->update('tbl_users_devices');
				}
				//add new record
				else
				{
					//echo "coming here";die;
					$value=array(
						'userId'=>$result['userId'],
						'roleId'=>$result['roleId'],
						'tbl_users_device_id'=>$input['tbl_emp_device_id'],
						'tbl_users_platform'=>$input['tbl_emp_device_type'],
						'tbl_users_device_token'=>$input['tbl_emp_device_token'],
						'created_at'=>date('Y-m-d H:i:s'),
						'updated_at'=>date('Y-m-d H:i:s'),
						'isDeleted'=>0
						);
					$this->db->insert('tbl_users_devices', $value); 
					$lid=$this->db->insert_id();
				}
				$vals=$this->user_api_model->get_return_admin_data($result['userId'],$input['tbl_emp_device_id']);
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
			else
			{
				$this->db->where('tbl_employee_email',$input['tbl_employee_email']);
		        $this->db->where('tbl_employee_password',$input['tbl_employee_password']);
				$query = $this->db->get('tbl_employee');
				$row = $query->row_array();
		        if(!empty($row))
		        {
		        	$this->user_api_model->update_emp_device_details_by_email($input);
		        	$vals=$this->user_api_model->get_emp_by_email($input['tbl_employee_email']);
		        	if(!empty($vals))
					{
						$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
						echo json_encode($body);
					}
					else
					{
						$body=array('message'=>'something went wrong please tyr after some time.','rstatus'=>0,'status'=>401);
						echo json_encode($body);
					}
				}
				else
				{
					$body=array('message'=>'Invalid user name of password please retry with right credentials.','rstatus'=>0,'status'=>401);
					echo json_encode($body);
				}
			}												
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function ScheduleService()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$vals=$this->user_api_model->schedule_service($input);
			$this->user_api_model->update_user_location($input);
        	if(!empty($vals))
			{
				$input['sr_id']=$vals;
				//first get user's all of devices from sr id 
				$devlist=$this->user_api_model->get_user_all_dev_by_sr_id($input['sr_id']);
				$data['emp']=$this->user_api_model->get_emp_details($devlist['assigned_emp_id']);
	            $data['user']=$this->user_api_model->get_user_details_by_sr_id($input['sr_id']);
				
				// send one notification to manager level users
				$mdevlist=$this->user_api_model->get_all_managers_devices_by_role_id();
				//echo "<pre>";print_r($mdevlist);die;
				$msg='For Oreder no#'.$devlist['service_request_ref'].' our employee : '.$data['emp']['tbl_employee_name'].' has started inspection.' ;
				$this->user_api_model->insert_users_notification($input['sr_id'],$msg,2);

				if(!empty($mdevlist['Android']))
				{
					// send notifications to android devices if any
	                $alltokens=array_column($mdevlist['Android'], 'tbl_users_device_token');
	                $this->Android_ScheduleService_notification($msg,$alltokens);
				}
				if(!empty($mdevlist['iOS']))
				{
					// send notifications to iOS devices if any
					$alltokens=array_column($mdevlist['iOS'], 'tbl_users_device_token');
					for($i=0;$i<count($alltokens);$i++)
					{
						$this->iOS_emp_accept_admin_notification($msg,$alltokens[$i],$input['sr_id']);
					}
				}

				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'something went wrong please tyr after some time.','rstatus'=>0,'status'=>401);
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function Android_ScheduleService_notification($msg,$alltokens)
    {
        $registrationIds = $alltokens;
        //echo "<pre>";print_r($registrationIds);die;
        // prep the bundle
        $msg = array
        (
            'message'   => $msg,
            'title'     => 'Notification',
            'subtitle'  => '',
            'vibrate'   => 1,
            'sound'     => 'default',
            'largeIcon' => 'large_icon',
            'isNew'=>1
        );
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
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );       
        //echo $result;die;
    }

	public function NewScheduleService()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$input=$_POST;
			echo "<pre>";print_r($input);die;
			$vals=$this->user_api_model->newschedule_service($input);
			$this->user_api_model->update_user_location($input);
        	if(!empty($vals))
			{
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
			else
			{

				$body=array('message'=>'something went wrong please tyr after some time.','rstatus'=>0,'status'=>401);
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function UpdateUserLocation()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$vals=$this->user_api_model->update_user_location($input);
        	if(!empty($vals))
			{
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'something went wrong please tyr after some time.','rstatus'=>0,'status'=>401);
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function UpdateUserProfile()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$vals=$this->user_api_model->update_user_profile($input);
        	if(!empty($vals))
			{
				$device_id=$this->user_api_model->get_deviceid_by_user_id($input['tbl_user_id']);
				//echo "<pre>";print_r($device_id);die;
				$data=$this->user_api_model->user_get($input['tbl_user_id'],$device_id['tbl_user_device_id']);
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$data);
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'nothing to update please update any information.','rstatus'=>0,'status'=>401);
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function UpdateEmployeeProfile()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$vals=$this->user_api_model->update_employee_profile($input);
        	if(!empty($vals))
			{
				$data=$this->user_api_model->emp_get($input['tbl_employee_id']);
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$data);
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'nothing to update please update any information.','rstatus'=>0,'status'=>401);
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function EmployeeTaskHistory()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$vals=$this->user_api_model->get_employee_task_history($input['tbl_employee_id'],$input['page_size'],$input['page_num']);
        	if(!empty($vals))
			{
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'No Records Found.','rstatus'=>1,'status'=>200,'data'=>array());
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	// public function UserNotificationList()
	// {
	// 	$header=getallheaders();
	// 	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
	// 	{
	// 		$inputJSON = file_get_contents('php://input');
	// 		$input= json_decode($inputJSON, TRUE);
	// 		$vals=$this->user_api_model->user_notification_list($input['tbl_user_id'],$input['page_size'],$input['page_num']);
 //        	if(!empty($vals))
	// 		{
	// 			$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
	// 			echo json_encode($body);
	// 		}
	// 		else
	// 		{
	// 			$body=array('message'=>'No Records Found.','rstatus'=>1,'status'=>200,'data'=>array());
	// 			echo json_encode($body);
	// 		}
	// 	}
	// 	else
	// 	{
	// 		$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
	// 		echo json_encode($body);
	// 	}
	// }

	public function AdminOrderList()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$vals=$this->user_api_model->get_admin_order_list($input['status'],$input['page_size'],$input['page_num']);
        	if(!empty($vals))
			{
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'No Records Found.','rstatus'=>1,'status'=>200,'data'=>array());
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function NotificationList()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$vals=$this->user_api_model->get_notification_list($input);
        	if(!empty($vals))
			{
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'No Records Found.','rstatus'=>1,'status'=>200,'data'=>array());
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function UserAddress()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			if($input['function']==='add')
			{

				$result=$this->user_api_model->add_user_address($input);
				$body=array('message'=>'Address Added.','rstatus'=>1,'status'=>200,'data'=>array());
				echo json_encode($body);
			}
			if($input['function']=='update')
			{
				$result=$this->user_api_model->update_user_address_by_id($input);
				$body=array('message'=>$result.' Record Updated.','rstatus'=>1,'status'=>200,'data'=>array());
				echo json_encode($body);	
			}
			if($input['function']=='delete')
			{
				$result=$this->user_api_model->delete_user_address($input);
				$body=array('message'=>$result.' Record Deleted.','rstatus'=>1,'status'=>200,'data'=>array());
				echo json_encode($body);	
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function UserAddressList()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$vals=$this->user_api_model->get_user_address_list($input);
        	if(!empty($vals))
			{
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'No Records Found.','rstatus'=>1,'status'=>200,'data'=>array());
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function AdminOrderDetail()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$vals=$this->user_api_model->get_admin_order_detail($input['sr_id']);
        	if(!empty($vals))
			{
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'No Records Found.','rstatus'=>1,'status'=>200,'data'=>array());
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function AdminUpdateOrderLocation()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$vals=$this->user_api_model->admin_update_order_location($input);        	
			$body=array('message'=>'Location Updated Succesfully.','rstatus'=>1,'status'=>200,'data'=>array());
			echo json_encode($body);			
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function AdminListEmployee()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$vals=$this->user_api_model->admin_list_employee($input['page_size'],$input['page_num'],$input['searchkey']);
        	if(!empty($vals))
			{
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'No Records Found.','rstatus'=>1,'status'=>200,'data'=>array());
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function GetAdminListEmployee()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$vals=$this->user_api_model->get_admin_list_employee();
        	if(!empty($vals))
			{
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'No Records Found.','rstatus'=>1,'status'=>200,'data'=>array());
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function EmpUploadDocs()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$input=$_POST;
			//echo "<pre>";print_r($input);die;
			if(isset($input['is_image']) && $input['is_image']==0)
			{
				/*only image upload upload*/
		        $dir='assets/service_request/';
		        $n=pathinfo($_FILES['sr_docs_url']['name']);
		        $ex=$n['extension'];
		        $uid=uniqid('sr_docs_img_');
		        $tfile=$dir.$uid.'.'.$ex;
		        $idimg='';
		        $imageFileType = strtolower(pathinfo($_FILES['sr_docs_url']['name'],PATHINFO_EXTENSION));   
		        if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
		        {
		            if ( move_uploaded_file($_FILES['sr_docs_url']['tmp_name'],$tfile))
		            {
		                $idimg=ADMIN_PATH.$tfile;
		                $this->user_api_model->insert_sr_docs($input,$idimg,$thumb='');
		            }
		            else
		            {
		                $body=array('message'=>'Problem with file uploading...','rstatus'=>1,'status'=>200);
						echo json_encode($body);
		            }
		        }
		        /*only image upload*/
		    }
		    if(isset($input['is_image']) && $input['is_image']==1)
		    {

	            /*only video upload*/
	            $dir='assets/service_request/';
	            $n=pathinfo($_FILES['sr_docs_url']['name']);
	            $ex=$n['extension'];
	            $uid=uniqid('sr_docs_vid_');
	            $tfile=$dir.$uid.'.'.$ex;
	            $img1='';
	            $imageFileType = strtolower(pathinfo($_FILES['sr_docs_url']['name'],PATHINFO_EXTENSION));   
	            if($imageFileType == "MP4" || $imageFileType == "M4P" || $imageFileType == "M4V" || $imageFileType == "mp4" || $imageFileType == "mov")
	            {

	                if ( move_uploaded_file($_FILES['sr_docs_url']['tmp_name'],$tfile))
	                {
	                	//echo "coming";die;
	                    $img1=ADMIN_PATH.$tfile;
	                }
	                else
	                {
	                	$body=array('message'=>'Problem With file uploading...','rstatus'=>1,'status'=>200);
						echo json_encode($body);
	                }
	            }
	            /*only video upload*/

	            if(isset($_FILES['sr_docs_thumb']) && $_FILES['sr_docs_thumb']['name']!=''){
	            /*upload thumb if given*/
	            $dir='assets/service_request/';
	            $n=pathinfo($_FILES['sr_docs_thumb']['name']);
	            $ex=$n['extension'];
	            $uid=uniqid('sr_docs_vid_thumb');
	            $tfile=$dir.$uid.'.'.$ex;
	            $img2='';
	            $imageFileType = strtolower(pathinfo($_FILES['sr_docs_thumb']['name'],PATHINFO_EXTENSION));   
	            if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
	            {

	                if ( move_uploaded_file($_FILES['sr_docs_thumb']['tmp_name'],$tfile))
	                {
	                	//echo "coming";die;
	                    $img2=ADMIN_PATH.$tfile;
	                }
	                else
	                {
	                	$body=array('message'=>'Problem With file uploading...','rstatus'=>1,'status'=>200);
						echo json_encode($body);
	                }
	            }
	        	}
	        	$this->user_api_model->insert_sr_docs($input,$img1,$img2);
	            /*upload thumb if given*/
	        }

	        //send all the image or video in response
			$vals=$this->user_api_model->get_emp_all_docs_by_sr_id($input['sr_id'],$input['sr_docs_type']);
        	if(!empty($vals))
			{
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'No Records Found.','rstatus'=>1,'status'=>200,'data'=>array());
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function EmpDiscardDocs()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			if(isset($input['complete']) && $input['complete']==1 && isset($input['sr_docs_type']) && $input['sr_docs_type']==1)
			{
				$this->EmpJobCompleted($input['sr_id']);
				$this->GetInvoice($input['sr_id']);
				$vals=$this->user_api_model->emp_ordre_detail($input['sr_id']);
				$body=array('message'=>'Status updated Succesfully.','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
			else if(isset($input['complete']) && $input['complete']==0 && isset($input['sr_docs_type']) && $input['sr_docs_type']==0)
			{
				$vals=$this->user_api_model->get_emp_all_docs_by_sr_id_type($input['sr_id'],$input['sr_docs_type']);
	        	if(!empty($vals))
				{
					for($i=0;$i<count($vals);$i++)
					{
						$un=str_replace(FRONT_PATH,'',$vals[$i]['sr_docs_url']);
						$u=unlink($_SERVER['DOCUMENT_ROOT'].'/'.$un);
					}
					$count=$this->user_api_model->remove_all_emp_docs_by_sr_id_type($input['sr_id'],$input['sr_docs_type']);
					$body=array('message'=>$count.' Docs removed Succesfully.','rstatus'=>1,'status'=>200,'data'=>new stdClass());
					echo json_encode($body);
				}
				else
				{
					$body=array('message'=>'No Records Found.','rstatus'=>1,'status'=>200,'data'=>new stdClass());
					echo json_encode($body);
				}
			}
			else if(isset($input['complete']) && $input['complete']==1 && isset($input['sr_docs_type']) && $input['sr_docs_type']==0)
			{
				$this->user_api_model->emp_complete_inspection($input);
				$this->EmpCompletedInspection($input);
				$vals=$this->user_api_model->emp_ordre_detail($input['sr_id']);
				$body=array('message'=>'Status updated Succesfully.','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
			else if(isset($input['complete']) && $input['complete']==0 && isset($input['sr_docs_type']) && $input['sr_docs_type']==1)
			{
				$vals=$this->user_api_model->get_emp_all_docs_by_sr_id_type($input['sr_id'],$input['sr_docs_type']);
	        	if(!empty($vals))
				{
					for($i=0;$i<count($vals);$i++)
					{
						$un=str_replace(FRONT_PATH,'',$vals[$i]['sr_docs_url']);
						$u=unlink($_SERVER['DOCUMENT_ROOT'].'/'.$un);
					}
					$count=$this->user_api_model->remove_all_emp_docs_by_sr_id_type($input['sr_id'],$input['sr_docs_type']);
					$body=array('message'=>$count.' Docs removed Succesfully.','rstatus'=>1,'status'=>200,'data'=>new stdClass());
					echo json_encode($body);
				}
				else
				{
					$body=array('message'=>'No Records Found.','rstatus'=>1,'status'=>200,'data'=>new stdClass());
					echo json_encode($body);
				}
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function AdminAddEmployee()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$input=$_POST;
			
			/*id card upload*/
            $dir='assets/employee/';
            $n=pathinfo($_FILES['tbl_employee_id_card']['name']);
            $ex=$n['extension'];
            $uid=uniqid('emp_');
            $tfile=$dir.$uid.'.'.$ex;
            $idimg='';
            $imageFileType = strtolower(pathinfo($_FILES['tbl_employee_id_card']['name'],PATHINFO_EXTENSION));   
            if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
            {
                if ( move_uploaded_file($_FILES['tbl_employee_id_card']['tmp_name'],$tfile))
                {
                    $idimg=ADMIN_PATH.$tfile;
                }
                else
                {
                    $body=array('message'=>'Problem with file uploading...','rstatus'=>1,'status'=>200);
					echo json_encode($body);
                }
            }
            /*id card upload*/

             /*employee image upload*/
            $dir='assets/employee/';
            $n=pathinfo($_FILES['tbl_employee_image']['name']);
            $ex=$n['extension'];
            $uid=uniqid('emp_');
            $tfile=$dir.$uid.'.'.$ex;
            $img1='';
            $imageFileType = strtolower(pathinfo($_FILES['tbl_employee_image']['name'],PATHINFO_EXTENSION));   
            if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
            {
                if ( move_uploaded_file($_FILES['tbl_employee_image']['tmp_name'],$tfile))
                {
                    $img1=ADMIN_PATH.$tfile;
                }
                else
                {
                	$body=array('message'=>'Problem With file uploading...','rstatus'=>1,'status'=>200);
					echo json_encode($body);
                }
            }
            /*employee image upload*/


			$vals=$this->user_api_model->admin_add_employee($input,$idimg,$img1);
        	if(!empty($vals))
			{
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'No Records Found.','rstatus'=>1,'status'=>200,'data'=>array());
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function AdminUpdateEmployee()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$input=$_POST;
			$idimg='';
			if(isset($_FILES['tbl_employee_id_card']['name']))
			{			
				/*id card upload*/
		        $dir='assets/employee/';
		        $n=pathinfo($_FILES['tbl_employee_id_card']['name']);
		        $ex=$n['extension'];
		        $uid=uniqid('emp_');
		        $tfile=$dir.$uid.'.'.$ex;
		        
		        $imageFileType = strtolower(pathinfo($_FILES['tbl_employee_id_card']['name'],PATHINFO_EXTENSION));   
		        if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
		        {
		            if ( move_uploaded_file($_FILES['tbl_employee_id_card']['tmp_name'],$tfile))
		            {
		                $idimg=ADMIN_PATH.$tfile;
		            }
		            else
		            {
		                $body=array('message'=>'Problem with file uploading...','rstatus'=>1,'status'=>200);
						echo json_encode($body);
		            }
		        }
        	}
        	
            /*id card upload*/
            $img1='';
            if(isset($_FILES['tbl_employee_image']['name']))
			{
	            /*employee image upload*/
	            $dir='assets/employee/';
	            $n=pathinfo($_FILES['tbl_employee_image']['name']);
	            $ex=$n['extension'];
	            $uid=uniqid('emp_');
	            $tfile=$dir.$uid.'.'.$ex;
	            
	            $imageFileType = strtolower(pathinfo($_FILES['tbl_employee_image']['name'],PATHINFO_EXTENSION));   
	            if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
	            {
	                if ( move_uploaded_file($_FILES['tbl_employee_image']['tmp_name'],$tfile))
	                {
	                    $img1=ADMIN_PATH.$tfile;
	                }
	                else
	                {
	                	$body=array('message'=>'Problem With file uploading...','rstatus'=>1,'status'=>200);
						echo json_encode($body);
	                }
	            }
	            /*employee image upload*/
        	}        	

			$vals=$this->user_api_model->admin_update_employee($input,$idimg,$img1);
        	if(!empty($vals))
			{
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'No Records Found.','rstatus'=>1,'status'=>200,'data'=>array());
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function AdminDeleteEmployee()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{			
        	$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);

			$vals=$this->user_api_model->admin_delete_employee($input);
        	if(!empty($vals))
			{
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'No Records Found.','rstatus'=>1,'status'=>200,'data'=>array());
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function GetEligibleEmpList()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$vals=$this->user_api_model->get_eligible_emp_list($input['sr_id']);
        	if(!empty($vals))
			{
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'No Records Found.','rstatus'=>1,'status'=>200,'data'=>array());
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function AdminAssignOrder()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$vals=$this->user_api_model->admin_assign_order($input);
        	if(!empty($vals))
			{
				//send notification to employee
                $empdev=$this->user_api_model->get_emp_dev_detail_by_sr_id($input['sr_id']);
                $empmsg='Alert ! you have one new order.';
                if($empdev['tbl_emp_device_type']=='iOS')
                {
                    $this->iOS_emp_accept_user_notification($empmsg,$empdev['tbl_emp_device_token'],$input['sr_id']);
                }
                else if($empdev['tbl_emp_device_type']=='Android')
                {
                    $this->Android_Employee_notification($empdev['tbl_emp_device_token'],$empmsg);
                }
				$body=array('message'=>'Order Succesfully Assigned.','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'No Records Found.','rstatus'=>1,'status'=>200,'data'=>array());
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function UpdateUserPassword()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$vals=$this->user_api_model->get_user_password($input);
        	if(!empty($vals))
			{
				$this->user_api_model->update_user_password($input);
				$data=array();
				$body=array('message'=>'Password Succesfully Updated.','rstatus'=>1,'status'=>200,'data'=>$data);
				echo json_encode($body);
			}
			else
			{
				$data=array();
				$body=array('message'=>'Invalid Current Password.','rstatus'=>0,'status'=>200,'data'=>$data);
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function UpdateEmployeePassword()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$vals=$this->user_api_model->get_employee_password($input);
        	if(!empty($vals))
			{
				$this->user_api_model->update_employee_password($input);
				$data=array();
				$body=array('message'=>'Password Succesfully Updated.','rstatus'=>1,'status'=>200,'data'=>$data);
				echo json_encode($body);
			}
			else
			{
				$data=array();
				$body=array('message'=>'Invalid Current Password.','rstatus'=>0,'status'=>200,'data'=>$data);
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}	

	public function UpdateEmployeeLocation()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$vals=$this->user_api_model->update_employee_location($input);
        	if(!empty($vals))
			{
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'something went wrong please tyr after some time.','rstatus'=>0,'status'=>401);
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function EmployeeTrackLocation()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$vals=$this->user_api_model->emp_track_location($input);
			if(!empty($vals))
			{
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'No records Found.','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function AllEmployeeLocation()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$vals=$this->user_api_model->all_employee_location();
			//echo "<pre>";print_r($vals);die;
			if(count($vals)==1 && $vals[0]['tbl_employee_id']=='')
			{
				$body=array('message'=>'No records Found.','rstatus'=>1,'status'=>200,'data'=>array());
				echo json_encode($body);
			}
			else if(!empty($vals))
			{
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'No records Found.','rstatus'=>1,'status'=>200,'data'=>array());
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function EmployeeGetLocation()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$vals=$this->user_api_model->emp_get_location($input);
			$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
			echo json_encode($body);
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function ServicesHistory()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$vals=$this->user_api_model->service_history($input['tbl_user_id'],$input['page_size'],$input['page_num']);        	
			$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
			echo json_encode($body);
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function MyTaskList()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$vals=$this->user_api_model->my_task_list($input['tbl_employee_id']);        	
			$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
			echo json_encode($body);		
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function EmpOrderDetail()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$vals=$this->user_api_model->emp_ordre_detail($input['sr_id']);        	
			$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
			echo json_encode($body);		
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function UserOrderDetail()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$vals=$this->user_api_model->user_ordre_detail($input['sr_id']); 
			$vals['status_history']=json_decode($vals['status_history']);
			$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
			echo json_encode($body);		
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function TaskAcceptReject()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$ans=$this->user_api_model->task_accept_reject($input);
			$vals=$this->user_api_model->my_task_list($input['tbl_employee_id']);
			if($ans==1)
			{
				//first get user's all of devices from sr id 
				$devlist=$this->user_api_model->get_user_all_dev_by_sr_id($input['sr_id']);
				$data['emp']=$this->user_api_model->get_emp_details($devlist['assigned_emp_id']);
                $data['user']=$this->user_api_model->get_user_details_by_sr_id($input['sr_id']);
				//echo "<pre>";print_r($devlist);die;
				$msg='Hello '.$data['user']['tbl_user_name'].' Our employee '.$data['emp']['tbl_employee_name'].' is Assigned for your service order no '.$devlist['service_request_ref'].'. He will reach you ASAP.';
				$this->user_api_model->insert_user_notification($input['sr_id'],$msg,$data['user']['tbl_user_id']);	
				if(isset($devlist['assigned_emp_id']) && !empty($devlist['Android']))
				{
					// send notifications to android devices if any
                    $alltokens=array_column($devlist['Android'], 'tbl_user_device_token');
                    $this->Android_emp_accept_user_notification($alltokens,$msg);                                       
				}
				if(isset($devlist['assigned_emp_id']) && !empty($devlist['iOS']))
				{
					// send notifications to iOS devices if any
					$alltokens=array_column($devlist['iOS'], 'tbl_user_device_token');
					for($i=0;$i<count($alltokens);$i++)
					{
						$this->iOS_emp_accept_user_notification($msg,$alltokens[$i],$input['sr_id']);
					}
				}

				// send one notification to manager level users
				$mdevlist=$this->user_api_model->get_all_managers_devices_by_role_id();
				//echo "<pre>";print_r($mdevlist);die;

				$msg='Oreder no#'.$devlist['service_request_ref'].' is now in progress with employee : '.$data['emp']['tbl_employee_name'];
				$this->user_api_model->insert_users_notification($input['sr_id'],$msg,2);
				if(!empty($mdevlist['Android']))
				{
					// send notifications to android devices if any
                    $alltokens=array_column($mdevlist['Android'], 'tbl_users_device_token');
                    $this->Android_emp_accept_admin_notification($msg,$alltokens);                    
				}
				if(!empty($mdevlist['iOS']))
				{
					// send notifications to iOS devices if any
					$alltokens=array_column($mdevlist['iOS'], 'tbl_users_device_token');
					for($i=0;$i<count($alltokens);$i++)
					{
						$this->iOS_emp_accept_admin_notification($msg,$alltokens[$i],$input['sr_id']);
					}					
				}
			}
        	if(!empty($vals))
			{
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
			else
			{
				$devlist=$this->user_api_model->get_user_all_dev_by_sr_id($input['sr_id']);
				$data['emp']=$this->user_api_model->get_emp_details($devlist['assigned_emp_id']);
                $data['user']=$this->user_api_model->get_user_details_by_sr_id($input['sr_id']);
				// send one notification to manager level users
				$mdevlist=$this->user_api_model->get_all_managers_devices_by_role_id();
				//echo "<pre>";print_r($mdevlist);die;

				$msg='Alert ! Oreder no#'.$devlist['service_request_ref'].' is rejected by employee : '.$data['emp']['tbl_employee_name'];
				$this->user_api_model->insert_users_notification($input['sr_id'],$msg,2);
				if(!empty($mdevlist['Android']))
				{
					// send notifications to android devices if any
                    $alltokens=array_column($mdevlist['Android'], 'tbl_users_device_token');
                    $this->Android_emp_accept_admin_notification($msg,$alltokens);                    
				}
				if(!empty($mdevlist['iOS']))
				{
					// send notifications to iOS devices if any
					$alltokens=array_column($mdevlist['iOS'], 'tbl_users_device_token');
					for($i=0;$i<count($alltokens);$i++)
					{
						$this->iOS_emp_accept_admin_notification($msg,$alltokens[$i],$input['sr_id']);
					}					
				}
				$body=array('message'=>'You have Rejected this order.','rstatus'=>1,'status'=>200);
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function EmpArrivedAtCustomerPlace()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$ans=$this->user_api_model->emp_arrived_at_customer_place($input);
			
			//first get user's all of devices from sr id 
			$devlist=$this->user_api_model->get_user_all_dev_by_sr_id($input['sr_id']);
			$data['emp']=$this->user_api_model->get_emp_details($devlist['assigned_emp_id']);
            $data['user']=$this->user_api_model->get_user_details_by_sr_id($input['sr_id']);

			$msg='Hello '.$data['user']['tbl_user_name'].' Our employee '.$data['emp']['tbl_employee_name'].' is Arrived at your place for order no '.$devlist['service_request_ref'];
			$this->user_api_model->insert_user_notification($input['sr_id'],$msg,$data['user']['tbl_user_id']);

			if(isset($devlist['assigned_emp_id']) && !empty($devlist['Android']))
			{
				// send notifications to android devices if any
                $alltokens=array_column($devlist['Android'], 'tbl_user_device_token');
                $this->Android_emp_accept_user_notification($alltokens,$msg);                                        
			}
			if(isset($devlist['assigned_emp_id']) && !empty($devlist['iOS']))
			{
				// send notifications to iOS devices if any
				$alltokens=array_column($devlist['iOS'], 'tbl_user_device_token');
				for($i=0;$i<count($alltokens);$i++)
				{
					$this->iOS_emp_accept_user_notification($msg,$alltokens[$i],$input['sr_id']);
				}
			}

			// send one notification to manager level users
			$mdevlist=$this->user_api_model->get_all_managers_devices_by_role_id();
			$msg='For Oreder no#'.$devlist['service_request_ref'].' our employee : '.$data['emp']['tbl_employee_name'].' is now reached at customers place.' ;
			$this->user_api_model->insert_users_notification($input['sr_id'],$msg,2);

			if(!empty($mdevlist['Android']))
			{
				// send notifications to android devices if any
                $alltokens=array_column($mdevlist['Android'], 'tbl_users_device_token');
                $this->Android_emp_accept_admin_notification($msg,$alltokens);                
			}
			if(!empty($mdevlist['iOS']))
			{
				// send notifications to iOS devices if any
				$alltokens=array_column($mdevlist['iOS'], 'tbl_users_device_token');
				for($i=0;$i<count($alltokens);$i++)
				{
					$this->iOS_emp_accept_admin_notification($msg,$alltokens[$i],$input['sr_id']);
				}					
			}
			$vals=$this->user_api_model->emp_ordre_detail($input['sr_id']);
			$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
			echo json_encode($body);			
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function EmpStartedInspection()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);

			if(isset($input['job_started']) && $input['job_started']==1)
			{
				$sr_status=$this->user_api_model->get_sr_status($input['sr_id']);
				if($sr_status['status']!=99)
				{
					$this->NewEmpJobStarted($input['sr_id']);
				}
				else
				{ 
					$body=array('message'=>'Order is Cancelled by user.','rstatus'=>1,'status'=>200,'data'=>array());
					echo json_encode($body);
				}
			}
			else
			{
				$ans=$this->user_api_model->emp_started_inspection($input);
			
				//first get user's all of devices from sr id 
				$devlist=$this->user_api_model->get_user_all_dev_by_sr_id($input['sr_id']);
				$data['emp']=$this->user_api_model->get_emp_details($devlist['assigned_emp_id']);
	            $data['user']=$this->user_api_model->get_user_details_by_sr_id($input['sr_id']);
				
				$msg='Hello '.$data['user']['tbl_user_name'].' Our employee '.$data['emp']['tbl_employee_name'].' has started Inspection for order no '.$devlist['service_request_ref'];
				$this->user_api_model->insert_user_notification($input['sr_id'],$msg,$data['user']['tbl_user_id']);

				if(isset($devlist['assigned_emp_id']) && !empty($devlist['Android']))
				{
					// send notifications to android devices if any
	                $alltokens=array_column($devlist['Android'], 'tbl_user_device_token');
	                $this->Android_emp_accept_user_notification($alltokens,$msg);                                       
				}
				if(isset($devlist['assigned_emp_id']) && !empty($devlist['iOS']))
				{
					// send notifications to iOS devices if any
					$alltokens=array_column($devlist['iOS'], 'tbl_user_device_token');
					for($i=0;$i<count($alltokens);$i++)
					{
						$this->iOS_emp_accept_user_notification($msg,$alltokens[$i],$input['sr_id']);
					}
				}

				// send one notification to manager level users
				$mdevlist=$this->user_api_model->get_all_managers_devices_by_role_id();
				
				$msg='For Oreder no#'.$devlist['service_request_ref'].' our employee : '.$data['emp']['tbl_employee_name'].' has started inspection.' ;
				$this->user_api_model->insert_users_notification($input['sr_id'],$msg,2);

				if(!empty($mdevlist['Android']))
				{
					// send notifications to android devices if any
	                $alltokens=array_column($mdevlist['Android'], 'tbl_users_device_token');
	                $this->Android_emp_accept_admin_notification($msg,$alltokens);
				}
				if(!empty($mdevlist['iOS']))
				{
					// send notifications to iOS devices if any
					$alltokens=array_column($mdevlist['iOS'], 'tbl_users_device_token');
					for($i=0;$i<count($alltokens);$i++)
					{
						$this->iOS_emp_accept_admin_notification($msg,$alltokens[$i],$input['sr_id']);
					}
				}
				$vals=$this->user_api_model->emp_ordre_detail($input['sr_id']); 
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}						
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function EmpCompletedInspection($input)
	{
		$devlist=$this->user_api_model->get_user_all_dev_by_sr_id($input['sr_id']);
		$data['emp']=$this->user_api_model->get_emp_details($devlist['assigned_emp_id']);
        $data['user']=$this->user_api_model->get_user_details_by_sr_id($input['sr_id']);
		
		$msg='Hello '.$data['user']['tbl_user_name'].' Our employee '.$data['emp']['tbl_employee_name'].' has completed Inspection for order no '.$devlist['service_request_ref'];
		$this->user_api_model->insert_user_notification($input['sr_id'],$msg,$data['user']['tbl_user_id']);

		if(isset($devlist['assigned_emp_id']) && !empty($devlist['Android']))
		{
			// send notifications to android devices if any
            $alltokens=array_column($devlist['Android'], 'tbl_user_device_token');
            $this->Android_emp_accept_user_notification($alltokens,$msg);                                       
		}
		if(isset($devlist['assigned_emp_id']) && !empty($devlist['iOS']))
		{
			// send notifications to iOS devices if any
			$alltokens=array_column($devlist['iOS'], 'tbl_user_device_token');
			for($i=0;$i<count($alltokens);$i++)
			{
				$this->iOS_emp_accept_user_notification($msg,$alltokens[$i],$input['sr_id']);
			}
		}

		// send one notification to manager level users
		$mdevlist=$this->user_api_model->get_all_managers_devices_by_role_id();
		
		$msg='For Oreder no#'.$devlist['service_request_ref'].' our employee : '.$data['emp']['tbl_employee_name'].' has completed inspection.' ;
		$this->user_api_model->insert_users_notification($input['sr_id'],$msg,2);

		if(!empty($mdevlist['Android']))
		{
			// send notifications to android devices if any
            $alltokens=array_column($mdevlist['Android'], 'tbl_users_device_token');
            $this->Android_emp_accept_admin_notification($msg,$alltokens);
		}
		if(!empty($mdevlist['iOS']))
		{
			// send notifications to iOS devices if any
			$alltokens=array_column($mdevlist['iOS'], 'tbl_users_device_token');
			for($i=0;$i<count($alltokens);$i++)
			{
				$this->iOS_emp_accept_admin_notification($msg,$alltokens[$i],$input['sr_id']);
			}
		}
	}

	public function NewEmpJobStarted($sr_id)
	{
		$input['sr_id']=$sr_id;
		
			$ans=$this->user_api_model->emp_job_started($input);
			
			//first get user's all of devices from sr id 
			$devlist=$this->user_api_model->get_user_all_dev_by_sr_id($input['sr_id']);
			$data['emp']=$this->user_api_model->get_emp_details($devlist['assigned_emp_id']);
            $data['user']=$this->user_api_model->get_user_details_by_sr_id($input['sr_id']);
			
			$msg='Hello '.$data['user']['tbl_user_name'].' Our employee '.$data['emp']['tbl_employee_name'].' has started job for order no '.$devlist['service_request_ref'];
			$this->user_api_model->insert_user_notification($input['sr_id'],$msg,$data['user']['tbl_user_id']);

			if(isset($devlist['assigned_emp_id']) && !empty($devlist['Android']))
			{
				// send notifications to android devices if any
                $alltokens=array_column($devlist['Android'], 'tbl_user_device_token');                
                $this->Android_emp_accept_user_notification($alltokens,$msg);                                        
			}
			if(isset($devlist['assigned_emp_id']) && !empty($devlist['iOS']))
			{
				// send notifications to iOS devices if any
				$alltokens=array_column($devlist['iOS'], 'tbl_user_device_token');
				for($i=0;$i<count($alltokens);$i++)
				{
					$this->iOS_emp_accept_user_notification($msg,$alltokens[$i],$input['sr_id']);
				}
			}

			// send one notification to manager level users
			$mdevlist=$this->user_api_model->get_all_managers_devices_by_role_id();
			
			$msg='For Oreder no#'.$devlist['service_request_ref'].' our employee : '.$data['emp']['tbl_employee_name'].' has started job.' ;
			$this->user_api_model->insert_users_notification($input['sr_id'],$msg,2);

			if(!empty($mdevlist['Android']))
			{
				// send notifications to android devices if any
                $alltokens=array_column($mdevlist['Android'], 'tbl_users_device_token');
                $this->Android_emp_accept_admin_notification($msg,$alltokens);
			}
			if(!empty($mdevlist['iOS']))
			{
				// send notifications to iOS devices if any
				$alltokens=array_column($mdevlist['iOS'], 'tbl_users_device_token');
				for($i=0;$i<count($alltokens);$i++)
				{
					$this->iOS_emp_accept_admin_notification($msg,$alltokens[$i],$input['sr_id']);
				}					
			}
			$vals=$this->user_api_model->emp_ordre_detail($input['sr_id']);
			$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
			echo json_encode($body);
	}

	function EmpJobCompleted($sr_id)
	{		
		$input['sr_id']= $sr_id;
		$ans=$this->user_api_model->emp_job_completed($input);
		
		//first get user's all of devices from sr id 
		$devlist=$this->user_api_model->get_user_all_dev_by_sr_id($input['sr_id']);
		$data['emp']=$this->user_api_model->get_emp_details($devlist['assigned_emp_id']);
        $data['user']=$this->user_api_model->get_user_details_by_sr_id($input['sr_id']);

        $msg='Hello '.$data['user']['tbl_user_name'].' Our employee '.$data['emp']['tbl_employee_name'].' has completed job for order no '.$devlist['service_request_ref'];
        $this->user_api_model->insert_user_notification($input['sr_id'],$msg,$data['user']['tbl_user_id']);
			
		if(isset($devlist['assigned_emp_id']) && !empty($devlist['Android']))
		{
			// send notifications to android devices if any
            $alltokens=array_column($devlist['Android'], 'tbl_user_device_token');
            $this->Android_emp_accept_user_notification($alltokens,$msg);                                        
		}
		if(isset($devlist['assigned_emp_id']) && !empty($devlist['iOS']))
		{
			// send notifications to iOS devices if any
			$alltokens=array_column($devlist['iOS'], 'tbl_user_device_token');
			$msg='Hello '.$data['user']['tbl_user_name'].' Our employee '.$data['emp']['tbl_employee_name'].' has completed job for order no '.$devlist['service_request_ref'];
			for($i=0;$i<count($alltokens);$i++)
			{
				$this->iOS_emp_accept_user_notification($msg,$alltokens[$i],$input['sr_id']);
			}
		}

		// send one notification to manager level users
		$mdevlist=$this->user_api_model->get_all_managers_devices_by_role_id();
		
		$msg='For Oreder no#'.$devlist['service_request_ref'].' our employee : '.$data['emp']['tbl_employee_name'].' has completed job.' ;
		$this->user_api_model->insert_users_notification($input['sr_id'],$msg,2);

		if(!empty($mdevlist['Android']))
		{
			// send notifications to android devices if any
            $alltokens=array_column($mdevlist['Android'], 'tbl_users_device_token');
            $this->Android_emp_accept_admin_notification($msg,$alltokens);
		}
		if(!empty($mdevlist['iOS']))
		{
			// send notifications to iOS devices if any
			$alltokens=array_column($mdevlist['iOS'], 'tbl_users_device_token');
			for($i=0;$i<count($alltokens);$i++)
			{
				$this->iOS_emp_accept_admin_notification($msg,$alltokens[$i],$input['sr_id']);
			}					
		}	
	}

	public function EmpGetPayment()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$ans=$this->user_api_model->emp_get_payment($input);

			//first get user's all of devices from sr id 
			$devlist=$this->user_api_model->get_user_all_dev_by_sr_id($input['sr_id']);
			$data['emp']=$this->user_api_model->get_emp_details($devlist['assigned_emp_id']);
            $data['user']=$this->user_api_model->get_user_details_by_sr_id($input['sr_id']);

			$msg='Hello '.$data['user']['tbl_user_name'].' Our employee '.$data['emp']['tbl_employee_name'].' has collected payment for order no '.$devlist['service_request_ref'];
			$this->user_api_model->insert_user_notification($input['sr_id'],$msg,$data['user']['tbl_user_id']);

			if(isset($devlist['assigned_emp_id']) && !empty($devlist['Android']))
			{
				// send notifications to android devices if any
                $alltokens=array_column($devlist['Android'], 'tbl_user_device_token');
                $this->Android_emp_accept_user_notification($alltokens,$msg);                                        
			}
			if(isset($devlist['assigned_emp_id']) && !empty($devlist['iOS']))
			{
				// send notifications to iOS devices if any
				$alltokens=array_column($devlist['iOS'], 'tbl_user_device_token');
				for($i=0;$i<count($alltokens);$i++)
				{
					$this->iOS_emp_accept_user_notification($msg,$alltokens[$i],$input['sr_id']);
				}
			}

			if(isset($input['is_admin']) && $input['is_admin']==1)
			{
				//if admin generates quotation then send notification to emp and user
				$empdev=$this->user_api_model->get_emp_dev_detail_by_sr_id($input['sr_id']);
				//echo "<pre>";print_r($empdev);die;
				$empmsg='Payment collected from admin.please check your order'.$devlist['service_request_ref'];
				if($empdev['tbl_emp_device_type']=='iOS')
				{
					$this->iOS_emp_accept_user_notification($empmsg,$empdev['tbl_emp_device_token'],$input['sr_id']);
				}
				else if($empdev['tbl_emp_device_type']=='Android')
				{
					$this->Android_Employee_notification($empdev['tbl_emp_device_token'],$empmsg);
				}
			}
			else
			{
				// send one notification to manager level users
				$mdevlist=$this->user_api_model->get_all_managers_devices_by_role_id();
				$msg='For Oreder no#'.$devlist['service_request_ref'].' our employee : '.$data['emp']['tbl_employee_name'].' has collected payment.' ;
				$this->user_api_model->insert_users_notification($input['sr_id'],$msg,2);

				if(!empty($mdevlist['Android']))
				{
					// send notifications to android devices if any
			        $alltokens=array_column($mdevlist['Android'], 'tbl_users_device_token');
			        $this->Android_emp_accept_admin_notification($msg,$alltokens);                
				}
				if(!empty($mdevlist['iOS']))
				{
					// send notifications to iOS devices if any
					$alltokens=array_column($mdevlist['iOS'], 'tbl_users_device_token');
					for($i=0;$i<count($alltokens);$i++)
					{
						$this->iOS_emp_accept_admin_notification($msg,$alltokens[$i],$input['sr_id']);
					}					
				}
			}			
			$vals=$this->user_api_model->emp_ordre_detail($input['sr_id']);
			$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
			echo json_encode($body);			
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function iOS_emp_accept_user_notification($msg,$token,$sr_id)
    {
        $registrationIds = $token;

        //$fields = array('to'=>$registrationIds,'notification'=>array('title'=>'wahidfix','body'=>$msg));
        $fields = array('to'=>$registrationIds,'notification'=>array('title'=>'wahidfix','body'=>$msg,'sound'=>'default','sr_id'=>$sr_id));
        //echo json_encode($fields);die;
        $headers = array('Authorization: key=' . API_ACCESS_KEY,'Content-Type: application/json');
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );       
        //echo $result;die;
    }

    public function iOS_emp_accept_admin_notification($msg,$token,$sr_id)
    {
        
        $registrationIds = $token;
        // prep the bundle
        //$fields = array('to'=>$registrationIds,'notification'=>array('title'=>'wahidfix Admin','body'=>$msg));
        $fields = array('to'=>$registrationIds,'notification'=>array('title'=>'wahidfix','body'=>$msg,'sound'=>'default','sr_id'=>$sr_id));
        //echo json_encode($fields);die;
        $headers = array('Authorization: key=' . API_ACCESS_KEY,'Content-Type: application/json');
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );       
        //echo $result;die;
    }

	public function Android_emp_accept_user_notification($alltokens,$msg)
    {
        $registrationIds = $alltokens;
        // prep the bundle
        $msg = array
        (
            'message'   => $msg,
            'title'     => 'Notification',
            'subtitle'  => '',
            'vibrate'   => 1,
            'sound'     => 'default',
            'largeIcon' => 'large_icon'
        );
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
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );       
        //echo $result;die;
    }

    public function Android_emp_accept_admin_notification($msg,$alltokens)
    {
        $registrationIds = $alltokens;
        $msg = array
        (
            'message'   => $msg,
            'subtitle'  => '',
            'vibrate'   => 1,
            'sound'     => 'default',
            'largeIcon' => ''
        );
        
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
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );       
        //echo $result;die;
    }

	public function AdminAcceptReject()
	{
		$header=getallheaders();
		if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$this->user_api_model->admin_accept_reject($input);

			//first get user's all of devices from sr id 
			$devlist=$this->user_api_model->get_user_all_dev_by_sr_id($input['sr_id']);
			$data['emp']=$this->user_api_model->get_emp_details($devlist['assigned_emp_id']);
            $data['user']=$this->user_api_model->get_user_details_by_sr_id($input['sr_id']);

			$msg='';
			if($input['isAccept']==1)
			{
				$msg='Hello '.$data['user']['tbl_user_name'].' your order with order no '.$devlist['service_request_ref'].'. is Accepted and prosessed.';
			}
			else
			{
				$msg='Hello '.$data['user']['tbl_user_name'].' your order with order no '.$devlist['service_request_ref'].'. is Rejectd by admin you can contact us on our helpline number.';
			}
			
			//echo "<pre>";print_r($devlist);die;
			
			$this->user_api_model->insert_user_notification($input['sr_id'],$msg,$data['user']['tbl_user_id']);	
			if(isset($devlist['assigned_emp_id']) && !empty($devlist['Android']))
			{
				// send notifications to android devices if any
                $alltokens=array_column($devlist['Android'], 'tbl_user_device_token');
                $this->Android_emp_accept_user_notification($alltokens,$msg);                                       
			}
			if(isset($devlist['assigned_emp_id']) && !empty($devlist['iOS']))
			{
				// send notifications to iOS devices if any
				$alltokens=array_column($devlist['iOS'], 'tbl_user_device_token');
				for($i=0;$i<count($alltokens);$i++)
				{
					$this->iOS_emp_accept_user_notification($msg,$alltokens[$i],$input['sr_id']);
				}
			}
			//$vals=$this->user_api_model->my_task_list($input['tbl_employee_id']);
			$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>1);
			echo json_encode($body);
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function GetServiceList()
	{
		$header=getallheaders();		
    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{			
        	$data['services']=$this->user_api_model->get_service_list();
        	$data['timeslots']=$this->user_api_model->get_time_slot_list();
        	if(!empty($data))
			{
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$data);
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'something went wrong please tyr after some time.','rstatus'=>0,'status'=>401);
				echo json_encode($body);
			}				
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function GetItemCategoryList()
	{
		$header=getallheaders();		
    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{			
        	$category=$this->user_api_model->get_item_category_list();        	
			$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$category);
			echo json_encode($body);
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function MasterItemList()
	{
		$header=getallheaders();		
    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);			
        	$vals=$this->user_api_model->get_master_item_list($input['item_category_id']);     	
			$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
			echo json_encode($body);					
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function CreateSalesQuotation()
    {
    	$header=getallheaders();
    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$row=$input['sales_quotation_boi'];
			//echo "<pre>";print_r($row);die;			
			if(!empty($row))
			{
				$sqid=$this->user_api_model->add_sales_quotation($input);
				$lid=$this->user_api_model->add_sales_quotation_boi($input['sales_quotation_boi'],$sqid);
				$uid=$this->user_api_model->get_user_from_sr_id($input['sr_id']);
				$this->user_api_model->update_user_address($uid['tbl_user_id'],$input['tbl_user_address']);
				$user=$this->user_api_model->user_get($uid['tbl_user_id']);
				$boi=$this->user_api_model->get_details_for_bio($sqid);
				$sqdetails=$this->user_api_model->get_details_for_sq($input['sr_id']);
				$ret=$this->sales_quotation_pdf($sqid,$user,$boi,$sqdetails);
				$this->user_api_model->update_sq_pdf_link($sqid,$ret['url'],$input['sr_id'],$ret['grand_total']);
				//echo "<pre>";print_r($user);die;
				//generate pdf here in new function and send url in response
				if(isset($sqid))
				{	
					$data['url']=$ret['url'];
					$data['sales_quotation_id']=$sqid;
					$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$data);	
					echo json_encode($body);
				}
				else
				{
					$body=array('message'=>'Something went wrong please try again.','rstatus'=>0,'status'=>401);	       
					echo json_encode($body);
				}
			}
			else
			{
				$body=array('message'=>'No Products found.','rstatus'=>0,'status'=>401);
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function UpdateSalesQuotation()
    {
    	$header=getallheaders();
    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$row=$input['sales_quotation_id'];
			//echo "<pre>";print_r($row);die;			
			if($row)
			{
				//delete previous items from boi
				$this->user_api_model->delete_boi_by_sqid($input['sales_quotation_id']);
				$this->user_api_model->update_sales_quotation($input);
				$this->user_api_model->add_sales_quotation_boi($input['sales_quotation_boi'],$input['sales_quotation_id']);
				$uid=$this->user_api_model->get_user_from_sr_id($input['sr_id']);
				$this->user_api_model->update_user_address($uid['tbl_user_id'],$input['tbl_user_address']);
				$user=$this->user_api_model->user_get($uid['tbl_user_id']);
				$boi=$this->user_api_model->get_details_for_bio($input['sales_quotation_id']);
				$sqdetails=$this->user_api_model->get_details_for_sq($input['sr_id']);
				$ret=$this->sales_quotation_pdf($input['sales_quotation_id'],$user,$boi,$sqdetails);
				$this->user_api_model->update_sq_pdf_link($input['sales_quotation_id'],$ret['url'],$input['sr_id'],$ret['grand_total']);
				///////////////////////////////////		
				//echo "<pre>";print_r($user);die;
				//generate pdf here in new function and send url in response
				if(isset($input['sales_quotation_id']))
				{	
					$data['url']=$ret['url'];
					$data['sales_quotation_id']=$input['sales_quotation_id'];
					$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$data);	
					echo json_encode($body);
				}
				else
				{
					$body=array('message'=>'Something went wrong please try again.','rstatus'=>0,'status'=>401);	       
					echo json_encode($body);
				}
			}
			else
			{
				$body=array('message'=>'No Products found.','rstatus'=>0,'status'=>401);
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function GetSalesQuotation()
    {
    	$header=getallheaders();
    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);			
			$sqid=$input['sales_quotation_id'];
			$boi=$this->user_api_model->get_details_for_sq_boi($sqid);
			$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$boi);	
			echo json_encode($body);			
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function sales_quotation_pdf($sqid,$user,$boi,$sqdetails)
    {
        require_once(FCPATH.'application/libraries/TCPDF-master/tcpdf.php');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Wahid Fix');
        $pdf->SetTitle('Sales Quotation');
        $pdf->SetSubject('Sales Quotation');
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE , PDF_HEADER_STRING);
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->AddPage();
		$pdf->SetFont('times', '', 20);// set font
        $html='<u><b>Sales Quotation</b></u>';
        $pdf->SetFillColor(255,255,0);
        $pdf->writeHTMLCell(0, 0, '', '', $html,0, 1, 0, true, 'C', true);
        $pdf->SetFont('times', '', 14);
        //$html = '<span align="left"><u>Bill To :</u></span><span align="right"><u>Ship To :</u></span>';
        //$pdf->writeHTMLCell(0, 0, '', '', $html,0, 1, 0, true, 'R', true);
        $pdf->Cell(50, 5, 'To : '.$user['tbl_user_name']);
        $pdf->Cell(130, 5, 'From : WahidFix',0,0,$align='R');
		$pdf->Ln(6);
		$pdf->SetFont('times', '', 10);
		//$html=$data['vendor_salutation'].' '.$data['vendor_name'];
		
		/*$html=$data['vendor_billing_attention'];
		$html1=$data['vendor_shipping_attention'];
		$pdf->Cell(50, 5,$html);
        $pdf->Cell(130, 5, $html1,0,0,$align='R');
		$pdf->Ln(6);*/
		//$html=$data['vendor_billing_address'].','.$data['vendor_billing_city'];
		//$html1=$data['vendor_shipping_address'].','.$data['vendor_shipping_city'];
		$pdf->Cell(50, 5,$user['tbl_user_address']);
        $pdf->Cell(130, 5, 'MUSSAFAH M13,PLOT 100, ABU DHABI,UAE',0,0,$align='R');
		$pdf->Ln(6);
		$html='Email :'.$user['tbl_user_email'];
		$html1='Email-info@wahidfix.com';
		$pdf->Cell(50, 5,$html);
        $pdf->Cell(130, 5, $html1,0,0,$align='R');
		$pdf->Ln(6);
		$html='Phone :'.$user['tbl_user_mobile'];
		$html1='Phone :'.'+971 55 555 555';
		$pdf->Cell(50, 5,$html);
        $pdf->Cell(130, 5, $html1,0,0,$align='R');
		$pdf->Ln(6);

		$orderref='Order #  '.$sqdetails['service_request_ref'];
		$pdf->Cell(180, 5,$orderref,0,0,$align='C');
		$pdf->Ln(6);
		/*$html='Fax :'.$data['vendor_billing_fax'];
		$html1='Fax :'.$data['vendor_shipping_fax'];
		$pdf->Cell(50, 5,$html);
        $pdf->Cell(130, 5, $html1,0,0,$align='R');
		$pdf->Ln(6); */       
        $pdf->SetFont('times', 'B', 16);
        $html = '<table border="1" cellpadding="5">
            <tr>
                <th align="center" width="30">Sr. No</th>
                <th align="center" width="395">Description</th>
                <th align="center" width="45">Qty</th>
                <th align="center" width="45">Unit</th>
                <th align="center" width="50">Rate</th>
                <th align="center" width="73">Amount</th>
            </tr>';
        $pdf->SetFont('times', '', 10);
        $subtotal=0.0;
        //echo "<pre>";print_r($boi);die;
        for($i=0;$i<count($boi);$i++)
        {        
        $html .='<tr>
                <td align="center" width="30">'.($i+1).'</td>
                <td align="center" width="395">'.$boi[$i]['item_master_name'].'</td>
                <td align="center" width="45">'.$boi[$i]['sales_quotation_boi_qty'].'</td>
                <td align="center" width="45">'.$boi[$i]['item_unit_name'].'</td>
                <td align="center" width="50">'.$boi[$i]['sales_quotation_boi_rate'].'</td>
                <td align="right" width="73">'.number_format(($boi[$i]['sales_quotation_boi_qty']*$boi[$i]['sales_quotation_boi_rate']),2,'.','').'</td>
            </tr>';
            $subtotal+=$boi[$i]['sales_quotation_boi_qty']*$boi[$i]['sales_quotation_boi_rate'];
        }
        $vat='5';
        $tax_amt=$subtotal*5/100;
        $grand_total=$subtotal+$tax_amt;
        $html.='</table><table border="0" cellpadding="5">';
        $html.= '
            <tr>
            	<td></td>
            	<td></td>
            	<td></td>
            	<td></td>
                <td align="center" style="border: 1px solid black;">Subtotal</td>
                <td align="right" style="border: 1px solid black;">'.number_format($subtotal,2,'.','').'</td>
            </tr>';
        $html.= '
            <tr>
            	<td></td>
            	<td></td>
            	<td></td>
            	<td></td>
                <td align="center" style="border: 1px solid black;">VAT (5%)</td>
                <td align="right" style="border: 1px solid black;">'.number_format($vat,2,'.','').'</td>
            </tr>';
        $html.= '
            <tr>
            	<td></td>
            	<td></td>
            	<td></td>
            	<td></td>
                <td align="center" style="border: 1px solid black;">Tax Amount</td>
                <td align="right" style="border: 1px solid black;">'.number_format($tax_amt,2,'.','').'</td>
            </tr>';
        $html.= '<tr>
        		<td></td>
            	<td></td>
            	<td></td>
            	<td></td>
                <td align="center" style="border: 1px solid black;">Grand Total  </td>
                <td align="right" style="border: 1px solid black;">'.number_format($grand_total,2,'.','').'</td>
            </tr>';
        $html.='</table>';
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // Print some HTML Cells
        switch ($i) {
        	case '1': $pdf->Ln(115);break;
        	case '2': $pdf->Ln(110);break;
        	case '3': $pdf->Ln(95);break;
        	case '4': $pdf->Ln(85);break;
        	case '5': $pdf->Ln(73);break;
        	case '6': $pdf->Ln(63);break;
        	case '7': $pdf->Ln(55);break;
        	case '8': $pdf->Ln(50);break;
        	case '9': $pdf->Ln(40);break;
        	case '10': $pdf->Ln(45);break;
        	case '11': $pdf->Ln(50);break;
        	case '12': $pdf->Ln(50);break;
        	case '13': $pdf->Ln(50);break;
        }
        /*$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 4, 'color' => array(0, 0, 0)));
        $html='<table height="100"><tr><td></td></tr></table>';
        $pdf->SetFillColor(255,255,0);
        $pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'L', true);
        $pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'C', true);
        $pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'R', true);*/
        $tandc='(a) The invoice amount for the goods and services must be paid in full within seven (7) days of the end of the month during which
		the goods and services were invoiced.
		(b) The Customer is not entitled to withhold payment or make any deduction from the quoted price of the goods and services in
		respect of any set off or counterclaim.
		(c)If the Customer fails to pay for any of the goods or services, the Supplier may in its absolute discretion, but without prejudice to
		any other remedy it may have, postpone the fulfillment of its obligations under this order or briefing and under any other order or
		briefing with this Customer until such payment is made and charge to the Customer any extra expense incurred thereby';
        $tbl ='<table cellspacing="0" cellpadding="1" border="1" align="center"><tr><td>Terms & Condition</td>
		   </tr><tr><td>'.$tandc.'<br /></td></tr></table>';
		$pdf->writeHTML($tbl, true, false, false, false, '');
    	//$pdf->Ln(20);
		// $tbl=' Accepted By ( Name & Signature )';
		// $tbl1=' Issue By ( Name & Signature )';
		// //$pdf->writeHTML($tbl, true, false, false, false, '');
		// $pdf->Cell(0, 0, $tbl.'                          '.$tbl1, 1, 1, 'C', 0, '', 3);
		// $usename=$sqdetails['tbl_user_name'];
		// $empname=$sqdetails['tbl_employee_name'];
		// $pdf->Cell(0, 0, $usename.'                          '.$empname, 1, 1, 'C', 0, '', 3);
		//$pdf->writeHTML($tbl, true, false, false, false, '');
        // reset pointer to the last page
        $pdf->lastPage();
        $filelocation = FCPATH.'assets/sq_pdf';  
        $fileNL = $filelocation.'/'.$sqdetails['service_request_ref'].'.pdf';
        $pdf->Output($fileNL, 'F'); 
        //echo FCPATH.$fileNL;
        $var=base_url().'/assets/sq_pdf/'.$sqdetails['service_request_ref'].'.pdf';
        $ret['url']=$var;
        $ret['grand_total']=$grand_total;
        return $ret;
        //return json_encode(stripcslashes($var));
	}

	public function ConfirmSalesQuotation()
	{
		$header=getallheaders();
    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);			
			$vals=$this->user_api_model->confirm_sales_quotation($input['sr_id']);

			//first get user's all of devices from sr id 
			$devlist=$this->user_api_model->get_user_all_dev_by_sr_id($input['sr_id']);
			$data['emp']=$this->user_api_model->get_emp_details($devlist['assigned_emp_id']);
            $data['user']=$this->user_api_model->get_user_details_by_sr_id($input['sr_id']);
			
			$msg='Hello '.$data['user']['tbl_user_name'].' Our employee '.$data['emp']['tbl_employee_name'].' has generated quotation for order no '.$devlist['service_request_ref'];
			$this->user_api_model->insert_user_notification($input['sr_id'],$msg,$data['user']['tbl_user_id']);

			if(isset($devlist['assigned_emp_id']) && !empty($devlist['Android']))
			{
				// send notifications to android devices if any
                $alltokens=array_column($devlist['Android'], 'tbl_user_device_token');
                $this->Android_emp_accept_user_notification($alltokens,$msg);                                       
			}
			if(isset($devlist['assigned_emp_id']) && !empty($devlist['iOS']))
			{
				// send notifications to iOS devices if any
				$alltokens=array_column($devlist['iOS'], 'tbl_user_device_token');
				for($i=0;$i<count($alltokens);$i++)
				{
					$this->iOS_emp_accept_user_notification($msg,$alltokens[$i],$input['sr_id']);
				}
			}

			if(isset($input['is_admin']) && $input['is_admin']==1)
			{
				//if admin generates quotation then send notification to emp and user
				$empdev=$this->user_api_model->get_emp_dev_detail_by_sr_id($input['sr_id']);
				//echo "<pre>";print_r($empdev);die;
				$empmsg='Quotation generated by admin.please check your order'.$devlist['service_request_ref'];
				if($empdev['tbl_emp_device_type']=='iOS')
				{
					$this->iOS_emp_accept_user_notification($empmsg,$empdev['tbl_emp_device_token'],$input['sr_id']);
				}
				else if($empdev['tbl_emp_device_type']=='Android')
				{
					$this->Android_Employee_notification($empdev['tbl_emp_device_token'],$empmsg);
				}
			}
			else
			{
				// send one notification to manager level users
				$mdevlist=$this->user_api_model->get_all_managers_devices_by_role_id();
				
				$msg='For Oreder no#'.$devlist['service_request_ref'].' our employee : '.$data['emp']['tbl_employee_name'].' has generated quotation.' ;
				$this->user_api_model->insert_users_notification($input['sr_id'],$msg,2);

				if(!empty($mdevlist['Android']))
				{
					// send notifications to android devices if any
	                $alltokens=array_column($mdevlist['Android'], 'tbl_users_device_token');
	                $this->Android_emp_accept_admin_notification($msg,$alltokens);
				}
				if(!empty($mdevlist['iOS']))
				{
					// send notifications to iOS devices if any
					$alltokens=array_column($mdevlist['iOS'], 'tbl_users_device_token');
					for($i=0;$i<count($alltokens);$i++)
					{
						$this->iOS_emp_accept_admin_notification($msg,$alltokens[$i],$input['sr_id']);
					}
				}
			}
			$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);	
			echo json_encode($body);			
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function UserConfirmQuotation()
	{
		$header=getallheaders();
    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			$vals=$this->user_api_model->user_confirm_sales_quotation($input['sr_id'],$input['isConfirm']);

			$devlist=$this->user_api_model->get_user_all_dev_by_sr_id($input['sr_id']);
			$data['emp']=$this->user_api_model->get_emp_details($devlist['assigned_emp_id']);
            $data['user']=$this->user_api_model->get_user_details_by_sr_id($input['sr_id']);

			//send notification to employee
			$empdev=$this->user_api_model->get_emp_dev_detail_by_sr_id($input['sr_id']);
			//echo "<pre>";print_r($empdev);die;
			$empmsg='Quotation approved from user.please check your order'.$devlist['service_request_ref'];
			if($empdev['tbl_emp_device_type']=='iOS')
			{
				$this->iOS_emp_accept_user_notification($empmsg,$empdev['tbl_emp_device_token'],$input['sr_id']);
			}
			else if($empdev['tbl_emp_device_type']=='Android')
			{
				$this->Android_Employee_notification($empdev['tbl_emp_device_token'],$empmsg);
			}
			// send one notification to manager level users
			$devlist=$this->user_api_model->get_user_all_dev_by_sr_id($input['sr_id']);
			$data['emp']=$this->user_api_model->get_emp_details($devlist['assigned_emp_id']);
            $data['user']=$this->user_api_model->get_user_details_by_sr_id($input['sr_id']);

			$mdevlist=$this->user_api_model->get_all_managers_devices_by_role_id();			
			$msg='For Oreder no#'.$devlist['service_request_ref'].' our employee : '.$data['emp']['tbl_employee_name'].' got confirmation for quotation.' ;
			$this->user_api_model->insert_users_notification($input['sr_id'],$msg,2);
			if(!empty($mdevlist['Android']))
			{
				// send notifications to android devices if any
                $alltokens=array_column($mdevlist['Android'], 'tbl_users_device_token');
                $this->Android_emp_accept_admin_notification($msg,$alltokens);
			}
			if(!empty($mdevlist['iOS']))
			{
				// send notifications to iOS devices if any
				$alltokens=array_column($mdevlist['iOS'], 'tbl_users_device_token');
				for($i=0;$i<count($alltokens);$i++)
				{
					$this->iOS_emp_accept_admin_notification($msg,$alltokens[$i],$input['sr_id']);
				}
			}
			$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);	
			echo json_encode($body);			
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function Android_Employee_notification($alltokens,$msg)
    {
        $registrationIds = array($alltokens);
        $msg=array('message'=> $msg,'title'=>'Notification','subtitle'=>'','vibrate'=>1,'sound'=>'default','largeIcon'=>'large_icon');
        $fields=array('registration_ids'=>$registrationIds,'data'=>$msg);
		$headers=array('Authorization: key='.API_ACCESS_KEY,'Content-Type: application/json');
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );       
        //echo $result;die;
    }

	public function AdminReports()
    {
    	$header=getallheaders();
    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
			if(isset($input['report_type']) && $input['report_type']=='order_report')
			{
				$row=$this->user_api_model->check_admin_order_reports_data($input);
				//echo "<pre>";print_r($row);die;			
				if(!empty($row))
				{
					$url=$this->generate_admin_order_report($input,$row);
					$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$url);	
					echo json_encode($body);
				}
				else
				{
					$body=array('message'=>'No Records found.','rstatus'=>0,'status'=>401);
					echo json_encode($body);
				}
			}
			if(isset($input['report_type']) && $input['report_type']=='employee_report')
			{
				if(isset($input['tbl_employee_id']) && $input['tbl_employee_id']!='')
				{
					$row=$this->user_api_model->check_admin_single_employee_reports_data($input);
					//echo "<pre>";print_r($row);die;			
					if(!empty($row))
					{
						$url=$this->generate_admin_single_employee_report($input,$row);
						$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$url);	
						echo json_encode($body);
					}
					else
					{
						$body=array('message'=>'No Records found.','rstatus'=>0,'status'=>401);
						echo json_encode($body);
					}
				}
				else
				{
					$row=$this->user_api_model->check_admin_employee_reports_data($input);
					//echo "<pre>";print_r($row);die;			
					if(!empty($row))
					{
						$url=$this->generate_admin_order_report($input,$row);
						$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$url);	
						echo json_encode($body);
					}
					else
					{
						$body=array('message'=>'No Records found.','rstatus'=>0,'status'=>401);
						echo json_encode($body);
					}
				}				
			}			
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function generate_admin_single_employee_report($input,$row)
	{
		require_once(FCPATH.'application/libraries/TCPDF-master/tcpdf.php');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        //$pdf->SetAuthor('Wahid Fix');
        $pdf->SetTitle('Report');
        $pdf->SetSubject('Report');
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE , PDF_HEADER_STRING);
        //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        $pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->AddPage();
        $pdf->SetFillColor(255,255,0);
        $pdf->SetXY(25,7);
        $pdf->SetFont('times', '', 12);
        $pdf->MultiCell(95, 5, 'Wahidfix General Services LLC.', 0, 'R', 0, 2, '', '', true, 0);

        $pdf->SetFont('times', '', 8);

        $pdf->SetXY(24,12);
        $pdf->MultiCell(95, 5, 'M13, Plot 100', 0, 'C', 0, 2, '', '', true, 0);

        $from='From : '.date('d-m-Y', strtotime($input['start_date']));
        $pdf->SetXY(30,16);
        $pdf->MultiCell(97, 5, 'Mussafah Abu Dhabi,UAE', 0, 'C', 0, 2, '', '', true, 0);
        $pdf->MultiCell(70, 5, $from, 0, 'R', 0, 2, '', '', true, 0);

        $to='To : '.date('d-m-Y', strtotime($input['end_date']));
        $pdf->SetXY(62,20);
        $pdf->MultiCell(98, 5, 'Email : info@awfueltrading.com', 0, 'L', 0, 2, '', '', true, 0);
        $pdf->MultiCell(37, 5, $to, 0, 'R', 0, 2, '', '', true, 0);
        //echo "<pre>";print_r($input);die;
        if(isset($input['report_type']) && $input['report_type']=='employee_report')
        {
        	$str='Order : All';
        	$status='';
        	if($input['status']===0)
	        {
	        	$status='New';
	        }
	        else if($input['status']==1)
	        {
	        	$status='Admin accepted';
	        }
	        else if($input['status']==2)
	        {
	        	$status='Admin Rejected';
	        }
	        else if($input['status']==3)
	        {
	        	$status='Assigned';
	        }
	        else if($input['status']==4)
	        {
	        	$status='Inprogress';
	        }
	        else if($input['status']==5)
	        {
	        	$status='Customer place';
	        }
	        else if($input['status']==6)
	        {
	        	$status='Inspction Started';
	        }
	        else if($input['status']==7)
	        {
	        	$status='Inspection Completed';
	        }
	         else if($input['status']==8)
	        {
	        	$status='Quotation Generated';
	        }
	         else if($input['status']==9)
	        {
	        	$status='Quotation Approved';
	        }
	         else if($input['status']==10)
	        {
	        	$status='Unpaid';
	        }
	         else if($input['status']==11)
	        {
	        	$status='Completed';
	        }
	        else
	        {
	        	$status='N.A.';
	        }
        }
        else
        {
        	$str='Order : All';
        }
        $pdf->SetXY(62,24);
        $pdf->MultiCell(95, 5, 'Phone :+971-25550870', 0, 'L', 0, 2, '', '', true, 0);
        $pdf->MultiCell(40, 5, $str, 0, 'R', 0, 2, '', '', true, 0);

        $pdf->SetXY(62,28);
        $pdf->MultiCell(95, 5, 'Fax : 025550871', 0, 'L', 0, 2, '', '', true, 0);
        $pdf->MultiCell(40, 5, 'Status : '.$status, 0, 'R', 0, 2, '', '', true, 0);

        $pdf->SetXY(62,32);
        $pdf->MultiCell(95, 5, 'TRN : 100330389600003', 0, 'L', 0, 2, '', '', true, 0);

        $pdf->Image('assets/images/logo.jpg', 15, 5, 30, 30, 'JPG', 'http://www.wahidfix.com', '', true, 150, '', false, false, 0, false, false, false);
        $pdf->SetXY(15,37);
        
		$pdf->Ln(6);

		$pdf->SetFont('times', '', 15);
        $html='<u><b>EMPLOYEE REPORT</b></u>';
        
        $pdf->writeHTMLCell(0, 0, '', '', $html,0, 1, 0, true, 'C', true);
        $pdf->SetFont('times', '', 14);
    	       
        $pdf->SetFont('times', 'B', 16);
        $html = '<table border="1" cellpadding="5">
            <tr>
                <th align="center" width="30">Sr. No</th>
                <th align="center" width="80">Date</th>
                <th align="center" width="80">Order No</th>
                <th align="center" width="80">User Name</th>
                <th align="center" width="100">Assigned Emp</th>
                <th align="center" width="100">Services</th>
                <th align="center" width="100">Status</th>
                <th align="center" width="80">Invoice Amt.</th>
            </tr>';
        $pdf->SetFont('times', '', 10);
        $subtotal=0.0;

        for($i=0;$i<count($row);$i++)
        {
	        if($input['status']==0)
	        {
	        	$status='New';
	        }
	        else if($input['status']==1)
	        {
	        	$status='Admin accepted';
	        }
	        else if($input['status']==2)
	        {
	        	$status='Admin Rejected';
	        }
	        else if($input['status']==3)
	        {
	        	$status='Assigned';
	        }
	        else if($input['status']==4)
	        {
	        	$status='Inprogress';
	        }
	        else if($input['status']==5)
	        {
	        	$status='Customer place';
	        }
	        else if($input['status']==6)
	        {
	        	$status='Inspction Started';
	        }
	        else if($input['status']==7)
	        {
	        	$status='Inspection Completed';
	        }
	         else if($input['status']==8)
	        {
	        	$status='Quotation Generated';
	        }
	         else if($input['status']==9)
	        {
	        	$status='Quotation Approved';
	        }
	         else if($input['status']==10)
	        {
	        	$status='Unpaid';
	        }
	         else if($input['status']==11)
	        {
	        	$status='Completed';
	        }
	        else
	        {
	        	$status='N.A.';
	        }
        $html .='<tr>
                <td align="center" width="30">'.($i+1).'</td>
                <td align="center" width="80">'.date('d-m-Y', strtotime($row[$i]['created_at'])).'</td>
                <td align="center" width="80">'.$row[$i]['service_request_ref'].'</td>
                <td align="center" width="80">'.$row[$i]['tbl_user_name'].'</td>
                <td align="center" width="100">'.$row[$i]['tbl_employee_name'].'</td>
                <td align="center" width="100">'.$row[$i]['services_name'].'</td>
              	<td align="center" width="100">'.$status.'</td>
              	<td align="center" width="80">'.$row[$i]['sales_master_grand_total'].'</td>
            </tr>';
            $subtotal+=$row[$i]['sales_master_grand_total'];
        }
        $pdf->SetFillColor(255, 0, 0);
        $html.='</table><table border="0" cellpadding="5">';
        $html.= '
            <tr color="red">
            	<td width="30"></td>
            	<td width="80"></td>
            	<td width="80"></td>
            	<td width="80"></td>
            	<td width="100"></td>
            	<td width="100"></td>
                <td width="100" align="center" style="border: 1px solid black;">Total : </td>
                <td width="80" align="right" style="border: 1px solid black;">'.number_format($subtotal,2,'.','').'</td>
            </tr>';
        $html.='</table>';
        $pdf->writeHTML($html, true, false, true, false, '');        
        $pdf->lastPage();
        $filelocation = FCPATH.'assets/reports';  
        $fileNL = $filelocation.'/'.'Admin_order'.time().'.pdf';
        $pdf->Output($fileNL, 'F'); 
        $var=base_url().'/assets/reports/'.'Admin_order'.time().'.pdf';
        $ret['url']=$var;
        return $ret;
	}

	public function generate_admin_order_report($input,$row)
	{
		require_once(FCPATH.'application/libraries/TCPDF-master/tcpdf.php');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        //$pdf->SetAuthor('Wahid Fix');
        $pdf->SetTitle('Report');
        $pdf->SetSubject('Report');
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE , PDF_HEADER_STRING);
        //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        $pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->AddPage();
        $pdf->SetFillColor(255,255,0);
        $pdf->SetXY(25,7);
        $pdf->SetFont('times', '', 12);
        $pdf->MultiCell(95, 5, 'Wahidfix General Services LLC.', 0, 'R', 0, 2, '', '', true, 0);

        $pdf->SetFont('times', '', 8);

        $pdf->SetXY(24,12);
        $pdf->MultiCell(95, 5, 'M13, Plot 100', 0, 'C', 0, 2, '', '', true, 0);

        $from='From : '.date('d-m-Y', strtotime($input['start_date']));
        $pdf->SetXY(30,16);
        $pdf->MultiCell(97, 5, 'Mussafah Abu Dhabi,UAE', 0, 'C', 0, 2, '', '', true, 0);
        $pdf->MultiCell(70, 5, $from, 0, 'R', 0, 2, '', '', true, 0);

        $to='To : '.date('d-m-Y', strtotime($input['end_date']));
        $pdf->SetXY(62,20);
        $pdf->MultiCell(98, 5, 'Email : info@awfueltrading.com', 0, 'L', 0, 2, '', '', true, 0);
        $pdf->MultiCell(37, 5, $to, 0, 'R', 0, 2, '', '', true, 0);

        if(isset($input['report_type']) && $input['report_type']=='order_report')
        {
        	$str='Order : All';
        	$status='';
        	if($input['status']===0)
	        {
	        	$status='New';
	        }
	        else if($input['status']==1)
	        {
	        	$status='Accepted by Admin';
	        }
	        else if($input['status']==2)
	        {
	        	$status='Rejected by Admin';
	        }
	        else if($input['status']==3)
	        {
	        	$status='Accepted by Emp';
	        }
	        else if($input['status']==4)
	        {
	        	$status='Inprogress';
	        }
	        else if($input['status']==5)
	        {
	        	$status='Unpaid';
	        }
	        else if($input['status']==6)
	        {
	        	$status='Completed';
	        }
	        else if($input['status']==7)
	        {
	        	$status='Customer Cancelled';
	        }
	        else if($input['status']=='all')
	        {
	        	$status='All';
	        }
        }
        else
        {
        	$str='Order : All';
        }
        $pdf->SetXY(62,24);
        $pdf->MultiCell(95, 5, 'Phone :+971-25550870', 0, 'L', 0, 2, '', '', true, 0);
        $pdf->MultiCell(40, 5, $str, 0, 'R', 0, 2, '', '', true, 0);

        $pdf->SetXY(62,28);
        $pdf->MultiCell(95, 5, 'Fax : 025550871', 0, 'L', 0, 2, '', '', true, 0);
        $pdf->MultiCell(40, 5, 'Status : '.$status, 0, 'R', 0, 2, '', '', true, 0);

        $pdf->SetXY(62,32);
        $pdf->MultiCell(95, 5, 'TRN : 100330389600003', 0, 'L', 0, 2, '', '', true, 0);

        $pdf->Image('assets/images/logo.jpg', 15, 5, 30, 30, 'JPG', 'http://www.wahidfix.com', '', true, 150, '', false, false, 0, false, false, false);
        $pdf->SetXY(15,37);
        
		$pdf->Ln(6);

		$pdf->SetFont('times', '', 15);
        $html='<u><b>ORDER REPORT</b></u>';
        
        $pdf->writeHTMLCell(0, 0, '', '', $html,0, 1, 0, true, 'C', true);
        $pdf->SetFont('times', '', 14);
    	       
        $pdf->SetFont('times', 'B', 16);
        $html = '<table border="1" cellpadding="5">
            <tr>
                <th align="center" width="30">Sr. No</th>
                <th align="center" width="80">Date</th>
                <th align="center" width="80">Order No</th>
                <th align="center" width="80">User Name</th>
                <th align="center" width="100">Assigned Emp</th>
                <th align="center" width="100">Services</th>
                <th align="center" width="100">Status</th>
                <th align="center" width="80">Invoice Amt.</th>
            </tr>';
        $pdf->SetFont('times', '', 10);
        $subtotal=0.0;

        for($i=0;$i<count($row);$i++)
        {
	        if($row[$i]['status']==0)
	        {
	        	$status='New';
	        }
	        else if($row[$i]['status']==1)
	        {
	        	$status='Accepted by Admin';
	        }
	        else if($row[$i]['status']==2)
	        {
	        	$status='Rejected by Admin';
	        }
	        else if($row[$i]['status']==3)
	        {
	        	$status='Accepted by Emp';
	        }
	        else if($row[$i]['status']==4)
	        {
	        	$status='Inprogress';
	        }
	        else if($row[$i]['status']==5)
	        {
	        	$status='Unpaid';
	        }
	        else if($row[$i]['status']==6)
	        {
	        	$status='Completed';
	        }
	        else if($row[$i]['status']==7)
	        {
	        	$status='Customer Cancelled';
	        }
	        else
	        {
	        	$status='N.A.';
	        }
        $html .='<tr>
                <td align="center" width="30">'.($i+1).'</td>
                <td align="center" width="80">'.date('d-m-Y', strtotime($row[$i]['created_at'])).'</td>
                <td align="center" width="80">'.$row[$i]['service_request_ref'].'</td>
                <td align="center" width="80">'.$row[$i]['tbl_user_name'].'</td>
                <td align="center" width="100">'.$row[$i]['tbl_employee_name'].'</td>
                <td align="center" width="100">'.$row[$i]['services_name'].'</td>
              	<td align="center" width="100">'.$status.'</td>
              	<td align="center" width="80">'.$row[$i]['sales_master_grand_total'].'</td>
            </tr>';
            $subtotal+=$row[$i]['sales_master_grand_total'];
        }
        $pdf->SetFillColor(255, 0, 0);
        $html.='</table><table border="0" cellpadding="5">';
        $html.= '
            <tr color="red">
            	<td width="30"></td>
            	<td width="80"></td>
            	<td width="80"></td>
            	<td width="80"></td>
            	<td width="100"></td>
            	<td width="100"></td>
                <td width="100" align="center" style="border: 1px solid black;">Total : </td>
                <td width="80" align="right" style="border: 1px solid black;">'.number_format($subtotal,2,'.','').'</td>
            </tr>';
        $html.='</table>';
        $pdf->writeHTML($html, true, false, true, false, '');        
        $pdf->lastPage();
        $filelocation = FCPATH.'assets/reports';  
        $fileNL = $filelocation.'/'.'Admin_order'.time().'.pdf';
        $pdf->Output($fileNL, 'F'); 
        $var=base_url().'/assets/reports/'.'Admin_order'.time().'.pdf';
        $ret['url']=$var;
        return $ret;
	}

	public function UserCancelService()
	{
		$header=getallheaders();
    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);			
			
			$vals=$this->user_api_model->user_cancel_service($input);
			if($vals==1)
			{
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);	
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'Sorry you can not cancel service at this moment.','rstatus'=>0,'status'=>200,'data'=>$vals);	
				echo json_encode($body);
			}	
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}	

	public function GetInvoice($sr_id)
	{
		$input['sr_id']=$sr_id;
		//get sales quotation id form sr_id//
		$this->db->select('sales_quotation_id');
		$this->db->where('sales_quotation_sr_id', $input['sr_id']);
		$query1 = $this->db->get('tbl_sales_quotation');
		$row1 = $query1->row_array();
		$input['sales_quotation_id']=$row1['sales_quotation_id'];
		//get sales quotation id from sr_id//
		$smid=$this->user_api_model->add_sales_master($input['sales_quotation_id']);
		$lid=$this->user_api_model->add_sales_master_boi($input['sales_quotation_id'],$smid);
		$smdetails=$this->user_api_model->get_sm($smid);
		$uid=$this->user_api_model->get_user_from_sr_id($smdetails['sales_quotation_sr_id']);
		$user=$this->user_api_model->user_get($uid['tbl_user_id']);
		$boi=$this->user_api_model->get_details_for_sales_master_boi($smid);
		$data=$this->user_api_model->get_details_for_sm($input['sr_id']);
		//$signature=$this->user_api_model->update_sm_signature_link($smid,$input['sales_master_signature']);
		$ret=$this->sales_master_pdf($smid,$user,$boi,$data);
		$this->user_api_model->update_sm_pdf_link($smid,$ret['url'],$ret['grand_total']);
		$this->user_api_model->update_sr_status($smdetails['sales_quotation_sr_id'],$ret['grand_total']);
	}

	public function Android1($token,$msg_detail)
	{
		$token_id=$token;    	
		$registrationIds = array($token_id);
		// prep the bundle
		$msg = array
		(
			'message' 	=> $msg_detail,
			'title'		=> 'Order Notification',
			'subtitle'	=> '',
			'vibrate'	=> 1,
			'sound'		=> 1,
			'largeIcon'	=> 'large_icon',
			'smallIcon'	=> 'small_icon'
		);
		$fields = array
		(
			'registration_ids' 	=> $registrationIds,
			'data'			=> $msg
		);
		$headers = array
		(
			'Authorization: key=' . API_ACCESS_KEY,
			'Content-Type: application/json'
		);
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
		//echo $result;
	}

	public function sales_master_pdf($smid,$user,$boi,$smdetails)
    {
        require_once(FCPATH.'application/libraries/TCPDF-master/tcpdf.php');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        //$value=$this->input->post();
        //$data = $this->purchase_order_model->get_po_pdf_data($value['data']);
        //$boi =  $this->purchase_order_model->get_all_boi_by_poid_pdf($data['purchase_order_id']);
        //echo "<pre>";print_r($data);die;
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Wahid Fix');
        $pdf->SetTitle('TAX INVOICE');
        $pdf->SetSubject('TAX INVOICE');
        //$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE , PDF_HEADER_STRING);
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        // ---------------------------------------------------------
        // add a page
        $pdf->AddPage();
		$pdf->SetFont('times', '', 20);// set font
        $html='<u><b>TAX INVOICE</b></u>';
        $pdf->SetFillColor(255,255,0);
        $pdf->writeHTMLCell(0, 0, '', '', $html,0, 1, 0, true, 'C', true);
        $pdf->SetFont('times', '', 14);
        //$html = '<span align="left"><u>Bill To :</u></span><span align="right"><u>Ship To :</u></span>';
        //$pdf->writeHTMLCell(0, 0, '', '', $html,0, 1, 0, true, 'R', true);
        $pdf->Cell(50, 5, 'To : '.$user['tbl_user_name']);
        $pdf->Cell(130, 5, 'From : WahidFix',0,0,$align='R');
		$pdf->Ln(6);
		$pdf->SetFont('times', '', 10);
		
		$pdf->Cell(50, 5,$user['tbl_user_address']);
        $pdf->Cell(130, 5, 'MUSSAFAH M13,PLOT 100, ABU DHABI,UAE',0,0,$align='R');
		$pdf->Ln(6);
		$html='Email :'.$user['tbl_user_email'];
		$html1='Email-info@wahidfix.com';
		$pdf->Cell(50, 5,$html);
        $pdf->Cell(130, 5, $html1,0,0,$align='R');
		$pdf->Ln(6);
		$html='Phone :'.$user['tbl_user_mobile'];
		$html1='Phone :'.'+971 55 555 555';
		$pdf->Cell(50, 5,$html);
        $pdf->Cell(130, 5, $html1,0,0,$align='R');
		$pdf->Ln(6);
		
		$orderref='Order #  '.$smdetails['service_request_ref'];
		$pdf->Cell(180, 5,$orderref,0,0,$align='C');
		$pdf->Ln(6);


        $pdf->SetFont('times', 'B', 16);
        $html = '<table border="1" cellpadding="5">
            <tr>
                <th align="center" width="30">Sr. No</th>
                <th align="center" width="395">Description</th>
                <th align="center" width="45">Qty</th>
                <th align="center" width="45">Unit</th>
                <th align="center" width="50">Rate</th>
                <th align="center" width="73">Amount</th>
            </tr>';
        $pdf->SetFont('times', '', 10);
        $subtotal=0.0;
        //echo "<pre>";print_r($boi);die;
        for($i=0;$i<count($boi);$i++)
        {        
        $html .='<tr>
                <td align="center" width="30">'.($i+1).'</td>
                <td align="center" width="395">'.$boi[$i]['item_master_name'].'</td>
                <td align="center" width="45">'.$boi[$i]['sales_master_boi_rate'].'</td>
                <td align="center" width="45">'.$boi[$i]['item_unit_name'].'</td>
                <td align="center" width="50">'.$boi[$i]['sales_master_boi_rate'].'</td>
                <td align="right" width="73">'.number_format(($boi[$i]['sales_master_boi_qty']*$boi[$i]['sales_master_boi_rate']),2,'.','').'</td>
            </tr>';
            $subtotal+=$boi[$i]['sales_master_boi_qty']*$boi[$i]['sales_master_boi_rate'];
        }
        $vat='5';
        $tax_amt=$subtotal*5/100;
        $grand_total=$subtotal+$tax_amt;
        $html.='</table><table border="0" cellpadding="5">';
        $html.= '
            <tr>
	           	<td></td>
            	<td></td>
            	<td></td>
            	<td></td>
                <td align="center" style="border: 1px solid black;">Subtotal</td>
                <td align="right" style="border: 1px solid black;">'.number_format($subtotal,2,'.','').'</td>
            </tr>';

        $html.= '
            <tr>
            	<td></td>
            	<td></td>
            	<td></td>
            	<td></td>
                <td align="center" style="border: 1px solid black;">VAT (5%)</td>
                <td align="right" style="border: 1px solid black;">'.number_format($vat,2,'.','').'</td>
            </tr>';
        $html.= '
            <tr>
            	<td></td>
            	<td></td>
            	<td></td>
            	<td></td>
                <td align="center" style="border: 1px solid black;">Tax Amount</td>
                <td align="right" style="border: 1px solid black;">'.number_format($tax_amt,2,'.','').'</td>
            </tr>';

        $html.= '<tr>
        		<td></td>
            	<td></td>
            	<td></td>
            	<td></td>
                <td align="center" style="border: 1px solid black;">Grand Total  </td>
                <td align="right" style="border: 1px solid black;">'.number_format($grand_total,2,'.','').'</td>
            </tr>';
        $html.='</table>';
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // Print some HTML Cells
        switch ($i) {
        	case '1': $pdf->Ln(115);break;
        	case '2': $pdf->Ln(110);break;
        	case '3': $pdf->Ln(95);break;
        	case '4': $pdf->Ln(85);break;
        	case '5': $pdf->Ln(73);break;
        	case '6': $pdf->Ln(63);break;
        	case '7': $pdf->Ln(55);break;
        	case '8': $pdf->Ln(50);break;
        	case '9': $pdf->Ln(40);break;
        	case '10': $pdf->Ln(45);break;
        	case '11': $pdf->Ln(50);break;
        	case '12': $pdf->Ln(50);break;
        	case '13': $pdf->Ln(50);break;
        }
        /*$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 4, 'color' => array(0, 0, 0)));
        $html='<table height="100"><tr><td></td></tr></table>';
        $pdf->SetFillColor(255,255,0);
        $pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'L', true);
        $pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'C', true);
        $pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'R', true);*/
        $tandc='(a) The invoice amount for the goods and services must be paid in full within seven (7) days of the end of the month during which
		the goods and services were invoiced.
		(b) The Customer is not entitled to withhold payment or make any deduction from the quoted price of the goods and services in
		respect of any set off or counterclaim.
		(c)If the Customer fails to pay for any of the goods or services, the Supplier may in its absolute discretion, but without prejudice to
		any other remedy it may have, postpone the fulfillment of its obligations under this order or briefing and under any other order or
		briefing with this Customer until such payment is made and charge to the Customer any extra expense incurred thereby';
        $tbl ='<table cellspacing="0" cellpadding="1" border="1" align="center"><tr><td>Terms & Condition</td>
		   </tr><tr><td>'.$tandc.'<br /></td></tr></table>';
		$pdf->writeHTML($tbl, true, false, false, false, '');
    	$pdf->Ln(20);
    	//$pdf->SetXY(110, 200);
		
		// $tbl=' Accepted By ( Name & Signature )';
		// $tbl1=' Issue By ( Name & Signature )';
		// //$pdf->writeHTML($tbl, true, false, false, false, '');
		// $pdf->Cell(0, 0, $tbl.'                          '.$tbl1, 1, 1, 'C', 0, '', 3);
		// $usename=$user['tbl_user_name'];
		// $empname=$smdetails['tbl_employee_name'];
		// $pdf->Cell(0, 0, $usename.'                          '.$empname, 1, 1, 'C', 0, '', 3);
		//$pdf->Image($signature, 60, '', 20, 20, '', '', '', false, 300, '', false, false, 1, false, false, false);
		//$pdf->writeHTML($tbl, true, false, false, false, '');
        // reset pointer to the last page
        $pdf->lastPage();
        $filelocation = FCPATH.'assets/sm_pdf';  
        $fileNL = $filelocation.'/'.$smdetails['service_request_ref'].'.pdf';
        $pdf->Output($fileNL, 'F'); 
        //echo FCPATH.$fileNL;
        $var=base_url().'/assets/sm_pdf/'.$smdetails['service_request_ref'].'.pdf';
        $ret['url']=$var;
        $ret['grand_total']=$grand_total;
        return $ret;
	}

	public function Dashboard()
	{
		$header=getallheaders();		
    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{			
        	$vals['services']=$this->user_api_model->get_service_list();
        	$vals['slider']=$this->user_api_model->get_slider_list();
        	if(!empty($vals))
			{
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'something went wrong please tyr after some time.','rstatus'=>0,'status'=>401);
				echo json_encode($body);
			}				
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function GetTimeSlots()
	{
		$header=getallheaders();		
    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{			
        	$vals=$this->user_api_model->get_time_slot_list();
        	if(!empty($vals))
			{
				$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals);
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'something went wrong please tyr after some time.','rstatus'=>0,'status'=>401);
				echo json_encode($body);
			}				
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function UserLogout()
	{
		$header=getallheaders();
    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
        	$vals=$this->user_api_model->user_logout($input);
			$body=array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>array());
			echo json_encode($body);
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function EmployeeLogout()
	{
		$header=getallheaders();
    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
        	$vals=$this->user_api_model->employee_logout($input);        	
			$body=array('message'=>'Logged out Succesfully.','rstatus'=>1,'status'=>200,'data'=>array());
			echo json_encode($body);
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function TandC()
	{

		$header=getallheaders();

    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='zokham')

		{

			$input=$_POST;

        	$vals=$this->user_api_model->get_TandC();

        	if(!empty($vals))

			{

				$body=array('result'=>array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals));echo json_encode($body);

			}

			else

			{

				$body=array('result'=>array('message'=>'something went wrong please tyr after some time.','rstatus'=>0,'status'=>401));

				echo json_encode($body);

			}

		}

		else

		{

			$body=array('result'=>array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401));

			echo json_encode($body);

		}

	}



	public function PrivacyPolicy()

	{

		$header=getallheaders();

    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='zokham')

		{

			$input=$_POST;

        	$vals=$this->user_api_model->privacy_policy();

        	if(!empty($vals))

			{

				$body=array('result'=>array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$vals));echo json_encode($body);

			}

			else

			{

				$body=array('result'=>array('message'=>'something went wrong please tyr after some time.','rstatus'=>0,'status'=>401));

				echo json_encode($body);

			}

		}

		else

		{

			$body=array('result'=>array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401));

			echo json_encode($body);

		}

	}

	public function UpdateUserToken()

	{

		$header=getallheaders();

    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='zokham')

		{

			$input=$_POST;

			//echo "<pre>";print_r($_POST);die;

        	$vals=$this->user_api_model->update_user_token($input);

        	if(!empty($vals))

			{

				$data=$this->user_api_model->get_user_by_id($input['tbl_user_id']);

				$body=array('result'=>array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$data));echo json_encode($body);

			}

			else

			{

				$body=array('result'=>array('message'=>'nothing to update...','rstatus'=>0,'status'=>401));

				echo json_encode($body);

			}

		}

		else

		{

			$body=array('result'=>array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401));

			echo json_encode($body);

		}

	}



	public function ForgotPassword()
	{
		$header=getallheaders();
    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='wahidfix')
		{
			$inputJSON = file_get_contents('php://input');
			$input= json_decode($inputJSON, TRUE);
        	$vals=$this->user_api_model->get_user_by_email($input['tbl_user_email']);
        	if(!empty($vals))
			{
				$token = openssl_random_pseudo_bytes(16);
				$token = bin2hex($token);
				$res=$this->user_api_model->update_token_to_email($token,$input['tbl_user_email']);
		        //$to = 'zokham8989@gmail.com';
		        $to=$vals['tbl_user_email'];
		        $from = 'info@wahidfix.com';
		        $fromName = 'Wahidfix';
		        $subject = 'Password Reset by Wahidfix'; 
		        $link='<a href="http://wahidfix.com/Forgot_password/token/'.$token.'">Reset Password</a>';
		        $htmlContent = 'Someone requested a password reset for your account. If this was not you, please disregard this email. If you\'d like to continue click the link below.'.$link.'This link will expire in 20 minutes.';
		        $headers = "From: $fromName"." <".$from.">";
		        $semi_rand = md5(time()); 
		        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
		        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";
		        $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
		        "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";
                $message .= "--{$mime_boundary}\n";
		        $message .= "--{$mime_boundary}--";
		        $returnpath = "-f" . $from;
		        $mail = @mail($to, $subject, $message, $headers, $returnpath);
				//echo "<pre>";print_r($vals);die;
				$body=array('message'=>'We have sent you an Email Please check your inbox.','rstatus'=>1,'status'=>200,'data'=>array());
				echo json_encode($body);
			}
			else
			{
				$body=array('message'=>'Email Address is not registered with us.','rstatus'=>0,'status'=>200,'data'=>array());
				echo json_encode($body);
			}
		}
		else
		{
			$body=array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401);
			echo json_encode($body);
		}
	}

	public function UpdateCompanyToken()
	{
		$header=getallheaders();
    	if(!empty($header['X-Api-Key']) && $header['X-Api-Key']=='zokham')
		{
			$input=$_POST;
			//echo "<pre>";print_r($_POST);die;
        	$vals=$this->user_api_model->update_company_token($input);
        	if(!empty($vals))
			{
				$data=$this->user_api_model->get_company_by_id($input['company_id']);
				$body=array('result'=>array('message'=>'OK','rstatus'=>1,'status'=>200,'data'=>$data));echo json_encode($body);
			}
			else

			{

				$body=array('result'=>array('message'=>'nothing to update...','rstatus'=>0,'status'=>401));

				echo json_encode($body);

			}

		}

		else

		{

			$body=array('result'=>array('message'=>'Unautorized user access.','rstatus'=>0,'status'=>401));

			echo json_encode($body);

		}

	}



	public function Android($row,$row1,$cid)
	{
		$token_id=$row['tbl_user_device_token'];
		$registrationIds = array($token_id);
		// prep the bundle
		$msg = array
		(
			'message' 	=> 'Hello '.$row['tbl_user_name'].' The company '.$row1['company_name'].' from '.$row1['company_address'].' wants to hire you please reply here As Soon As Possible...',
			'title'		=> 'Hire Notification',
			'subtitle'	=> '',
			'vibrate'	=> 1,
			'sound'		=> 1,
			'largeIcon'	=> 'large_icon',
			'smallIcon'	=> $row1['company_logo_iamge']
		);
		$this->user_api_model->insert_user_notification($row['tbl_user_id'],$row1['company_id'],$msg['message'],$cid,$type='hire');
		$fields = array
		(
			'registration_ids' 	=> $registrationIds,
			'data'			=> $msg
		);
		$headers = array
		(
			'Authorization: key=' . API_ACCESS_KEY,
			'Content-Type: application/json'
		);
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
		//echo $result;
	}
}