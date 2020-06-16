<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Contact_us_model extends CI_Model
{
    function contact_usListingCount($searchText = '')
    {
        $this->db->select('id,name,email,mobile_number,comments,created_at');
        $this->db->from('tbl_contact_us as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();        
        return $query->num_rows();
    }
    
    function contact_usListing($searchText = '', $page, $segment)
    {
        $this->db->select('id,name,email,mobile_number,comments,created_at,status');
        $this->db->from('tbl_contact_us as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->limit($page, $segment);
        $query = $this->db->get();        
        $result = $query->result();        
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
    
    function get_info($id)
    {
        $this->db->select('id,name,email,mobile_number,comments');
        $this->db->from('tbl_contact_us');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function send_mail($data)
    {
        $this->db->select('service_id, service_name, created_at, updated_at');
        $this->db->from('tbl_services');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function update_values($val)
    {
        $this->db->set('status',1);
        $this->db->set('admin_reply',$val['admin_reply']);
        $this->db->set('updated_at',date('Y-m-d H:i:s'));
        $this->db->where('id', $val['id']);
        $this->db->update('tbl_contact_us');
        return TRUE;
    }
    
    function delete_contact_us($id)
    {
        $this->db->set('isDeleted',1);
        $this->db->where('id', $id);
        $this->db->update('tbl_contact_us');
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

  