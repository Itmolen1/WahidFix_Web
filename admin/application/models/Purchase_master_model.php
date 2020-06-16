<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Purchase_master_model extends CI_Model
{
    function purchase_master_listing_count($searchText = '')
    {
        $this->db->select('BaseTbl.*,Vendor.*');
        $this->db->from('tbl_purchase_master as BaseTbl');
        $this->db->join('tbl_vendor as Vendor', 'Vendor.vendor_id = BaseTbl.purchase_master_venodr_id','left');
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

    function purchase_master_listing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.*,Vendor.*');
        $this->db->from('tbl_purchase_master as BaseTbl');
        $this->db->join('tbl_vendor as Vendor', 'Vendor.vendor_id = BaseTbl.purchase_master_venodr_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.vehicle_no  LIKE '%".$searchText."%'
                            OR  BaseTbl.vehicle_tc_no  LIKE '%".$searchText."%'
                            OR  BaseTbl.vehicle_status  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $this->db->order_by('BaseTbl.purchase_master_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function get_vendor_list()
    {
        $query = $this->db->get('tbl_vendor');
        $result = $query->result_array();        
        return $result;
    }

    function get_item_list()
    {
        $query = $this->db->get('tbl_item_master');
        $result = $query->result_array();        
        return $result;
    }

    function get_unit_list()
    {
        $query = $this->db->get('tbl_item_unit');
        $result = $query->result_array();        
        return $result;
    }

    function get_bill_no()
    {
        $this->db->order_by('purchase_master_id', 'DESC');
        $query = $this->db->get('tbl_purchase_master', 1 );
        $result=$query->row_array();
        if(empty($result))
        {
            return 'INV-'.str_pad(0+1,4,'0',STR_PAD_LEFT);
        }
        else
        {
            return 'INV-'.str_pad($result['purchase_master_id']+1, 4, '0', STR_PAD_LEFT);
        }
    }

    function add_new_purchase_master($val,$sid)
    {
        $data=array(
        'purchase_master_venodr_id'=>$val['purchase_master_venodr_id'],
        'purchase_master_bill_no'=>$val['purchase_master_bill_no'],
        'purchase_master_date'=>$val['purchase_master_date'],
        'purchase_master_payment_term'=>$val['purchase_master_payment_term'],
        'purchase_master_due_date'=>$val['purchase_master_due_date'],
        'purchase_master_reference_no'=>$val['purchase_master_reference_no'],
        'purchase_master_vendor_notes'=>$val['purchase_master_vendor_notes'],
        'purchase_master_tc'=>$val['purchase_master_tc'],
        'purchase_master_sub_total'=>$val['purchase_master_sub_total'],
        'purchase_master_tax_per'=>$val['purchase_master_tax_per'],
        'purchase_master_tax_amt'=>$val['purchase_master_tax_amt'],
        'purchase_master_grand_total'=>$val['purchase_master_grand_total'],
        'purchase_master_image'=>$val['purchase_master_image'],
        'purchase_master_paid_amt'=>0.0,
        'purchase_master_due_amt'=>$val['purchase_master_grand_total'],
        'purchase_master_created_at'=>date('Y-m-d H:i:s'),
        'purchase_master_updated_at'=>date('Y-m-d H:i:s'),
        'pm_boi_pm_id_session'=>$sid
       );
        $this->db->insert('tbl_purchase_master', $data); 
        $lid=$this->db->insert_id();
        //echo $this->db->last_query();die;
        return $lid;
    }

    function purchase_master_add_payment_record($val)
    {
        $data=array(
        'pm_payment_record_pm_id'=>$val['pm_payment_record_pm_id'],
        'pm_payment_record_date'=>$val['pm_payment_record_date'],
        'pm_payment_record_invoice_no'=>$val['purchase_master_bill_no'],
        'pm_payment_record_payment_no'=>$val['pm_payment_record_payment_no'],
        'pm_payment_record_type'=>$val['pm_payment_record_type'],
        'pm_payment_record_cheque_no'=>$val['pm_payment_record_cheque_no'],
        'pm_payment_record_bank'=>$val['pm_payment_record_bank'],
        'pm_payment_record_total_amt'=>$val['pm_payment_record_total_amt'],
        'pm_payment_record_paid_amt'=>$val['pm_payment_record_paid_amt'],
        'pm_payment_record_due_amt'=>$val['pm_payment_record_due_amt'],
        'pm_payment_record_note'=>$val['pm_payment_record_note'],
        'pm_payment_record_created_at'=>date('Y-m-d H:i:s'),
        'pm_payment_record_updated_at'=>date('Y-m-d H:i:s')
       );
        $this->db->insert('tbl_pm_payment_record', $data); 
        //$lid=$this->db->insert_id();

        $this->db->set('purchase_master_due_amt',($val['purchase_master_due_amt']-$val['pm_payment_record_due_amt']));
        $this->db->set('purchase_master_paid_amt',($val['pm_payment_record_paid_amt']+$val['pm_payment_record_due_amt']));
        $this->db->where('purchase_master_id',$val['pm_payment_record_pm_id']); 
        $lid=$this->db->update('tbl_purchase_master');
        //echo $this->db->last_query();die;
        return TRUE;
    }

    function update_purchase_master($val)
    {
        //$this->db->set('vehicle_no',$val['vehicle_no']);
        $this->db->set('purchase_master_venodr_id',$val['purchase_master_venodr_id']);
        $this->db->set('purchase_master_date',$val['purchase_master_date']);
        $this->db->set('purchase_master_payment_term',$val['purchase_master_payment_term']);
        $this->db->set('purchase_master_due_date',$val['purchase_master_due_date']);
        $this->db->set('purchase_master_reference_no',$val['purchase_master_reference_no']);
        $this->db->set('purchase_master_vendor_notes',$val['purchase_master_vendor_notes']);
        $this->db->set('purchase_master_tc',$val['purchase_master_tc']);
        $this->db->set('purchase_master_updated_at',date('Y-m-d H:i:s'));
        $this->db->set('purchase_master_sub_total',$val['purchase_master_sub_total']);
        $this->db->set('purchase_master_tax_amt',$val['purchase_master_tax_amt']);
        $this->db->set('purchase_master_grand_total',$val['purchase_master_grand_total']);
        $this->db->set('purchase_master_image',$val['purchase_master_image']);
        $this->db->where('purchase_master_id',$val['purchase_master_id']); 
        $lid=$this->db->update('tbl_purchase_master');
        //echo $this->db->last_query();die;
        return $lid;
    }

    function insert_session_to_boi($records,$poid)
    {
        if(!empty($records))
        {
            for($i=0;$i<count($records);$i++)
            {
                $value=array(
                    'pm_boi_pm_id'=>$poid,
                    'pm_boi_pm_id_session'=>$records[$i]['pm_boi_pm_id_session'],
                    'item_master_id'=>$records[$i]['item_master_id_session'],
                    'pm_boi_detail'=>$records[$i]['pm_boi_detail_session'],
                    'item_unit_id'=>$records[$i]['item_unit_id_session'],
                    'pm_boi_qty'=>$records[$i]['pm_boi_qty_session'],
                    'pm_boi_rate'=>$records[$i]['pm_boi_rate_session'],
                    'pm_boi_total'=>$records[$i]['pm_boi_total_session'],
                    'pm_boi_created_at'=>$records[$i]['pm_boi_created_at_session'],
                    'pm_boi_updated_at'=>$records[$i]['pm_boi_updated_at_session']
                );
                $this->db->insert('tbl_pm_boi', $value);
                $this->db->where('pm_boi_id_session', $records[$i]['pm_boi_id_session']);
                $this->db->delete('tbl_pm_boi_session'); 
            }
        }
    }

    function add_pm_boi_session($val)
    {
        //echo "<pre>";print_r($val);die;
        //echo "<pre>";print_r($this->session->userdata('pm_boi_pm_id_session'));die;
        $total=$val['pm_boi_qty_session']*$val['pm_boi_rate_session'];
        $data=array(
        'item_master_id_session'=>$val['item_master_id_session'],
        'pm_boi_pm_id_session'=>$this->session->userdata['purchase_master_item']['pm_boi_pm_id_session'],
        'pm_boi_detail_session'=>$val['pm_boi_detail_session'],
        'item_unit_id_session'=>$val['item_unit_id_session'],
        'pm_boi_qty_session'=>$val['pm_boi_qty_session'],
        'pm_boi_rate_session'=>$val['pm_boi_rate_session'],
        'pm_boi_total_session'=>$total,
        'pm_boi_created_at_session'=>date('Y-m-d H:i:s'),
        'pm_boi_updated_at_session'=>date('Y-m-d H:i:s'),
       );
        $this->db->insert('tbl_pm_boi_session', $data); 
        $lid=$this->db->insert_id();
        //echo $this->db->last_query();die;

        $this->db->select('BaseTbl.*,Item.*,Unit.*');
        $this->db->from('tbl_pm_boi_session as BaseTbl');
        $this->db->join('tbl_item_master as Item', 'Item.item_master_id = BaseTbl.item_master_id_session','left');
        $this->db->join('tbl_item_unit as Unit', 'Unit.item_unit_id = BaseTbl.item_unit_id_session','left');
        $this->db->where('BaseTbl.pm_boi_id_session',$lid);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->row_array();
    }

    function delete_pm_boi_session($id)
    {
        //echo "<pre>";print_r($id['data']);die;
        $this->db->where('pm_boi_id_session',$id); 
        $lid=$this->db->delete('tbl_pm_boi_session');
        //echo $this->db->last_query();die;
        return TRUE;
    }

    function get_pm_boi_pm_id_session($record_num)
    {
        $this->db->select('pm_boi_pm_id_session');
        $query=$this->db->get_where('tbl_pm_boi_session',array('pm_boi_id_session'=>$record_num));
        //echo $this->db->last_query();die;
        $session_id=$query->row_array();
        return $session_id['pm_boi_pm_id_session'];
    }

    function get_remaining($session_id)
    {
        $query=$this->db->get_where('tbl_pm_boi_session',array('pm_boi_pm_id_session'=>$session_id));
        return $query->result_array();        
    }

    function get_items_by_session_id($pm_boi_pm_id_session)
    {
        $this->db->select('BaseTbl.*,Item.*,Unit.*');
        $this->db->from('tbl_pm_boi_session as BaseTbl');
        $this->db->join('tbl_item_master as Item', 'Item.item_master_id = BaseTbl.item_master_id_session','left');
        $this->db->join('tbl_item_unit as Unit', 'Unit.item_unit_id = BaseTbl.item_unit_id_session','left');
        $this->db->where('BaseTbl.pm_boi_pm_id_session',$pm_boi_pm_id_session);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    function get_all_by_session_id($sid)
    {
        $this->db->where('pm_boi_pm_id_session',$sid);
        $query=$this->db->get('tbl_pm_boi_session');
        $result=$query->result_array();
        return $result;
    }

    function get_all_boi_by_poid($record_num)
    {
        $this->db->where('pm_boi_pm_id',$record_num);
        $query=$this->db->get('tbl_pm_boi');
        $result=$query->result_array();
        return $result;
    }

    function inset_boi_to_session($records)
    {
        if(!empty($records))
        {
            for($i=0;$i<count($records);$i++)
            {
                $value=array(
                    'pm_id'=>$records[$i]['pm_boi_pm_id'],
                    'pm_boi_pm_id_session'=>$records[$i]['pm_boi_pm_id_session'],
                    'item_master_id_session'=>$records[$i]['item_master_id'],
                    'pm_boi_detail_session'=>$records[$i]['pm_boi_detail'],
                    'item_unit_id_session'=>$records[$i]['item_unit_id'],
                    'pm_boi_qty_session'=>$records[$i]['pm_boi_qty'],
                    'pm_boi_rate_session'=>$records[$i]['pm_boi_rate'],
                    'pm_boi_total_session'=>$records[$i]['pm_boi_total'],
                    'pm_boi_created_at_session'=>$records[$i]['pm_boi_created_at'],
                    'pm_boi_updated_at_session'=>$records[$i]['pm_boi_updated_at']
                );
                $this->db->insert('tbl_pm_boi_session', $value);
                $this->db->where('pm_boi_id', $records[$i]['pm_boi_id']);
                $this->db->delete('tbl_pm_boi'); 
            }
        }
    }

    function get_po_by_id($poid)
    {
        $this->db->where('purchase_master_id',$poid);
        $query=$this->db->get('tbl_purchase_master');
        $result=$query->row_array();
        return $result;
    }

    function get_pm_pdf_data($poid)
    {
        $this->db->select('BaseTbl.*,vendor.*');
        $this->db->from('tbl_purchase_master as BaseTbl');
        $this->db->join('tbl_vendor as vendor', 'vendor.vendor_id = BaseTbl.purchase_master_venodr_id','left');
        //$this->db->join('tbl_item_unit as Unit', 'Unit.item_unit_id = BaseTbl.item_unit_id_session','left');
        $this->db->where('BaseTbl.purchase_master_id',$poid);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->row_array();
    }

    function get_all_boi_by_poid_pdf($poid)
    {
        $this->db->select('BaseTbl.*,item.*,Unit.*');
        $this->db->from('tbl_pm_boi as BaseTbl');
        $this->db->join('tbl_item_master as item', 'item.item_master_id = BaseTbl.item_master_id','left');
        $this->db->join('tbl_item_unit as Unit', 'Unit.item_unit_id = BaseTbl.item_unit_id','left');
        $this->db->where('BaseTbl.pm_boi_pm_id',$poid);
        $query = $this->db->get();
        return $query->result_array();
    }

    function delete_purchase_master($id)
    {
        /*1.set deleted child record in po item table*/
        $this->db->set('isDeleted',1);
        $this->db->where('pm_boi_pm_id',$id); 
        $this->db->update('tbl_pm_boi');
        /*2.set po parent to deleted*/
        $this->db->set('isDeleted',1);
        $this->db->where('purchase_master_id',$id); 
        $lid=$this->db->update('tbl_purchase_master');
        return $this->db->affected_rows();
    }

    function purchase_master_get_payment_record_details($poid)
    {
        $this->db->select('BaseTbl.*,vendor.*');
        $this->db->from('tbl_purchase_master as BaseTbl');
        $this->db->join('tbl_vendor as vendor', 'vendor.vendor_id = BaseTbl.purchase_master_venodr_id','left');
        $this->db->where('BaseTbl.purchase_master_id',$poid);
        $query = $this->db->get();
        return $query->row_array();
    }
}