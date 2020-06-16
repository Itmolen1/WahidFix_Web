<?php
	//wahidfix
	class User_api_model extends CI_Model 
	{
		public function __construct() 
		{
			parent::__construct();
			$this->load->database();
		}

		public function get_slider_list()
		{
			$this->db->select('BaseTbl.slider_id, BaseTbl.slider_image,BaseTbl.slider_image_alt,BaseTbl.created_at');
	        //$this->db->select('sub_service_id, service_id, sub_service_name');
	        $this->db->from('tbl_slider as BaseTbl');
	        $this->db->where('isDeleted',0);
	        //$this->db->join('tbl_sub_services as s', 's.service_id = BaseTbl.service_id','left');
	        //comment
	        $query = $this->db->get();
	        return $query->result_array();
		}

		public function admin_assign_order($data)
		{
			$this->db->select('status_history');
	        $this->db->from('tbl_service_request');
	        $this->db->where('sr_id',$data['sr_id']);
	        $query = $this->db->get();
	        $res=$query->row_array();
	        //echo "<pre>";print_r($res);die;

	        $res=json_decode($res['status_history'],true);
	        //echo "<pre>";print_r($res);die;
	        $ctime=date('Y-m-d H:i:s');
	        $res[]=array('status_name'=>'Assigned','status_time'=>$ctime);
			$res=json_encode($res);
	        //echo "<pre>";print_r($res);die;

	        $this->db->set('assigned_emp_id',$data['assigned_emp_id']);
	        $this->db->set('assigned_admin_id',$data['assigned_admin_id']);
	        $this->db->set('status',3);
	        $this->db->set('status_history',$res);
	        $this->db->set('updated_at',$ctime);
	        $this->db->where('sr_id', $data['sr_id']);
	        $this->db->update('tbl_service_request');
	        //echo $this->db->last_query();die;
	        return TRUE;
		}

		public function insert_sr_docs($val,$tfile)
		{
			$data=array(
		        'sr_id'=>$val['sr_id'],
		        'is_image'=>$val['is_image'],
		        'sr_docs_type'=>$val['sr_docs_type'],
		        'sr_docs_url'=>$tfile,
		        'creatd_at'=>date('Y-m-d H:i:s')
		       );
	        $this->db->insert('sr_docs', $data); 
	        $lid=$this->db->insert_id();
	        return $lid;
		}

		public function get_emp_all_docs_by_sr_id($sr_id)
		{
			$this->db->select('sr_docs_id,sr_id,is_image,sr_docs_url');
			$query=$this->db->get_where('sr_docs',array('sr_id'=>$sr_id,'sr_docs_type'=>0));
			$result=$query->result_array();
			return $result;
		}

		public function get_emp_all_docs_by_sr_id_type($sr_id,$sr_docs_type)
		{
			$this->db->select('sr_docs_id,sr_id,sr_docs_url');
			$query=$this->db->get_where('sr_docs',array('sr_id'=>$sr_id,'sr_docs_type'=>$sr_docs_type));
			$result=$query->result_array();
			return $result;
		}

		public function remove_all_emp_docs_by_sr_id_type($sr_id,$sr_docs_type)
		{
			$this->db->where('sr_id',$sr_id);
			$this->db->where('sr_docs_type',$sr_docs_type);
			$query=$this->db->delete('sr_docs');
			return $this->db->affected_rows();
		}

		public function admin_add_employee($val,$idimg,$img1)
		{			 
			$se=base64_encode(serialize(explode(',', $val['tbl_employee_skills'])));
			$data=array(
		        'tbl_employee_name'=>$val['tbl_employee_name'],
		        'tbl_employee_email'=>$val['tbl_employee_email'],
		        'tbl_employee_mobile'=>$val['tbl_employee_mobile'],
		        'tbl_employee_password'=>$val['tbl_employee_password'],
		        'tbl_employee_id_card'=>$idimg,
		        'tbl_employee_image'=>$img1,
		        'tbl_employee_status'=>$val['tbl_employee_email'],
		        'tbl_employee_basic_salary'=>$val['tbl_employee_basic_salary'],
		        'tbl_employee_doj'=>$val['tbl_employee_doj'],
		        'tbl_employee_emegency_contact'=>$val['tbl_employee_emegency_contact'],
		        'tbl_employee_notes'=>$val['tbl_employee_notes'],
		        'tbl_employee_nationality'=>$val['tbl_employee_nationality'],
		        'tbl_employee_skills'=>$se,
		        'tbl_employee_created_at'=>date('Y-m-d H:i:s'),
		        'tbl_employee_updated_at'=>date('Y-m-d H:i:s'),
		       );
	        $this->db->insert('tbl_employee', $data); 
	        $lid=$this->db->insert_id();
	        //echo $this->db->last_query();die;
	        return $lid;
		}

		public function admin_update_employee($val,$idimg,$img1)
		{			 
			$se=base64_encode(serialize(explode(',', $val['tbl_employee_skills'])));
			if($idimg!='')
			{
				$this->db->set('tbl_employee_id_card',$idimg);
			}
			if($img1!='')
			{
				$this->db->set('tbl_employee_image',$img1);
			}
	        $this->db->set('tbl_employee_name',$val['tbl_employee_name']);
	        //$this->db->set('tbl_employee_email',$val['tbl_employee_email']);
	        $this->db->set('tbl_employee_mobile',$val['tbl_employee_mobile']);
	        //$this->db->set('tbl_employee_password',$val['tbl_employee_password']);
	        //$this->db->set('tbl_employee_status',$val['tbl_employee_status']);
	        $this->db->set('tbl_employee_basic_salary',$val['tbl_employee_basic_salary']);
	        $this->db->set('tbl_employee_doj',$val['tbl_employee_doj']);
	        $this->db->set('tbl_employee_emegency_contact',$val['tbl_employee_emegency_contact']);
	        $this->db->set('tbl_employee_notes',$val['tbl_employee_notes']);
	        $this->db->set('tbl_employee_nationality',$val['tbl_employee_nationality']);
	        $this->db->set('tbl_employee_latitude',$val['tbl_employee_latitude']);
	        $this->db->set('tbl_employee_longitude',$val['tbl_employee_longitude']);
	        $this->db->set('tbl_employee_skills',$se);
	        $this->db->set('tbl_employee_updated_at',date('Y-m-d H:i:s'));
	        $this->db->where('tbl_employee_id',$val['tbl_employee_id']); 
	        $lid=$this->db->update('tbl_employee');
	        //echo $this->db->last_query();die;
	        return $lid;
		}

		public function admin_delete_employee($data)
		{
			$this->db->set('isDeleted',1);
	        $this->db->where('tbl_employee_id',$data['tbl_employee_id']); 
	        $lid=$this->db->update('tbl_employee');
	        return 1;
		}

		function check_admin_order_reports_data($input)
		{
			if(isset($input['report_type']) && $input['report_type']=='order_report')
			{
				$this->db->select('sr.*,emp.tbl_employee_name,user.tbl_user_name,sm.sales_master_grand_total');
				$this->db->from('tbl_service_request as sr');
				$this->db->where('sr.isDeleted',0);
				if(isset($input['status']) && $input['status']!='all')
				{
					//echo "coming";die;
					$this->db->where('sr.status',$input['status']);
				}
				$this->db->join('tbl_employee as emp','emp.tbl_employee_id=sr.assigned_emp_id','left');
				$this->db->join('tbl_sales_master as sm','sm.sales_quotation_sr_id=sr.sr_id','left');
				$this->db->join('tbl_user as user','user.tbl_user_id=sr.tbl_user_id');
				$this->db->order_by('sr.created_at','ASC');
				$query = $this->db->get();
		        $row=$query->result_array();
		        //echo "<pre>";print_r($row);die;

		        if(!empty($row))
				{
					for($i=0;$i<count($row);$i++)
					{
						$this->db->select('BaseTbl.*,s.service_name,s.service_desc,s.service_logo');
				        $this->db->from('tbl_service_request_boi as BaseTbl');
				        $this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
				        $this->db->where('sr_id',$row[$i]['sr_id']);
				        $query1=$this->db->get();
				        $row1=$query1->result_array();
						$row[$i]['service_list']=$row1;
						$title=array_column($row1, 'service_name');
						$row[$i]['services_name']=implode(', ',$title);
					}	
					//echo "<pre>dsf";print_r($row);die;
				}
				//echo "<pre>";print_r($row);die;

		        return $row;
		    }

		}

		function check_admin_employee_reports_data($input)
		{
			if(isset($input['report_type']) && $input['report_type']=='employee_report')
			{
				$this->db->select('sr.*,user.tbl_user_name,emp.tbl_employee_name');//,,sm.sales_master_grand_total
				$this->db->from('tbl_service_request as sr');
				$this->db->where('sr.isDeleted',0);
				$this->db->where('sr.assigned_emp_id !=',0);
				if(isset($input['status']) && $input['status']!='all')
				{
					//echo "coming";die;
					$this->db->where('sr.status',$input['status']);
				}
				$this->db->join('tbl_employee as emp','emp.tbl_employee_id=sr.assigned_emp_id','left');
				//$this->db->join('tbl_sales_master as sm','sm.sales_quotation_sr_id=sr.sr_id');
				$this->db->join('tbl_user as user','user.tbl_user_id=sr.tbl_user_id');
				$this->db->order_by('sr.created_at','ASC');
				//$this->db->group_by('sr.assigned_emp_id'); 
				$query = $this->db->get();
		        $row=$query->result_array();
		        echo $this->db->last_query();die;
		        echo "<pre>";print_r($row);die;

		        if(!empty($row))
				{
					for($i=0;$i<count($row);$i++)
					{
						$this->db->select('BaseTbl.*,s.service_name,s.service_desc,s.service_logo');
				        $this->db->from('tbl_service_request_boi as BaseTbl');
				        $this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
				        $this->db->where('sr_id',$row[$i]['sr_id']);
				        $query1=$this->db->get();
				        $row1=$query1->result_array();
						$row[$i]['service_list']=$row1;
						$title=array_column($row1, 'service_name');
						$row[$i]['services_name']=implode(', ',$title);
					}	
					//echo "<pre>dsf";print_r($row);die;
				}
				//echo "<pre>";print_r($row);die;

		        return $row;
		    }

		}

		public function admin_list_employee($limit,$offset,$serachKey)
		{
			$offset=$offset-1;
			$offset=$offset*$limit;
			if($serachKey!='')
			{
				$this->db->like('tbl_employee_name',$serachKey);
			}
			$this->db->select('tbl_employee_id,tbl_employee_name,tbl_employee_email,tbl_employee_mobile,tbl_employee_status,tbl_employee_image,tbl_employee_id_card,tbl_employee_skills,tbl_employee_basic_salary,tbl_employee_doj,tbl_employee_emegency_contact,tbl_employee_notes,tbl_employee_nationality,tbl_employee_latitude,tbl_employee_longitude,');
	        $this->db->from('tbl_employee');
	        $this->db->limit($limit,$offset);
	        $this->db->order_by('tbl_employee_id','DESC');
	        $this->db->where('isDeleted',0);
	        $query = $this->db->get();
	        $all=$query->result_array();

	        $emp_list=array();
	        for($i=0;$i<count($all);$i++)
	        {
	            $ar1=unserialize(base64_decode($all[$i]['tbl_employee_skills']));
	            //echo "<pre>";print_r($ar1);die;

	            $this->db->select('service_name');
	            $this->db->from('tbl_services');
	            $this->db->where('isDeleted',0);
	            $this->db->where_in('service_id', $ar1);
	            $query=$this->db->get();
	            $result=$query->result_array();
	            //echo "<pre>";print_r($result);die;
	            $all[$i]['tbl_employee_skills']=array_column($result, 'service_name');
	        }
            return $all;
		}

		public function get_admin_list_employee()
		{
			$this->db->select('tbl_employee_id,tbl_employee_name,tbl_employee_email,tbl_employee_mobile,tbl_employee_status,tbl_employee_image,tbl_employee_id_card,tbl_employee_skills,tbl_employee_basic_salary,tbl_employee_doj,tbl_employee_emegency_contact,tbl_employee_notes,tbl_employee_nationality,tbl_employee_latitude,tbl_employee_longitude,');
	        $this->db->from('tbl_employee');
	        //$this->db->limit($limit,$offset);
	        $this->db->order_by('tbl_employee_id','DESC');
	        $this->db->where('isDeleted',0);
	        $query = $this->db->get();
	        $all=$query->result_array();

	        $emp_list=array();
	        for($i=0;$i<count($all);$i++)
	        {
	            $ar1=unserialize(base64_decode($all[$i]['tbl_employee_skills']));
	            //echo "<pre>";print_r($ar1);die;

	            $this->db->select('service_name');
	            $this->db->from('tbl_services');
	            $this->db->where('isDeleted',0);
	            $this->db->where_in('service_id', $ar1);
	            $query=$this->db->get();
	            $result=$query->result_array();
	            //echo "<pre>";print_r($result);die;
	            $all[$i]['tbl_employee_skills']=array_column($result, 'service_name');
	        }
            return $all;
		}

		public function get_item_category_list()
		{
			$this->db->select('item_category_id,item_category_name');
	        $this->db->from('tbl_item_category');
	        $this->db->where('isDeleted',0);
	        $query = $this->db->get();
	        return $query->result_array();
		}

		public function get_time_slot_list()
		{
			$this->db->select('time_slot_id,time_slot_name');
	        $query = $this->db->get_where('tbl_time_slot',array('isDeleted'=>0));
	        return $query->result_array();
		}

		function loginMe($email, $password)
	    {
	        $this->db->select('BaseTbl.userId, BaseTbl.password, BaseTbl.name, BaseTbl.roleId');
	        $this->db->from('tbl_users as BaseTbl');
	        $this->db->where('BaseTbl.email', $email);
	        $this->db->where('BaseTbl.isDeleted', 0);
	        $query = $this->db->get();
	        
	        $user = $query->row_array();
	        //echo "<pre>";print_r($user);die;
	        if(!empty($user)){
	            if(verifyHashedPassword($password, $user['password'])){
	                return $user;
	            } else {
	                return array();
	            }
	        } else {
	            return array();
	        }
	    }

		public function version_check($v)
		{
			$query = $this->db->get_where('app_version', array('virsion_id' => 1));
			$row = $query->row_array();
			if($row['virsion']==$v)
				return 1;
			else
				return 0;
		}		

		public function user_add($data)
		{
			$value=array(
				'tbl_user_name'=>$data['tbl_user_name'],
				'tbl_user_mobile'=>$data['tbl_user_mobile'],
				'tbl_user_email'=>$data['tbl_user_email'],
				'tbl_user_password'=>$data['tbl_user_password'],
				'tbl_user_createdat'=>date('Y-m-d H:i:s'),
				'tbl_user_updatedat'=>date('Y-m-d H:i:s')
				);
			$this->db->insert('tbl_user', $value); 
			$lid=$this->db->insert_id();
			return $lid;
		}

		public function get_return_admin_data($id,$devid=null)
		{
			//echo "<pre>";print_r($devid);die;
			$row=array();
			if($devid!=null)
			{
				$this->db->select('tbl_users_device_id,tbl_users_platform,tbl_users_device_token');
				$query=$this->db->get_where('tbl_users_devices',array('userId'=>$id,'tbl_users_device_id'=>$devid));
				$row = $query->row_array();
            	//return $row;
			}
			//\echo "<pre>";print_r($row);die;
			$this->db->select('userId,email,name,mobile,roleId');
			$query = $this->db->get_where('tbl_users', array('userId' => $id));
			$row1 = $query->row_array();
			if($devid==null)
			{
				return $row1;
			}
			else
			{
				$row=array_merge($row,$row1);
            	return $row;
			}
		}

		public function location_test($data)
		{
			$value=array(
				'tbl_user_id'=>$data['tbl_user_id'],
				'sr_id'=>$data['sr_id'],
				'service_track_latitude'=>$data['service_track_latitude'],
				'service_track_longitude'=>$data['service_track_longitude'],
				'createdat'=>date('Y-m-d H:i:s')
				);
			$this->db->insert('tbl_service_track', $value); 
			$lid=$this->db->insert_id();
			return $lid;
		}

		public function user_device_add($data,$userid)
		{
			$value=array(
				'tbl_user_id'=>$userid,
				'tbl_user_device_id'=>$data['tbl_user_device_id'],
				'tbl_user_platform'=>$data['tbl_user_platform'],
				'tbl_user_device_token'=>$data['tbl_user_device_token'],
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
				'isDeleted'=>0
				);

			$this->db->insert('tbl_user_devices', $value); 

			$lid=$this->db->insert_id();

			return $lid;

		}



		function get_details_for_bio($sqid)

		{

			if($sqid)

			{				

				$this->db->select('s.sales_quotation_boi_id,s.item_master_id,i.item_master_name,s.item_unit_id,u.item_unit_name,s.sales_quotation_boi_qty,s.sales_quotation_boi_rate,s.sales_quotation_id');

				$this->db->from('tbl_sales_quotation_boi as s');

				$this->db->join('tbl_item_master as i','i.item_master_id=s.item_master_id');

				$this->db->join('tbl_item_unit as u','u.item_unit_id=s.item_unit_id');

				$this->db->where('s.sales_quotation_id',$sqid);

				$query = $this->db->get();

				$row = $query->result_array();

				return $row;				

			}

			else

			{

				return NULL;

			}

		}



		function get_details_for_sq_boi($sqid)

		{

			if(!empty($sqid))

			{				

				$this->db->select('s.sales_quotation_boi_id,s.item_master_id,i.item_master_name,s.item_unit_id,u.item_unit_name,s.sales_quotation_boi_qty,s.sales_quotation_boi_rate,s.sales_quotation_id,ic.item_category_id,ic.item_category_name,i.item_master_logo');

				$this->db->from('tbl_sales_quotation_boi as s');

				$this->db->join('tbl_item_master as i','i.item_master_id=s.item_master_id');

				$this->db->join('tbl_item_unit as u','u.item_unit_id=s.item_unit_id');

				$this->db->join('tbl_item_category as ic','ic.item_category_id=i.item_master_category');

				$this->db->where('s.sales_quotation_id',$sqid);

				$query = $this->db->get();

				$row = $query->result_array();

				//echo "<pre>";print_r($row);die;

				return $row;				

			}

			else

			{

				return NULL;

			}

		}



		function delete_boi_by_sqid($boid)

		{

			$this->db->where('sales_quotation_id', $boid);

			$this->db->delete('tbl_sales_quotation_boi');

			$res=$this->db->affected_rows();

			if($res)

				return 1;

			else

				return 0;

		}



		function get_details_for_sq($srid)

		{

			if(!empty($srid))

			{				

				$this->db->select('sr.sr_id,sr.tbl_user_id,sr.assigned_emp_id,u.tbl_user_name,e.tbl_employee_name');

				$this->db->from('tbl_service_request as sr');

				$this->db->join('tbl_user as u','u.tbl_user_id=sr.tbl_user_id');

				$this->db->join('tbl_employee as e','e.tbl_employee_id=sr.assigned_emp_id');

				$this->db->where('sr.sr_id',$srid);

				$query = $this->db->get();

				$row = $query->row_array();

				//echo "<pre>";print_r($row);die;

				return $row;				

			}

			else

			{

				return NULL;

			}

		}



		function update_device_details_by_uid($data)

		{

			$this->db->set('tbl_user_device_id',$data['tbl_user_device_id']);

			$this->db->set('tbl_user_device_type',$data['tbl_user_device_type']);

			$this->db->set('tbl_user_device_token',$data['tbl_user_device_token']);

			$this->db->where('tbl_user_email', $data['tbl_user_email']);

			$this->db->update('tbl_user');            

		}



		function update_device_details_by_email($data)

		{

			$this->db->set('tbl_user_device_id',$data['tbl_user_device_id']);

			$this->db->set('tbl_user_device_type',$data['tbl_user_device_type']);

			$this->db->set('tbl_user_device_token',$data['tbl_user_device_token']);

			$this->db->where('tbl_user_email', $data['tbl_user_email']);

			$this->db->update('tbl_user');            

		}

		public function user_get($userid,$devid=null)
		{
			$row=array();
			if($devid!=null)
			{
				$this->db->select('tbl_user_device_id,tbl_user_platform,tbl_user_device_token');
				$query=$this->db->get_where('tbl_user_devices',array('tbl_user_id'=>$userid,'tbl_user_device_id'=>$devid));
				$row = $query->row_array();
            	//return $row;
			}
			//echo "<pre>";print_r($row);die;
			$this->db->select('tbl_user_id,tbl_user_name,tbl_user_mobile,tbl_user_email,tbl_user_image,tbl_user_address');
			$query = $this->db->get_where('tbl_user', array('tbl_user_id' => $userid));
			$row1 = $query->row_array();
			if($devid==null)
			{
				return $row1;
			}
			else
			{
				$row=array_merge($row,$row1);
            	return $row;
			}
		}

		public function emp_get($tbl_employee_id)
		{
			$this->db->select('tbl_employee_id,tbl_employee_name,tbl_employee_mobile,tbl_employee_email,tbl_employee_image,tbl_emp_device_token,tbl_emp_device_id,tbl_emp_device_type');
			$query = $this->db->get_where('tbl_employee', array('tbl_employee_id' => $tbl_employee_id));
			$row1 = $query->row_array();
			return $row1;
		}

		function get_device_id_from_user_id($uid)
		{
			$this->db->select('tbl_user_device_id');
			$query=$this->db->get_where('tbl_user_devices',array('tbl_user_id'=>$uid));
			$row = $query->row_array();
			return $row;
		}

		function updte_user_device_details($uid,$device_id,$data)
		{
			$this->db->set('tbl_user_device_id',$data['tbl_user_device_id']);
			$this->db->set('tbl_user_platform',$data['tbl_user_platform']);
			$this->db->set('tbl_user_device_token',$data['tbl_user_device_token']);
			$this->db->where('tbl_user_id', $uid);
			$this->db->where('tbl_user_device_id', $device_id);
			$this->db->update('tbl_user_devices');
		}

		function get_user_id_from_emailid($emailid)
		{
			$this->db->select('tbl_user_id');
			$query=$this->db->get_where('tbl_user',array('tbl_user_email'=>$emailid));
			$row = $query->row_array();
			return $row;
		}

		public function add_sales_quotation($data)
		{
			$value=array(
				'sales_quotation_employee_id'=>$data['tbl_employee_id'],
				'sales_quotation_sr_id'=>$data['sr_id'],
				'sales_quotation_status'=>0,
				'isDeleted'=>0,
				'sales_quotation_created_at'=>date('Y-m-d H:i:s'),
				'sales_quotation_updated_at'=>date('Y-m-d H:i:s')
				);
			$this->db->insert('tbl_sales_quotation', $value); 
			$lid=$this->db->insert_id();
			return $lid;
		}

		public function update_sales_quotation($data)
		{
			$value=array(
				'sales_quotation_employee_id'=>$data['tbl_employee_id'],
				'sales_quotation_sr_id'=>$data['sr_id'],
				'sales_quotation_status'=>1,
				'isDeleted'=>0,
				'sales_quotation_pdf'=>'',
				'sales_quotation_updated_at'=>date('Y-m-d H:i:s')
				);
			$this->db->where('sales_quotation_id',$data['sales_quotation_id']);
			$this->db->update('tbl_sales_quotation',$value);			
		}

		public function add_sales_master($sqid)
		{
			$this->db->select('*');
			$query=$this->db->get_where('tbl_sales_quotation',array('sales_quotation_id'=>$sqid));
			$row = $query->row_array();
			//echo "<pre>";print_r($row);die;
			$value=array(
				'sales_quotation_id'=>$row['sales_quotation_id'],
				'sales_quotation_employee_id'=>$row['sales_quotation_employee_id'],
				'sales_quotation_sr_id'=>$row['sales_quotation_sr_id'],
				'sales_master_createdat'=>date('Y-m-d H:i:s'),
				'sales_master_updatedat'=>date('Y-m-d H:i:s'),
				'sales_master_status'=>0,
				'isDeleted'=>0
				);
			$this->db->insert('tbl_sales_master', $value); 
			$lid=$this->db->insert_id();
			//echo $this->db->last_query();die;
			return $lid;
		}

		public function add_sales_master_boi($sqid,$smid)
		{
			$this->db->select('*');
			$query=$this->db->get_where('tbl_sales_quotation_boi',array('sales_quotation_id'=>$sqid));
			$data = $query->result_array();
			//echo "r<pre>";print_r($row);die;
			for($i=0;$i<count($data);$i++)
			{
				$value=array(
				'sales_quotation_boi_id'=>$data[$i]['sales_quotation_boi_id'],
				'item_master_id'=>$data[$i]['item_master_id'],
				'item_unit_id'=>$data[$i]['item_unit_id'],
				'sales_master_boi_qty'=>$data[$i]['sales_quotation_boi_qty'],
				'sales_master_boi_rate'=>$data[$i]['sales_quotation_boi_rate'],
				'sales_master_id'=>$smid
				);
				$this->db->insert('tbl_sales_master_boi', $value);
			}
			return 1;			
		}

		function get_details_for_sales_master_boi($smid)
		{
			if(!empty($smid))
			{				
				$this->db->select('s.sales_quotation_boi_id,s.item_master_id,i.item_master_name,s.item_unit_id,u.item_unit_name,s.sales_master_boi_qty,s.sales_master_boi_rate,s.sales_master_id');
				$this->db->from('tbl_sales_master_boi as s');
				$this->db->join('tbl_item_master as i','i.item_master_id=s.item_master_id');
				$this->db->join('tbl_item_unit as u','u.item_unit_id=s.item_unit_id');
				$this->db->where('s.sales_master_id',$smid);
				$query = $this->db->get();
				$row = $query->result_array();
				//echo "<pre>";print_r($row);die;
				return $row;				
			}
			else
			{
				return NULL;
			}
		}

		public function get_sm($smid)
		{
			$this->db->select('*');
			$query=$this->db->get_where('tbl_sales_master',array('sales_master_id'=>$smid));
			$row = $query->row_array();
			return $row;
		}

		public function get_details_for_sm($srid)
		{
			if(!empty($smid))
			{				
				$this->db->select('sr.sr_id,sr.service_request_ref,sr.tbl_user_id,sr.assigned_emp_id,u.tbl_user_name,e.tbl_employee_name');
				$this->db->from('tbl_service_request as sr');
				$this->db->join('tbl_user as u','u.tbl_user_id=sr.tbl_user_id');
				$this->db->join('tbl_employee as e','e.tbl_employee_id=sr.assigned_emp_id');
				$this->db->where('sr.sr_id',$srid);
				$query = $this->db->get();
				$row = $query->row_array();
				//echo "<pre>";print_r($row);die;
				return $row;				
			}
			else
			{
				return NULL;
			}
		}

		function update_sm_signature_link($smid,$img)
		{
			/*image writing*/
			$target_path='';
			if($img)
			{
				$t=time()."_signature.JPG";
				$target_path=ADMIN_PATH.'assets/sm_user_signature/'.$t;
				//echo $target_path;die;
				//echo FCPATH;die;
				file_put_contents(FCPATH.'assets/sm_user_signature/'.$t,base64_decode($img));
			}
			/*image writing*/
			$this->db->set('sales_master_signature',$target_path);
			$this->db->where('sales_master_id', $smid);
			$this->db->update('tbl_sales_master');
			return $target_path;
		}

		function update_sm_pdf_link($smid,$url,$sales_master_grand_total)
		{
			$this->db->set('sales_master_grand_total',$sales_master_grand_total);
			$this->db->set('sales_master_pdf',$url);
			$this->db->where('sales_master_id', $smid);
			$this->db->update('tbl_sales_master');
		}

		function update_sq_pdf_link($sqid,$url,$sr_id,$grand_total)
		{
			$this->db->set('sales_quotation_pdf',$url);
			$this->db->where('sales_quotation_id', $sqid);
			$this->db->update('tbl_sales_quotation');

			$this->db->select('status_history');
	        $this->db->from('tbl_service_request');
	        $this->db->where('sr_id',$sr_id);
	        $query = $this->db->get();
	        $res=$query->row_array();
	        $res=json_decode($res['status_history'],true);
			$ctime=date('Y-m-d H:i:s');			
			$res[]=array('status_name'=>'Quotation Generated','status_time'=>$ctime);
			$res=json_encode($res);

			$this->db->set('status_history',$res);
			$this->db->set('pending_amount',$grand_total);
			$this->db->set('status',7);
			$this->db->set('isQuotation',1);
			$this->db->where('sr_id', $sr_id);
			$this->db->update('tbl_service_request');
		}



		public function add_sales_quotation_boi($data,$sqid)
		{
			for($i=0;$i<count($data);$i++)
			{
				$value=array(
				'item_master_id'=>$data[$i]['item_master_id'],
				'item_unit_id'=>$data[$i]['item_unit_id'],
				'sales_quotation_boi_qty'=>$data[$i]['sales_quotation_boi_qty'],
				'sales_quotation_boi_rate'=>$data[$i]['sales_quotation_boi_rate'],
				'sales_quotation_id'=>$sqid
				);
				$this->db->insert('tbl_sales_quotation_boi', $value);
			}			
		}

		public function schedule_service($data)
		{
			$refno=$this->get_refrence_no();
			$value=array(
				'tbl_user_id'=>$data['tbl_user_id'],
				'prefferd_date'=>$data['prefferd_date'],
				'prefferd_time'=>$data['prefferd_time'],
				'status'=>0,
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
				'service_request_ref'=>$refno,
				'status_history'=>json_encode(array(array('status_name'=>'New','status_time'=>date('Y-m-d H:i:s'))))
				);
			$this->db->insert('tbl_service_request', $value); 
			$lid=$this->db->insert_id();

			for($i=0;$i<count($data['service_request_boi']);$i++)
			{
				/*image writing*/
				$target_path='';
				if($data['service_request_boi'][$i]['service_image'])
				{
					$t=uniqid()."_service_request.JPG";
					$target_path=ADMIN_PATH.'assets/service_request/'.$t;
					//echo $target_path;die;
					//echo FCPATH;die;
					file_put_contents(FCPATH.'assets/service_request/'.$t,base64_decode($data['service_request_boi'][$i]['service_image']));
				}
				/*image writing*/
				$value=array(
				'sr_id'=>$lid,
				'service_id'=>$data['service_request_boi'][$i]['service_id'],
				'service_desc'=>$data['service_request_boi'][$i]['service_desc'],
				'service_image'=>$target_path
				);
				$this->db->insert('tbl_service_request_boi', $value);
			}
			return $lid;
		}

		function get_refrence_no()
	    {
	        $this->db->order_by('sr_id', 'DESC');
	        $query = $this->db->get('tbl_service_request', 1 );
	        $result=$query->row_array();
	        if(empty($result))
	        {
	            return 'ORD-'.str_pad(0+1,4,'0',STR_PAD_LEFT);
	        }
	        else
	        {
	            return 'ORD-'.str_pad($result['sr_id']+1, 4, '0', STR_PAD_LEFT);
	        }
	    }
	    
		public function service_history($user_id,$limit,$offset)
		{
			$offset=$offset-1;
			$offset=$offset*$limit;
		    $sql = "SELECT t.sr_id,t.service_request_ref,t.prefferd_date,ts.time_slot_name,t.status FROM tbl_service_request t  LEFT JOIN tbl_time_slot ts ON t.prefferd_time = ts.time_slot_id WHERE t.tbl_user_id = ".$user_id." ORDER BY t.sr_id DESC LIMIT ".$offset.",".$limit."";
		    //echo $sql;die;
			$query = $this->db->query($sql);
			$row=$query->result_array();

			$title='';
			if(!empty($row))
			{
				for($i=0;$i<count($row);$i++)
				{
					$this->db->select('BaseTbl.*,s.service_name,s.service_desc,s.service_logo');
			        $this->db->from('tbl_service_request_boi as BaseTbl');
			        $this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
			        $this->db->where('sr_id',$row[$i]['sr_id']);
			        $query1=$this->db->get();
			        $row1=$query1->result_array();
					$row[$i]['service_list']=$row1;
					$title=array_column($row1, 'service_name');
					$row[$i]['services_name']=implode(',',$title);
				}	
			}
			
			return $row;
		}

		public function support_add($data)
		{
			$value=array(
				'tbl_user_id'=>$data['tbl_user_id'],
				'company_id'=>$data['company_id'],
				'messge'=>$data['messge'],
				'date'=>date('Y-m-d H:i:s')
				);
			$this->db->insert('tbl_support', $value); 
			$lid=$this->db->insert_id();
			return $lid;
		}

		public function update_company_device_details($device_id,$device_type,$device_token,$mobile_number)
		{
			$values=array(
				'company_device_id'=>$device_id,
				'company_device_type'=>$device_type,
				'company_device_token'=>$device_token
			);
			$this->db->where('company_mobile_number', $mobile_number);
			$this->db->update('company_master', $values);
		}

		public function company_add($data)
		{
			$token = openssl_random_pseudo_bytes(16);
			$token = bin2hex($token);
			/*image writing*/
			$target_path='';
			if(!empty($data['company_logo_iamge']))
			{
				$t=time()."_profile.JPG";
				$target_path=COMPANY_PROFILE_IMAGE_PATH.$t;
				//echo $target_path;die;
				//echo FCPATH;die;
				file_put_contents(FCPATH.'uploads/company_profile/'.$t,base64_decode($data['company_logo_iamge']));
			}
			/*image writing*/

			$value=array(
				'company_name'=>$data['company_name'],
				'company_address'=>$data['company_address'],
				'company_mobile_number'=>$data['company_mobile_number'],
				'company_password'=>$data['company_password'],
				'company_email'=>$data['company_email'],
				'company_owner_name'=>$data['company_owner_name'],
				'company_total_emp'=>$data['company_total_emp'],
				'company_device_id'=>$data['company_device_id'],
				'company_device_type'=>$data['company_device_type'],
				'company_device_token'=>$data['company_device_token'],
				'company_category'=>$data['company_category'],
				'company_city'=>$data['company_city'],
				'company_created_date'=>date('Y-m-d H:i:s'),
				'company_updated_time'=>date('Y-m-d H:i:s'),
				'company_comm_token'=>$token,
				'company_logo_iamge'=>$target_path
				);
			$this->db->insert('company_master', $value); 
			$lid=$this->db->insert_id();
			return $lid;
		}

		function get_user_all_devices($userid)
		{
			$this->db->select('tbl_user_device_id,tbl_user_platform,tbl_user_device_token');
			$query = $this->db->get_where('tbl_user_devices', array('tbl_user_id' => $userid,'tbl_user_platform'=>'Android'));
			$row = $query->result_array();
            return $row;
		}

		function get_deviceid_by_user_id($userid)
		{
			$this->db->select('tbl_user_device_id');
			$query = $this->db->get_where('tbl_user_devices', array('tbl_user_id' => $userid));
			$row = $query->row_array();
            return $row;
		}

		function get_deviceid_by_employee_id($tbl_employee_id)
		{
			$this->db->select('tbl_emp_device_id');
			$query = $this->db->get_where('tbl_employee', array('tbl_employee_id' => $tbl_employee_id));
			$row = $query->row_array();
            return $row;
		}		

		function update_user_address($uid,$address)
		{
			$this->db->set('tbl_user_address',$address);
			$this->db->where('tbl_user_id', $uid);
			$this->db->update('tbl_user'); 
		}

		public function company_get($id)
		{
			$this->db->select('company_id,company_name,company_address,company_logo_iamge,company_visiting_card,company_owner_name,company_contact_person,company_mobile_number,company_category,company_email,company_website,company_total_emp,company_city');
			$query = $this->db->get_where('company_master', array('company_id' => $id));
			$row = $query->row_array();
            return $row;
		}		

		function my_task_list($empid)
		{
			//s.service_name,s.service_desc,s.service_logo
			$this->db->select('sr.sr_id,sr.service_request_ref,sr.prefferd_date,sr.prefferd_time,sr.created_at,sr.status,t.time_slot_name,sr.pending_amount');
			$this->db->where('assigned_emp_id', $empid);
			$this->db->where('sr.status !=',6);
			$this->db->order_by("sr.sr_id", "desc");
			//$this->db->where('isDeleted',0);
			$this->db->join('tbl_time_slot as t','t.time_slot_id=sr.prefferd_time');
			//$this->db->join('tbl_services as s','s.service_id=sr.service_id');
			$query = $this->db->get('tbl_service_request as sr');
			$row = $query->result_array();

			$title='';
			if(!empty($row))
			{
				for($i=0;$i<count($row);$i++)
				{
					$this->db->select('BaseTbl.*,s.service_name,s.service_logo');
			        $this->db->from('tbl_service_request_boi as BaseTbl');
			        $this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
			        $this->db->where('sr_id',$row[$i]['sr_id']);
			        $query1=$this->db->get();
			        $row1=$query1->result_array();
					$row[$i]['service_list']=$row1;
					$title=array_column($row1, 'service_name');
					$row[$i]['services_name']=implode(',',$title);
				}	
				//echo "<pre>dsf";print_r($row);die;
			}
			//echo "<pre>";print_r($row);die;
			//echo $this->db->last_query();die;
            return $row;
		}

		function emp_ordre_detail($sr_id)
		{
			$this->db->select('sr.sr_id,sr.service_request_ref,sr.prefferd_date,sr.prefferd_time,sr.created_at,sr.status,t.time_slot_name,sr.isQuotation,sr.tbl_user_id,u.tbl_user_name,u.tbl_user_mobile,u.tbl_user_email,u.tbl_user_latitude,u.tbl_user_longitude,u.tbl_user_place,u.tbl_user_image,u.tbl_user_address,sr.pending_amount');
			$this->db->where('sr.sr_id', $sr_id);
			//$this->db->where('isDeleted',0);
			$this->db->join('tbl_time_slot as t','t.time_slot_id=sr.prefferd_time');
			$this->db->join('tbl_user as u','u.tbl_user_id=sr.tbl_user_id');
			$query = $this->db->get('tbl_service_request as sr');
			$row = $query->row_array();
			//echo $this->db->last_query();die;
			//echo "<pre>dsf";print_r($row);die;
			if($row['isQuotation']==1)
			{
				$this->db->select('sales_quotation_pdf,sales_quotation_id');
				$this->db->where('sales_quotation_sr_id', $sr_id);
				$query1 = $this->db->get('tbl_sales_quotation');
				$row1 = $query1->row_array();
				$row=array_merge($row,$row1);
				//echo "<pre>dsf";print_r($row);die;
			}
			if($row['isQuotation']==2)
			{
				$this->db->select('sales_master_pdf as sales_quotation_pdf,sales_master_id as sales_quotation_id');
				$this->db->where('sales_quotation_sr_id', $sr_id);
				$query1 = $this->db->get('tbl_sales_master');
				$row1 = $query1->row_array();
				$row=array_merge($row,$row1);
				//echo "<pre>dsf";print_r($row);die;
			}

			if($row)
			{
				$this->db->select('BaseTbl.*,s.service_name,s.service_logo');
		        $this->db->from('tbl_service_request_boi as BaseTbl');
		        $this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
		        $this->db->where('sr_id',$row['sr_id']);
		        $query3=$this->db->get();
		        $row3=$query3->result_array();
				$row['service_list']=$row3;
				$title=array_column($row3, 'service_name');
				$row['services_name']=implode(',',$title);				
			}
            return $row;
		}

		function get_eligible_emp_list($sr_id)
		{
			$this->db->select('BaseTbl.*,s.*');
	        $this->db->from('tbl_service_request_boi as BaseTbl');
	        $this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
	        $this->db->where('sr_id',$sr_id);
	        $query1=$this->db->get();
	        $row=$query1->result_array();
	        //echo "<pre>";print_r($row);die;

	        $this->db->select('BaseTbl.tbl_employee_id,BaseTbl.tbl_employee_name,BaseTbl.tbl_employee_email,BaseTbl.tbl_employee_mobile,BaseTbl.tbl_employee_status,BaseTbl.tbl_employee_image,BaseTbl.tbl_employee_skills');
	        $this->db->from('tbl_employee as BaseTbl');
	        $this->db->where('BaseTbl.tbl_employee_status',0);
	        $query = $this->db->get();
	        $all=$query->result_array();
	        //echo "<pre>dsf";print_r($all);die;
	        $emp_list=array();
	        for($i=0;$i<count($all);$i++)
	        {
	            $ar1=unserialize(base64_decode($all[$i]['tbl_employee_skills']));
	            //echo "<pre>";print_r($ar1);die;

	            $this->db->select('service_name');
	            $this->db->from('tbl_services');
	            $this->db->where('isDeleted',0);
	            $this->db->where_in('service_id', $ar1);
	            $query=$this->db->get();
	            $result=$query->result_array();
	            //echo "<pre>";print_r($result);die;
	            $all[$i]['tbl_employee_skills']=array_column($result, 'service_name');
	            if(in_array($row[0]['service_id'],$ar1))
	            {
	                //echo "ye0";die;
	                $emp_list[]=$all[$i];
	            }
	        }
	        //echo "<pre>";print_r($emp_list);die;
	        return $emp_list;
		}

		function user_ordre_detail($sr_id)
		{

			$this->db->select('sr.sr_id,sr.status_history,sr.service_request_ref,sr.prefferd_date,sr.prefferd_time,sr.created_at,sr.status,t.time_slot_name,sr.isQuotation,sr.tbl_user_id,u.tbl_user_name,u.tbl_user_mobile,u.tbl_user_email,u.tbl_user_latitude,u.tbl_user_longitude,u.tbl_user_place,u.tbl_user_image,u.tbl_user_address,sr.pending_amount,sr.assigned_emp_id');
			$this->db->where('sr.sr_id', $sr_id);
			//$this->db->where('isDeleted',0);
			$this->db->join('tbl_time_slot as t','t.time_slot_id=sr.prefferd_time');
			$this->db->join('tbl_user as u','u.tbl_user_id=sr.tbl_user_id');
			//$this->db->join('tbl_employee as emp','emp.tbl_employee_id=sr.assigned_emp_id');
			$query = $this->db->get('tbl_service_request as sr');
			$row = $query->row_array();
			//echo "<pre>";print_r($row);die;
			if($row)
			{
				$this->db->select('BaseTbl.*,s.service_name,s.service_logo');
		        $this->db->from('tbl_service_request_boi as BaseTbl');
		        $this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
		        $this->db->where('sr_id',$row['sr_id']);
		        $query3=$this->db->get();
		        $row3=$query3->result_array();
				$row['service_list']=$row3;	
				$title=array_column($row3, 'service_name');
				$row['services_name']=implode(',',$title);			
			}
			//echo $this->db->last_query();die;
			//echo "<pre>dsf";print_r($row);die;
			if($row['isQuotation']==1)
			{
				$this->db->select('sales_quotation_pdf,sales_quotation_id');
				$this->db->where('sales_quotation_sr_id', $sr_id);
				$query1 = $this->db->get('tbl_sales_quotation');
				$row1 = $query1->row_array();
				$row=array_merge($row,$row1);
				//echo "<pre>dsf";print_r($row);die;
			}
			if($row['isQuotation']==2)
			{
				$this->db->select('sales_master_pdf as sales_quotation_pdf,sales_master_id as sales_quotation_id');
				$this->db->where('sales_quotation_sr_id', $sr_id);
				$query1 = $this->db->get('tbl_sales_master');
				$row1 = $query1->row_array();
				$row=array_merge($row,$row1);
				//echo "<pre>dsf";print_r($row);die;
			}
			if($row['assigned_emp_id']!=0)
			{
				$this->db->select('tbl_employee_name,tbl_employee_email,tbl_employee_mobile,tbl_employee_image');
				$this->db->where('tbl_employee_id', $row['assigned_emp_id']);
				$query2 = $this->db->get('tbl_employee');
				$row2 = $query2->row_array();
				$row=array_merge($row,$row2);
			}
			else
			{
				$row2=array('tbl_employee_name'=>null,'tbl_employee_email'=>null,'tbl_employee_mobile'=>null,'tbl_employee_image'=>null);
				$row=array_merge($row,$row2);
			}
            return $row;
		}	

		function get_user_password($data)
		{
			$this->db->select('tbl_user_id,tbl_user_password');
			$query = $this->db->get_where('tbl_user', array('tbl_user_id' => $data['tbl_user_id'],'tbl_user_password'=>$data['tbl_user_password_old']));
			$row = $query->row_array();
			//echo $this->db->last_query();die;
            return $row;
		}

		function get_employee_password($data)
		{
			$this->db->select('tbl_employee_id,tbl_employee_password');
			$query = $this->db->get_where('tbl_employee', array('tbl_employee_id' => $data['tbl_employee_id'],'tbl_employee_password'=>$data['tbl_employee_password_old']));
			$row = $query->row_array();
            return $row;
		}

		function update_user_password($data)
		{
			$this->db->set('tbl_user_password',$data['tbl_user_password']);
			$this->db->where('tbl_user_password', $data['tbl_user_password_old']);
			$this->db->where('tbl_user_id', $data['tbl_user_id']);
			$this->db->update('tbl_user');
			//echo $this->db->last_query();die;
			return 1;
		}

		function confirm_sales_quotation($sr_id)
		{
			$this->db->select('status_history');
			$this->db->from('tbl_service_request');
			$this->db->where('sr_id',$sr_id);
			$query = $this->db->get();
			$res=$query->row_array();

			$res=json_decode($res['status_history'],true);
			$ctime=date('Y-m-d H:i:s');
			$res[]=array('status_name'=>'Quotation Confirmed','status_time'=>$ctime);
			$res=json_encode($res);

			$this->db->set('status_history',$res);
			$this->db->set('status',8);
			$this->db->where('sr_id', $sr_id);
			$this->db->update('tbl_service_request');
			//echo $this->db->last_query();die;

			$result=$this->get_admin_order_detail($sr_id);
			return $result;
		}

		function update_employee_password($data)
		{
			$this->db->set('tbl_employee_password',$data['tbl_employee_password']);
			$this->db->where('tbl_employee_password', $data['tbl_employee_password_old']);
			$this->db->where('tbl_employee_id', $data['tbl_employee_id']);
			$this->db->update('tbl_employee');
			//echo $this->db->last_query();die;
			return 1;
		}

		function task_accept_reject($input)
		{
			$this->db->select('status_history');
	        $this->db->from('tbl_service_request');
	        $this->db->where('sr_id',$input['sr_id']);
	        $query = $this->db->get();
	        $res=$query->row_array();
	        $res=json_decode($res['status_history'],true);
			$ctime=date('Y-m-d H:i:s');
			if($input['isAccept']==1)
			{				
		        $res[]=array('status_name'=>'Inprogress','status_time'=>$ctime);
				$res=json_encode($res);
        		$this->db->set('status_history',$res);
				$this->db->set('status',4);
				$this->db->where('sr_id', $input['sr_id']);
				$this->db->update('tbl_service_request');

				$this->db->set('tbl_employee_status',1);
				$this->db->where('tbl_employee_id', $input['tbl_employee_id']);
				$this->db->update('tbl_employee');
				return 1;
			}
			else
			{
				$res[]=array('status_name'=>'Employee Rejected','status_time'=>$ctime);
				$res=json_encode($res);
				$this->db->set('status_history',$res);
				$this->db->set('assigned_emp_id',0);
				$this->db->set('reject_emp_id',$input['tbl_employee_id']);
				$this->db->set('status',1);
				$this->db->where('sr_id', $input['sr_id']);
				$this->db->update('tbl_service_request');
				return 0;
			}			
		}

		function emp_arrived_at_customer_place($input)
		{
			$this->db->select('status_history');
	        $this->db->from('tbl_service_request');
	        $this->db->where('sr_id',$input['sr_id']);
	        $query = $this->db->get();
	        $res=$query->row_array();
	        $res=json_decode($res['status_history'],true);
			$ctime=date('Y-m-d H:i:s');			
			$res[]=array('status_name'=>'Employee Arrived At Customer Place','status_time'=>$ctime);
			$res=json_encode($res);
			$this->db->set('status_history',$res);
			$this->db->set('status',5);
			$this->db->where('sr_id', $input['sr_id']);
			$this->db->update('tbl_service_request');
			return 1;						
		}

		function emp_started_inspection($input)
		{
			$this->db->select('status_history');
	        $this->db->from('tbl_service_request');
	        $this->db->where('sr_id',$input['sr_id']);
	        $query = $this->db->get();
	        $res=$query->row_array();
	        $res=json_decode($res['status_history'],true);
			$ctime=date('Y-m-d H:i:s');			
			$res[]=array('status_name'=>'Employee Started Inspection','status_time'=>$ctime);
			$res=json_encode($res);

			$this->db->set('status_history',$res);
			$this->db->set('status',6);
			$this->db->where('sr_id', $input['sr_id']);
			$this->db->update('tbl_service_request');
			return 1;						
		}

		function emp_job_started($input)
		{
			$this->db->select('status_history');
	        $this->db->from('tbl_service_request');
	        $this->db->where('sr_id',$input['sr_id']);
	        $query = $this->db->get();
	        $res=$query->row_array();
	        $res=json_decode($res['status_history'],true);
			$ctime=date('Y-m-d H:i:s');			
			$res[]=array('status_name'=>'Job Started','status_time'=>$ctime);
			$res=json_encode($res);
			$this->db->set('status_history',$res);
			$this->db->set('status',9);
			$this->db->where('sr_id', $input['sr_id']);
			$this->db->update('tbl_service_request');
			return 1;						
		}

		function emp_job_completed($input)
		{
			$this->db->select('status_history');
	        $this->db->from('tbl_service_request');
	        $this->db->where('sr_id',$input['sr_id']);
	        $query = $this->db->get();
	        $res=$query->row_array();
	        $res=json_decode($res['status_history'],true);
			$ctime=date('Y-m-d H:i:s');			
			$res[]=array('status_name'=>'Job Completed','status_time'=>$ctime);
			$res=json_encode($res);
			$this->db->set('status_history',$res);
			$this->db->set('status',10);
			$this->db->where('sr_id', $input['sr_id']);
			$this->db->update('tbl_service_request');
			return 1;						
		}

		function get_user_all_dev_by_sr_id($sr_id)
		{
			$this->db->select('tbl_user_id,assigned_emp_id,service_request_ref');
			$this->db->from('tbl_service_request');
			$this->db->where('isDeleted',0);
			$this->db->where('sr_id',$sr_id);
			$query=$this->db->get();
			$result=$query->row_array();
			$result['assigned_emp_id']=$result['assigned_emp_id'];
			$result['service_request_ref']=$result['service_request_ref'];

			$this->db->select('tbl_user_device_id,tbl_user_platform,tbl_user_device_token');
			$this->db->from('tbl_user_devices');
			$this->db->where('isDeleted',0);
			$this->db->where('tbl_user_platform','Android');
			$this->db->where('tbl_user_id',$result['tbl_user_id']);
			$query=$this->db->get();
			$result['Android']=$query->result_array();

			$this->db->select('tbl_user_device_id,tbl_user_platform,tbl_user_device_token');
			$this->db->from('tbl_user_devices');
			$this->db->where('isDeleted',0);
			$this->db->where('tbl_user_platform','iOS');
			$this->db->where('tbl_user_id',$result['tbl_user_id']);
			$query=$this->db->get();
			$result['iOS']=$query->result_array();
			return $result;
			//echo "<pre>";print_r($result);die;
		}

		function get_all_managers_devices_by_role_id()
		{
			$this->db->select('tbl_users_devices_id,tbl_users_device_id,tbl_users_platform,tbl_users_device_token');
			$this->db->from('tbl_users_devices');
			$this->db->where('isDeleted',0);
			$this->db->where('tbl_users_platform','Android');
			$this->db->where('roleId',2);
			$query=$this->db->get();
			$result['Android']=$query->result_array();

			$this->db->select('tbl_users_devices_id,tbl_users_device_id,tbl_users_platform,tbl_users_device_token');
			$this->db->from('tbl_users_devices');
			$this->db->where('isDeleted',0);
			$this->db->where('tbl_users_platform','iOS');
			$this->db->where('roleId',2);
			$query=$this->db->get();
			$result['iOS']=$query->result_array();

			return $result;
		}

		function insert_user_notification($sr_id,$msg,$tbl_user_id)
	    {
	        $value=array(
	            'user_notification_sr_id'=>$sr_id,
	            'user_notification_message'=>$msg,
	            'user_notification_status'=>0,
	            'user_notification_createat'=>date('Y-m-d H:i:s'),
	            'isDeleted'=>0,
	            'tbl_user_id'=>$tbl_user_id
	            );
	        $this->db->insert('tbl_user_notification_log', $value); 
	        $lid=$this->db->insert_id();
	        return $lid;
	    }

	    function insert_users_notification($sr_id,$msg,$userId)
	    {
	        $value=array(
	            'users_notification_sr_id'=>$sr_id,
	            'users_notification_message'=>$msg,
	            'users_notification_status'=>0,
	            'users_notification_createat'=>date('Y-m-d H:i:s'),
	            'isDeleted'=>0,
	            'userId'=>$userId
	            );
	        $this->db->insert('tbl_users_notification_log', $value); 
	        $lid=$this->db->insert_id();
	        return $lid;
	    }

		function get_emp_details($empid)
	    {
	        $this->db->select('tbl_employee_id, tbl_employee_name, tbl_employee_email, tbl_employee_mobile, tbl_employee_image,tbl_emp_device_type,tbl_emp_device_token,tbl_emp_device_id');
	        $this->db->from('tbl_employee');
	        $this->db->where('tbl_employee_id',$empid);
	        $query = $this->db->get();
	        return $query->row_array();
	    }

	    function get_user_details_by_sr_id($sr_id)
	    {
	        $this->db->select('tbl_user_id');
	        $qry=$this->db->get_where('tbl_service_request',array('sr_id'=>$sr_id));
	        $res=$qry->row_array();
	        //echo "<pre>";print_r($res);die;

	        $this->db->select('u.tbl_user_id, u.tbl_user_name, u.tbl_user_mobile, u.tbl_user_email, d.tbl_user_platform,d.tbl_user_device_id,d.tbl_user_device_token');
	        $this->db->from('tbl_user as u');
	        $this->db->where('u.tbl_user_id',$res['tbl_user_id']);
	        $this->db->join('tbl_user_devices as d', 'd.tbl_user_id = u.tbl_user_id','left');
	        $query = $this->db->get();
	        return $query->row_array();
	    }

		function admin_accept_reject($input)
		{
			$this->db->select('status_history');
	        $this->db->from('tbl_service_request');
	        $this->db->where('sr_id',$input['sr_id']);
	        $query = $this->db->get();
	        $res=$query->row_array();
	        $res=json_decode($res['status_history'],true);
	        $ctime=date('Y-m-d H:i:s');
			if($input['isAccept']==1)
			{				
		        $res[]=array('status_name'=>'Admin accepted','status_time'=>$ctime);
		        $res=json_encode($res);

        		$this->db->set('status_history',$res);
				$this->db->set('status',1);
				$this->db->where('sr_id', $input['sr_id']);
				$this->db->update('tbl_service_request');
			}
			else
			{
				$res[]=array('status_name'=>'Admin Rejected','status_time'=>$ctime);
		        $res=json_encode($res);

				$this->db->set('status_history',$res);
				$this->db->set('reject_reason_text',$input['reject_reason_text']);
				$this->db->set('status',2);
				$this->db->where('sr_id', $input['sr_id']);
				$this->db->update('tbl_service_request');
			}
			return 1;
		}

		function update_sr_status($sr_id,$grand_total)
		{
			//echo "<pre>";print_r($data);die;
			$this->db->select('status_history');
			$this->db->from('tbl_service_request');
			$this->db->where('sr_id',$sr_id);
			$query = $this->db->get();
			$res=$query->row_array();

			$res=json_decode($res['status_history'],true);
			$ctime=date('Y-m-d H:i:s');
			$res[]=array('status_name'=>'Completed','status_time'=>$ctime);
			$res=json_encode($res);

			$this->db->set('status_history',$res);
			$this->db->set('isQuotation',2);
			$this->db->set('status',11);
			$this->db->set('pending_amount',$grand_total);
			$this->db->where('sr_id', $sr_id);
			$this->db->update('tbl_service_request');

			$this->db->set('sales_quotation_status',1);
			$this->db->where('sales_quotation_sr_id', $sr_id);
			$this->db->update('tbl_sales_quotation');

			$this->db->select('assigned_emp_id');
			$query=$this->db->get_where('tbl_service_request',array('sr_id'=>$sr_id));
			$row=$query->row_array();


			$this->db->set('tbl_employee_status',0);
			$this->db->where('tbl_employee_id', $row['assigned_emp_id']);
			$this->db->update('tbl_employee');
			return 1;
		}

		function user_cancel_service($data)
		{

			$this->db->select('status');
	        $this->db->from('tbl_service_request');
	        $this->db->where('sr_id',$data['sr_id']);
	        $query = $this->db->get();
	        $res=$query->row_array();
	        if($res['status']!=6)
	        {
	        	$this->db->select('assigned_emp_id');
		        $this->db->from('tbl_service_request');
		        $this->db->where('sr_id',$data['sr_id']);
		        $query = $this->db->get();
		        $res=$query->row_array();
		        if($res['assigned_emp_id']!=0)
		        {
		        	$this->db->set('tbl_employee_status',0);
					$this->db->where('tbl_employee_id', $res['assigned_emp_id']);
					$this->db->update('tbl_employee');
		        }		        

				$this->db->set('isQuotation',0);
				$this->db->set('status',7);
				$this->db->set('status_history',NULL);
				$this->db->set('pending_amount',0);
				$this->db->set('assigned_emp_id',0);
				$this->db->set('user_reject_reason',$data['user_reject_reason']);
				$this->db->where('sr_id', $data['sr_id']);
				$this->db->update('tbl_service_request');
				return 1;
	        }
	        else
				return 0;
		}

		function update_emp_device_details_by_email($data)
		{
			//echo "<pre>";print_r($data);die;
			$this->db->set('tbl_emp_device_id',$data['tbl_emp_device_id']);
			$this->db->set('tbl_emp_device_type',$data['tbl_emp_device_type']);
			$this->db->set('tbl_emp_device_token',$data['tbl_emp_device_token']);
			$this->db->where('tbl_employee_email', $data['tbl_employee_email']);
			$this->db->update('tbl_employee');  
		}

		function update_user_location($data)
		{
			if(isset($data['tbl_user_place']))
			{
				$this->db->set('tbl_user_place',$data['tbl_user_place']);
			}
			$this->db->set('tbl_user_latitude',$data['tbl_user_latitude']);
			$this->db->set('tbl_user_longitude',$data['tbl_user_longitude']);
			$this->db->where('tbl_user_id', $data['tbl_user_id']);
			$this->db->update('tbl_user');
			return TRUE;            
		}

		function update_employee_location($data)
		{
			$this->db->set('tbl_employee_latitude',$data['tbl_employee_latitude']);
			$this->db->set('tbl_employee_longitude',$data['tbl_employee_longitude']);
			$this->db->where('tbl_employee_id', $data['tbl_employee_id']);
			$this->db->update('tbl_employee');
			return TRUE;            
		}
		public function emp_status_update($id,$status)
		{
			$this->db->set('tbl_user_employment_status',$status);
			$this->db->where('tbl_user_id', $id);
			$this->db->update('tbl_user');
			$this->db->select('tbl_user_id,tbl_user_employment_status');
			$query = $this->db->get_where('tbl_user', array('tbl_user_id' => $id));
			$row = $query->row_array();
            return $row;
		}

		public function company_status_update($id,$status)
		{
			$this->db->set('company_status',$status);
			$this->db->where('company_id', $id);
			$this->db->update('company_master');
			$this->db->select('company_id,company_status');
			$query = $this->db->get_where('company_master', array('company_id' => $id));
			$row = $query->row_array();
            return $row;
		}

		public function emp_rating($data)
		{
			$value=array(
				'tbl_user_id'=>$data['tbl_user_id'],
				'company_id'=>$data['company_id'],
				'user_rating_value'=>$data['user_rating_value'],
				'user_rating_desc'=>$data['user_rating_desc'],
				'user_rating_created_date'=>date('Y-m-d H:i:s')
				);
			$this->db->insert('user_rating', $value); 
			$lid=$this->db->insert_id();
			$this->db->select('user_rating_id,tbl_user_id,company_id,user_rating_value,user_rating_desc,user_rating_created_date');
			$query = $this->db->get_where('user_rating', array('user_rating_id' => $lid));
			$row = $query->row_array();
            return $row;
		}
		public function company_rating($data)
		{
			$value=array(
				'company_id'=>$data['company_id'],
				'tbl_user_id'=>$data['tbl_user_id'],
				'company_rating_value'=>$data['company_rating_value'],
				'company_rating_desc'=>$data['company_rating_desc'],
				'company_rating_created_date'=>date('Y-m-d H:i:s')
				);
			$this->db->insert('company_rating', $value); 
			$lid=$this->db->insert_id();

			$this->db->select('company_rating_id,tbl_user_id,company_id,company_rating_value,company_rating_desc,company_rating_created_date');
			$query = $this->db->get_where('company_rating', array('company_rating_id' => $lid));
			$row = $query->row_array();
            return $row;
		}

		public function get_user_list()
		{
			$this->db->select('tbl_user_id,tbl_user_name,tbl_user_mobile,tbl_user_dept,tbl_user_experiance,tbl_user_current_company,tbl_user_previouse_company,tbl_user_expected_salary,tbl_user_employment_status,tbl_user_image');
			$this->db->where('tbl_user_employment_status', 0);
			$query = $this->db->get('tbl_user');
			$rows = $query->result_array();
            return $rows;
		}

		public function get_company_list()
		{
			$this->db->select('company_id,company_name,company_address,company_owner_name,company_mobile_number,company_email,company_website,company_total_emp,company_vacancy,company_logo_iamge');
			$query = $this->db->get('company_master');
			$rows = $query->result_array();
            return $rows;
		}

		function get_user_from_sr_id($sr_id)
		{
			$this->db->select('tbl_user_id');
			$qry=$this->db->get_where('tbl_service_request',array('sr_id'=>$sr_id));
			return $row=$qry->row_array();
		}

		public function get_user_details($id)
		{
			$this->db->select('tbl_user_id,tbl_user_name,tbl_user_mobile,tbl_user_dept,tbl_user_experiance,tbl_user_current_company,tbl_user_previouse_company,tbl_user_expected_salary,tbl_user_employment_status,tbl_user_image');
			$query = $this->db->get_where('tbl_user', array('tbl_user_id' => $id));
			$row = $query->row_array();
            return $row;
		}

		public function get_company_details($id)
		{
			$this->db->select('company_id,company_name,company_address,company_owner_name,company_mobile_number,company_email,company_website,company_total_emp,company_vacancy,company_logo_iamge');
			$query = $this->db->get_where('company_master', array('company_id' => $id));
			$row = $query->row_array();
            return $row;
		}

		public function token_validation($token)
		{
			$query = $this->db->get_where('tbl_user', array('tbl_user_comm_token' => $token));
			$row = $query->row_array();
			if($row)
				return 1;
			else
				return 0;
		}

		public function get_user_by_mobile($mobile)
		{
			$this->db->select('tbl_user_id,tbl_user_name,tbl_user_mobile,tbl_user_device_type,tbl_user_address,tbl_user_dept,tbl_user_experiance,tbl_user_current_company,tbl_user_previouse_company,tbl_user_expected_salary,tbl_user_image,tbl_user_city,tbl_user_employment_status,tbl_user_image');
			$query=$this->db->get_where('tbl_user',array('tbl_user_mobile'=>$mobile));
			return $query->row_array();
		}

		public function get_company_by_mobile($mobile)
		{
			$this->db->select('company_id,company_name,company_address,company_logo_iamge,company_visiting_card,company_owner_name,company_contact_person,company_mobile_number,company_category,company_email,company_website,company_total_emp,company_status,company_logo_iamge');
			$query=$this->db->get_where('company_master',array('company_mobile_number'=>$mobile));
			return $query->row_array();
		}

		public function get_userlist()
		{
			$this->db->select('*');
			$this->db->from('tbl_user');
			//$this->db->join('productimages as i','p.pid=i.pid');
			//$this->db->where('p.pid',$pid);
			$query = $this->db->get();
			$row = $query->result_array();
			//echo "<pre>";print_r($row);die;
			return $row;
		}

		public function get_news()
		{
			$this->db->select('*');
			$this->db->from('news');
			$this->db->order_by("news_id", "desc");
			$query = $this->db->get();
			$row = $query->result_array();
			return $row;
		}

		public function get_version()
		{
			$this->db->select('*');
			$this->db->from('app_version');
			//$this->db->where('virsion_id',1);
			$query = $this->db->get();
			$row = $query->result_array();
			return $row;
		}

		public function get_construction_parameter()
		{
			$this->db->select('*');
			$this->db->from('app_under_construction');
			//$this->db->where('virsion_id',1);
			$query = $this->db->get();
			$row = $query->result_array();
			return $row;
		}

		public function get_video($id)
		{
			$this->db->order_by('video_id', 'desc');
			$query = $this->db->get_where('video', array('video_from' => $id));
			$row = $query->result_array();
            return $row;
		}

		public function get_TandC()
		{
			$query = $this->db->get('TandC');
			$row = $query->result_array();
            return $row;
		}

		public function privacy_policy()
		{
			$query = $this->db->get('privacy_policy');
			$row = $query->result_array();
            return $row;
		}

		public function user_logout($data)
		{
			$this->db->where('tbl_user_id', $data['tbl_user_id']);
			$this->db->where('tbl_user_device_id', $data['tbl_user_device_id']);
			$this->db->delete('tbl_user_devices');
			$res=$this->db->affected_rows();
			if($res)
				return 1;
			else
				return 0;
		}

		public function employee_logout($data)
		{
			$this->db->set('tbl_emp_device_id','');
			$this->db->set('tbl_emp_device_token','');
			$this->db->set('tbl_emp_device_type','');
			$this->db->where('tbl_employee_id', $data['tbl_employee_id']);
			$this->db->update('tbl_employee');
			//$res=$this->db->affected_rows();
			//if($res)
				return 1;
			//else
			//	return 0;
		}

		public function change_password($data)
		{
			$this->db->set('new_password',$data['new_password']);
			$this->db->where('tbl_user_id', $data['tbl_user_id']);
			$this->db->where('tbl_user_password', $data['tbl_user_password']);
			$this->db->update('tbl_user');
			$res=$this->db->affected_rows();
			if($res)
				return 1;
			else
				return 0;
		}

		public function change_company_password($data)
		{
			$this->db->set('company_password',$data['new_company_password']);
			$this->db->where('company_id', $data['company_id']);
			$this->db->where('company_password', $data['company_password']);
			$this->db->update('company_master');
			$res=$this->db->affected_rows();
			if($res==1)
				return 1;
			else
				return 0;
		}

		public function update_user_profile($data)
		{
			/*image writing*/
			$target_path='';
			if(!empty($data['tbl_user_image']))
			{
				$t=time()."_profile.JPG";
				$target_path=ADMIN_PATH.'assets/user_profile/'.$t;
				//echo $target_path;die;
				//echo FCPATH;die;
				file_put_contents(FCPATH.'assets/user_profile/'.$t,base64_decode($data['tbl_user_image']));
			}
			/*image writing*/
			if($target_path!='')
			{
				$this->db->select('tbl_user_image');
				$qry=$this->db->get_where('tbl_user',array('tbl_user_id'=>$data['tbl_user_id']));
				$row = $qry->row_array();
				if($row['tbl_user_image']!=NULL)
				{
					$un=str_replace(ADMIN_PATH,'',$row['tbl_user_image']);					
					if (strpos($un, 'default.jpg') === false) 
					{
						$u=unlink($_SERVER['DOCUMENT_ROOT'].'/admin/'.$un);						
					}                
				}
			}
			$this->db->set('tbl_user_name',$data['tbl_user_name']);
			$this->db->set('tbl_user_mobile',$data['tbl_user_mobile']);
			if($target_path!='')
			{
				$this->db->set('tbl_user_image',$target_path);
			}			
			$this->db->where('tbl_user_id', $data['tbl_user_id']);
			$this->db->update('tbl_user');
			$res=$this->db->affected_rows();
			if($res)
				return 1;
			else
				return 0;
		}

		function get_employee_task_history($empid,$limit,$offset)
		{
			//s.service_name,s.service_desc,s.service_logo,
			//LEFT JOIN tbl_services s ON s.service_id=sr.service_id

			$offset=$offset-1;
			$offset=$offset*$limit;
			$sql="SELECT sr.sr_id,sr.service_request_ref,sr.prefferd_date,sr.prefferd_time,sr.created_at,sr.status,t.time_slot_name,sr.pending_amount,sr.assigned_emp_id,sr.status FROM tbl_service_request sr LEFT JOIN tbl_time_slot t ON t.time_slot_id=sr.prefferd_time  WHERE sr.assigned_emp_id = ".$empid." AND sr.isDeleted = 0 ORDER BY sr.sr_id DESC,sr.status DESC LIMIT ".$offset.",".$limit."";
			$query = $this->db->query($sql);
			$row=$query->result_array();

			$title='';
			if(!empty($row))
			{
				for($i=0;$i<count($row);$i++)
				{
					$this->db->select('BaseTbl.*,s.service_name,s.service_desc,s.service_logo');
			        $this->db->from('tbl_service_request_boi as BaseTbl');
			        $this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
			        $this->db->where('sr_id',$row[$i]['sr_id']);
			        $query1=$this->db->get();
			        $row1=$query1->result_array();
					$row[$i]['service_list']=$row1;
					$title=array_column($row1, 'service_name');
					$row[$i]['services_name']=implode(',',$title);
				}	
				//echo "<pre>dsf";print_r($row);die;
			}
			return $row;
		}

		function get_admin_order_list($status,$limit,$offset)
		{
			//s.service_name,s.service_desc,s.service_logo,
			//LEFT JOIN tbl_services s ON s.service_id=sr.service_id
			$offset=$offset-1;
			$offset=$offset*$limit;
			if($status=='all')
			{
				$sql="SELECT sr.sr_id,sr.service_request_ref,sr.prefferd_date,sr.prefferd_time,sr.created_at,sr.status,t.time_slot_name,sr.pending_amount,sr.assigned_emp_id,sr.status,sr.tbl_user_id,user.tbl_user_latitude,user.tbl_user_longitude,user.tbl_user_place FROM tbl_service_request sr LEFT JOIN tbl_time_slot t ON t.time_slot_id=sr.prefferd_time LEFT JOIN tbl_user user ON user.tbl_user_id=sr.tbl_user_id  WHERE sr.isDeleted = 0 AND sr.status!=7 ORDER BY sr.sr_id DESC LIMIT ".$offset.",".$limit."";
			}
			else
			{
				$sql="SELECT sr.sr_id,sr.service_request_ref,sr.prefferd_date,sr.prefferd_time,sr.created_at,sr.status,t.time_slot_name,sr.pending_amount,sr.assigned_emp_id,sr.status FROM tbl_service_request sr LEFT JOIN tbl_time_slot t ON t.time_slot_id=sr.prefferd_time  WHERE sr.isDeleted = 0 AND sr.status = ".$status." ORDER BY sr.sr_id DESC LIMIT ".$offset.",".$limit."";
			}
			$query = $this->db->query($sql);
			$row=$query->result_array();
			//echo "<pre>";print_r($row);die;
			$title='';
			if(!empty($row))
			{
				for($i=0;$i<count($row);$i++)
				{
					$this->db->select('BaseTbl.*,s.service_name,s.service_desc,s.service_logo');
			        $this->db->from('tbl_service_request_boi as BaseTbl');
			        $this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
			        $this->db->where('sr_id',$row[$i]['sr_id']);
			        $query1=$this->db->get();
			        $row1=$query1->result_array();
					$row[$i]['service_list']=$row1;
					$title=array_column($row1, 'service_name');
					$row[$i]['services_name']=implode(', ',$title);
				}	
				//echo "<pre>dsf";print_r($row);die;
			}
			return $row;
		}

		function get_admin_order_detail($sr_id)
		{
			//s.service_name,s.service_desc,s.service_logo,
			//LEFT JOIN tbl_services s ON s.service_id=sr.service_id
			//$offset=$offset-1;
			//$offset=$offset*$limit;
			$sql="SELECT sr.sr_id,sr.service_request_ref,sr.prefferd_date,sr.prefferd_time,sr.created_at,sr.status,t.time_slot_name,sr.pending_amount,sr.assigned_emp_id,sr.status,sr.tbl_user_id,user.tbl_user_latitude,user.tbl_user_longitude,user.tbl_user_mobile,user.tbl_user_place,user.tbl_user_name,user.tbl_user_image,sr.assigned_emp_id,sr.isQuotation,sr.pending_amount,sr.status_history,user.tbl_user_email FROM tbl_service_request sr LEFT JOIN tbl_time_slot t ON t.time_slot_id=sr.prefferd_time LEFT JOIN tbl_user user ON user.tbl_user_id=sr.tbl_user_id  WHERE sr.isDeleted = 0 AND sr.sr_id= ".$sr_id." ORDER BY sr.sr_id DESC ";
			
			$query = $this->db->query($sql);
			$row=$query->row_array();
			

			if($row['assigned_emp_id']!=0)
			{
				$this->db->select('tbl_employee_id,tbl_employee_name,tbl_employee_email,tbl_employee_mobile,tbl_employee_status,tbl_employee_image,tbl_employee_latitude,tbl_employee_longitude');
		        $this->db->from('tbl_employee');
		        $this->db->where('tbl_employee_id',$row['assigned_emp_id']);
		        $query1=$this->db->get();
		        $row1=$query1->row_array();
		        $row=array_merge($row,$row1);
			}

			if($row['isQuotation']==1)
			{
				$this->db->select('sales_quotation_pdf,sales_quotation_id');
				$this->db->where('sales_quotation_sr_id', $sr_id);
				$query1 = $this->db->get('tbl_sales_quotation');
				$row1 = $query1->row_array();
				$row=array_merge($row,$row1);
				//echo "<pre>dsf";print_r($row);die;
			}
			if($row['isQuotation']==2)
			{
				$this->db->select('sales_master_pdf as sales_quotation_pdf,sales_master_id as sales_quotation_id');
				$this->db->where('sales_quotation_sr_id', $sr_id);
				$query1 = $this->db->get('tbl_sales_master');
				$row1 = $query1->row_array();
				$row=array_merge($row,$row1);
				//echo "<pre>dsf";print_r($row);die;
			}

			$this->db->select('BaseTbl.*,s.service_name,s.service_desc,s.service_logo');
	        $this->db->from('tbl_service_request_boi as BaseTbl');
	        $this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
	        $this->db->where('sr_id',$row['sr_id']);
	        $query2=$this->db->get();
	        $row2=$query2->result_array();
			$row['service_list']=$row2;
			$title=array_column($row2, 'service_name');
			$row['services_name']=implode(', ',$title);

			//echo "<pre>";print_r($row);die;
				
			return $row;
		}

		public function ref__and_del($user_id,$limit,$offset)
		{
			$offset=$offset-1;
			$offset=$offset*$limit;
		    $sql = "SELECT t.sr_id,t.service_request_ref,t.service_id,t.prefferd_date,ts.time_slot_name,t.status,s.service_name,s.service_logo FROM tbl_service_request t LEFT JOIN tbl_services s  ON s.service_id = t.service_id LEFT JOIN tbl_time_slot ts ON t.prefferd_time = ts.time_slot_id WHERE t.tbl_user_id = ".$user_id." ORDER BY t.sr_id DESC LIMIT ".$offset.",".$limit."";
		    //echo $sql;die;
			$query = $this->db->query($sql);
			//echo $this->db->last_query();die;
			return $query->result_array();
		}

		public function update_employee_profile($data)
		{
			/*image writing*/
			$target_path='';
			if(!empty($data['tbl_employee_image']))
			{
				$t=time()."_profile.JPG";
				$target_path=ADMIN_PATH.'assets/employee/'.$t;
				//echo $target_path;die;
				//echo FCPATH;die;
				file_put_contents(FCPATH.'assets/employee/'.$t,base64_decode($data['tbl_employee_image']));
			}
			/*image writing*/
			if($target_path!='')
			{
				$this->db->select('tbl_employee_image');
				$qry=$this->db->get_where('tbl_employee',array('tbl_employee_id'=>$data['tbl_employee_id']));
				$row = $qry->row_array();
				if($row['tbl_employee_image']!=NULL)
				{
					$un=str_replace(ADMIN_PATH,'',$row['tbl_employee_image']);
	                //echo $_SERVER['DOCUMENT_ROOT'].'/karigar/'.$un;die;
	                $u=unlink($_SERVER['DOCUMENT_ROOT'].'/admin/'.$un);
				}
			}
			$this->db->set('tbl_employee_name',$data['tbl_employee_name']);
			$this->db->set('tbl_employee_mobile',$data['tbl_employee_mobile']);
			if($target_path!='')
			{
				$this->db->set('tbl_employee_image',$target_path);
			}			
			$this->db->where('tbl_employee_id', $data['tbl_employee_id']);
			$this->db->update('tbl_employee');
			$res=$this->db->affected_rows();
			if($res)
				return 1;
			else
				return 0;
		}

		public function update_user_token($data)
		{
			$this->db->set('tbl_user_device_token',$data['tbl_user_device_token']);
			$this->db->where('tbl_user_mobile', $data['tbl_user_mobile']);
			$this->db->where('tbl_user_id', $data['tbl_user_id']);
			$this->db->update('tbl_user');
			$res=$this->db->affected_rows();
			if($res)
				return 1;
			else
				return 0;
		}

		public function mark_as_read($data)
		{
			$this->db->set('read_',1);
			$this->db->where('id', $data['id']);
			$this->db->update('notification');
			//echo $this->db->last_query();die;
			$res=$this->db->affected_rows();
			if($res)
				return 1;
			else
				return 0;
		}

		public function get_user_by_id($id)
		{
			$this->db->select('tbl_user_id,tbl_user_name,tbl_user_mobile,tbl_user_device_type,tbl_user_address,tbl_user_dept,tbl_user_experiance,tbl_user_current_company,tbl_user_previouse_company,tbl_user_expected_salary,tbl_user_city,tbl_user_image');
			$query=$this->db->get_where('tbl_user',array('tbl_user_id'=>$id));
			return $query->row_array();
		}

		public function get_user_by_email($email)
		{
			$this->db->select('tbl_user_id,tbl_user_name,tbl_user_mobile,tbl_user_email');
			$query=$this->db->get_where('tbl_user',array('tbl_user_email'=>$email));
			return $query->row_array();
		}

		function update_token_to_email($token,$email)
		{
			$newTime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +10 minutes"));
			$this->db->set('tbl_user_token_expire_time',$newTime);
			$this->db->set('tbl_user_password_token',$token);
			$this->db->where('tbl_user_email',$email);		
			$this->db->update('tbl_user');
			return 1;
		}

		public function get_emp_by_email($email)
		{
			$this->db->select('tbl_employee_id,tbl_employee_name,tbl_employee_email,tbl_employee_mobile,tbl_employee_status,tbl_employee_image,tbl_employee_id_card,tbl_employee_skills,tbl_employee_basic_salary,tbl_employee_doj,tbl_employee_emegency_contact,tbl_employee_nationality');
			$query=$this->db->get_where('tbl_employee',array('tbl_employee_email'=>$email));
			return $query->row_array();
		}

		public function get_service_list()
		{
			$this->db->select('service_id,service_name,service_desc,service_logo');
			$this->db->from('tbl_services');
			$this->db->where('isDeleted',0);
			$query = $this->db->get();
			$row = $query->result_array();
			if(!empty($row))
			{
				for($i=0;$i<count($row);$i++)
				{					
					$serviceid=$row[$i]['service_id'];
					$this->db->select('sub_service_name');
					$query=$this->db->get_where('tbl_sub_services',array('isDeleted'=>0,'service_id'=>$serviceid));
					$res=$query->result_array();
					$row[$i]['sub_service_name']=array_column($res, 'sub_service_name');

					$this->db->select('sub_service_image');
					$query1=$this->db->get_where('tbl_sub_services',array('isDeleted'=>0,'service_id'=>$serviceid,'sub_service_image !='=>''));
					$res1=$query1->result_array();
					$row[$i]['sub_service_image']=array_column($res1, 'sub_service_image');	
				}
				return $row;
			}
			else
			{
				return $row;
			}			
		}

		public function get_master_item_list($item_category_id)
		{			
			$this->db->select('item.item_master_id,item.item_master_name,item.item_master_unit as item_unit_id,unit.item_unit_name,item.item_master_price,item.item_master_logo');
			$this->db->from('tbl_item_master as item');
			$this->db->join('tbl_item_unit as unit','item.item_master_unit=unit.item_unit_id');
			$this->db->order_by('item.item_master_id', 'desc');
			$this->db->where('item.isDeleted',0);
			$this->db->where('item.item_master_category',$item_category_id);
			$query=$this->db->get_where();
			//echo $this->db->last_query();die;
			return $query->result_array();			
		}

		public function user_notification_list($tbl_user_id,$limit,$offset)
		{
			$offset=$offset-1;
			$offset=$offset*$limit;
			$this->db->select('user_notification_id,user_notification_message,user_notification_status');
			$this->db->from('tbl_user_notification_log');
			$this->db->order_by('user_notification_id', 'desc');
			$this->db->where('isDeleted',0);
			$this->db->where('tbl_user_id',$tbl_user_id);
			$this->db->limit($limit, $offset);
			$query=$this->db->get_where();
			//echo $this->db->last_query();die;
			return $query->result_array();			
		}

		/*public function get_master_item_list($limit,$offset)
		{
			$offset=$offset-1;
			$offset=$offset*$limit;
			$this->db->select('item.item_master_id,item.item_master_name,item.item_master_unit,unit.item_unit_name,item.item_master_price,item.item_master_logo');
			$this->db->from('tbl_item_master as item');
			$this->db->join('tbl_item_unit as unit','item.item_master_unit=unit.item_unit_id');
			$this->db->order_by('item.item_master_id', 'desc');
			$this->db->where('item.isDeleted',0);
			$this->db->limit($limit, $offset);
			$query=$this->db->get_where();
			//echo $this->db->last_query();die;
			return $query->result_array();			
		}*/	
		
}
?>