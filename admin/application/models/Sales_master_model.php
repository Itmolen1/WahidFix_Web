<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Sales_master_model extends CI_Model
{
    function sales_master_listing_count($searchText = '')
    {
        $this->db->select('BaseTbl.*,sr.service_request_ref');
        $this->db->from('tbl_sales_master as BaseTbl');
        $this->db->join('tbl_service_request as sr', 'sr.sr_id = BaseTbl.sales_quotation_sr_id','left');
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

    function sales_master_listing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.*,sr.service_request_ref');
        $this->db->from('tbl_sales_master as BaseTbl');
        $this->db->join('tbl_service_request as sr', 'sr.sr_id = BaseTbl.sales_quotation_sr_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.vehicle_no  LIKE '%".$searchText."%'
                            OR  BaseTbl.vehicle_tc_no  LIKE '%".$searchText."%'
                            OR  BaseTbl.vehicle_status  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $this->db->order_by('BaseTbl.sales_master_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }    

    function delete_purchase_master($id)
    {
        /*1.set deleted child record in po item table*/
        $this->db->set('isDeleted',1);
        $this->db->where('pm_boi_pm_id',$id); 
        $this->db->update('tbl_pm_boi');
        /*2.set po parent to deleted*/
        $this->db->set('isDeleted',1);
        $this->db->where('sales_master_id',$id); 
        $lid=$this->db->update('tbl_purchase_master');
        return $this->db->affected_rows();
    }  
}