<?php defined('BASEPATH') or exit('No direct script access allowed');

class Member_model extends CI_Model
{
    private $tbl_name1 = 'MEM_H_MEMBER';
    private $tbl_name2 = 'SHR_MEM';
    private $tbl_name3 = 'BK_H_SAVINGACCOUNT';
    private $tbl_name4 = 'LOAN_M_CONTACT';
    private $tbl_name5 = 'WEL_H_MEMBER';
    private $tbl_name6 = 'BK_T_FINANCE';
    private $tbl_name7 = 'LOAN_M_PAYDEPT';
    private $tbl_name8 = 'SHR_T_SHARE';

    public function fetch_user_login($ID_CARD)
    {
        $this->db->where('ID_CARD', $ID_CARD);
        $query = $this->db->get($this->tbl_name1);
        return $query->row();
    }

    public function data_member($ID_CARD)
    {
        // $this->db->select('ID_CARD,MEM_ID,BR_NO,FNAME,LNAME');
        $this->db->where('ID_CARD', $ID_CARD);
        $query = $this->db->get($this->tbl_name1);
        return $query->row();
    }

    public function updatephone_member($MOBILE_TEL, $LINE_ID, $EMAIL, $ID_CARD)
    {
        $data = array(
            'MOBILE_TEL' => $MOBILE_TEL,
            'LINE_ID' => $LINE_ID,
            'EMAIL' => $EMAIL
        );
        $this->db->where('ID_CARD', $ID_CARD);
        $result = $this->db->update($this->tbl_name1, $data);
        return $result;
    }

    public function share_member($ID_CARD, $BR_NO, $MEM_ID)
    {
        $this->db->select('SHR_MEM.MEM_ID,BK_M_BRANCH.BR_NAME,SHR_MEM.SHR_SUM_BTH,SHR_MEM.POINT_SHR');
        $this->db->where('MEM_H_MEMBER.ID_CARD', $ID_CARD);
        $this->db->where('MEM_H_MEMBER.MEM_ID', $MEM_ID);
        $this->db->where('SHR_MEM.BR_NO', $BR_NO);
        $this->db->join('MEM_H_MEMBER', 'MEM_H_MEMBER.MEM_ID = SHR_MEM.MEM_ID');
        $this->db->join('BK_M_BRANCH', 'BK_M_BRANCH.BR_NO = SHR_MEM.BR_NO');
        $query = $this->db->get($this->tbl_name2);
        return $query->row();
    }

    public function share_member_detail($ID_CARD, $BR_NO, $MEM_ID)
    {
        $this->db->select('SLIP_NO,SHR_NA,TMP_DATE_TODAY,SHR_SUM_BTH,TMP_SHARE_QTY,TMP_SHARE_BHT');
        $this->db->where('MEM_H_MEMBER.ID_CARD', $ID_CARD);
        $this->db->where('SHR_T_SHARE.BR_NO', $BR_NO);
        $this->db->where('SHR_T_SHARE.MEM_ID', $MEM_ID);
        $this->db->join('MEM_H_MEMBER', 'MEM_H_MEMBER.MEM_ID = SHR_T_SHARE.MEM_ID');
        $this->db->join('SHR_TBL', 'SHR_TBL.SHR_NO = SHR_T_SHARE.SHR_NO');
        $this->db->order_by('SHR_T_SHARE.TMP_YEAR', 'ASC');
        // $this->db->limit('5');
        $result = $this->db->get($this->tbl_name8);
        return $result;
    }

    public function deposit_member($ID_CARD, $BR_NO)
    {
        $this->db->select('ACCOUNT_NAME,ACCOUNT_NO,ACC_DESC,BR_NAME,BALANCE');
        $this->db->where('MEM_H_MEMBER.ID_CARD', $ID_CARD);
        $this->db->where('BK_H_SAVINGACCOUNT.BR_NO', $BR_NO);
        $this->db->join('MEM_H_MEMBER', ' MEM_H_MEMBER.MEM_ID = BK_H_SAVINGACCOUNT.MEM_ID ');
        $this->db->join('BK_M_BRANCH', 'BK_M_BRANCH.BR_NO = MEM_H_MEMBER.BR_NO');
        $this->db->join('BK_M_ACC_TYPE', 'BK_H_SAVINGACCOUNT.ACC_TYPE = BK_M_ACC_TYPE.ACC_TYPE');
        $result = $this->db->get($this->tbl_name3);
        return $result;
    }

    public function credit_member($MEM_ID, $ID_CARD, $BR_NO)
    {
        $this->db->select('LOAN_M_CONTACT.LCONT_ID,LOAN_M_CONTACT.L_TYPE_CODE,LOAN_M_CONTACT.LSUB_CODE,LOAN_M_CONTACT.LCONT_DATE,LOAN_M_CONTACT.LCONT_APPROVE_SAL,LOAN_M_CONTACT.LCONT_AMOUNT_INST,LOAN_M_CONTACT.LCONT_AMOUNT_SAL,LOAN_M_CONTACT.CODE,LOAN_M_REGISTER.END_PAYDEPT');
        $this->db->where('MEM_H_MEMBER.ID_CARD', $ID_CARD);
        $this->db->where('MEM_H_MEMBER.MEM_ID', $MEM_ID);
        $this->db->where('LOAN_M_CONTACT.BR_NO', $BR_NO);
        $this->db->where('LOAN_M_REGISTER.BR_NO', $BR_NO);
        $this->db->where('LOAN_M_CONTACT.LCONT_STATUS_FLAG', '1');
        $this->db->join('MEM_H_MEMBER', ' MEM_H_MEMBER.MEM_ID = LOAN_M_CONTACT.MEM_ID ');
        $this->db->join('LOAN_M_REGISTER', ' LOAN_M_REGISTER.CODE = LOAN_M_CONTACT.CODE ');
        $this->db->order_by('LOAN_M_CONTACT.LCONT_DATE', 'ASC');

        $result = $this->db->get($this->tbl_name4);
        return $result;
    }

    public function credit_member_detail($BR_NO, $code)
    {
        $this->db->select('LPD_DATE,SUM_SAL,LCONT_BAL_AMOUNT,LPD_NUM_INST');
        $this->db->where('LOAN_M_PAYDEPT.CODE', $code);
        $this->db->where('LOAN_M_PAYDEPT.BR_NO', $BR_NO);
        $this->db->where('LOAN_M_PAYDEPT.LPD_NUM_INST >', '0');
        $this->db->order_by('LPD_DATE', 'ASC');
        $result = $this->db->get($this->tbl_name7);
        return $result;
    }

    public function credit_member_select($BR_NO, $code)
    {
        $this->db->select('LOAN_M_CONTACT.LCONT_ID,LOAN_M_CONTACT.L_TYPE_CODE,LOAN_M_CONTACT.LSUB_CODE,LOAN_M_CONTACT.LCONT_DATE,LOAN_M_CONTACT.LCONT_APPROVE_SAL,LOAN_M_CONTACT.LCONT_AMOUNT_INST,LOAN_M_CONTACT.LCONT_AMOUNT_SAL,LOAN_M_REGISTER.END_PAYDEPT');
        $this->db->where('LOAN_M_CONTACT.BR_NO', $BR_NO);
        $this->db->where('LOAN_M_REGISTER.BR_NO', $BR_NO);
        $this->db->where('LOAN_M_REGISTER.CODE', $code);
        $this->db->join('LOAN_M_REGISTER', ' LOAN_M_REGISTER.CODE = LOAN_M_CONTACT.CODE ');
        $query = $this->db->get($this->tbl_name4);
        return $query->row();
    }

    public function checkcredit_member($MEM_ID, $ID_CARD, $BR_NO)
    {
        $this->db->select('LCONT_ID,L_TYPE_CODE,LSUB_CODE,LCONT_DATE,LCONT_APPROVE_SAL,LCONT_AMOUNT_SAL,CODE');
        $this->db->where('MEM_H_MEMBER.ID_CARD', $ID_CARD);
        $this->db->where('MEM_H_MEMBER.MEM_ID', $MEM_ID);
        $this->db->where('LOAN_M_CONTACT.BR_NO', $BR_NO);
        $this->db->where('LOAN_M_CONTACT.LCONT_STATUS_FLAG', '4');
        $this->db->join('MEM_H_MEMBER', ' MEM_H_MEMBER.MEM_ID = LOAN_M_CONTACT.MEM_ID ');
        $this->db->order_by('LCONT_DATE', 'ASC');
        $result = $this->db->get($this->tbl_name4);
        return $result;
    }

    public function checkcredit_member_detail($BR_NO, $code)
    {
        $this->db->select('LPD_DATE,SUM_SAL,LCONT_BAL_AMOUNT,LPD_NUM_INST');
        $this->db->where('LOAN_M_PAYDEPT.CODE', $code);
        $this->db->where('LOAN_M_PAYDEPT.BR_NO', $BR_NO);
        $this->db->where('LOAN_M_PAYDEPT.LPD_NUM_INST >', '0');
        $this->db->order_by('LPD_DATE', 'ASC');
        $result = $this->db->get($this->tbl_name7);
        return $result;
    }

    public function getaccount_member($account_number)
    {
        $this->db->select('ACCOUNT_NO');
        $this->db->where('ACCOUNT_NO', $account_number);
        $result = $this->db->get($this->tbl_name3);
        return $result->row();
    }

    // public function deposit_member_seeaccount($account_number, $startdate, $enddate)
    // {
    //     $this->db->select('F_TIME,F_DEP,F_WDL,F_BALANCE');
    //     $this->db->where('F_FROM_ACC', $account_number);
    //     $this->db->where('F_TIME >=', "TO_DATE('$startdate','YYYY-MM-DD')", false);
    //     $this->db->where('F_TIME <=', "TO_DATE('$enddate','YYYY-MM-DD')", false);
    //     $this->db->order_by('F_TIME', 'ASC');
    //     $result = $this->db->get($this->tbl_name6);
    //     return $result;
    // }

    public function deposit_member_seeaccount($account_number,$startdate, $enddate)
    {
        $this->db->select('F_TIME,F_DEP,F_WDL,F_BALANCE');
        $this->db->where('F_FROM_ACC', $account_number);
        $this->db->where('F_TIME >=', $startdate);
        $this->db->where('F_TIME <=', $enddate);
        $this->db->order_by('F_TIME', 'ASC');
        $result = $this->db->get($this->tbl_name6);
        return $result;
    }

    public function deposit_member_seeaccount_allday($account_number)
    {
        $this->db->select('F_TIME,F_DEP,F_WDL,F_BALANCE');
        $this->db->where('F_FROM_ACC', $account_number);
        $this->db->order_by('F_TIME', 'ASC');
        $result = $this->db->get($this->tbl_name6);
        return $result;
    }

    public function welfare_member($MEM_ID, $ID_CARD, $BR_NO)
    {
        $this->db->where('MEM_H_MEMBER.ID_CARD', $ID_CARD);
        $this->db->where('MEM_H_MEMBER.MEM_ID', $MEM_ID);
        $this->db->where('WEL_H_MEMBER.BR_NO', $BR_NO);
        $this->db->join('MEM_H_MEMBER', 'MEM_H_MEMBER.MEM_ID = WEL_H_MEMBER.MEM_ID');
        $this->db->join('BK_M_BRANCH', 'BK_M_BRANCH.BR_NO = MEM_H_MEMBER.BR_NO');
        $result = $this->db->get($this->tbl_name5);
        return $result;
    }

    public function requestwelfare_member($MEM_ID, $ID_CARD, $BR_NO)
    {
        $this->db->where('MEM_H_MEMBER.ID_CARD', $ID_CARD);
        $this->db->where('MEM_H_MEMBER.MEM_ID', $MEM_ID);
        $this->db->where('WEL_H_MEMBER.BR_NO', $BR_NO);
        $this->db->join('MEM_H_MEMBER', 'MEM_H_MEMBER.MEM_ID = WEL_H_MEMBER.MEM_ID');
        $this->db->join('BK_M_BRANCH', 'BK_M_BRANCH.BR_NO = MEM_H_MEMBER.BR_NO');
        $result = $this->db->get($this->tbl_name5);
        return $result;
    }

    public function insert_register_form($USERNAME, $PASSWORD, $FIRSTNAME, $LASTNAME, $PHONE, $EMAIL)
    {
        $data = array(
            'POSITIONID' => 2,
            'USERNAME' => $USERNAME,
            'PASSWORD' => $PASSWORD,
            'FIRSTNAME' => $FIRSTNAME,
            'LASTNAME' => $LASTNAME,
            'PHONE' => $PHONE,
            'EMAIL' => $EMAIL
        );
        $result = $this->db->insert($this->tbl_name, $data);

        if ($result) {
            echo "<script>alert('สมัครบัญชีผู้ใช้สำเร็จ');window.location='http://localhost/project/';</script>";
        } else {
            echo "<script>alert('สมัครบัญชีผู้ใช้ไม่สำเร็จ');window.location='http://localhost/project/index.php/login/register';</script>";
        }
    }

    public function requestOTP($project_key, $PHONE, $ref_code)
    {
        include_once("application/libraries/SMSOTPLib.php");
        $otp = new SMSOTP(ConnectionType::SOAP, Security::STANDARD);

        $result = $otp->requestOTP($project_key, $PHONE, $ref_code);
        $result = json_decode($result);

        // $otp->viewStructure($result);
        // $status_code = $result->response->status->status_code;
        // $status_detail = $result->response->status->status_detail;
        $token = $result->response->token;

        return $token;
    }

    public function validateOTP($token, $otp_password, $ref_code)
    {
        include_once("application/libraries/SMSOTPLib.php");
        $otp = new SMSOTP(ConnectionType::SOAP, Security::STANDARD);

        $result = $otp->validateOTP($token, $otp_password, $ref_code);
        $result = json_decode($result);

        // $otp->viewStructure($result);

        $status_code = $result->response->status->status_code;
        // $status_detail = $result->response->status->status_detail;
        // $token = $result->response->token;

        // echo "status_code : " . $status_code . "<br>";
        // echo "status_detail : " . $status_detail . "<br>";
        // echo "token : " . $token . "<br>";
        // echo "Error : " . $otp->Error . "<br>";

        return $status_code;
    }
}
