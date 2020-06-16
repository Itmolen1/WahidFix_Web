<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Purchase_order_model extends CI_Model
{
    function purchase_order_listing_count($searchText = '')
    {
        $this->db->select('BaseTbl.*,Vendor.*');
        $this->db->from('tbl_purchase_order as BaseTbl');
        $this->db->join('tbl_vendor as Vendor', 'Vendor.vendor_id = BaseTbl.purchase_order_venodr_id','left');
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

    function purchase_order_listing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.*,Vendor.*');
        $this->db->from('tbl_purchase_order as BaseTbl');
        $this->db->join('tbl_vendor as Vendor', 'Vendor.vendor_id = BaseTbl.purchase_order_venodr_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.vehicle_no  LIKE '%".$searchText."%'
                            OR  BaseTbl.vehicle_tc_no  LIKE '%".$searchText."%'
                            OR  BaseTbl.vehicle_status  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $this->db->order_by('BaseTbl.purchase_order_id', 'DESC');
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
        $this->db->order_by('purchase_order_id', 'DESC');
        $query = $this->db->get('tbl_purchase_order', 1 );
        $result=$query->row_array();
        if(empty($result))
        {
            return 'BILL-'.str_pad(0+1,4,'0',STR_PAD_LEFT);
        }
        else
        {
            return 'BILL-'.str_pad($result['purchase_order_id']+1, 4, '0', STR_PAD_LEFT);
        }
    }

    function add_new_purchase_order($val,$sid)
    {
        $data=array(
        'purchase_order_venodr_id'=>$val['purchase_order_venodr_id'],
        'purchase_order_bill_no'=>$val['purchase_order_bill_no'],
        'purchase_order_date'=>$val['purchase_order_date'],
        'purchase_order_payment_term'=>$val['purchase_order_payment_term'],
        'purchase_order_due_date'=>$val['purchase_order_due_date'],
        'purchase_order_reference_no'=>$val['purchase_order_reference_no'],
        'purchase_order_vendor_notes'=>$val['purchase_order_vendor_notes'],
        'purchase_order_tc'=>$val['purchase_order_tc'],
        'purchase_order_sub_total'=>$val['purchase_order_sub_total'],
        'purchase_order_tax_per'=>$val['purchase_order_tax_per'],
        'purchase_order_tax_amt'=>$val['purchase_order_tax_amt'],
        'purchase_order_grand_total'=>$val['purchase_order_grand_total'],
        'purchase_order_image'=>$val['purchase_order_image'],
        'purchase_order_created_at'=>date('Y-m-d H:i:s'),
        'purchase_order_updated_at'=>date('Y-m-d H:i:s'),
        'po_boi_po_id_session'=>$sid
       );
        $this->db->insert('tbl_purchase_order', $data); 
        $lid=$this->db->insert_id();
        //echo $this->db->last_query();die;
        return $lid;
    }

    function update_purchase_order($val)
    {
        //$this->db->set('vehicle_no',$val['vehicle_no']);
        $this->db->set('purchase_order_venodr_id',$val['purchase_order_venodr_id']);
        $this->db->set('purchase_order_date',$val['purchase_order_date']);
        $this->db->set('purchase_order_payment_term',$val['purchase_order_payment_term']);
        $this->db->set('purchase_order_due_date',$val['purchase_order_due_date']);
        $this->db->set('purchase_order_reference_no',$val['purchase_order_reference_no']);
        $this->db->set('purchase_order_vendor_notes',$val['purchase_order_vendor_notes']);
        $this->db->set('purchase_order_tc',$val['purchase_order_tc']);
        $this->db->set('purchase_order_updated_at',date('Y-m-d H:i:s'));
        $this->db->set('purchase_order_sub_total',$val['purchase_order_sub_total']);
        $this->db->set('purchase_order_tax_amt',$val['purchase_order_tax_amt']);
        $this->db->set('purchase_order_grand_total',$val['purchase_order_grand_total']);
        $this->db->set('purchase_order_image',$val['purchase_order_image']);
        $this->db->where('purchase_order_id',$val['purchase_order_id']); 
        $lid=$this->db->update('tbl_purchase_order');
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
                    'po_boi_po_id'=>$poid,
                    'po_boi_po_id_session'=>$records[$i]['po_boi_po_id_session'],
                    'item_master_id'=>$records[$i]['item_master_id_session'],
                    'po_boi_detail'=>$records[$i]['po_boi_detail_session'],
                    'item_unit_id'=>$records[$i]['item_unit_id_session'],
                    'po_boi_qty'=>$records[$i]['po_boi_qty_session'],
                    'po_boi_rate'=>$records[$i]['po_boi_rate_session'],
                    'po_boi_total'=>$records[$i]['po_boi_total_session'],
                    'po_boi_created_at'=>$records[$i]['po_boi_created_at_session'],
                    'po_boi_updated_at'=>$records[$i]['po_boi_updated_at_session']
                );
                $this->db->insert('tbl_po_boi', $value);
                $this->db->where('po_boi_id_session', $records[$i]['po_boi_id_session']);
                $this->db->delete('tbl_po_boi_session'); 
            }
        }
    }

    function add_po_boi_session($val)
    {
        //echo "<pre>";print_r($val);die;
        //echo "<pre>";print_r($this->session->userdata('po_boi_po_id_session'));die;
        $total=$val['po_boi_qty_session']*$val['po_boi_rate_session'];
        $data=array(
        'item_master_id_session'=>$val['item_master_id_session'],
        'po_boi_po_id_session'=>$this->session->userdata['purchase_order_item']['po_boi_po_id_session'],
        'po_boi_detail_session'=>$val['po_boi_detail_session'],
        'item_unit_id_session'=>$val['item_unit_id_session'],
        'po_boi_qty_session'=>$val['po_boi_qty_session'],
        'po_boi_rate_session'=>$val['po_boi_rate_session'],
        'po_boi_total_session'=>$total,
        'po_boi_created_at_session'=>date('Y-m-d H:i:s'),
        'po_boi_updated_at_session'=>date('Y-m-d H:i:s'),
       );
        $this->db->insert('tbl_po_boi_session', $data); 
        $lid=$this->db->insert_id();
        //echo $this->db->last_query();die;

        $this->db->select('BaseTbl.*,Item.*,Unit.*');
        $this->db->from('tbl_po_boi_session as BaseTbl');
        $this->db->join('tbl_item_master as Item', 'Item.item_master_id = BaseTbl.item_master_id_session','left');
        $this->db->join('tbl_item_unit as Unit', 'Unit.item_unit_id = BaseTbl.item_unit_id_session','left');
        $this->db->where('BaseTbl.po_boi_id_session',$lid);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->row_array();
    }

    function delete_po_boi_session($id)
    {
        //echo "<pre>";print_r($id['data']);die;
        $this->db->where('po_boi_id_session',$id); 
        $lid=$this->db->delete('tbl_po_boi_session');
        //echo $this->db->last_query();die;
        return TRUE;
    }

    function get_po_boi_po_id_session($record_num)
    {
        $this->db->select('po_boi_po_id_session');
        $query=$this->db->get_where('tbl_po_boi_session',array('po_boi_id_session'=>$record_num));
        //echo $this->db->last_query();die;
        $session_id=$query->row_array();
        return $session_id['po_boi_po_id_session'];
    }

    function get_remaining($session_id)
    {
        $query=$this->db->get_where('tbl_po_boi_session',array('po_boi_po_id_session'=>$session_id));
        return $query->result_array();        
    }

    function get_items_by_session_id($po_boi_po_id_session)
    {
        $this->db->select('BaseTbl.*,Item.*,Unit.*');
        $this->db->from('tbl_po_boi_session as BaseTbl');
        $this->db->join('tbl_item_master as Item', 'Item.item_master_id = BaseTbl.item_master_id_session','left');
        $this->db->join('tbl_item_unit as Unit', 'Unit.item_unit_id = BaseTbl.item_unit_id_session','left');
        $this->db->where('BaseTbl.po_boi_po_id_session',$po_boi_po_id_session);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    function get_all_by_session_id($sid)
    {
        $this->db->where('po_boi_po_id_session',$sid);
        $query=$this->db->get('tbl_po_boi_session');
        $result=$query->result_array();
        return $result;
    }

    function get_all_boi_by_poid($record_num)
    {
        $this->db->where('po_boi_po_id',$record_num);
        $query=$this->db->get('tbl_po_boi');
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
                    'po_id'=>$records[$i]['po_boi_po_id'],
                    'po_boi_po_id_session'=>$records[$i]['po_boi_po_id_session'],
                    'item_master_id_session'=>$records[$i]['item_master_id'],
                    'po_boi_detail_session'=>$records[$i]['po_boi_detail'],
                    'item_unit_id_session'=>$records[$i]['item_unit_id'],
                    'po_boi_qty_session'=>$records[$i]['po_boi_qty'],
                    'po_boi_rate_session'=>$records[$i]['po_boi_rate'],
                    'po_boi_total_session'=>$records[$i]['po_boi_total'],
                    'po_boi_created_at_session'=>$records[$i]['po_boi_created_at'],
                    'po_boi_updated_at_session'=>$records[$i]['po_boi_updated_at']
                );
                $this->db->insert('tbl_po_boi_session', $value);
                $this->db->where('po_boi_id', $records[$i]['po_boi_id']);
                $this->db->delete('tbl_po_boi'); 
            }
        }
    }

    function get_po_by_id($poid)
    {
        $this->db->where('purchase_order_id',$poid);
        $query=$this->db->get('tbl_purchase_order');
        $result=$query->row_array();
        return $result;
    }

    function get_po_pdf_data($poid)
    {
        $this->db->select('BaseTbl.*,vendor.*');
        $this->db->from('tbl_purchase_order as BaseTbl');
        $this->db->join('tbl_vendor as vendor', 'vendor.vendor_id = BaseTbl.purchase_order_venodr_id','left');
        //$this->db->join('tbl_item_unit as Unit', 'Unit.item_unit_id = BaseTbl.item_unit_id_session','left');
        $this->db->where('BaseTbl.purchase_order_id',$poid);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->row_array();
    }

    function get_all_boi_by_poid_pdf($poid)
    {
        $this->db->select('BaseTbl.*,item.*,Unit.*');
        $this->db->from('tbl_po_boi as BaseTbl');
        $this->db->join('tbl_item_master as item', 'item.item_master_id = BaseTbl.item_master_id','left');
        $this->db->join('tbl_item_unit as Unit', 'Unit.item_unit_id = BaseTbl.item_unit_id','left');
        $this->db->where('BaseTbl.po_boi_po_id',$poid);
        $query = $this->db->get();
        return $query->result_array();
    }

    function delete_purchase_order($id)
    {
        /*1.set deleted child record in po item table*/
        $this->db->set('isDeleted',1);
        $this->db->where('po_boi_po_id',$id); 
        $this->db->update('tbl_po_boi');
        /*2.set po parent to deleted*/
        $this->db->set('isDeleted',1);
        $this->db->where('purchase_order_id',$id); 
        $lid=$this->db->update('tbl_purchase_order');
        return $this->db->affected_rows();
    }
}