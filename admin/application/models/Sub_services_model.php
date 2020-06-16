<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Sub_services_model extends CI_Model
{
    function sub_servicesListingCount($searchText = '',$parent='')
    {
        $this->db->select('BaseTbl.sub_service_id, BaseTbl.service_id, BaseTbl.sub_service_name, BaseTbl.created_at,BaseTbl.updated_at,s.service_name,BaseTbl.sub_service_image');
        $this->db->from('tbl_sub_services as BaseTbl');
        $this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.sub_service_name  LIKE '%".$searchText."%'
                            OR  s.service_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($parent))
        {
            $this->db->where('BaseTbl.service_id',$parent);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();        
        return $query->num_rows();
    }
    
    function sub_servicesListing($searchText = '',$parent='', $page, $segment)
    {
        $this->db->select('BaseTbl.sub_service_id, BaseTbl.service_id, BaseTbl.sub_service_name, BaseTbl.created_at,BaseTbl.updated_at,s.service_name,BaseTbl.sub_service_image');
        $this->db->from('tbl_sub_services as BaseTbl');
        $this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.sub_service_name  LIKE '%".$searchText."%'
                            OR  s.service_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($parent))
        {
            $this->db->where('BaseTbl.service_id',$parent);
        }
        $this->db->order_by('BaseTbl.sub_service_id', 'DESC');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function get_services()
    {
        $this->db->select('service_id,service_name');
        $this->db->from('tbl_services');
        $this->db->where('isDeleted',0);
        $query = $this->db->get();
        return $query->result_array();
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
    
    function get_sub_service_info($id)
    {
        $this->db->select('BaseTbl.sub_service_id, BaseTbl.service_id, BaseTbl.sub_service_name, BaseTbl.sub_service_image');
        //$this->db->select('sub_service_id, service_id, sub_service_name');
        $this->db->from('tbl_sub_services as BaseTbl');
        $this->db->where('sub_service_id', $id);
        $this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_all_services()
    {
        $this->db->select('service_id, service_name, created_at, updated_at');
        $this->db->from('tbl_services');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function edit_sub_service($val)
    {
        $this->db->set('service_id',$val['service_id']);
        $this->db->set('sub_service_name',$val['sub_service_name']);
        $this->db->set('sub_service_image',$val['sub_service_image']);
        $this->db->set('updated_at',date('Y-m-d H:i:s'));
        $this->db->where('sub_service_id', $val['sub_service_id']);
        $this->db->update('tbl_sub_services');
        return TRUE;
    }
    
    function delete_sub_service($id)
    {
        $this->db->set('isDeleted',1);
        $this->db->where('sub_service_id', $id);
        $this->db->update('tbl_sub_services');
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

  