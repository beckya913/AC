<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portal extends CI_Controller {

	public function __construct(){
		
	      session_start();
	      parent::__construct();
      	
     }

    public function index()
	{
		$this->load->view('dashboard');
	}

    public function login(){

	if ( isset($_SESSION['username'])) {
         $this->load->view('dashboard');
      }
		$this->load->view('login');
	}

	public function checklogin(){
	
	$query=$this->db->where('username', $this->input->post('username'))
					->where('password', $this->input->post('password'))
					->get('global_user');
		
	$res= $query->num_rows();
	$row = $query->row();
	
	if($res == 1){

		$level = $row->level;
		$_SESSION['username']= $this->input->post('username');
		header("location:dashboard");
		
	} else {

		echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
				alert('帳號密碼錯誤！');
				window.location.href='login';
			  </script></body></html>";

		} 
	}

	public function dashboard(){

		$this->load->view('dashboard');
	}

	public function view(){
		
		$this->load->model('Git_db');
		$data['results'] = $this->Git_db->get_sn_detail();
		$data['results_rma'] = $this->Git_db->get_rma_detail();
		$data['results_sw'] = $this->Git_db->get_sw_detail();
		$this->load->view('view', $data);
		
	}

	public function view_filter() {

		$query=$this->db->where('time >=', $this->input->post('startdate'))
					->where('time <=', $this->input->post('enddate'))
					->get('sn_record');

		$query_rma=$this->db->where('time >=', $this->input->post('startdate'))
					->where('time <=', $this->input->post('enddate'))
					->get('rma_detail');

		$query_sw=$this->db->where('time >=', $this->input->post('startdate'))
					->where('time <=', $this->input->post('enddate'))
					->get('sw_record');

		$data['results'] = $query->result();
		$data['results_rma'] = $query_rma->result();
		$data['results_sw'] = $query_sw->result();
		$data['startdate'] = $this->input->post('startdate');
		$data['enddate'] = $this->input->post('enddate');
		$this->load->view('view',$data);
	}

	public function logout(){
		
		session_destroy();
		header("location: ".base_url()."portal/login");
	 }

//End
}