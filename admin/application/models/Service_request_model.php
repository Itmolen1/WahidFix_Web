<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class service_request_model extends CI_Model
{
    function service_requestListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.*,u.*,ts.time_slot_name');
        $this->db->from('tbl_service_request as BaseTbl');
        //$this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
        $this->db->join('tbl_user as u', 'u.tbl_user_id = BaseTbl.tbl_user_id','left');
        $this->db->join('tbl_time_slot as ts', 'ts.time_slot_id = BaseTbl.prefferd_time','left');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(u.tbl_user_name  LIKE '%".$searchText."%'
                            OR  ts.time_slot_name  LIKE '%".$searchText."%'
                            OR  u.tbl_user_mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.status !=', 7);
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get(); 
        //echo $this->db->last_query();die;       
        return $query->num_rows();
    }
    
    function service_requestListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.*,u.*,ts.time_slot_name');
        $this->db->from('tbl_service_request as BaseTbl');
       // $this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
        $this->db->join('tbl_user as u', 'u.tbl_user_id = BaseTbl.tbl_user_id','left');
        $this->db->join('tbl_time_slot as ts', 'ts.time_slot_id = BaseTbl.prefferd_time','left');
        if(!empty($searchText)) {
            $likeCriteria = "(u.tbl_user_name  LIKE '%".$searchText."%'
                            OR  ts.time_slot_name  LIKE '%".$searchText."%'
                            OR  u.tbl_user_mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.status !=', 7);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.sr_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get(); 
        $result = $query->result();        
        return $result;
    }

    function get_services()
    {
        $this->db->select('service_id,service_name');
        $this->db->from('tbl_services');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_suborder_details($sr_id)
    {
        $this->db->select('BaseTbl.*,s.service_id,s.service_name');
        $this->db->from('tbl_service_request_boi as BaseTbl');
        $this->db->where('sr_id',$sr_id);
        $this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
        $query = $this->db->get(); 
        $result = $query->result_array();        
        return $result;
    }

    function get_details_by_sr_id($record_num)
    {
        $this->db->select('*');
        $this->db->where('sr_id', $record_num);
        $this->db->from('tbl_service_request');
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_latest_cordinates($sr_id)
    {
        $this->db->order_by('service_track_id', 'DESC');
        $this->db->select('service_track_latitude,service_track_longitude');
        $this->db->from('tbl_service_track');
        $this->db->where('sr_id',$sr_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function checkEmailExists($email, $servicesId = 0)
    {
        $this->db->select("email");
        $this->db->from("tbl_services");
        $this->db->where("email", $email);   
        $this->db->where("isDeleted", 0);
        if($servicesId != 0){
            $this->db->where("service_id !=", $servicesId);
        }
        $query = $this->db->get();

        return $query->result();
    }
    
    function add_new_subservice($servicesInfo)
    {
        //echo "model";die;
        $this->db->trans_start();
        $this->db->insert('tbl_sub_services', $servicesInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
    
    function get_service_request_info($id)
    {
        $this->db->select('BaseTbl.*,u.*');
        $this->db->from('tbl_service_request as BaseTbl');
        //$this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
        $this->db->join('tbl_user as u', 'u.tbl_user_id = BaseTbl.tbl_user_id','left');
        $this->db->where('BaseTbl.sr_id',$id);
        $query = $this->db->get();

        $this->db->select('BaseTbl.*,s.*');
        $this->db->from('tbl_service_request_boi as BaseTbl');
        $this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
        $this->db->where('sr_id',$id);
        $query1=$this->db->get();
        $row=$query1->result_array();
        return array('sr'=>$query->row_array(),'service_ids'=>$row);
    }

    function get_eligible_emp_list($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_employee as BaseTbl');
        //$this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
        //$this->db->join('tbl_user as u', 'u.tbl_user_id = BaseTbl.tbl_user_id','left');
        $this->db->where('BaseTbl.tbl_employee_status',0);
        $query = $this->db->get();
        $all=$query->result_array();
        $emp_list=array();
        for($i=0;$i<count($all);$i++)
        {
            $ar1=unserialize(base64_decode($all[$i]['tbl_employee_skills']));
            if(in_array($id,$ar1))
            {
                //echo "ye0";die;
                $emp_list[]=$all[$i];
            }
        }
        //echo "<pre>";print_r($emp_list);die;
        return $emp_list;         
    }

    function get_emp_details($empid)
    {
        $this->db->select('tbl_employee_id, tbl_employee_name, tbl_employee_email, tbl_employee_mobile, tbl_employee_image,tbl_emp_device_type,tbl_emp_device_token,tbl_emp_device_id');
        $this->db->from('tbl_employee');
        $this->db->where('tbl_employee_id',$empid);
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_user_details($sr_id)
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

    function insert_user_notification($sr_id,$msg)
    {
        $value=array(
            'user_notification_sr_id'=>$sr_id,
            'user_notification_message'=>$msg,
            'user_notification_status'=>0,
            'user_notification_createat'=>date('Y-m-d H:i:s'),
            'isDeleted'=>0
            );
        $this->db->insert('tbl_user_notification_log', $value); 
        $lid=$this->db->insert_id();
        return $lid;
    }

    function get_all_services()
    {
        $this->db->select('service_id, service_name, created_at, updated_at');
        $this->db->from('tbl_services');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function edit_service_request($val)
    {
        $this->db->select('status_history');
        $this->db->from('tbl_service_request');
        $this->db->where('sr_id',$val['sr_id']);
        $query = $this->db->get();
        $res=$query->row_array();
        $res=json_decode($res['status_history'],true);
        $ctime=date('Y-m-d H:i:s');
        $res[]=array('status_name'=>'Assigned','status_time'=>$ctime);
        $res=json_encode($res);
        $this->db->set('status_history',$res);

        $this->db->set('assigned_emp_id',$val['assigned_emp_id']);
        $this->db->set('status',3);
        $this->db->set('updated_at',$ctime);
        $this->db->where('sr_id', $val['sr_id']);
        $this->db->update('tbl_service_request');
        return TRUE;
    }
    
    function delete_service_request($id)
    {
        $this->db->set('isDeleted',1);
        $this->db->where('sr_id', $id);
        $this->db->update('tbl_service_request');
        return $this->db->affected_rows();
    }

    function update_one_to_sr_id($id)
    {
        $this->db->select('status_history');
        $this->db->from('tbl_service_request');
        $this->db->where('sr_id',$id);
        $query = $this->db->get();
        $res=$query->row_array();
        $res=json_decode($res['status_history'],true);
        $ctime=date('Y-m-d H:i:s');
        $res[]=array('status_name'=>'Admin accepted','status_time'=>$ctime);
        $res=json_encode($res);
        $this->db->set('status_history',$res);

        $this->db->set('status',1);
        $this->db->where('sr_id', $id);
        $this->db->update('tbl_service_request');
        return $this->db->affected_rows();
    }

    function update_two_to_sr_id($id)
    {
        $this->db->select('status_history');
        $this->db->from('tbl_service_request');
        $this->db->where('sr_id',$id);
        $query = $this->db->get();
        $res=$query->row_array();
        $res=json_decode($res['status_history'],true);
        $ctime=date('Y-m-d H:i:s');
        $res[]=array('status_name'=>'Admin Rejected','status_time'=>$ctime);
        $res=json_encode($res);
        $this->db->set('status_history',$res);

        $this->db->set('status',2);
        $this->db->where('sr_id', $id);
        $this->db->update('tbl_service_request');
        return $this->db->affected_rows();
    }

    function getservicesInfoById($servicesId)
    {
        $this->db->select('servicesId, name, email, mobile, roleId');
        $this->db->from('tbl_services');
        $this->db->where('isDeleted', 0);
        $this->db->where('tbl_sub_services', $servicesId);
        $query = $this->db->get();
        
        return $query->row();
    }

    function getservicesInfoWithRole($servicesId)
    {
        $this->db->select('BaseTbl.servicesId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.roleId, Roles.role');
        $this->db->from('tbl_services as BaseTbl');
        $this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
        $this->db->where('BaseTbl.servicesId', $servicesId);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }

}

  