<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Services_model extends CI_Model
{
    function servicesListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.service_id, BaseTbl.service_name, BaseTbl.created_at, BaseTbl.updated_at,BaseTbl.service_logo,BaseTbl.service_desc,BaseTbl.detail_page');
        $this->db->from('tbl_services as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.service_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.service_desc  LIKE '%".$searchText."%'
                            OR  BaseTbl.created_at  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    function servicesListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.service_id, BaseTbl.service_name, BaseTbl.created_at, BaseTbl.updated_at,BaseTbl.service_logo,BaseTbl.service_desc,BaseTbl.detail_page');
        $this->db->from('tbl_services as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.service_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.service_desc  LIKE '%".$searchText."%'
                            OR  BaseTbl.created_at  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $this->db->order_by('BaseTbl.service_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    function getservicesRoles()
    {
        $this->db->select('roleId, role');
        $this->db->from('tbl_roles');
        $this->db->where('roleId !=', 1);
        $query = $this->db->get();
        
        return $query->result();
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

    function addNewservices($servicesInfo)
    {
        //echo "model";die;
        $this->db->trans_start();
        $this->db->insert('tbl_services', $servicesInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
    
    
    function getservicesInfo($service_id)
    {
        $this->db->select('service_id, service_name, created_at, updated_at,service_logo,service_desc,detail_page');
        $this->db->from('tbl_services');
        $this->db->where('service_id', $service_id);
        $query = $this->db->get();
        return $query->row();
    }
    
    function editservices($val)
    {
        $this->db->set('service_name',$val['service_name']);
        $this->db->set('service_desc',$val['service_desc']);
        $this->db->set('detail_page',$val['detail_page']);
        $this->db->set('updated_at',date('Y-m-d H:i:s'));
        $this->db->set('service_logo',$val['service_logo']);
        $this->db->where('service_id', $val['service_id']);
        $this->db->update('tbl_services');
        return TRUE;
    }
    
    function deleteservices($id)
    {
        $this->db->set('isDeleted',1);
        $this->db->where('service_id', $id);
        $this->db->update('tbl_services');
        return $this->db->affected_rows();
    }

    function getservicesInfoById($servicesId)
    {
        $this->db->select('servicesId, name, email, mobile, roleId,detail_page');
        $this->db->from('tbl_services');
        $this->db->where('isDeleted', 0);
        $this->db->where('servicesId', $servicesId);
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

  