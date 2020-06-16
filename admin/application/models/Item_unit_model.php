<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Item_unit_model extends CI_Model
{
    function item_unitListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.item_unit_id, BaseTbl.item_unit_name, BaseTbl.item_unit_created_at, BaseTbl.item_unit_updated_at');
        $this->db->from('tbl_item_unit as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.item_unit_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    function item_unitListing($searchText = '', $page, $segment)
    {
         $this->db->select('BaseTbl.item_unit_id, BaseTbl.item_unit_name, BaseTbl.item_unit_created_at, BaseTbl.item_unit_updated_at');
        $this->db->from('tbl_item_unit as BaseTbl');
        //$this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
        if(!empty($searchText)) {
           $likeCriteria = "(BaseTbl.item_unit_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('BaseTbl.item_unit_id', 'DESC');
        $this->db->limit($page, $segment);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    function add_new_item_unit($servicesInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_item_unit', $servicesInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
    
    function get_item_unit_info($id)
    {
         $this->db->select('BaseTbl.item_unit_id, BaseTbl.item_unit_name, BaseTbl.item_unit_created_at, BaseTbl.item_unit_updated_at');
        //$this->db->select('sub_service_id, service_id, sub_service_name');
        $this->db->from('tbl_item_unit as BaseTbl');
        $this->db->where('item_unit_id', $id);
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
    
    function edit_item_unit($val)
    {
        $this->db->set('item_unit_name',$val['item_unit_name']);
        $this->db->set('item_unit_updated_at',date('Y-m-d H:i:s'));
        $this->db->where('item_unit_id', $val['item_unit_id']);
        $this->db->update('tbl_item_unit');
        return TRUE;
    }
    
    function delete_item_unit($id)
    {
        $this->db->set('isDeleted',1);
        $this->db->where('item_unit_id', $id);
        $this->db->update('tbl_item_unit');
        return $this->db->affected_rows();
    }

    function getservicesInfoById($servicesId)
    {
        $this->db->select('servicesId, name, email, mobile, roleId');
        $this->db->from('tbl_services');
        $this->db->where('isDeleted', 0);
        $this->db->where('tbl_item_unit', $servicesId);
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

  