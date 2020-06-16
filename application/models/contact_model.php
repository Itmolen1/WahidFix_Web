<?php 
class contact_model extends CI_Model {
	public function add($data)
	{
		//echo "<pre>";print_r($data);die;
		$this->db->insert('tbl_contact_us',$data);
	}

	public function edit($data)
	{	
		$this->db->where('news_id', $this->input->get('news_id'));
		$this->db->update('news', $data); 
	}

	public function get()
	{
		$query = $this->db->get_where('news',array('news_id' => $this->input->get('news_id')));
		return $query->result_array();
	}

	public function careers_add($data)
	{
		$this->db->insert('tbl_careers',$data);
	}

	public function partner_add($data)
	{
		$this->db->insert('tbl_partner',$data);
	}
}
?>