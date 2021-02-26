<?php defined('BASEPATH') or exit('No direct script access allowed');
session_start();
class Vision extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('member_model');
	}

	public function index()
	{
		$this->load->view("containner/head");		
		$this->load->view("containner/header");	
		$this->load->view("about/vision");	
		// $this->load->view("containner/footer");
		$this->load->view("containner/script");	
	}

	public function indexmember()
	{
		$ID_CARD = $this->session->userdata('ID_CARD');
		$data = $this->member_model->data_member($ID_CARD);
		$this->load->view("containner/head");
		$this->load->view("containner/headermember", $data);	
		$this->load->view("about/vision");	
		// $this->load->view("containner/footermember");
		$this->load->view("containner/script");	
	}
}
