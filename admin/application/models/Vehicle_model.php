<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Vehicle_model extends CI_Model
{
    function vehicle_listing_count($searchText = '')
    {
        $this->db->select('BaseTbl.vehicle_id, BaseTbl.vehicle_no, BaseTbl.vehicle_tc_no, BaseTbl.vehicle_insurance_img, BaseTbl.vehicle_insurance_exp_date, BaseTbl.vehicle_mulkia_front_img,BaseTbl.vehicle_mulkia_back_img,BaseTbl.vehicle_mulkia_exp_date,BaseTbl.vehicle_status,BaseTbl.vehicle_created_at,BaseTbl.vehicle_updated_at,BaseTbl.isDeleted');
        $this->db->from('tbl_vehicle as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.vehicle_no  LIKE '%".$searchText."%'
                            OR  BaseTbl.vehicle_tc_no  LIKE '%".$searchText."%'
                            OR  BaseTbl.vehicle_status  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function vehicle_listing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.vehicle_id, BaseTbl.vehicle_no, BaseTbl.vehicle_tc_no, BaseTbl.vehicle_insurance_img, BaseTbl.vehicle_insurance_exp_date, BaseTbl.vehicle_mulkia_front_img,BaseTbl.vehicle_mulkia_back_img,BaseTbl.vehicle_mulkia_exp_date,BaseTbl.vehicle_status,BaseTbl.vehicle_created_at,BaseTbl.vehicle_updated_at,BaseTbl.isDeleted');
        $this->db->from('tbl_vehicle as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.vehicle_no  LIKE '%".$searchText."%'
                            OR  BaseTbl.vehicle_tc_no  LIKE '%".$searchText."%'
                            OR  BaseTbl.vehicle_status  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $this->db->order_by('BaseTbl.vehicle_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function get_service_list()
    {
        $query = $this->db->get('tbl_services');
        $result = $query->result_array();        
        return $result;
    }
    
    function getUserRoles()
    {
        $this->db->select('roleId, role');
        $this->db->from('tbl_roles');
        $this->db->where('roleId !=', 1);
        $query = $this->db->get();
        return $query->result();
    }

    function vehicle_no_exists($vehicle_no, $vehicle_id = 0)
    {
        $this->db->select("vehicle_no");
        $this->db->from("tbl_vehicle");
        $this->db->where("vehicle_no", $vehicle_no);   
        $this->db->where("isDeleted", 0);
        if($vehicle_id != 0){
            $this->db->where("vehicle_id !=", $vehicle_id);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function add_new_vehicle($val)
    {
        $data=array(
        'vehicle_no'=>$val['vehicle_no'],
        'vehicle_tc_no'=>$val['vehicle_tc_no'],
        'vehicle_insurance_img'=>$val['vehicle_insurance_img'],
        'vehicle_insurance_exp_date'=>$val['vehicle_insurance_exp_date'],
        'vehicle_mulkia_front_img'=>$val['vehicle_mulkia_front_img'],
        'vehicle_mulkia_back_img'=>$val['vehicle_mulkia_back_img'],
        'vehicle_mulkia_exp_date'=>$val['vehicle_mulkia_exp_date'],
        'vehicle_status'=>$val['vehicle_status'],
        'vehicle_created_at'=>date('Y-m-d H:i:s'),
        'vehicle_updated_at'=>date('Y-m-d H:i:s'),
       );
        $this->db->insert('tbl_vehicle', $data); 
        $lid=$this->db->insert_id();
        //echo $this->db->last_query();die;
        return $lid;
    }

    function update_vehicle($val)
    {
        //$this->db->set('vehicle_no',$val['vehicle_no']);
        $this->db->set('vehicle_tc_no',$val['vehicle_tc_no']);
        $this->db->set('vehicle_insurance_img',$val['vehicle_insurance_img']);
        $this->db->set('vehicle_insurance_exp_date',$val['vehicle_insurance_exp_date']);
        $this->db->set('vehicle_mulkia_front_img',$val['vehicle_mulkia_front_img']);
        $this->db->set('vehicle_mulkia_back_img',$val['vehicle_mulkia_back_img']);
        $this->db->set('vehicle_mulkia_exp_date',$val['vehicle_mulkia_exp_date']);
        $this->db->set('vehicle_status',$val['vehicle_status']);
        $this->db->set('vehicle_updated_at',date('Y-m-d H:i:s'));
        $this->db->where('vehicle_id',$val['vehicle_id']); 
        $lid=$this->db->update('tbl_vehicle');
        //echo $this->db->last_query();die;
        return $lid;
    }

    function getUserInfo($userId)
    {
        $this->db->select('userId, name, email, mobile, roleId');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
		$this->db->where('roleId !=', 1);
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        
        return $query->row();
    }

    function get_vehicle_by_id($id)
    {
        $this->db->where('vehicle_id',$id);
        $query = $this->db->get('tbl_vehicle');
        $result = $query->row_array();        
        return $result;
    }

    function delete_vehicle($id)
    {
        $this->db->set('isDeleted',1);
        $this->db->where('vehicle_id',$id); 
        $lid=$this->db->update('tbl_vehicle');
        return $this->db->affected_rows();
    }

    function matchOldPassword($userId, $oldPassword)
    {
        $this->db->select('userId, password');
        $this->db->where('userId', $userId);        
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('tbl_users');
        
        $user = $query->result();

        if(!empty($user)){
            if(verifyHashedPassword($oldPassword, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    function changePassword($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbl_users', $userInfo);
        
        return $this->db->affected_rows();
    }

    function loginHistoryCount($userId, $searchText, $fromDate, $toDate)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.sessionData LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        if($userId >= 1){
            $this->db->where('BaseTbl.userId', $userId);
        }
        $this->db->from('tbl_last_login as BaseTbl');
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function loginHistory($userId, $searchText, $fromDate, $toDate, $page, $segment)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        $this->db->from('tbl_last_login as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.sessionData  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        if($userId >= 1){
            $this->db->where('BaseTbl.userId', $userId);
        }
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function getUserInfoById($userId)
    {
        $this->db->select('userId, name, email, mobile, roleId');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        
        return $query->row();
    }

    function getUserInfoWithRole($userId)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.roleId, Roles.role');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }
}