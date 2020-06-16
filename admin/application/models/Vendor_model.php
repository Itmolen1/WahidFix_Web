<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Vendor_model extends CI_Model
{
    function vendor_listing_count($searchText = '')
    {
        $this->db->select('BaseTbl.vendor_id, BaseTbl.vendor_name, BaseTbl.vendor_mobile, BaseTbl.vendor_email, BaseTbl.vendor_payment_term,BaseTbl.vendor_created_at,BaseTbl.vendor_updated_at');
        $this->db->from('tbl_vendor as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.vendor_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.vendor_mobile  LIKE '%".$searchText."%'
                            OR  BaseTbl.vendor_payment_term  LIKE '%".$searchText."%'
                            OR  BaseTbl.vendor_company_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.vendor_email  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function vendor_listing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.vendor_id, BaseTbl.vendor_name, BaseTbl.vendor_mobile, BaseTbl.vendor_email,  BaseTbl.vendor_payment_term,BaseTbl.vendor_created_at,BaseTbl.vendor_updated_at');
        $this->db->from('tbl_vendor as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.vendor_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.vendor_mobile  LIKE '%".$searchText."%'
                            OR  BaseTbl.vendor_payment_term  LIKE '%".$searchText."%'
                            OR  BaseTbl.vendor_company_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.vendor_email  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $this->db->order_by('BaseTbl.vendor_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function get_service_list()
    {
        $query = $this->db->get('tbl_services');
        $result = $query->result_array();        
        return $result;
    }
    
    function getUserRoles()
    {
        $this->db->select('roleId, role');
        $this->db->from('tbl_roles');
        $this->db->where('roleId !=', 1);
        $query = $this->db->get();
        return $query->result();
    }

    function vendor_email_exists($vendor_email, $vendor_id = 0)
    {
        $this->db->select("vendor_email");
        $this->db->from("tbl_vendor");
        $this->db->where("vendor_email", $vendor_email);   
        $this->db->where("isDeleted", 0);
        if($vendor_id != 0){
            $this->db->where("vendor_id !=", $vendor_id);
        }
        $query = $this->db->get();

        return $query->result();
    }

    function add_new_vendor($val)
    {
        $data=array(
        'vendor_salutation'=>$val['vendor_salutation'],
        'vendor_name'=>$val['vendor_name'],
        'vendor_mobile'=>$val['vendor_mobile'],
        'vendor_email'=>$val['vendor_email'],
        'vendor_payment_term'=>$val['vendor_payment_term'],
        'vendor_created_at'=>date('Y-m-d H:i:s'),
        'vendor_updated_at'=>date('Y-m-d H:i:s'),
        'vendor_trn'=>$val['vendor_trn'],
        'vendor_tel'=>$val['vendor_tel'],
        'vendor_company_name'=>$val['vendor_company_name'],
        'vendor_billing_attention'=>$val['vendor_billing_attention'],
        'vendor_shipping_attention'=>$val['vendor_shipping_attention'],
        'vendor_billing_address'=>$val['vendor_billing_address'],
        'vendor_shipping_address'=>$val['vendor_shipping_address'],
        'vendor_shipping_city'=>$val['vendor_shipping_city'],
        'vendor_billing_city'=>$val['vendor_billing_city'],
        'vendor_shipping_country'=>$val['vendor_shipping_country'],
        'vendor_billing_country'=>$val['vendor_billing_country'],
        'vendor_shipping_phone'=>$val['vendor_shipping_phone'],
        'vendor_billing_phone'=>$val['vendor_billing_phone'],
        'vendor_shipping_fax'=>$val['vendor_shipping_fax'],
        'vendor_billing_fax'=>$val['vendor_billing_fax'],
       );
        $this->db->insert('tbl_vendor', $data); 
        $lid=$this->db->insert_id();
        //echo $this->db->last_query();die;
        return $lid;
    }

    function update_vendor($val)
    {
        $this->db->set('vendor_salutation',$val['vendor_salutation']);
        $this->db->set('vendor_name',$val['vendor_name']);
        $this->db->set('vendor_mobile',$val['vendor_mobile']);
        $this->db->set('vendor_email',$val['vendor_email']);
        $this->db->set('vendor_payment_term',$val['vendor_payment_term']);
        $this->db->set('vendor_updated_at',date('Y-m-d H:i:s'));
        $this->db->set('vendor_trn',$val['vendor_trn']);
        $this->db->set('vendor_tel',$val['vendor_tel']);
        $this->db->set('vendor_company_name',$val['vendor_company_name']);
        $this->db->set('vendor_billing_attention',$val['vendor_billing_attention']);
        $this->db->set('vendor_shipping_attention',$val['vendor_shipping_attention']);
        $this->db->set('vendor_billing_address',$val['vendor_billing_address']);
        $this->db->set('vendor_shipping_address',$val['vendor_shipping_address']);
        $this->db->set('vendor_shipping_city',$val['vendor_shipping_city']);
        $this->db->set('vendor_billing_city',$val['vendor_billing_city']);
        $this->db->set('vendor_shipping_country',$val['vendor_shipping_country']);
        $this->db->set('vendor_billing_country',$val['vendor_billing_country']);
        $this->db->set('vendor_shipping_phone',$val['vendor_shipping_phone']);
        $this->db->set('vendor_billing_phone',$val['vendor_billing_phone']);
        $this->db->set('vendor_shipping_fax',$val['vendor_shipping_fax']);
        $this->db->set('vendor_billing_fax',$val['vendor_billing_fax']);
        $this->db->where('vendor_id',$val['vendor_id']); 
        $lid=$this->db->update('tbl_vendor');
        //echo $this->db->last_query();die;
        return $lid;
    }

    function getUserInfo($userId)
    {
        $this->db->select('userId, name, email, mobile, roleId');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
		$this->db->where('roleId !=', 1);
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        
        return $query->row();
    }

    function get_vendor_by_id($id)
    {
        $this->db->where('vendor_id',$id);
        $query = $this->db->get('tbl_vendor');
        $result = $query->row_array();        
        return $result;
    }

    function delete_vendor($id)
    {
        $this->db->set('isDeleted',1);
        $this->db->where('vendor_id',$id); 
        $lid=$this->db->update('tbl_vendor');
        return $this->db->affected_rows();
    }

    function matchOldPassword($userId, $oldPassword)
    {
        $this->db->select('userId, password');
        $this->db->where('userId', $userId);        
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('tbl_users');
        
        $user = $query->result();

        if(!empty($user)){
            if(verifyHashedPassword($oldPassword, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    function changePassword($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbl_users', $userInfo);
        
        return $this->db->affected_rows();
    }

    function loginHistoryCount($userId, $searchText, $fromDate, $toDate)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.sessionData LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        if($userId >= 1){
            $this->db->where('BaseTbl.userId', $userId);
        }
        $this->db->from('tbl_last_login as BaseTbl');
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function loginHistory($userId, $searchText, $fromDate, $toDate, $page, $segment)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        $this->db->from('tbl_last_login as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.sessionData  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        if($userId >= 1){
            $this->db->where('BaseTbl.userId', $userId);
        }
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function getUserInfoById($userId)
    {
        $this->db->select('userId, name, email, mobile, roleId');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        
        return $query->row();
    }

    function getUserInfoWithRole($userId)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.roleId, Roles.role');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }
}