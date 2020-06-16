<?php 
class register_model extends CI_Model {
	public function add($data)
	{
		$this->db->insert('tbl_user',$data);
		//echo $this->db->last_query();die;
		return 1;
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
}
?>