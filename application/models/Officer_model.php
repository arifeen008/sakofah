<?php defined('BASEPATH') or exit('No direct script access allowed');

class Officer_model extends CI_Model
{
    private $tbl_name1 = 'BK_H_TELLER_CONTROL';
    private $tbl_name2 = 'BK_M_BRANCH';
    private $tbl_name3 = 'BK_H_SAVINGACCOUNT';
    private $tbl_name4 = 'BK_T_FINANCE';
    private $tbl_name5 = 'MEM_H_MEMBER';
    private $tbl_name6 = 'BK_M_ACC_TYPE';
    private $tbl_name7 = 'LOAN_M_CONTACT';
    private $tbl_name8 = 'LOAN_M_PAYDEPT';
    private $tbl_name9 = 'uploadfile';


    public function fetch_user_login($USER_ID)
    {
        $this->db->where('USER_ID', $USER_ID);
        // $this->db->where('PASSWORD', $PASSWORD);
        $query = $this->db->get($this->tbl_name1);
        return $query->row();
    }

    public function data_officer($USER_ID)
    {
        // $this->db->select('BK_H_TELLER_CONTROL.USER_ID,BK_H_TELLER_CONTROL.USER_NAME,BK_H_TELLER_CONTROL.LEVEL_CODE,BK_M_BRANCH.BR_NO,BK_M_BRANCH.BR_NAME');
        $this->db->where('BK_H_TELLER_CONTROL.USER_ID', $USER_ID);
        $this->db->join('BK_M_BRANCH', 'BK_M_BRANCH.BR_NO = BK_H_TELLER_CONTROL.BR_NO');
        $query = $this->db->get($this->tbl_name1);
        return $query->row();
    }

    public function data_member($mem_id, $branch_number)
    {
        $this->db->select('MEM_ID,BR_NO,FNAME,LNAME');
        $this->db->where('MEM_ID', $mem_id);
        $this->db->where('BR_NO', $branch_number);
        $query = $this->db->get($this->tbl_name5);
        if ($query == null) {
            return null;
        } else {
            return $query->row();
        }
    }

    public function pullbranch()
    {
        $this->db->select('BR_NO,BR_NAME');
        $this->db->order_by('BR_NO', 'ASC');
        $result = $this->db->get($this->tbl_name2);
        return $result;
    }

    // public function depositreport_summary($startdate, $enddate, $USER_ID, $ACC_TYPE)
    // {
    //     $this->db->select('BK_T_FINANCE.F_DATE,BK_H_SAVINGACCOUNT.ACCOUNT_NO,BK_H_SAVINGACCOUNT.ACCOUNT_NAME,BK_M_TRANSCODE.TRANS_SHORT,BK_T_FINANCE.F_DEP,BK_T_FINANCE.F_WDL');
    //     $this->db->where('BK_H_TELLER_CONTROL.USER_ID', $USER_ID);
    //     $this->db->where('BK_H_SAVINGACCOUNT.ACC_TYPE', $ACC_TYPE);
    //     $this->db->where('BK_T_FINANCE.F_DATE >=', "TO_DATE('$startdate','YYYY-MM-DD')", false);
    //     $this->db->where('BK_T_FINANCE.F_DATE <=', "TO_DATE('$enddate','YYYY-MM-DD')", false);
    //     $this->db->join('BK_T_FINANCE', 'BK_T_FINANCE.USER_ID = BK_H_TELLER_CONTROL.USER_ID');
    //     $this->db->join('BK_H_SAVINGACCOUNT', 'BK_T_FINANCE.F_FROM_ACC = BK_H_SAVINGACCOUNT.ACCOUNT_NO');
    //     $this->db->join('BK_M_ACC_TYPE', 'BK_H_SAVINGACCOUNT.ACC_TYPE = BK_M_ACC_TYPE.ACC_TYPE');
    //     $this->db->join('BK_M_TRANSCODE', 'BK_M_TRANSCODE.TRANS_CODE = BK_T_FINANCE.TRANS_CODE');
    //     $this->db->group_by('BK_T_FINANCE.F_DATE,BK_H_SAVINGACCOUNT.ACCOUNT_NO,BK_H_SAVINGACCOUNT.ACCOUNT_NAME,BK_M_TRANSCODE.TRANS_SHORT,BK_T_FINANCE.F_DEP,BK_T_FINANCE.F_WDL');
    //     $this->db->order_by('BK_T_FINANCE.F_DATE', 'ASC');
    //     $result = $this->db->get($this->tbl_name1);
    //     return $result;
    // }

    public function depositreport_summary($startdate, $enddate, $USER_ID, $ACC_TYPE)
    {
        $this->db->select('BK_T_FINANCE.F_DATE,BK_H_SAVINGACCOUNT.ACCOUNT_NO,BK_H_SAVINGACCOUNT.ACCOUNT_NAME,BK_M_TRANSCODE.TRANS_SHORT,BK_T_FINANCE.F_DEP,BK_T_FINANCE.F_WDL');
        $this->db->where('BK_H_TELLER_CONTROL.USER_ID', $USER_ID);
        $this->db->where('BK_H_SAVINGACCOUNT.ACC_TYPE', $ACC_TYPE);
        $this->db->where('BK_T_FINANCE.F_DATE >=', $startdate);
        $this->db->where('BK_T_FINANCE.F_DATE <=', $enddate);
        $this->db->join('BK_T_FINANCE', 'BK_T_FINANCE.USER_ID = BK_H_TELLER_CONTROL.USER_ID');
        $this->db->join('BK_H_SAVINGACCOUNT', 'BK_T_FINANCE.F_FROM_ACC = BK_H_SAVINGACCOUNT.ACCOUNT_NO');
        $this->db->join('BK_M_ACC_TYPE', 'BK_H_SAVINGACCOUNT.ACC_TYPE = BK_M_ACC_TYPE.ACC_TYPE');
        $this->db->join('BK_M_TRANSCODE', 'BK_M_TRANSCODE.TRANS_CODE = BK_T_FINANCE.TRANS_CODE');
        $this->db->group_by('BK_T_FINANCE.F_DATE,BK_H_SAVINGACCOUNT.ACCOUNT_NO,BK_H_SAVINGACCOUNT.ACCOUNT_NAME,BK_M_TRANSCODE.TRANS_SHORT,BK_T_FINANCE.F_DEP,BK_T_FINANCE.F_WDL');
        $this->db->order_by('BK_T_FINANCE.F_DATE', 'ASC');
        $result = $this->db->get($this->tbl_name1);
        return $result;
    }

    public function credit_officer($mem_id, $branch_number)
    {
        $this->db->select('LOAN_M_CONTACT.LCONT_ID,LOAN_M_CONTACT.BR_NO,LOAN_M_CONTACT.CODE,LOAN_M_CONTACT.L_TYPE_CODE,LOAN_M_CONTACT.LSUB_CODE,LOAN_M_CONTACT.LCONT_DATE,LOAN_M_CONTACT.LCONT_APPROVE_SAL,LOAN_M_CONTACT.LCONT_AMOUNT_INST,LOAN_M_CONTACT.LCONT_AMOUNT_SAL,LOAN_M_REGISTER.END_PAYDEPT');
        $this->db->where('LOAN_M_CONTACT.MEM_ID', $mem_id);
        $this->db->where('LOAN_M_REGISTER.MEM_ID', $mem_id);
        $this->db->where('LOAN_M_CONTACT.BR_NO', $branch_number);
        $this->db->where('LOAN_M_CONTACT.LCONT_STATUS_FLAG', '1');
        $this->db->join('LOAN_M_REGISTER', ' LOAN_M_REGISTER.CODE = LOAN_M_CONTACT.CODE ');
        // $this->db->join('LOAN_M_REGISTER', ' LOAN_M_REGISTER.LCONT_ID = LOAN_M_CONTACT.LCONT_ID ');
        $this->db->order_by('LOAN_M_CONTACT.LCONT_DATE', 'ASC');
        $result = $this->db->get($this->tbl_name7);
        if ($result == NULL) {
            return NULL;
        } else {
            return $result;
        }
    }

    public function credit_officer_detail($code, $BR_NO)
    {
        $this->db->select('LPD_DATE,SUM_SAL,LCONT_BAL_AMOUNT,LPD_NUM_INST');
        $this->db->where('LOAN_M_PAYDEPT.CODE', $code);
        $this->db->where('LOAN_M_PAYDEPT.BR_NO', $BR_NO);
        $this->db->where('LOAN_M_PAYDEPT.LPD_NUM_INST >', '0');
        $this->db->order_by('LPD_DATE', 'ASC');
        $result = $this->db->get($this->tbl_name8);
        return $result;
    }

    public function credit_officer_select($code, $BR_NO)
    {
        $this->db->select('LOAN_M_CONTACT.LCONT_ID,LOAN_M_CONTACT.L_TYPE_CODE,LOAN_M_CONTACT.LSUB_CODE,LOAN_M_CONTACT.LCONT_DATE,LOAN_M_CONTACT.LCONT_APPROVE_SAL,LOAN_M_CONTACT.LCONT_AMOUNT_INST,LOAN_M_CONTACT.LCONT_AMOUNT_SAL,LOAN_M_REGISTER.END_PAYDEPT');
        $this->db->where('LOAN_M_CONTACT.BR_NO', $BR_NO);
        $this->db->where('LOAN_M_REGISTER.BR_NO', $BR_NO);
        $this->db->where('LOAN_M_REGISTER.CODE', $code);
        $this->db->join('LOAN_M_REGISTER', ' LOAN_M_REGISTER.CODE = LOAN_M_CONTACT.CODE ');
        $query = $this->db->get($this->tbl_name7);
        return $query->row();
    }

    public function checkcredit_officer($mem_id, $branch_number)
    {
        $this->db->select('LCONT_ID,L_TYPE_CODE,LSUB_CODE,LCONT_DATE,LCONT_APPROVE_SAL,LCONT_AMOUNT_SAL,CODE,BR_NO');
        $this->db->where('LOAN_M_CONTACT.MEM_ID', $mem_id);
        $this->db->where('LOAN_M_CONTACT.BR_NO', $branch_number);
        $this->db->where('LOAN_M_CONTACT.LCONT_STATUS_FLAG', '4');
        $this->db->order_by('LCONT_DATE', 'ASC');
        $result = $this->db->get($this->tbl_name7);
        return $result;
    }

    public function checkcredit_officer_select($code, $branch_number)
    {
        $this->db->select('LOAN_M_CONTACT.LCONT_ID,LOAN_M_CONTACT.L_TYPE_CODE,LOAN_M_CONTACT.LSUB_CODE,LOAN_M_CONTACT.LCONT_DATE,LOAN_M_CONTACT.LCONT_APPROVE_SAL,LOAN_M_CONTACT.LCONT_AMOUNT_INST,LOAN_M_CONTACT.LCONT_AMOUNT_SAL,LOAN_M_REGISTER.END_PAYDEPT');
        $this->db->where('LOAN_M_CONTACT.BR_NO', $branch_number);
        $this->db->where('LOAN_M_REGISTER.BR_NO', $branch_number);
        $this->db->where('LOAN_M_REGISTER.CODE', $code);
        $this->db->join('LOAN_M_REGISTER', ' LOAN_M_REGISTER.CODE = LOAN_M_CONTACT.CODE ');
        $query = $this->db->get($this->tbl_name7);
        return $query->row();
    }

    public function checkcredit_officer_detail($code, $branch_number)
    {
        // $this->db->select('LPD_DATE,SUM_SAL,LCONT_BAL_AMOUNT,LPD_NUM_INST');
        $this->db->where('LOAN_M_PAYDEPT.CODE', $code);
        $this->db->where('LOAN_M_PAYDEPT.BR_NO', $branch_number);
        $this->db->where('LOAN_M_PAYDEPT.LPD_NUM_INST >', '0');
        $this->db->order_by('LPD_DATE', 'ASC');
        $result = $this->db->get($this->tbl_name8);
        return $result;
    }

    public function deposittype()
    {
        $this->db->select('ACC_TYPE,ACC_DESC');
        $this->db->order_by('ACC_TYPE', 'ASC');
        $result = $this->db->get($this->tbl_name6);
        return $result;
    }

    // public function sum_deposit_summary($startdate, $enddate, $USER_ID, $ACC_TYPE)
    // {
    //     $this->db->select_sum('BK_T_FINANCE.F_DEP');
    //     $this->db->where('BK_H_TELLER_CONTROL.USER_ID', $USER_ID);
    //     $this->db->where('BK_H_SAVINGACCOUNT.ACC_TYPE', $ACC_TYPE);
    //     $this->db->where('BK_T_FINANCE.F_DATE >=', "TO_DATE('$startdate','YYYY-MM-DD')", false);
    //     $this->db->where('BK_T_FINANCE.F_DATE <=', "TO_DATE('$enddate','YYYY-MM-DD')", false);
    //     $this->db->join('BK_T_FINANCE', 'BK_T_FINANCE.USER_ID = BK_H_TELLER_CONTROL.USER_ID');
    //     $this->db->join('BK_H_SAVINGACCOUNT', 'BK_T_FINANCE.F_FROM_ACC = BK_H_SAVINGACCOUNT.ACCOUNT_NO');
    //     $this->db->join('BK_M_ACC_TYPE', 'BK_H_SAVINGACCOUNT.ACC_TYPE = BK_M_ACC_TYPE.ACC_TYPE');
    //     $this->db->join('BK_M_TRANSCODE', 'BK_M_TRANSCODE.TRANS_CODE = BK_T_FINANCE.TRANS_CODE');
    //     $this->db->order_by('BK_T_FINANCE.F_DATE', 'asc');
    //     $result = $this->db->get($this->tbl_name1);
    //     return $result->row();
    // }

    public function sum_deposit_summary($startdate, $enddate, $USER_ID, $ACC_TYPE)
    {
        $this->db->select_sum('BK_T_FINANCE.F_DEP');
        $this->db->where('BK_H_TELLER_CONTROL.USER_ID', $USER_ID);
        $this->db->where('BK_H_SAVINGACCOUNT.ACC_TYPE', $ACC_TYPE);
        $this->db->where('BK_T_FINANCE.F_DATE >=', $startdate);
        $this->db->where('BK_T_FINANCE.F_DATE <=', $enddate);
        $this->db->join('BK_T_FINANCE', 'BK_T_FINANCE.USER_ID = BK_H_TELLER_CONTROL.USER_ID');
        $this->db->join('BK_H_SAVINGACCOUNT', 'BK_T_FINANCE.F_FROM_ACC = BK_H_SAVINGACCOUNT.ACCOUNT_NO');
        $this->db->join('BK_M_ACC_TYPE', 'BK_H_SAVINGACCOUNT.ACC_TYPE = BK_M_ACC_TYPE.ACC_TYPE');
        $this->db->join('BK_M_TRANSCODE', 'BK_M_TRANSCODE.TRANS_CODE = BK_T_FINANCE.TRANS_CODE');
        $this->db->order_by('BK_T_FINANCE.F_DATE', 'asc');
        $result = $this->db->get($this->tbl_name1);
        return $result->row();
    }

    // public function sum_withdraw_summary($startdate, $enddate, $USER_ID, $ACC_TYPE)
    // {
    //     $this->db->select_sum('BK_T_FINANCE.F_WDL');
    //     $this->db->where('BK_H_TELLER_CONTROL.USER_ID', $USER_ID);
    //     $this->db->where('BK_H_SAVINGACCOUNT.ACC_TYPE', $ACC_TYPE);
    //     $this->db->where('BK_T_FINANCE.F_DATE >=', "TO_DATE('$startdate','YYYY-MM-DD')", false);
    //     $this->db->where('BK_T_FINANCE.F_DATE <=', "TO_DATE('$enddate','YYYY-MM-DD')", false);
    //     $this->db->join('BK_T_FINANCE', 'BK_T_FINANCE.USER_ID = BK_H_TELLER_CONTROL.USER_ID');
    //     $this->db->join('BK_H_SAVINGACCOUNT', 'BK_T_FINANCE.F_FROM_ACC = BK_H_SAVINGACCOUNT.ACCOUNT_NO');
    //     $this->db->join('BK_M_ACC_TYPE', 'BK_H_SAVINGACCOUNT.ACC_TYPE = BK_M_ACC_TYPE.ACC_TYPE');
    //     $this->db->join('BK_M_TRANSCODE', 'BK_M_TRANSCODE.TRANS_CODE = BK_T_FINANCE.TRANS_CODE');
    //     $this->db->order_by('BK_T_FINANCE.F_DATE', 'ASC');
    //     $result = $this->db->get($this->tbl_name1);
    //     return $result->row();
    // }

    public function sum_withdraw_summary($startdate, $enddate, $USER_ID, $ACC_TYPE)
    {
        $this->db->select_sum('BK_T_FINANCE.F_WDL');
        $this->db->where('BK_H_TELLER_CONTROL.USER_ID', $USER_ID);
        $this->db->where('BK_H_SAVINGACCOUNT.ACC_TYPE', $ACC_TYPE);
        $this->db->where('BK_T_FINANCE.F_DATE >=', $startdate);
        $this->db->where('BK_T_FINANCE.F_DATE <=', $enddate);
        $this->db->join('BK_T_FINANCE', 'BK_T_FINANCE.USER_ID = BK_H_TELLER_CONTROL.USER_ID');
        $this->db->join('BK_H_SAVINGACCOUNT', 'BK_T_FINANCE.F_FROM_ACC = BK_H_SAVINGACCOUNT.ACCOUNT_NO');
        $this->db->join('BK_M_ACC_TYPE', 'BK_H_SAVINGACCOUNT.ACC_TYPE = BK_M_ACC_TYPE.ACC_TYPE');
        $this->db->join('BK_M_TRANSCODE', 'BK_M_TRANSCODE.TRANS_CODE = BK_T_FINANCE.TRANS_CODE');
        $this->db->order_by('BK_T_FINANCE.F_DATE', 'ASC');
        $result = $this->db->get($this->tbl_name1);
        return $result->row();
    }

    // public function print_datebook($account_number, $startdate_print)
    // {
    //     $this->db->select('BK_T_FINANCE.F_DATE,BK_M_TRANSCODE.TRANS_SHORT,BK_T_FINANCE.F_DEP,BK_T_FINANCE.F_WDL,BK_T_FINANCE.F_BALANCE');
    //     $this->db->where('BK_T_FINANCE.F_FROM_ACC', $account_number);
    //     $this->db->where('BK_T_FINANCE.F_DATE >=', "TO_DATE('$startdate_print','YYYY-MM-DD')", false);
    //     $this->db->join('BK_M_TRANSCODE', 'BK_M_TRANSCODE.TRANS_CODE = BK_T_FINANCE.TRANS_CODE');
    //     $this->db->order_by('BK_T_FINANCE.F_DATE', 'ASC');
    //     $result = $this->db->get($this->tbl_name4);
    //     return $result;
    // }

    public function print_datebook($account_number, $startdate_print)
    {
        $this->db->select('BK_T_FINANCE.F_DATE,BK_M_TRANSCODE.TRANS_SHORT,BK_T_FINANCE.F_DEP,BK_T_FINANCE.F_WDL,BK_T_FINANCE.F_BALANCE');
        $this->db->where('BK_T_FINANCE.F_FROM_ACC', $account_number);
        $this->db->where('BK_T_FINANCE.F_DATE >=', $startdate_print);
        $this->db->join('BK_M_TRANSCODE', 'BK_M_TRANSCODE.TRANS_CODE = BK_T_FINANCE.TRANS_CODE');
        $this->db->order_by('BK_T_FINANCE.F_DATE', 'ASC');
        $result = $this->db->get($this->tbl_name4);
        return $result;
    }

    public function get_nameaccount($account_number)
    {
        $this->db->select('ACCOUNT_NAME');
        $this->db->where('ACCOUNT_NO', $account_number);
        $result = $this->db->get($this->tbl_name3);
        return $result->row();
    }

    public function account_book_balance($mem_id, $branch_number)
    {
        $this->db->select('ACCOUNT_NO,ACCOUNT_NAME,BALANCE,AVAILABLE');
        $this->db->where('MEM_ID', $mem_id);
        $this->db->where('BR_NO', $branch_number);
        $this->db->group_by('ACCOUNT_NO,ACCOUNT_NAME,BALANCE,AVAILABLE');
        $this->db->order_by('ACCOUNT_NO', 'ASC');
        $result = $this->db->get($this->tbl_name3);
        return $result;
    }

    public function sum_account_book_balance($mem_id, $branch_number)
    {
        $this->db->select_sum('BALANCE');
        $this->db->where('MEM_ID', $mem_id);
        $this->db->where('BR_NO', $branch_number);
        $result = $this->db->get($this->tbl_name3);
        return $result->row();
    }

    public function sum_account_book_available($mem_id, $branch_number)
    {
        $this->db->select_sum('AVAILABLE');
        $this->db->where('MEM_ID', $mem_id);
        $this->db->where('BR_NO', $branch_number);
        $result = $this->db->get($this->tbl_name3);
        return $result->row();
    }

    public function uploadfile($user_id, $br_no, $file_name)
    {
        $data = array(
            'user_id' => $user_id,
            'br_no' => $br_no,
            'fileupload' => $file_name
        );
        $result = $this->db->insert($this->tbl_name9, $data);
        return $result;
    }

    public function getdocument_file()
    {
        $this->db->select('*');
        $this->db->join('BK_H_TELLER_CONTROL', 'BK_H_TELLER_CONTROL.USER_ID = uploadfile.USER_ID');
        $result = $this->db->get($this->tbl_name9);
        return $result;
    }

    public function downloadfile($fileid)
    {
        $this->db->select('*');
        $this->db->where('fileid', $fileid);
        $result = $this->db->get($this->tbl_name9);
        return $result->row();
    }

    public function deletefileupload($fileid)
    {
        $this->db->where('fileid', $fileid);
        $result = $this->db->delete($this->tbl_name9);
        return $result;
    }

    public function getRows($params = array())
    {
        $this->db->select('*');
        $this->db->from($this->tbl_name9);
        if(array_key_exists('fileid',$params) && !empty($params['fileid'])){
            $this->db->where('fileid',$params['fileid']);
            $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        }
        return $result;
    }
}
