<?php defined('BASEPATH') or exit('No direct script access allowed');
session_start();
class Index extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view("containner/head");
		$this->load->view("containner/header");
		$this->load->view("index");
		// $this->load->view("containner/footer");
		$this->load->view("containner/script");
	}

	public function indexmember()
	{
		$ID_CARD = $this->session->userdata('ID_CARD');
		$this->load->model('member_model');
		$data = $this->member_model->data_member($ID_CARD);
		$this->load->view("containner/head");
		$this->load->view("containner/headermember", $data);
		$this->load->view("index");
		// $this->load->view("containner/footermember");
		$this->load->view("containner/script");
	}

	public function indexofficer()
	{
		$ID_CARD = $this->session->userdata('ID_CARD');
		$this->load->model('officer_model');
		$data = $this->officer_model->data_officer($ID_CARD);
		$this->load->view("containner/head");
		$this->load->view("containner/headermember", $data);
		$this->load->view("index");
		// $this->load->view("containner/footer");
		$this->load->view("containner/script");
	}
}
