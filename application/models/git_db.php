<?php 

class Git_db extends CI_Model { 

	function __construct()
    {
        // 呼叫模型(Model)的建構函數
        parent::__construct();
    }

    function insert_client($data){
	
		$this->db->insert('global_client', $data);
	}

	function insert_item($data){
	
		$this->db->insert('global_item', $data);
	}

	function insert_sn($data){
	
		$this->db->insert('sn_record', $data);
	}

	function insert_rma_info($data){
	
		$this->db->insert('rma_detail', $data);
	}

	function insert_spts($data){
	
		$this->db->insert('sw_spts', $data);
	}

	function insert_sw($data){
	
		$this->db->insert('sw_record', $data);
	}

	function get_sn_detail(){
	
		$query = $this->db->order_by('s_git_date', 'desc')->get('sn_record'); 
		return $query->result();
		
	}

	function get_sn_lend_not_return(){
	
		$query = $this->db->order_by('l_date', 'desc')
						  ->where('l_return_date','0000-00-00')
						  ->get('sn_record'); 
		return $query->result();
		
	}

	function get_sn_lend_returned(){
	
		$query = $this->db->order_by('l_date', 'desc')
						  ->where('l_return_date !=','0000-00-00')
						  ->get('sn_record'); 
		return $query->result();
		
	}

	function get_sn_detail_all($id){
	
		$query = $this->db->get_where('sn_record',array('id'=>$id));
		return $query->result();        

	}

	function get_rma_detail(){
		$query = $this->db->order_by('time', 'desc')->get('rma_detail'); 
		return $query->result();
	}

	function get_rma_detail_all($id){
		$query = $this->db->get_where('rma_detail',array('id'=>$id));
		return $query->result();        
	}

	function update_rma($data) {
		
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('rma_detail',$data);
	}

	function get_sw_detail(){
		$query = $this->db->order_by('time', 'desc')->get('sw_record'); 
		return $query->result();
	}

	function get_sw_detail_all($id){
	
		$query = $this->db->get_where('sw_record',array('id'=>$id));
		return $query->result();        

	}

	function get_client_detail_all($id){
	
		$query = $this->db->get_where('global_client',array('id'=>$id));
		return $query->result();        

	}

	function get_item_detail_all($id){
	
		$query = $this->db->get_where('global_item',array('id'=>$id));
		return $query->result();        

	}

	function get_spts_detail_all($id){
	
		$query = $this->db->get_where('sw_spts',array('id'=>$id));
		return $query->result();        

	}

}

?>