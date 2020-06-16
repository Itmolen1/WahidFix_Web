<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Slider_model extends CI_Model
{
    function sliderListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.slider_id, BaseTbl.slider_image, BaseTbl.slider_image_alt, BaseTbl.created_at,BaseTbl.updated_at');
        $this->db->from('tbl_slider as BaseTbl');
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
    
    function sliderListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.slider_id, BaseTbl.slider_image, BaseTbl.slider_image_alt, BaseTbl.created_at,BaseTbl.updated_at');
        $this->db->from('tbl_slider as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $this->db->order_by('BaseTbl.slider_id', 'DESC');
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

    function addNewslider($servicesInfo)
    {
        //echo "model";die;
        $this->db->trans_start();
        $this->db->insert('tbl_slider', $servicesInfo);        
        $insert_id = $this->db->insert_id();        
        $this->db->trans_complete();        
        return $insert_id;
    }
    
    
    function getsliderInfo($service_id)
    {
        $this->db->select('slider_id,slider_image,slider_image_alt,created_at,updated_at');
        $this->db->from('tbl_slider');
        $this->db->where('slider_id', $service_id);
        $query = $this->db->get();
        return $query->row();
    }
    
    function editslider($val)
    {
        $this->db->set('slider_image_alt',$val['slider_image_alt']);
        $this->db->set('updated_at',date('Y-m-d H:i:s'));
        $this->db->set('slider_image',$val['slider_image']);
        $this->db->where('slider_id', $val['slider_id']);
        $this->db->update('tbl_slider');
        return TRUE;
    }
    
    function deleteslider($id)
    {
        $this->db->set('isDeleted',1);
        $this->db->where('slider_id', $id);
        $this->db->update('tbl_slider');
        return $this->db->affected_rows();
    }
}  