<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Careers_model extends CI_Model
{
    function careers_ListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_careers as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.careers_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.careers_email  LIKE '%".$searchText."%'
                            OR  BaseTbl.careers_mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();        
        return $query->num_rows();
    }
    
    function careers_Listing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_careers as BaseTbl');
         if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.careers_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.careers_email  LIKE '%".$searchText."%'
                            OR  BaseTbl.careers_mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('BaseTbl.careers_id', 'DESC');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->limit($page, $segment);
        $query = $this->db->get();        
        $result = $query->result();        
        return $result;
    }
   
    function get_info($id)
    {
        $this->db->select('id,name,email,mobile_number,comments');
        $this->db->from('tbl_careers');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function send_mail($data)
    {
        $this->db->select('service_id, service_name, created_at, updated_at');
        $this->db->from('tbl_careers');
        $query = $this->db->get();
        return $query->result_array();
    }

    function delete_careers($id)
    {
        $this->db->set('isDeleted',1);
        $this->db->where('careers_id', $id);
        $this->db->update('tbl_careers');
        return $this->db->affected_rows();
    }   
}