<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Guest_service_request_model extends CI_Model
{
    function guest_service_requestListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_guest_user as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.tbl_guest_user_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.tbl_guest_user_mobile  LIKE '%".$searchText."%'
                            OR  BaseTbl.tbl_guest_user_service_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.tbl_guest_user_email  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();        
        return $query->num_rows();
    }
    
    function guest_service_requestListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.*,ts.time_slot_id,ts.time_slot_name');
        $this->db->from('tbl_guest_user as BaseTbl');
        //$this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
        $this->db->join('tbl_time_slot as ts', 'ts.time_slot_id = BaseTbl.tbl_guest_user_service_time','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.tbl_guest_user_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.tbl_guest_user_mobile  LIKE '%".$searchText."%'
                            OR  BaseTbl.tbl_guest_user_service_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.tbl_guest_user_email  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.tbl_guest_user_id', 'DESC');
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

    function get_guest_suborder_details($sr_id)
    {
        $this->db->select('BaseTbl.*,s.service_id,s.service_name');
        $this->db->from('tbl_guest_user_boi as BaseTbl');
        $this->db->where('sr_id',$sr_id);
        $this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
        $query = $this->db->get(); 
        $result = $query->result_array();        
        return $result;
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
        $this->db->select('BaseTbl.*,s.*,u.*');
        $this->db->from('tbl_service_request as BaseTbl');
        $this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
        $this->db->join('tbl_user as u', 'u.tbl_user_id = BaseTbl.tbl_user_id','left');
        $this->db->where('BaseTbl.sr_id',$id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_eligible_emp_list($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_employee as BaseTbl');
        //$this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
        //$this->db->join('tbl_user as u', 'u.tbl_user_id = BaseTbl.tbl_user_id','left');
        //$this->db->where('BaseTbl.sr_id',$id);
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

    function get_all_services()
    {
        $this->db->select('service_id, service_name, created_at, updated_at');
        $this->db->from('tbl_services');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function edit_service_request($val)
    {
        $this->db->set('assigned_emp_id',$val['assigned_emp_id']);
        $this->db->set('status',1);
        //$this->db->set('sub_service_name',$val['sub_service_name']);
        $this->db->set('updated_at',date('Y-m-d H:i:s'));
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

  