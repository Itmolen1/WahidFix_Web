<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Employee_model extends CI_Model
{
    function employee_listing_count($searchText = '')
    {
        $this->db->select('BaseTbl.tbl_employee_id, BaseTbl.tbl_employee_name, BaseTbl.tbl_employee_email, BaseTbl.tbl_employee_mobile, BaseTbl.tbl_employee_status, BaseTbl.tbl_employee_created_at,BaseTbl.tbl_employee_updated_at,BaseTbl.tbl_employee_image,BaseTbl.tbl_employee_id_card,BaseTbl.tbl_employee_skills,BaseTbl.tbl_employee_basic_salary,BaseTbl.tbl_employee_doj,BaseTbl.tbl_employee_emegency_contact,BaseTbl.tbl_employee_notes,BaseTbl.tbl_employee_nationality,');
        $this->db->from('tbl_employee as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.tbl_employee_email  LIKE '%".$searchText."%'
                            OR  BaseTbl.tbl_employee_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.tbl_employee_mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function employee_listing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.tbl_employee_id, BaseTbl.tbl_employee_name, BaseTbl.tbl_employee_email, BaseTbl.tbl_employee_mobile, BaseTbl.tbl_employee_status, BaseTbl.tbl_employee_created_at,BaseTbl.tbl_employee_updated_at,BaseTbl.tbl_employee_image,BaseTbl.tbl_employee_id_card,BaseTbl.tbl_employee_skills,BaseTbl.tbl_employee_basic_salary,BaseTbl.tbl_employee_doj,BaseTbl.tbl_employee_emegency_contact,BaseTbl.tbl_employee_notes,BaseTbl.tbl_employee_nationality,');
        $this->db->from('tbl_employee as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.tbl_employee_email  LIKE '%".$searchText."%'
                            OR  BaseTbl.tbl_employee_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.tbl_employee_mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $this->db->order_by('BaseTbl.tbl_employee_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function get_service_list()
    {
        $this->db->where('isDeleted', 0);
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

    function employee_email_exists($tbl_employee_email, $tbl_employee_id = 0)
    {
        $this->db->select("tbl_employee_email");
        $this->db->from("tbl_employee");
        $this->db->where("tbl_employee_email", $tbl_employee_email);   
        $this->db->where("isDeleted", 0);
        if($tbl_employee_id != 0){
            $this->db->where("tbl_employee_id !=", $tbl_employee_id);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function add_new_employee($val)
    {
        $se=base64_encode(serialize($val['tbl_employee_skills']));
        //$final="'.$se.'";
        $data=array(
        'tbl_employee_name'=>$val['tbl_employee_name'],
        'tbl_employee_email'=>$val['tbl_employee_email'],
        'tbl_employee_mobile'=>$val['tbl_employee_mobile'],
        'tbl_employee_password'=>$val['tbl_employee_password'],
        'tbl_employee_id_card'=>$val['tbl_employee_id_card'],
        'tbl_employee_image'=>$val['tbl_employee_image'],
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

    function update_employee($val)
    {
        $se=base64_encode(serialize($val['tbl_employee_skills']));
        //$final="'.$se.'";
       /* $data=array(
        'tbl_employee_name'=>$val['tbl_employee_name'],
        'tbl_employee_email'=>$val['tbl_employee_email'],
        'tbl_employee_mobile'=>$val['tbl_employee_mobile'],
        //'tbl_employee_status'=>$val['tbl_employee_email'],
        //'tbl_employee_image'=>$val['tbl_employee_email'],
        //'tbl_employee_id_card'=>$val['tbl_employee_email'],
        'tbl_employee_skills'=>$se,
        'tbl_employee_updated_at'=>date('Y-m-d H:i:s'),
       );*/
        $this->db->set('tbl_employee_name',$val['tbl_employee_name']);
        //$this->db->set('tbl_employee_email',$val['tbl_employee_email']);
        $this->db->set('tbl_employee_mobile',$val['tbl_employee_mobile']);
        $this->db->set('tbl_employee_password',$val['tbl_employee_password']);
        $this->db->set('tbl_employee_status',$val['tbl_employee_status']);
        $this->db->set('tbl_employee_image',$val['tbl_employee_image']);
        $this->db->set('tbl_employee_id_card',$val['tbl_employee_id_card']);
        $this->db->set('tbl_employee_basic_salary',$val['tbl_employee_basic_salary']);
        $this->db->set('tbl_employee_doj',$val['tbl_employee_doj']);
        $this->db->set('tbl_employee_emegency_contact',$val['tbl_employee_emegency_contact']);
        $this->db->set('tbl_employee_notes',$val['tbl_employee_notes']);
        $this->db->set('tbl_employee_nationality',$val['tbl_employee_nationality']);
        $this->db->set('tbl_employee_skills',$se);
        $this->db->set('tbl_employee_updated_at',date('Y-m-d H:i:s'));
        $this->db->where('tbl_employee_id',$val['tbl_employee_id']); 
        $lid=$this->db->update('tbl_employee');
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

    function get_employee_by_id($id)
    {
        $this->db->where('tbl_employee_id',$id);
        $query = $this->db->get('tbl_employee');
        $result = $query->row_array();        
        return $result;
    }

    function delete_employee($id)
    {
        $this->db->set('isDeleted',1);
        $this->db->where('tbl_employee_id',$id); 
        $lid=$this->db->update('tbl_employee');
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