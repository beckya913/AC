<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sys_sw extends CI_Controller {

    /* Start - Create SPTS */
	public function create_spts()
	{
		$this->load->model('Git_db');
		$this->load->view('create_spts');
	}

	public function action_create_spts()
	{
		$this->load->model('Git_db');
		$newRow = array(
					'name' => $this->input->post('name'),
					'creator' => $this->input->post('creator')
				);
		$this->Git_db->insert_spts($newRow);
		echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
					alert('新增 SPTS 成功！');
					window.location.href='create_spts';
				  </script></body></html>";
	}
	/* End - Create Spts */

	public function update_spts(){

		$this->load->model('Git_db');
		$id= $this->uri->segment(3);
		$data['results_all'] = $this->Git_db->get_spts_detail_all($id);
		$this->load->view('update_spts', $data);
	}

	public function action_update_spts(){
		
		$data = array(
					'name' => $this->input->post('name'),
					'creator' => $this->input->post('creator')
				);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('sw_spts', $data);
		echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
					alert('更新SPTS成功！');
					window.location.href='../sys_sw/create_spts';
				  </script></body></html>";
	}

	/* Start - Create sw record */
	public function create()
	{
		$this->load->model('Git_db');
		$this->load->view('create_sw');
	}

	public function action_create_sw()
	{
		$this->load->model('Git_db');
		$newRow = array(
					'client' => $this->input->post('client'),
					'spts' => $this->input->post('spts'),
					'support_date_s' => $this->input->post('support_date_s'),
					'support_date_e' => $this->input->post('support_date_e'),
					'creator' => $this->input->post('creator')
				);
		$this->Git_db->insert_sw($newRow);
		echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
					alert('新增軟體記錄成功！');
					window.location.href='create';
				  </script></body></html>";
	}

	public function view(){
		
		$this->load->model('Git_db');
		$data['results_sw'] = $this->Git_db->get_sw_detail();
		$this->load->view('view_sw', $data);
		
	}

	public function view_filter() {

		$query_sw=$this->db->where('time >=', $this->input->post('startdate'))
					->where('time <=', $this->input->post('enddate'))
					->get('sw_record');

		$data['results_sw'] = $query_sw->result();
		$data['startdate'] = $this->input->post('startdate');
		$data['enddate'] = $this->input->post('enddate');
		$this->load->view('view_sw',$data);
	}

	public function update(){

		$this->load->model('Git_db');
		$id= $this->uri->segment(3);
		$data['results_all'] = $this->Git_db->get_sw_detail_all($id);
		$this->load->view('update_sw', $data);
	}

	public function action_update(){
		
		$data = array(
					'client' => $this->input->post('client'),
					'spts' => $this->input->post('spts'),
					'support_date_s' => $this->input->post('support_date_s'),
					'support_date_e' => $this->input->post('support_date_e'),
					'creator' => $this->input->post('creator')
				);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('sw_record', $data);
		echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
					alert('更新軟體記錄成功！');
					window.location.href='../sys_sw/view';
				  </script></body></html>";
	}
	/* End - Create Item */
}
