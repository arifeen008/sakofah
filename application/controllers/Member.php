<?php defined('BASEPATH') or exit('No direct script access allowed');
session_start();
class Member extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('member_model');
	}

	public function login_member()
	{
		$this->load->view("containner/head");
		$this->load->view("login_member");
	}

	public function check_member()
	{
		$result = $this->member_model->fetch_user_login($this->input->post("ID_CARD"));
		if (!empty($result)) {
			$session = array(
				'ID_CARD' => $result->ID_CARD, 'MEM_ID' => $result->MEM_ID, 'BR_NO' => $result->BR_NO, 'FNAME' => $result->FNAME, 'LNAME' => $result->LNAME
			);
			$this->session->set_userdata($session);
			$ID_CARD = $this->session->userdata("ID_CARD");
			$data = $this->member_model->data_member($ID_CARD);
			$this->load->view("containner/head");
			$this->load->view("containner/headermember", $data);
			$this->load->view("containner/sidebarmember", $data);
			$this->load->view("data_member", $data);
			// $this->load->view("containner/footermember");
			$this->load->view("containner/script");
		} else {
			$this->session->unset_userdata(array('ID_CARD', 'MEM_ID',  'BR_NO', 'FNAME', 'LNAME'));
			$this->load->view("containner/head");
			$this->load->view("login_member");
			$this->load->view("containner/script");
			echo "<script>alert('คุณใส่ Usename หรือ PASSWORD ไม่ถูกต้อง');</script>";
		}
	}

	public function logout_member()
	{
		$this->session->unset_userdata(array('ID_CARD', 'MEM_ID',  'BR_NO', 'FNAME', 'LNAME'));
		redirect('index', 'refresh');
	}

	public function register_member()
	{
		$this->load->view("containner/head");
		$this->load->view("register_form");
		$this->load->view("containner/script");
	}

	public function callsendmessage($tel)
	{
		$Username	= "feenkundee";
		$Password	= "9aBk@Ubn";
		$PhoneList	= $tel;
		$Message	= urlencode("ทดสอบการส่งข้อความผ่าน API ด้วยภาษา PHP");

		$Sender		= "Demo-SMS";

		$Parameter	=	"User=$Username&Password=$Password&Msnlist=$PhoneList&Msg=$Message&Sender=$Sender";
		$API_URL	=	"http://member.smsmkt.com/SMSLink/SendMsg/index.php";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $API_URL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $Parameter);

		$Result = curl_exec($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		echo ($http_code);
		echo "<br>";
		echo ($Result);

		return $http_code;
	}

	public function register_form()
	{
		$USERNAME = $this->input->post('USERNAME');
		$PASSWORD = sha1($this->input->post('PASSWORD'));
		$FIRSTNAME = $this->input->post('FIRSTNAME');
		$LASTNAME = $this->input->post('LASTNAME');
		$PHONE = $this->input->post('PHONE');
		$EMAIL = $this->input->post('EMAIL');
		$this->member_model->insert_register_form($USERNAME, $PASSWORD, $FIRSTNAME, $LASTNAME, $PHONE, $EMAIL);
		// $token = $this->requestOTP($PHONE);

		// $data = array('USERNAME' => $USERNAME, 'PASSWORD' => $PASSWORD, 'FIRSTNAME' => $FIRSTNAME, 'LASTNAME' => $LASTNAME, 'PHONE' => $PHONE, 'EMAIL' => $EMAIL, 'token' => $token);

		// $this->load->view("containner/head");
		// $this->load->view("insertapi", $data);

	}

	public function requestOTP($phone)
	{
		$project_key = "KtwOMP5Gij";
		$ref_code = "";

		$token = $this->member_model->requestOTP($project_key, $phone, $ref_code);
		return $token;
	}

	public function validateOTP()
	{
		$USERNAME = $this->input->post('USERNAME');
		$PASSWORD = sha1($this->input->post('PASSWORD'));
		$FIRSTNAME = $this->input->post('FIRSTNAME');
		$LASTNAME = $this->input->post('LASTNAME');
		$PHONE = $this->input->post('PHONE');
		$EMAIL = $this->input->post('EMAIL');
		$token = $this->input->post('token');

		$otp_password = $this->input->post('otp_password');
		$ref_code = "";

		$status_code = $this->member_model->validateOTP($token, $otp_password, $ref_code);
		if ($status_code === 000) {
			$this->member_model->insert_register_form($USERNAME, $PASSWORD, $FIRSTNAME, $LASTNAME, $PHONE, $EMAIL);
		} else {
			// echo "<script>alert('สมัครบัญชีผู้ใช้ไม่สำเร็จ');window.location='http://localhost/project/index.php/login/register';</script>";
			echo "<script>alert('สมัครบัญชีผู้ใช้ไม่สำเร็จ')</script>";
			$this->load->view("containner/head");
			$this->load->view("register_form");
			$this->load->view("containner/script");
		}
	}

	public function checkcredit()
	{
		$Username	= "feenkundee";
		$Password	= "9aBk@Ubn";

		$Parameter	=	"User=$Username&Password=$Password";
		$API_URL	=	"http://member.smsmkt.com/SMSLink/GetCredit/index.php";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $API_URL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $Parameter);

		$Result = curl_exec($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		echo ($http_code);
		echo "<br>";
		echo ($Result);
	}

	public function data_member()
	{
		$ID_CARD = $this->session->userdata("ID_CARD");
		$data = $this->member_model->data_member($ID_CARD);
		$this->load->view("containner/head");
		$this->load->view("containner/headermember", $data);
		$this->load->view("containner/sidebarmember", $data);
		$this->load->view("data_member", $data);
		$this->load->view("containner/script");
	}

	public function editdata_member()
	{
		$ID_CARD = $this->session->userdata("ID_CARD");
		$data = $this->member_model->data_member($ID_CARD);
		$this->load->view("containner/head");
		$this->load->view("containner/headermember", $data);
		$this->load->view("containner/sidebarmember", $data);
		$this->load->view("editdata_member", $data);
		$this->load->view("containner/script");
	}

	public function updateeditdata_member()
	{
		$ID_CARD = $this->session->userdata('ID_CARD');
		$MOBILE_TEL = $this->input->post('MOBILE_TEL');
		$LINE_ID = $this->input->post('LINE_ID');
		$EMAIL = $this->input->post('EMAIL');
		$result = $this->member_model->updatephone_member($MOBILE_TEL, $LINE_ID, $EMAIL, $ID_CARD);
		if ($result) {
			$data = $this->member_model->data_member($ID_CARD);
			echo "<script>alert('แก้ไขสำเร็จ')</script>";
			redirect('member/data_member', 'refresh');
		} else {
			$data = $this->member_model->data_member($ID_CARD);
			echo "<script>alert('แก้ไขไม่สำเร็จ')</script>";
			redirect('member/data_member', 'refresh');
		}
	}

	public function share_member()
	{
		$MEM_ID = $this->session->userdata("MEM_ID");
		$ID_CARD = $this->session->userdata("ID_CARD");
		$BR_NO = $this->session->userdata("BR_NO");
		$data1 = $this->member_model->data_member($ID_CARD);
		$data2['result'] = $this->member_model->share_member($ID_CARD, $BR_NO, $MEM_ID);
		$data2['detail'] = $this->member_model->share_member_detail($ID_CARD, $BR_NO, $MEM_ID);
		// echo "MEM_ID = ". $MEM_ID ."ID_CARD = ". $ID_CARD;
		$this->load->view("containner/head");
		$this->load->view("containner/headermember", $data1);
		$this->load->view("containner/sidebarmember", $data1);
		$this->load->view("share_member", $data2);
		$this->load->view("containner/script");
	}

	public function deposit_member()
	{
		$ID_CARD = $this->session->userdata("ID_CARD");
		$BR_NO = $this->session->userdata("BR_NO");
		$data1 = $this->member_model->data_member($ID_CARD);
		$data2['result'] = $this->member_model->deposit_member($ID_CARD, $BR_NO);
		$this->load->view("containner/head");
		$this->load->view("containner/headermember", $data1);
		$this->load->view("containner/sidebarmember");
		$this->load->view("deposit_member", $data2);
		$this->load->view("containner/script");
	}

	public function deposit_member_seedata($ACCOUNT_NO)
	{
		$ID_CARD = $this->session->userdata("ID_CARD");
		$account_number = $this->input->get('ACCOUNT_NO');
		$dataaccount['result'] = $this->member_model->getaccount_member($ACCOUNT_NO);
		$data = $this->member_model->data_member($ID_CARD);
		$this->load->view("containner/head");
		$this->load->view("containner/headermember", $data);
		$this->load->view("containner/sidebarmember");
		$this->load->view("deposit_member_seedata", $dataaccount);
		$this->load->view("containner/script");
	}

	public function deposit_member_seeaccount()
	{
		$ID_CARD = $this->session->userdata("ID_CARD");
		$account_number = $this->input->post("account_number");
		$startdate = $this->input->post('startdate');
		$enddate = $this->input->post('enddate');
		$data1 = $this->member_model->data_member($ID_CARD);
		$data2['result'] = $this->member_model->deposit_member_seeaccount($account_number, $startdate, $enddate);
		$this->load->view("containner/head");
		$this->load->view("containner/headermember", $data1);
		$this->load->view("containner/sidebarmember");
		$this->load->view("deposit_member_seeaccount", $data2);
		$this->load->view("containner/script");
	}

	public function deposit_member_seeaccount_allday($ACCOUNT_NO)
	{
		$ID_CARD = $this->session->userdata('ID_CARD');
		$data1 = $this->member_model->data_member($ID_CARD);
		$data2['result'] = $this->member_model->deposit_member_seeaccount_allday($ACCOUNT_NO);
		$this->load->view("containner/head");
		$this->load->view("containner/headermember", $data1);
		$this->load->view("containner/sidebarmember");
		$this->load->view("deposit_member_seeaccount", $data2);
		$this->load->view("containner/script");
	}

	public function credit_member()
	{
		$ID_CARD = $this->session->userdata('ID_CARD');
		$MEM_ID = $this->session->userdata('MEM_ID');
		$BR_NO = $this->session->userdata('BR_NO');
		$data1 = $this->member_model->data_member($ID_CARD);
		$data2['result'] = $this->member_model->credit_member($MEM_ID, $ID_CARD, $BR_NO);
		$this->load->view("containner/head");
		$this->load->view("containner/headermember", $data1);
		$this->load->view("containner/sidebarmember", $data1);
		$this->load->view("credit_member", $data2);
		$this->load->view("containner/script");
	}

	public function credit_member_detail($code)
	{
		$ID_CARD = $this->session->userdata('ID_CARD');
		$BR_NO = $this->session->userdata('BR_NO');
		$data1 = $this->member_model->data_member($ID_CARD);
		$data2['result'] = $this->member_model->credit_member_detail($BR_NO, $code);
		$data2['select'] = $this->member_model->credit_member_select($BR_NO, $code);

		$this->load->view("containner/head");
		$this->load->view("containner/headermember", $data1);
		$this->load->view("containner/sidebarmember", $data1);
		$this->load->view("credit_member_detail", $data2);
		$this->load->view("containner/script");
	}

	public function checkcredit_member()
	{
		$ID_CARD = $this->session->userdata('ID_CARD');
		$MEM_ID = $this->session->userdata('MEM_ID');
		$BR_NO = $this->session->userdata('BR_NO');
		$data1 = $this->member_model->data_member($ID_CARD);
		$data2['result'] = $this->member_model->checkcredit_member($MEM_ID, $ID_CARD, $BR_NO);
		$this->load->view("containner/head");
		$this->load->view("containner/headermember", $data1);
		$this->load->view("containner/sidebarmember", $data1);
		$this->load->view("checkcredit_member", $data2);
		$this->load->view("containner/script");
	}

	public function checkcredit_member_detail($code)
	{
		$ID_CARD = $this->session->userdata('ID_CARD');
		$MEM_ID = $this->session->userdata('MEM_ID');
		$BR_NO = $this->session->userdata('BR_NO');
		$data1 = $this->member_model->data_member($ID_CARD);
		$data2['result'] = $this->member_model->credit_member_detail($BR_NO, $code);
		$data2['select'] = $this->member_model->credit_member_select($BR_NO, $code);
		$this->load->view("containner/head");
		$this->load->view("containner/headermember", $data1);
		$this->load->view("containner/sidebarmember", $data1);
		$this->load->view("checkcredit_member_detail", $data2);
		$this->load->view("containner/script");
	}

	public function welfare_member()
	{
		$ID_CARD = $this->session->userdata('ID_CARD');
		$MEM_ID = $this->session->userdata('MEM_ID');
		$BR_NO = $this->session->userdata('BR_NO');
		$data1 = $this->member_model->data_member($ID_CARD);
		$data2['result'] = $this->member_model->welfare_member($MEM_ID, $ID_CARD, $BR_NO);
		$this->load->view("containner/head");
		$this->load->view("containner/headermember", $data1);
		$this->load->view("containner/sidebarmember", $data1);
		$this->load->view("welfare_member", $data2);
		$this->load->view("containner/script");
	}

	public function requestwelfare_member()
	{
		$ID_CARD = $this->session->userdata('ID_CARD');
		$MEM_ID = $this->session->userdata('MEM_ID');
		$BR_NO = $this->session->userdata('BR_NO');
		$data1 = $this->member_model->data_member($ID_CARD);
		$data2['result'] = $this->member_model->welfare_member($MEM_ID, $ID_CARD, $BR_NO);
		$this->load->view("containner/head");
		$this->load->view("containner/headermember", $data1);
		$this->load->view("containner/sidebarmember", $data1);
		$this->load->view("requestwelfare_member", $data2);
		$this->load->view("containner/script");
	}
}
