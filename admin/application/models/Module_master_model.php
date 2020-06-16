<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Module_master_model extends CI_Model
{
    function module_masterListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.module_id, BaseTbl.module_name, BaseTbl.module_lable');
        $this->db->from('tbl_modules as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.module_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    function module_masterListing($searchText = '', $page, $segment)
    {
         $this->db->select('BaseTbl.module_id, BaseTbl.module_name,BaseTbl.module_lable,');
        $this->db->from('tbl_modules as BaseTbl');
        //$this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
        if(!empty($searchText)) {
           $likeCriteria = "(BaseTbl.module_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('BaseTbl.module_id', 'DESC');
        $this->db->limit($page, $segment);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    function add_new_module_master($servicesInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_modules', $servicesInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
    
    function get_module_master_info($id)
    {
         $this->db->select('BaseTbl.module_id, BaseTbl.module_name, BaseTbl.module_master_created_at, BaseTbl.module_master_updated_at');
        //$this->db->select('sub_service_id, service_id, sub_service_name');
        $this->db->from('tbl_modules as BaseTbl');
        $this->db->where('module_id', $id);
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
    
    function edit_module_master($val)
    {
        $this->db->set('module_name',$val['module_name']);
        $this->db->set('module_master_updated_at',date('Y-m-d H:i:s'));
        $this->db->where('module_id', $val['module_id']);
        $this->db->update('tbl_modules');
        return TRUE;
    }
    
    function delete_module_master($id)
    {
        $this->db->set('isDeleted',1);
        $this->db->where('module_id', $id);
        $this->db->update('tbl_modules');
        return $this->db->affected_rows();
    }

    function getservicesInfoById($servicesId)
    {
        $this->db->select('servicesId, name, email, mobile, roleId');
        $this->db->from('tbl_services');
        $this->db->where('isDeleted', 0);
        $this->db->where('tbl_modules', $servicesId);
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

  