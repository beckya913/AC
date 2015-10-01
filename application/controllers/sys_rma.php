<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sys_rma extends CI_Controller {

	
	public function create()
	{
		$this->load->model('Git_db');
		$this->load->view('create_rma');
	}

	public function action_create(){

			$this->config =  array(

	                  'upload_path'     => "./uploads/",
	                  'allowed_types'   => "gif|jpg|png|jpeg|pdf|doc|xml|zip|rar|txt",
	                  'overwrite'       => TRUE,
	                  'max_size'        => "5000KB",
	                  /*'max_height'      => "3000",
	                  'max_width'       => "3000"*/

	                );

			$this->load->library('upload', $this->config);
			$this->load->model('Git_db');

			if($this->upload->do_upload("attachment"))

			{
				//取得附件檔案名稱
				$upload_data = $this->upload->data();
				$file_name = $upload_data['file_name'];

				//寫入記錄至 ram_detail (有附件)
				$newRow = array(
				'submit_date' => $this->input->post('submit_date'),
				'post_num' => $this->input->post('post_num'),
				'applicant' => $this->input->post('applicant'),
				'form_num' => $this->input->post('serial_num'),
				'contact_winodw' => $this->input->post('contact_winodw'),
				'email' => $this->input->post('email'),
				'client' => $this->input->post('client'),
				'area' => $this->input->post('area'),
				'remark' => $this->input->post('remark'),
				'attachment' => $file_name,
				'demand_date' => $this->input->post('demand_date'),
				'ni_po_num' => $this->input->post('ni_po_num'),
				'client_po_num' => $this->input->post('client_po_num'),
				'receive_date_tw' => $this->input->post('receive_date_tw'),
				'receive_date_client' => $this->input->post('receive_date_client'),
				'receive_date_ks' => $this->input->post('receive_date_ks'),

				);

				$newRow_item =array();
				$count = count($this->input->post('sn_before'));
				for($i=0; $i<$count; $i++) {
				$newRow_item[] = array(
				'form_num' => $this->input->post('serial_num'),
				'category' => $this->input->post('category')[$i], 
				'item' => $this->input->post('item')[$i],
				'problem' => $this->input->post('problem')[$i],
				'problem_date' => $this->input->post('problem_date')[$i],
				'ship_date_git' => $this->input->post('ship_date_git')[$i],
				'product_date_ni' => $this->input->post('product_date_ni')[$i], 
				'status' => $this->input->post('status')[$i],
				'sn_before' => $this->input->post('sn_before')[$i],
				'sn_after' => $this->input->post('sn_after')[$i],
				'result' => $this->input->post('result')[$i],
				'solution' => $this->input->post('solution')[$i],
				'fee' => $this->input->post('fee')[$i],

				           );
				}
				
				$this->Git_db->insert_rma_info($newRow);
				$this->db->insert_batch('rma_item', $newRow_item);
				echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
					alert('RMA 表單新增成功！');
					window.location.href='create';
				  </script></body></html>";

			} else {

				//寫入記錄至 ram_detail (無附件)
				$newRow = array(
					'submit_date' => $this->input->post('submit_date'),
					'post_num' => $this->input->post('post_num'),
					'applicant' => $this->input->post('applicant'),
					'form_num' => $this->input->post('serial_num'),
					'contact_winodw' => $this->input->post('contact_winodw'),
					'email' => $this->input->post('email'),
					'client' => $this->input->post('client'),
					'area' => $this->input->post('area'),
					'remark' => $this->input->post('remark'),
					'demand_date' => $this->input->post('demand_date'),
					'ni_po_num' => $this->input->post('ni_po_num'),
					'client_po_num' => $this->input->post('client_po_num'),
					'receive_date_tw' => $this->input->post('receive_date_tw'),
					'receive_date_client' => $this->input->post('receive_date_client'),
					'receive_date_ks' => $this->input->post('receive_date_ks')
				);

				$newRow_item =array();
				$count = count($this->input->post('sn_before'));
				for($i=0; $i<$count; $i++) {
					$newRow_item[] = array(
					'form_num' => $this->input->post('serial_num'),
					'category' => $this->input->post('category')[$i], 
					'item' => $this->input->post('item')[$i],
					'problem' => $this->input->post('problem')[$i],
					'problem_date' => $this->input->post('problem_date')[$i],
					'ship_date_git' => $this->input->post('ship_date_git')[$i],
					'product_date_ni' => $this->input->post('product_date_ni')[$i], 
					'status' => $this->input->post('status')[$i],
					'sn_before' => $this->input->post('sn_before')[$i],
					'sn_after' => $this->input->post('sn_after')[$i],
					'result' => $this->input->post('result')[$i],
					'solution' => $this->input->post('solution')[$i],
					'fee' => $this->input->post('fee')[$i],
					);
				}

				$this->Git_db->insert_rma_info($newRow);
				$this->db->insert_batch('rma_item', $newRow_item);
			    echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
					alert('RMA 表單新增成功！');
					window.location.href='create';
				  	</script></body></html>";
			}
	}

		public function view(){

		$this->load->model('Git_db');
		$data['results_rma'] = $this->Git_db->get_rma_detail();
		$this->load->view('view_rma', $data);
		
	}

	/* with pagination 

		public function view(){
		$this->load->model('Git_db');
		$this->load->library('pagination');
		$config['base_url'] = base_url() . "sys_rma/view";
		$config['total_rows'] = $this->db->get('rma_detail')->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 20;
		$this->pagination->initialize($config); 
		$data['results_rma'] = $this->Git_db->get_rma_detail($config['per_page'],$this->uri->segment(3));
		$this->load->view('view_rma', $data);
		
	} */ 

	public function view_filter() {

		$query_rma=$this->db->where('time >=', $this->input->post('startdate'))
					->where('time <=', $this->input->post('enddate'))
					->get('rma_detail');

		$data['results_rma'] = $query_rma->result();
		$data['startdate'] = $this->input->post('startdate');
		$data['enddate'] = $this->input->post('enddate');
		$this->load->view('view_rma',$data);
	}

	public function update(){

		$this->load->model('Git_db');
		$id= $this->uri->segment(3);
		$data['results_all'] = $this->Git_db->get_rma_detail_all($id);
		$this->load->view('update_rma', $data);
	}

	public function action_update(){

		$this->config =  array(

	                  'upload_path'     => "./uploads/",
	                  'allowed_types'   => "gif|jpg|png|jpeg|pdf|doc|xml|zip|rar|txt",
	                  'overwrite'       => TRUE,
	                  'max_size'        => "5000KB",
	                  /*'max_height'      => "3000",
	                  'max_width'       => "3000"*/

	                );

		$this->load->library('upload', $this->config);
		$this->load->model('Git_db');

		if($this->upload->do_upload("attachment")){
				//取得附件檔案名稱
			$upload_data = $this->upload->data();
			$file_name = $upload_data['file_name'];

			$newRow = array(
				'submit_date' => $this->input->post('submit_date'),
				'post_num' => $this->input->post('post_num'),
				'applicant' => $this->input->post('applicant'),
				'form_num' => $this->input->post('form_num'),
				'contact_winodw' => $this->input->post('contact_winodw'),
				'email' => $this->input->post('email'),
				'client' => $this->input->post('client'),
				'area' => $this->input->post('area'),
				'remark' => $this->input->post('remark'),
				'demand_date' => $this->input->post('demand_date'),
				'ni_po_num' => $this->input->post('ni_po_num'),
				'client_po_num' => $this->input->post('client_po_num'),
				'receive_date_tw' => $this->input->post('receive_date_tw'),
				'receive_date_client' => $this->input->post('receive_date_client'),
				'receive_date_ks' => $this->input->post('receive_date_ks'),
				'attachment' => $file_name
				);

				$newRow_item =array();
				$count = count($this->input->post('sn_before'));
				for($i=0; $i<$count; $i++) {
					$newRow_item[] = array(
					'id' => $this->input->post('id_item')[$i],
					'form_num' => $this->input->post('form_num_item')[$i],
					'category' => $this->input->post('category')[$i], 
					'item' => $this->input->post('item')[$i],
					'problem' => $this->input->post('problem')[$i],
					'problem_date' => $this->input->post('problem_date')[$i],
					'ship_date_git' => $this->input->post('ship_date_git')[$i],
					'product_date_ni' => $this->input->post('product_date_ni')[$i], 
					'status' => $this->input->post('status')[$i],
					'sn_before' => $this->input->post('sn_before')[$i],
					'sn_after' => $this->input->post('sn_after')[$i],
					'result' => $this->input->post('result')[$i],
					'solution' => $this->input->post('solution')[$i],
					'fee' => $this->input->post('fee')[$i]
					);
				}

				$this->Git_db->update_rma($newRow);
				$this->db->update_batch('rma_item', $newRow_item, 'id');

				echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
				alert('RMA 表單更新成功！');
				window.location.href='../sys_rma/view/';
				</script></body></html>";

			}else{

				$newRow = array(
				'submit_date' => $this->input->post('submit_date'),
				'post_num' => $this->input->post('post_num'),
				'applicant' => $this->input->post('applicant'),
				'form_num' => $this->input->post('form_num'),
				'contact_winodw' => $this->input->post('contact_winodw'),
				'email' => $this->input->post('email'),
				'client' => $this->input->post('client'),
				'area' => $this->input->post('area'),
				'remark' => $this->input->post('remark'),
				'demand_date' => $this->input->post('demand_date'),
				'ni_po_num' => $this->input->post('ni_po_num'),
				'client_po_num' => $this->input->post('client_po_num'),
				'receive_date_tw' => $this->input->post('receive_date_tw'),
				'receive_date_client' => $this->input->post('receive_date_client'),
				'receive_date_ks' => $this->input->post('receive_date_ks'),
	
				);

				$newRow_item =array();
				$count = count($this->input->post('sn_before'));
				for($i=0; $i<$count; $i++) {
					$newRow_item[] = array(
					'id' => $this->input->post('id_item')[$i],
					'form_num' => $this->input->post('form_num_item')[$i],
					'category' => $this->input->post('category')[$i], 
					'item' => $this->input->post('item')[$i],
					'problem' => $this->input->post('problem')[$i],
					'problem_date' => $this->input->post('problem_date')[$i],
					'ship_date_git' => $this->input->post('ship_date_git')[$i],
					'product_date_ni' => $this->input->post('product_date_ni')[$i], 
					'status' => $this->input->post('status')[$i],
					'sn_before' => $this->input->post('sn_before')[$i],
					'sn_after' => $this->input->post('sn_after')[$i],
					'result' => $this->input->post('result')[$i],
					'solution' => $this->input->post('solution')[$i],
					'fee' => $this->input->post('fee')[$i]
					);
				}

				$this->Git_db->update_rma($newRow);
				$this->db->update_batch('rma_item', $newRow_item, 'id');

				echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
				alert('RMA 表單更新成功！');
				window.location.href='../sys_rma/view/';
				</script></body></html>";
			}
		
	}
//End
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */