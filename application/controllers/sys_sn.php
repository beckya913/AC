<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sys_sn extends CI_Controller {

	public function create_client()
	{
		$this->load->model('Git_db');
		$this->load->view('create_client');
	}

	public function action_create_client()
	{
		$this->load->model('Git_db');
		$newRow = array(
					'name' => $this->input->post('name'),
					'creator' => $this->input->post('creator')
				);
		$this->Git_db->insert_client($newRow);
		echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
					alert('新增客戶成功！');
					window.location.href='create_client';
				  </script></body></html>";
	}

	public function update_client(){

		$this->load->model('Git_db');
		$id= $this->uri->segment(3);
		$data['results_all'] = $this->Git_db->get_client_detail_all($id);
		$this->load->view('update_client', $data);
	}

	public function action_update_client(){
		
		$data = array(
					'name' => $this->input->post('name'),
					'creator' => $this->input->post('creator')
				);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('global_client', $data);
		echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
					alert('更新客戶名稱成功！');
					window.location.href='../sys_sn/create_client';
				  </script></body></html>";
	}
	
	public function create_item()
	{
		$this->load->model('Git_db');
		$this->load->view('create_item');
	}

	public function action_create_item()
	{
		$this->load->model('Git_db');
		$newRow = array(
					'name' => $this->input->post('name'),
					'detail' => $this->input->post('detail'),
					'product_num' => $this->input->post('product_num'),
					'price' => $this->input->post('price'),
					'creator' => $this->input->post('creator')
				);
		$this->Git_db->insert_item($newRow);
		echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
					alert('新增產品項目成功！');
					window.location.href='create_item';
				  </script></body></html>";
	}

	public function update_item(){

		$this->load->model('Git_db');
		$id= $this->uri->segment(3);
		$data['results_all'] = $this->Git_db->get_item_detail_all($id);
		$this->load->view('update_item', $data);
	}

	public function action_update_item(){
		
		$data = array(
					'name' => $this->input->post('name'),
					'detail' => $this->input->post('detail'),
					'product_num' => $this->input->post('product_num'),
					'price' => $this->input->post('price'),
					'creator' => $this->input->post('creator')
				);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('global_item', $data);
		echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
					alert('更新產品成功！');
					window.location.href='../sys_sn/create_item';
				  </script></body></html>";
	}

	public function create_sn()
	{
		$this->load->model('Git_db');
		$this->load->view('create_sn');
	}

	public function create_sn_2()
	{
		$this->load->model('Git_db');
		$query = $this->db->get_where('global_item', array('name'=>$this->input->post('item')));
		$data['results'] = $query->result();
		$data['client'] = $this->input->post('client');
		$data['serial_num'] = $this->input->post('serial_num');
		$data['item'] = $this->input->post('item');
		$this->load->view('create_sn_2', $data);
	}

	public function action_create_sn()
	{
		$this->load->model('Git_db');
		$newRow = array(
					'serial_num' => $this->input->post('serial_num'),
					'client' => $this->input->post('client'),
					'item' => $this->input->post('item'),
					'detail' => $this->input->post('detail'),
					'note' => $this->input->post('note'),
					'product_num' => $this->input->post('product_num'),
					'price' => $this->input->post('price'),
					's_id' => $this->input->post('s_id'),
					's_ni_date' => $this->input->post('s_ni_date'),
					's_git_date' => $this->input->post('s_git_date'),
					's_ni_po' => $this->input->post('s_ni_po'),
					's_client_po' => $this->input->post('s_client_po'),
					's_price' => $this->input->post('s_price'),
					's_warranty' => $this->input->post('s_warranty'),
					'l_id' => $this->input->post('l_id'),
					'l_ni_date' => $this->input->post('l_ni_date'),
					'l_ni_po' => $this->input->post('l_ni_po'),
					'l_date' => $this->input->post('l_date'),
					'l_return_date' => $this->input->post('l_return_date'),
					'l_dongle' => $this->input->post('l_dongle'),
					'l_cable' => $this->input->post('l_cable'),
					'b_id' => $this->input->post('b_id'),
					'b_ni_date' => $this->input->post('b_ni_date'),
					'b_ni_po' => $this->input->post('b_ni_po'),
					'b_date' => $this->input->post('b_date'),
					'b_return_date' => $this->input->post('b_return_date'),
					'b_dongle' => $this->input->post('b_dongle'),
					'b_cable' => $this->input->post('b_cable'),
					'creator' => $this->input->post('creator')
				);
		$this->Git_db->insert_sn($newRow);
		echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
					alert('新增序號成功！');
					window.location.href='create_sn';
				  </script></body></html>";
	}

	public function view(){
		
		$this->load->model('Git_db');
		$data['results'] = $this->Git_db->get_sn_detail();
		$this->load->view('view_sn', $data);
		
	}

	public function view_filter() {

		$query=$this->db->where('time >=', $this->input->post('startdate'))
					->where('time <=', $this->input->post('enddate'))
					->get('sn_record');

		$data['results'] = $query->result();
		$data['startdate'] = $this->input->post('startdate');
		$data['enddate'] = $this->input->post('enddate');
		$this->load->view('view_sn',$data);
	}

	public function update_sn(){

		$this->load->model('Git_db');
		$id= $this->uri->segment(3);
		$data['results_all'] = $this->Git_db->get_sn_detail_all($id);
		$this->load->view('update_sn', $data);
	}

	public function action_update_sn(){
		
		$data = array(
					'serial_num' => $this->input->post('serial_num'),
					'client' => $this->input->post('client'),
					'item' => $this->input->post('item'),
					'detail' => $this->input->post('detail'),
					'note' => $this->input->post('note'),
					'product_num' => $this->input->post('product_num'),
					'price' => $this->input->post('price'),
					's_id' => $this->input->post('s_id'),
					's_ni_date' => $this->input->post('s_ni_date'),
					's_git_date' => $this->input->post('s_git_date'),
					's_ni_po' => $this->input->post('s_ni_po'),
					's_client_po' => $this->input->post('s_client_po'),
					's_price' => $this->input->post('s_price'),
					's_warranty' => $this->input->post('s_warranty'),
					'l_id' => $this->input->post('l_id'),
					'l_ni_date' => $this->input->post('l_ni_date'),
					'l_ni_po' => $this->input->post('l_ni_po'),
					'l_date' => $this->input->post('l_date'),
					'l_return_date' => $this->input->post('l_return_date'),
					'l_dongle' => $this->input->post('l_dongle'),
					'l_cable' => $this->input->post('l_cable'),
					'b_id' => $this->input->post('b_id'),
					'b_ni_date' => $this->input->post('b_ni_date'),
					'b_ni_po' => $this->input->post('b_ni_po'),
					'b_date' => $this->input->post('b_date'),
					'b_return_date' => $this->input->post('b_return_date'),
					'b_dongle' => $this->input->post('b_dongle'),
					'b_cable' => $this->input->post('b_cable'),
					'creator' => $this->input->post('creator')
				);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('sn_record', $data);
		echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
					alert('更新序號資料成功！');
					window.location.href='view';
				  </script></body></html>";
	}

	public function view_lend(){
		
		$this->load->model('Git_db');
		$data['results'] = $this->Git_db->get_sn_lend_not_return();
		$this->load->view('view_sn_lend', $data);
		
	}

	public function view_lend_returned(){
		
		$this->load->model('Git_db');
		$data['results'] = $this->Git_db->get_sn_lend_returned();
		$this->load->view('view_sn_lend', $data);
		
	}
	//End
}
