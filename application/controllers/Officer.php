<?php defined('BASEPATH') or exit('No direct script access allowed');
session_start();
class Officer extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		define('FPDF_FONTPATH', 'font/');
		$this->load->model('officer_model');
	}

	public function login_officer()
	{
		$this->load->view("containner/head");
		$this->load->view("login_officer");
	}

	public function check_officer()
	{
		$result = $this->officer_model->fetch_user_login(
			$this->input->post('USER_ID')
		);
		if (!empty($result)) {
			$session = array(
				'USER_ID' => $result->USER_ID,
				'BR_NO' => $result->BR_NO,
				'LEVEL_CODE' => $result->LEVEL_CODE,
				'USER_NAME' => $result->USER_NAME
			);

			$this->session->set_userdata($session);

			// print_r($session);
			// exit;
			$USER_ID = $this->session->userdata('USER_ID');
			$LEVEL_CODE = $this->session->userdata('LEVEL_CODE');
			$data = $this->officer_model->data_officer($USER_ID);
			if ($LEVEL_CODE === 'A') {
				$this->load->view("containner/head");
				$this->load->view("containner/headerofficer", $data);
				$this->load->view("containner/sidebarofficer");
				$this->load->view("data_officer");
				$this->load->view("containner/script");
			} elseif ($LEVEL_CODE === 'B') {
				$this->load->view("containner/head");
				$this->load->view("containner/headerofficer", $data);
				$this->load->view("containner/sidebarofficer");
				$this->load->view("data_officer");
				$this->load->view("containner/script");
			} elseif ($LEVEL_CODE === 'C') {
				$this->load->view("containner/head");
				$this->load->view("containner/headerofficer", $data);
				$this->load->view("containner/sidebarofficer");
				$this->load->view("data_officer");
				$this->load->view("containner/script");
			} elseif ($LEVEL_CODE === 'D') {
				$this->load->view("containner/head");
				$this->load->view("containner/headerofficer", $data);
				$this->load->view("containner/sidebarofficer_D");
				$this->load->view("data_officer");
				$this->load->view("containner/script");
			} elseif ($LEVEL_CODE === 'E') {
				$this->load->view("containner/head");
				$this->load->view("containner/headerofficer", $data);
				$this->load->view("containner/sidebarofficer");
				$this->load->view("data_officer");
				$this->load->view("containner/script");
			} elseif ($LEVEL_CODE === 'F') {
				$this->load->view("containner/head");
				$this->load->view("containner/headerofficer", $data);
				$this->load->view("containner/sidebarofficer");
				$this->load->view("data_officer");
				$this->load->view("containner/script");
			}
		} else {
			$this->session->unset_userdata(array('USER_ID', 'LEVEL_CODE', 'USER_NAME', 'BR_NO'));
			$this->load->view("containner/head");
			$this->load->view("login_officer");
			$this->load->view("containner/script");
			echo "<script>alert('คุณใส่ Usename หรือ Password ไม่ถูกต้อง');</script>";
		}
	}

	public function logout_officer()
	{
		$this->session->unset_userdata('USER_ID', 'LEVEL_CODE', 'USER_NAME', 'BR_NO');
		redirect('index', 'refresh');
	}

	public function data_officer()
	{
		$USER_ID = $this->session->userdata('USER_ID');
		$data = $this->officer_model->data_officer($USER_ID);
		$this->load->view("containner/head");
		$this->load->view("containner/headerofficer", $data);
		$this->load->view("containner/sidebarofficer");
		$this->load->view("data_officer");
		$this->load->view("containner/script");
	}

	public function goto_data_officer()
	{
		$USER_ID = $this->session->userdata('USER_ID');
		$data = $this->officer_model->data_officer($USER_ID);
		$this->load->view("containner/head");
		$this->load->view("containner/headerofficer", $data);
		$this->load->view("containner/sidebarofficer");
		$this->load->view("data_officer");
		$this->load->view("containner/script");
	}

	public function depositsystem()
	{
		$USER_ID = $this->session->userdata('USER_ID');
		$data1 = $this->officer_model->data_officer($USER_ID);
		$data2['result'] = $this->officer_model->pullbranch();
		$this->load->view("containner/head");
		$this->load->view("containner/headerofficer", $data1);
		$this->load->view("containner/sidebarofficer");
		$this->load->view("depositsystem", $data2);
		$this->load->view("containner/script");
	}

	public function creditsystem()
	{
		$USER_ID = $this->session->userdata('USER_ID');
		$data1 = $this->officer_model->data_officer($USER_ID);
		$data2['result'] = $this->officer_model->pullbranch();
		$this->load->view("containner/head");
		$this->load->view("containner/headerofficer", $data1);
		$this->load->view("containner/sidebarofficer");
		$this->load->view("creditsystem", $data2);
		$this->load->view("containner/script");
	}

	public function pullbranch()
	{
		$USER_ID = $this->session->userdata('USER_ID');
		$data1 = $this->officer_model->data_officer($USER_ID);
		$data2['result'] = $this->officer_model->pullbranch();
		$this->load->view("containner/head");
		$this->load->view("containner/headerofficer", $data1);
		$this->load->view("containner/sidebarofficer");
		$this->load->view("depositsystem");
		$this->load->view("wordpage", $data2);
		$this->load->view("containner/script");
	}

	/////////////////////////////////////////////////Deposit/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function depositreport_summary()
	{
		include_once("application/libraries/thaidate-functions.php");
		include_once("application/libraries/Thaidate.php");
		require('application/libraries/fpdf.php');

		$USER_ID = $this->session->userdata('USER_ID');
		$startdate = $this->input->post('startdate');
		$enddate = $this->input->post('enddate');

		$pdf = new FPDF();
		$pdf->AddPage('L', 'A4');
		$pdf->AddFont('angsa', '', 'angsa.php');
		$pdf->SetFont('angsa', '', 14);
		$pdf->SetTitle('Deposit_Summary');

		$data_officer = $this->officer_model->data_officer($USER_ID);
		$pdf->Cell(0, 8, iconv('UTF-8', 'TIS-620', $data_officer->BR_NAME), 0, 1, "C");
		$pdf->Cell(0, 8, iconv('UTF-8', 'TIS-620', 'รายงานสรุปรายการพนักงาน'), 0, 1, "C");
		$pdf->Cell(0, 8, iconv('UTF-8', 'TIS-620', 'ประจำวันที่ ' . thaidate("d/m/Y", strtotime($startdate)) . ' ถึง ' . thaidate("d/m/Y", strtotime($enddate))), 0, 1, "C");
		$pdf->Cell(0, 8, iconv('UTF-8', 'TIS-620', 'รหัสผู้ทำรายการ ' . $data_officer->USER_ID . '                                                                                                       ชื่อผู้ทำรายการ ' . $data_officer->USER_NAME), 0, 1, "L");

		$deposit_type = $this->officer_model->deposittype();
		foreach ($deposit_type->result() as $rowdeposit_type) {
			$data = $this->officer_model->depositreport_summary($startdate, $enddate, $USER_ID,  $rowdeposit_type->ACC_TYPE);
			$num = $data->num_rows();
			if ($num == 0) {
			} else {
				$pdf->Cell(0, 4, iconv('UTF-8', 'TIS-620', 'เงินฝาก : ' . $rowdeposit_type->ACC_DESC), 0, 1, 'L');
				$pdf->Ln();
				$pdf->Cell(20, 8, iconv('UTF-8', 'TIS-620', 'ลำดับ'), 1, 0, 'C');
				$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', 'วันที่'), 1, 0, 'C');
				$pdf->Cell(40, 8, iconv('UTF-8', 'TIS-620', 'เลขที่บัญชี'), 1, 0, 'C');
				$pdf->Cell(90, 8, iconv('UTF-8', 'TIS-620', 'ชื่อบัญชี'), 1, 0, 'C');
				$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', 'รายการ'), 1, 0, 'C');
				$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', 'ฝาก'), 1, 0, 'C');
				$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', 'ถอน'), 1, 0, 'C');
				$pdf->Ln();
				$i = 1;
				foreach ($data->result() as $row) {
					$pdf->Cell(20, 8, iconv('UTF-8', 'TIS-620', $i), 1, 0, 'C');
					$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', thaidate("d/m/Y", strtotime($row->F_DATE))), 1, 0, 'C');
					$pdf->Cell(40, 8, iconv('UTF-8', 'TIS-620', BankAccount($row->ACCOUNT_NO)), 1, 0, 'C');
					$pdf->Cell(90, 8, iconv('UTF-8', 'TIS-620', $row->ACCOUNT_NAME), 1, 0, 'L');
					$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', $row->TRANS_SHORT), 1, 0, 'C');
					$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format($row->F_DEP, 2)), 1, 0, 'R');
					$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format($row->F_WDL, 2)), 1, 0, 'R');
					$pdf->Ln();
					$i = $i + 1;
				}
				$last_dep = $this->officer_model->sum_deposit_summary($startdate, $enddate, $USER_ID, $rowdeposit_type->ACC_TYPE);
				$last_wdl = $this->officer_model->sum_withdraw_summary($startdate, $enddate, $USER_ID, $rowdeposit_type->ACC_TYPE);
				$pdf->Cell(210, 8, iconv('UTF-8', 'TIS-620', 'รวมแต่ละประเภทบัญชี ' . ($i - 1) . ' บัญชี'), 1, 0, 'C');
				$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format($last_dep->F_DEP, 2)), 1, 0, 'R');
				$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format($last_wdl->F_WDL, 2)), 1, 0, 'R');
				$pdf->Ln();
				$pdf->Ln();
			}
		}
		$pdf->Output('I', 'Deposit_Summary' . thaidate("d/m/Y", strtotime($startdate)) . ' To ' . thaidate("d/m/Y", strtotime($enddate)) . '.pdf');
	}

	public function print_datebook()
	{
		include_once("application/libraries/thaidate-functions.php");
		include_once("application/libraries/Thaidate.php");
		require('application/libraries/fpdf.php');

		$account_number = $this->input->post('account_number');
		$startdate_print = $this->input->post('startdate_print');

		$pdf = new FPDF();
		$pdf->AddPage('P', 'A4');
		$pdf->SetLeftMargin(16);
		$pdf->AddFont('angsa', '', 'angsa.php');
		$pdf->SetFont('angsa', '', 14);
		$pdf->SetTitle('DateBook');

		$data = $this->officer_model->get_nameaccount($account_number);

		if ($data == NULL) {
			$pdf->Cell(0, 8, iconv('UTF-8', 'TIS-620', 'ไม่มีข้อมูล'), 0, 1, 'C');
		} else {
			$pdf->Cell(0, 8, iconv('UTF-8', 'TIS-620', 'พิมพ์บัญชีเงินฝาก'), 0, 1, "C");
			$pdf->Cell(0, 8, iconv('UTF-8', 'TIS-620', 'เลขที่บัญชี : ' . BankAccount($account_number)), 0, 1, 'L');
			$pdf->Cell(0, 8, iconv('UTF-8', 'TIS-620', 'ชื่อบัญชี :' . $data->ACCOUNT_NAME), 0, 1, 'L');
			$pdf->Cell(20, 8, iconv('UTF-8', 'TIS-620', 'ลำดับ'), 1, 0, 'C');
			$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', 'วันที่'), 1, 0, 'C');
			$pdf->Cell(40, 8, iconv('UTF-8', 'TIS-620', 'รายการ'), 1, 0, 'C');
			$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', 'เงินฝาก'), 1, 0, 'C');
			$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', 'เงินถอน'), 1, 0, 'C');
			$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', 'ยอดเงินคงเหลือ'), 1, 0, 'C');
			$pdf->Ln();
			$i = 1;
			$data_account = $this->officer_model->print_datebook($account_number, $startdate_print);
			$num = $data_account->num_rows();
			if ($num == 0) {
				$pdf->Cell(150, 8, iconv('UTF-8', 'TIS-620', 'ยอดคงเหลือ'), 1, 0, 'C');
				$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format(0, 2)), 1, 0, 'R');
			} else {
				foreach ($data_account->result() as $row) {
					$pdf->Cell(20, 8, iconv('UTF-8', 'TIS-620', $i), 1, 0, 'C');
					$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', thaidate("d/m/Y", strtotime($row->F_DATE))), 1, 0, 'C');
					$pdf->Cell(40, 8, iconv('UTF-8', 'TIS-620', $row->TRANS_SHORT), 1, 0, 'C');
					$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format($row->F_DEP, 2)), 1, 0, 'R');
					$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format($row->F_WDL, 2)), 1, 0, 'R');
					$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format($row->F_BALANCE, 2)), 1, 0, 'R');
					$pdf->Ln();
					$i = $i + 1;
				}
				$pdf->Cell(150, 8, iconv('UTF-8', 'TIS-620', 'ยอดคงเหลือ'), 1, 0, 'C');
				$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format($row->F_BALANCE, 2)), 1, 0, 'R');
			}
			$pdf->Output('I', 'print_datebook.pdf');
		}
	}



	public function account_book_balance()
	{
		include_once("application/libraries/thaidate-functions.php");
		include_once("application/libraries/Thaidate.php");
		require('application/libraries/fpdf.php');

		$mem_id = $this->input->post('mem_id');
		$branch_number = $this->input->post('branch_number');

		$pdf = new FPDF();
		$pdf->AddPage('P', 'A4');
		$pdf->AddFont('angsa', '', 'angsa.php');
		$pdf->SetFont('angsa', '', 14);
		$pdf->SetTitle('Account balance');

		$data = $this->officer_model->data_member($mem_id, $branch_number);

		if ($data == NULL) {
			$pdf->Cell(0, 8, iconv('UTF-8', 'TIS-620', 'ไม่มีข้อมูล'), 0, 1, 'C');
		} else {
			$i = 1;
			$pdf->Cell(0, 8, iconv('UTF-8', 'TIS-620', 'ยอดเงินในสมุดของบัญชี'), 0, 1, 'C');
			$pdf->Cell(0, 8, iconv('UTF-8', 'TIS-620', 'เลขที่สมาชิก ' . $data->MEM_ID), 0, 1, 'L');
			$pdf->Cell(0, 8, iconv('UTF-8', 'TIS-620', 'ชื่อ ' . $data->FNAME . ' ' . $data->LNAME), 0, 1, 'L');
			$pdf->Cell(10, 8, iconv('UTF-8', 'TIS-620', 'ลำดับ'), 1, 0, 'C');
			$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', 'เลขที่บัญชี'), 1, 0, 'C');
			$pdf->Cell(90, 8, iconv('UTF-8', 'TIS-620', 'ชื่อบัญชี'), 1, 0, 'C');
			$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', 'ยอดเงินคงเหลือ'), 1, 0, 'C');
			$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', 'ยอดเงินถอนได้'), 1, 0, 'C');
			$pdf->Ln();
			$data_officer = $this->officer_model->account_book_balance($mem_id, $branch_number);
			foreach ($data_officer->result() as $row) {
				$pdf->Cell(10, 8, iconv('UTF-8', 'TIS-620', $i), 1, 0, 'C');
				$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', BankAccount($row->ACCOUNT_NO)), 1, 0, 'C');
				$pdf->Cell(90, 8, iconv('UTF-8', 'TIS-620', $row->ACCOUNT_NAME), 1, 0, 'L');
				$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format($row->BALANCE, 2)), 1, 0, 'R');
				$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format($row->AVAILABLE, 2)), 1, 0, 'R');
				$pdf->Ln();
				$i = $i + 1;
			}
			$pdf->Cell(130, 8, iconv('UTF-8', 'TIS-620', 'รวมมีบัญชี ' . ($i - 1) . ' เล่ม'), 1, 0, 'C');
			$sum = $this->officer_model->sum_account_book_balance($mem_id, $branch_number);
			$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format($sum->BALANCE, 2)), 1, 0, 'R');
			$sum = $this->officer_model->sum_account_book_available($mem_id, $branch_number);
			$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format($sum->AVAILABLE, 2)), 1, 0, 'R');
		}
		$pdf->Output('I', 'account_book_balance.pdf');
	}
	/////////////////////////////////////////////////Deposit/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/////////////////////////////////////////////////Credit/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function credit_officer()
	{
		$mem_id = $this->input->post('mem_id');
		$branch_number = $this->input->post('branch_number');
		$USER_ID = $this->session->userdata('USER_ID');
		$data_officer = $this->officer_model->data_officer($USER_ID);
		$data['name'] = $this->officer_model->data_member($mem_id, $branch_number);
		$data['result'] = $this->officer_model->credit_officer($mem_id, $branch_number);
		if ($data['name'] != NULL && $data['result'] != NULL) {
			$this->load->view("containner/head");
			$this->load->view("containner/headerofficer", $data_officer);
			$this->load->view("containner/sidebarofficer");
			$this->load->view("credit_officer", $data);
			$this->load->view("containner/script");
		} else {
			echo "<script>alert('ไม่มียอดข้อมูลสินเชื่อสมาชิกดังกล่าว');</script>";
			redirect('officer/creditsystem', 'refresh');
		}
	}

	public function credit_officer_detail($code, $br_no)
	{
		$USER_ID = $this->session->userdata('USER_ID');
		$data_officer = $this->officer_model->data_officer($USER_ID);
		$data['select'] = $this->officer_model->credit_officer_select($code, $br_no);
		$data['result'] = $this->officer_model->credit_officer_detail($code, $br_no);
		$this->load->view("containner/head");
		$this->load->view("containner/headerofficer", $data_officer);
		$this->load->view("containner/sidebarofficer");
		$this->load->view("credit_officer_detail", $data);
		$this->load->view("containner/script");
	}

	public function checkcredit_officer($mem_id, $branch_number)
	{
		$USER_ID = $this->session->userdata('USER_ID');
		$data_officer = $this->officer_model->data_officer($USER_ID);
		$data['member'] = $this->officer_model->data_member($mem_id, $branch_number);
		$data['result'] = $this->officer_model->checkcredit_officer($mem_id, $branch_number);
		$this->load->view("containner/head");
		$this->load->view("containner/headerofficer", $data_officer);
		$this->load->view("containner/sidebarofficer");
		$this->load->view("checkcredit_officer", $data);
		$this->load->view("containner/script");
	}

	public function checkcredit_officer_detail($code, $branch_number)
	{
		$USER_ID = $this->session->userdata('USER_ID');
		$data_officer = $this->officer_model->data_officer($USER_ID);
		$data['select'] = $this->officer_model->checkcredit_officer_select($code, $branch_number);
		$data['result'] = $this->officer_model->checkcredit_officer_detail($code, $branch_number);
		$this->load->view("containner/head");
		$this->load->view("containner/headerofficer", $data_officer);
		$this->load->view("containner/sidebarofficer");
		$this->load->view("checkcredit_officer_detail", $data);
		$this->load->view("containner/script");
	}

	public function creditreport_summary()
	{
		include_once("application/libraries/thaidate-functions.php");
		include_once("application/libraries/Thaidate.php");
		require('application/libraries/fpdf.php');

		$USER_ID = $this->session->userdata('USER_ID');
		$startdate = $this->input->post('startdate');
		$enddate = $this->input->post('enddate');

		$pdf = new FPDF();
		$pdf->AddPage('L', 'A4');
		$pdf->AddFont('angsa', '', 'angsa.php');
		$pdf->SetFont('angsa', '', 14);
		$pdf->SetTitle('Credit_Summary');

		$data_officer = $this->officer_model->data_officer($USER_ID);
		$pdf->Cell(0, 8, iconv('UTF-8', 'TIS-620', $data_officer->BR_NAME), 0, 1, "C");
		$pdf->Cell(0, 8, iconv('UTF-8', 'TIS-620', 'สรุปรายการสินเชื่อพนักงานประจำวัน'), 0, 1, "C");
		$pdf->Cell(0, 8, iconv('UTF-8', 'TIS-620', 'ประจำวันที่ ' . thaidate("d/m/Y", strtotime($startdate)) . ' ถึง ' . thaidate("d/m/Y", strtotime($enddate))), 0, 1, "C");
		$pdf->Cell(0, 8, iconv('UTF-8', 'TIS-620', 'รหัสผู้ทำรายการ ' . $data_officer->USER_ID . '                                                                                                       ชื่อผู้ทำรายการ ' . $data_officer->USER_NAME), 0, 1, "L");

		$deposit_type = $this->officer_model->deposittype();
		foreach ($deposit_type->result() as $rowdeposit_type) {
			$data = $this->officer_model->depositreport_summary($startdate, $enddate, $USER_ID,  $rowdeposit_type->ACC_TYPE);
			$num = $data->num_rows();
			if ($num == 0) {
			} else {
				$pdf->Cell(0, 4, iconv('UTF-8', 'TIS-620', 'เงินฝาก : ' . $rowdeposit_type->ACC_DESC), 0, 1, 'L');
				$pdf->Ln();
				$pdf->Cell(20, 8, iconv('UTF-8', 'TIS-620', 'ลำดับ'), 1, 0, 'C');
				$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', 'วันที่'), 1, 0, 'C');
				$pdf->Cell(40, 8, iconv('UTF-8', 'TIS-620', 'เลขที่บัญชี'), 1, 0, 'C');
				$pdf->Cell(90, 8, iconv('UTF-8', 'TIS-620', 'ชื่อบัญชี'), 1, 0, 'C');
				$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', 'รายการ'), 1, 0, 'C');
				$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', 'ฝาก'), 1, 0, 'C');
				$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', 'ถอน'), 1, 0, 'C');
				$pdf->Ln();
				$i = 1;
				foreach ($data->result() as $row) {
					$pdf->Cell(20, 8, iconv('UTF-8', 'TIS-620', $i), 1, 0, 'C');
					$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', thaidate("d/m/Y", strtotime($row->F_DATE))), 1, 0, 'C');
					$pdf->Cell(40, 8, iconv('UTF-8', 'TIS-620', BankAccount($row->ACCOUNT_NO)), 1, 0, 'C');
					$pdf->Cell(90, 8, iconv('UTF-8', 'TIS-620', $row->ACCOUNT_NAME), 1, 0, 'L');
					$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', $row->TRANS_SHORT), 1, 0, 'C');
					$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format($row->F_DEP, 2)), 1, 0, 'R');
					$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format($row->F_WDL, 2)), 1, 0, 'R');
					$pdf->Ln();
					$i = $i + 1;
				}
				$last_dep = $this->officer_model->sum_deposit_summary($startdate, $enddate, $USER_ID, $rowdeposit_type->ACC_TYPE);
				$last_wdl = $this->officer_model->sum_withdraw_summary($startdate, $enddate, $USER_ID, $rowdeposit_type->ACC_TYPE);
				$pdf->Cell(210, 8, iconv('UTF-8', 'TIS-620', 'รวมแต่ละประเภทบัญชี ' . ($i - 1) . ' บัญชี'), 1, 0, 'C');
				$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format($last_dep->F_DEP, 2)), 1, 0, 'R');
				$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format($last_wdl->F_WDL, 2)), 1, 0, 'R');
				$pdf->Ln();
				$pdf->Ln();
			}
		}
		$pdf->Output('I', 'Deposit_Summary' . thaidate("d/m/Y", strtotime($startdate)) . ' To ' . thaidate("d/m/Y", strtotime($enddate)) . '.pdf');
	}

	public function print_credit_datebook()
	{
		include_once("application/libraries/thaidate-functions.php");
		include_once("application/libraries/Thaidate.php");
		require('application/libraries/fpdf.php');

		$account_number = $this->input->post('account_number');
		$startdate_print = $this->input->post('startdate_print');

		$pdf = new FPDF();
		$pdf->AddPage('P', 'A4');
		$pdf->SetLeftMargin(16);
		$pdf->AddFont('angsa', '', 'angsa.php');
		$pdf->SetFont('angsa', '', 14);
		$pdf->SetTitle('Credit_DateBook');

		$data = $this->officer_model->get_nameaccount($account_number);

		if ($data == NULL) {
			$pdf->Cell(0, 8, iconv('UTF-8', 'TIS-620', 'ไม่มีข้อมูล'), 0, 1, 'C');
		} else {
			$pdf->Cell(0, 8, iconv('UTF-8', 'TIS-620', 'พิมพ์บัญชีสินเชื่อ'), 0, 1, "C");
			$pdf->Cell(0, 8, iconv('UTF-8', 'TIS-620', 'เลขที่บัญชี : ' . BankAccount($account_number)), 0, 1, 'L');
			$pdf->Cell(0, 8, iconv('UTF-8', 'TIS-620', 'ชื่อบัญชี :' . $data->ACCOUNT_NAME), 0, 1, 'L');
			$pdf->Cell(20, 8, iconv('UTF-8', 'TIS-620', 'ลำดับ'), 1, 0, 'C');
			$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', 'วันที่'), 1, 0, 'C');
			$pdf->Cell(40, 8, iconv('UTF-8', 'TIS-620', 'รายการ'), 1, 0, 'C');
			$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', 'เงินฝาก'), 1, 0, 'C');
			$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', 'เงินถอน'), 1, 0, 'C');
			$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', 'ยอดเงินคงเหลือ'), 1, 0, 'C');
			$pdf->Ln();
			$i = 1;
			$data_account = $this->officer_model->print_datebook($account_number, $startdate_print);
			$num = $data_account->num_rows();
			if ($num == 0) {
				$pdf->Cell(150, 8, iconv('UTF-8', 'TIS-620', 'ยอดคงเหลือ'), 1, 0, 'C');
				$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format(0, 2)), 1, 0, 'R');
			} else {
				foreach ($data_account->result() as $row) {
					$pdf->Cell(20, 8, iconv('UTF-8', 'TIS-620', $i), 1, 0, 'C');
					$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', thaidate("d/m/Y", strtotime($row->F_DATE))), 1, 0, 'C');
					$pdf->Cell(40, 8, iconv('UTF-8', 'TIS-620', $row->TRANS_SHORT), 1, 0, 'C');
					$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format($row->F_DEP, 2)), 1, 0, 'R');
					$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format($row->F_WDL, 2)), 1, 0, 'R');
					$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format($row->F_BALANCE, 2)), 1, 0, 'R');
					$pdf->Ln();
					$i = $i + 1;
				}
				$pdf->Cell(150, 8, iconv('UTF-8', 'TIS-620', 'ยอดคงเหลือ'), 1, 0, 'C');
				$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format($row->F_BALANCE, 2)), 1, 0, 'R');
			}
			$pdf->Output('I', 'print_datebook.pdf');
		}
	}

	// public function account_book_credit_balance()
	// {
	// 	include_once("application/libraries/thaidate-functions.php");
	// 	include_once("application/libraries/Thaidate.php");
	// 	require('application/libraries/fpdf.php');

	// 	$mem_id = $this->input->post('mem_id');
	// 	$branch_number = $this->input->post('branch_number');

	// 	$pdf = new FPDF();
	// 	$pdf->AddPage('P', 'A4');
	// 	$pdf->AddFont('angsa', '', 'angsa.php');
	// 	$pdf->SetFont('angsa', '', 14);
	// 	$pdf->SetTitle('Account credit balance');

	// 	$data = $this->officer_model->data_member($mem_id, $branch_number);

	// 	if ($data == NULL) {
	// 		$pdf->Cell(0, 8, iconv('UTF-8', 'TIS-620', 'ไม่มีข้อมูล'), 0, 1, 'C');
	// 	} else {
	// 		$i = 1;
	// 		$pdf->Cell(0, 8, iconv('UTF-8', 'TIS-620', 'ยอดเงินในสมุดของบัญชี'), 0, 1, 'C');
	// 		$pdf->Cell(0, 8, iconv('UTF-8', 'TIS-620', 'เลขที่สมาชิก ' . $data->MEM_ID), 0, 1, 'L');
	// 		$pdf->Cell(0, 8, iconv('UTF-8', 'TIS-620', 'ชื่อ ' . $data->FNAME . ' ' . $data->LNAME), 0, 1, 'L');
	// 		$pdf->Cell(10, 8, iconv('UTF-8', 'TIS-620', 'ลำดับ'), 1, 0, 'C');
	// 		$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', 'เลขที่บัญชี'), 1, 0, 'C');
	// 		$pdf->Cell(90, 8, iconv('UTF-8', 'TIS-620', 'ชื่อบัญชี'), 1, 0, 'C');
	// 		$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', 'ยอดเงินคงเหลือ'), 1, 0, 'C');
	// 		$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', 'ยอดเงินถอนได้'), 1, 0, 'C');
	// 		$pdf->Ln();
	// 		$data_officer = $this->officer_model->account_book_balance($mem_id, $branch_number);
	// 		foreach ($data_officer->result() as $row) {
	// 			$pdf->Cell(10, 8, iconv('UTF-8', 'TIS-620', $i), 1, 0, 'C');
	// 			$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', BankAccount($row->ACCOUNT_NO)), 1, 0, 'C');
	// 			$pdf->Cell(90, 8, iconv('UTF-8', 'TIS-620', $row->ACCOUNT_NAME), 1, 0, 'L');
	// 			$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format($row->BALANCE, 2)), 1, 0, 'R');
	// 			$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format($row->AVAILABLE, 2)), 1, 0, 'R');
	// 			$pdf->Ln();
	// 			$i = $i + 1;
	// 		}
	// 		$pdf->Cell(130, 8, iconv('UTF-8', 'TIS-620', 'รวมมีบัญชี ' . ($i - 1) . ' เล่ม'), 1, 0, 'C');
	// 		$sum = $this->officer_model->sum_account_book_balance($mem_id, $branch_number);
	// 		$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format($sum->BALANCE, 2)), 1, 0, 'R');
	// 		$sum = $this->officer_model->sum_account_book_available($mem_id, $branch_number);
	// 		$pdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', number_format($sum->AVAILABLE, 2)), 1, 0, 'R');
	// 	}
	// 	$pdf->Output('I', 'Account credit balance.pdf');
	// }
	/////////////////////////////////////////////////Credit/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////Upload/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function uploadfile()
	{
		$this->load->library('upload');

		$config['upload_path']          = './upload/';
		$config['allowed_types']        = 'pdf|csv';
		$config['max_size'] 			= '10000';
		$config['overwrite'] 			= true;

		$this->upload->initialize($config);
		if (!$this->upload->do_upload("myfile")) {
			echo $this->upload->display_errors();
		}

		$file_name = $this->upload->file_name;

		$user_id = $this->session->userdata('USER_ID');
		$br_no = $this->session->userdata('BR_NO');

		$result = $this->officer_model->uploadfile($user_id, $br_no, $file_name);

		if ($result != null) {
			echo "<script>alert('Upload file success');</script>";
			redirect('officer/creditsystem', 'refresh');
		} else {
			echo "<script>alert('ไม่สามารถอัพโหลดไฟล์ได้');</script>";
			redirect('officer/creditsystem', 'refresh');
		}
	}

	public function documentsystem()
	{
		$USER_ID = $this->session->userdata('USER_ID');
		$data_officer = $this->officer_model->data_officer($USER_ID);
		$document_file['result'] = $this->officer_model->getdocument_file();
		$this->load->view("containner/head");
		$this->load->view("containner/headerofficer", $data_officer);
		$this->load->view("containner/sidebarofficer");
		$this->load->view("documentsystem", $document_file);
		$this->load->view("containner/script");
	}

	public function downloadfile($fileid)
	{
		if (!empty($fileid)) {
			$this->load->helper(('download'));
			$fileinfo = $this->officer_model->getRows(array('fileid' => $fileid));
			$file = './upload/' . $fileinfo['fileupload'];
			force_download($file, NULL);
		}
	}

	public function deletefileupload($fileid)
	{
		$result = $this->officer_model->deletefileupload($fileid);
		if ($result == TRUE) {
			echo "<script>alert('delete success');</script>";
			redirect('officer/documentsystem', 'refresh');
		} else {
			echo "<script>alert('delete unsuccess');</script>";
			redirect('officer/documentsystem', 'refresh');
		}
	}
}
