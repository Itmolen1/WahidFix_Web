<?php 
class global_model extends CI_Model {
	public function add($data)
	{
		$this->db->insert('tbl_user',$data);
	}
	public function edit($data)
	{	
		$this->db->where('news_id', $this->input->get('news_id'));
		$this->db->update('news', $data); 
	}

	public function get_service_list()
	{
		$this->db->select('*');
		$this->db->where('isDeleted',0);
        //$this->db->select('sub_service_id, service_id, sub_service_name');
        $this->db->from('tbl_services');
        //$this->db->join('tbl_sub_services as s', 's.service_id = BaseTbl.service_id','left');
        $query = $this->db->get();
        return $query->result_array();
	}

	public function get_time_slot_list()
	{
		$this->db->select('*');
		$this->db->where('isDeleted',0);
        //$this->db->select('sub_service_id, service_id, sub_service_name');
        $this->db->from('tbl_time_slot');
        //$this->db->join('tbl_sub_services as s', 's.service_id = BaseTbl.service_id','left');
        $query = $this->db->get();
        return $query->result_array();
	}

	public function get_slider_list()
	{
		$this->db->select('BaseTbl.slider_id, BaseTbl.slider_image,BaseTbl.slider_image_alt,BaseTbl.created_at');
        //$this->db->select('sub_service_id, service_id, sub_service_name');
        $this->db->from('tbl_slider as BaseTbl');
        $this->db->where('isDeleted',0);
        //$this->db->join('tbl_sub_services as s', 's.service_id = BaseTbl.service_id','left');
        $query = $this->db->get();
        return $query->result_array();
	}

	public function get_sub_services($id)
	{
		$this->db->select('*');
        $this->db->from('tbl_sub_services');
        $this->db->where('service_id',$id);
        $query = $this->db->get();
        return $query->result_array();
	}

	public function get_service_id($record_num)
	{
		$this->db->select('*');
		$this->db->where('detail_page',$record_num);
		$query=$this->db->get('tbl_services');
		return $query->row_array();
	}

	public function isLoggedIn()
	{
		$islog=$this->session->userdata('user');
		if(!empty($islog))
		{
			return TRUE;
		}
		else
		{
			$this->session->set_userdata('referred_from', current_url());
			redirect('login','refresh');
		}
	}

	function get_refrence_no()
    {
        $this->db->order_by('sr_id', 'DESC');
        $query = $this->db->get('tbl_service_request', 1 );
        $result=$query->row_array();
        if(empty($result))
        {
            return 'ORD-'.str_pad(0+1,4,'0',STR_PAD_LEFT);
        }
        else
        {
            return 'ORD-'.str_pad($result['sr_id']+1, 4, '0', STR_PAD_LEFT);
        }
    }

	public function add_service_request($data)
	{
		//echo "<pre>";print_r($data);die;
		$refno=$this->get_refrence_no();
		$v=array(
			'tbl_user_id'=>$data['tbl_user_id'],
			'prefferd_date'=>$data['prefferd_date'],
			'prefferd_time'=>$data['prefferd_time'],
			'created_at'=>date('Y-m-d H:i:s'),
			'updated_at'=>date('Y-m-d H:i:s'),
			'status'=>0,
			'service_request_ref'=>$refno,
			'status_history'=>json_encode(array(array('status_name'=>'New','status_time'=>date('Y-m-d H:i:s'))))
		);
        $this->db->insert('tbl_service_request', $v);
        $lid=$this->db->insert_id();

        for($i=0;$i<count($data['service_id']);$i++)
		{
			$value=array(
			'sr_id'=>$lid,
			'service_id'=>$data['service_id'][$i],
			'service_desc'=>'',
			'service_image'=>''
			);
			$this->db->insert('tbl_service_request_boi', $value);
		}
        return $lid;
	}

	public function get_time_slots()
	{
		$this->db->select('time_slot_id,time_slot_name');
        $query = $this->db->get_where('tbl_time_slot',array('isDeleted'=>0));
        return $query->result_array();
	}

	public function add_guest_request($data)
	{
		//echo "<pre>";print_r($data);die;
		$v=array(
			'tbl_guest_user_name'=>$data['tbl_guest_user_name'],
			'tbl_guest_user_mobile'=>$data['tbl_guest_user_mobile'],
			'tbl_guest_user_email'=>$data['tbl_guest_user_email'],
			'tbl_guest_user_service_date'=>$data['tbl_guest_user_service_date'],
			'tbl_guest_user_service_time'=>$data['tbl_guest_user_service_time'],
			'tbl_guest_user_createdat'=>date('Y-m-d H:i:s')
		);
        $this->db->insert('tbl_guest_user', $v);
        //echo "coming here";die;
        $insert_id = $this->db->insert_id();

        for($i=0;$i<count($data['service_id']);$i++)
		{
			$value=array(
			'sr_id'=>$insert_id,
			'service_id'=>$data['service_id'][$i]
			);
			$this->db->insert('tbl_guest_user_boi', $value);
		}
        return $insert_id;
	}

	public function service_taken($user_id)
	{
		$this->db->select('t.*');
        $this->db->from('tbl_service_request as t');
        $this->db->where('t.tbl_user_id',$user_id);
        $this->db->order_by('sr_id', 'DESC');
        $query = $this->db->get();
        $row=$query->result_array();
        
        if(!empty($row))
			{
				for($i=0;$i<count($row);$i++)
				{
					$this->db->select('BaseTbl.*,s.service_name,s.service_desc,s.service_logo');
			        $this->db->from('tbl_service_request_boi as BaseTbl');
			        $this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
			        $this->db->where('sr_id',$row[$i]['sr_id']);
			        $query1=$this->db->get();
			        $row1=$query1->result_array();
					$row[$i]['service_list']=$row1;
				}	
			}
			//echo "<pre>";print_r($row);die;
        return $row;
	}
}
?>