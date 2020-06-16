<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class R_user_model extends CI_Model
{
    function r_userListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.tbl_user_id, BaseTbl.tbl_user_name, BaseTbl.tbl_user_mobile, BaseTbl.tbl_user_email,BaseTbl.tbl_user_platform,BaseTbl.tbl_user_createdat,BaseTbl.tbl_user_updatedat');
        $this->db->from('tbl_user as BaseTbl');
        //$this->db->join('tbl_item_unit as u', 'u.item_unit_id = BaseTbl.item_master_unit','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.tbl_user_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.tbl_user_mobile  LIKE '%".$searchText."%'
                            OR  BaseTbl.tbl_user_email  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    function r_userListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.tbl_user_id, BaseTbl.tbl_user_name, BaseTbl.tbl_user_mobile, BaseTbl.tbl_user_email,BaseTbl.tbl_user_platform,BaseTbl.tbl_user_createdat,BaseTbl.tbl_user_updatedat');
        $this->db->from('tbl_user as BaseTbl');
        //$this->db->join('tbl_item_unit as u', 'u.item_unit_id = BaseTbl.item_master_unit','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.tbl_user_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.tbl_user_mobile  LIKE '%".$searchText."%'
                            OR  BaseTbl.tbl_user_email  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('BaseTbl.tbl_user_id', 'DESC');
        $this->db->limit($page, $segment);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    
    function add_new_r_user($servicesInfo)
    {
        //echo "model";die;
        $this->db->trans_start();
        $this->db->insert('tbl_user', $servicesInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
    
    function get_r_user_info($id)
    {
        $this->db->select('BaseTbl.tbl_user_name, BaseTbl.tbl_user_mobile, BaseTbl.tbl_user_email, BaseTbl.tbl_user_platform,BaseTbl.tbl_user_password');
        //$this->db->select('sub_service_id, service_id, sub_service_name');
        $this->db->from('tbl_user as BaseTbl');
        $this->db->where('tbl_user_id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    
    function edit_r_user($val)
    {
        $this->db->set('tbl_user_name',$val['tbl_user_name']);
        $this->db->set('tbl_user_mobile',$val['tbl_user_mobile']);
        $this->db->set('tbl_user_email',$val['tbl_user_email']);
        $this->db->set('tbl_user_updatedat',date('Y-m-d H:i:s'));
        $this->db->where('tbl_user_id', $val['tbl_user_id']);
        $this->db->update('tbl_user');
        return TRUE;
    }
    
    function delete_r_user($id)
    {
        $this->db->set('isDeleted',1);
        $this->db->where('tbl_user_id', $id);
        $this->db->update('tbl_user');
        return $this->db->affected_rows();
    }

    function getservicesInfoById($servicesId)
    {
        $this->db->select('servicesId, name, email, mobile, roleId');
        $this->db->from('tbl_services');
        $this->db->where('isDeleted', 0);
        $this->db->where('tbl_item_master', $servicesId);
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

  