<div class="col-lg-9">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>รายการบัญชีสมาชิก</h2>
    </div>
    <form action="<?php echo site_url('member/deposit_member_seeaccount') ?>" method="post">
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="start">จาก :</label>
                    <input type="date" class="form-control" id="start" name="startdate" value="<?php echo date("Y-m-d"); ?>">
                    <input type="hidden" class="form-control" name="account_number" value="<?php echo $result->ACCOUNT_NO ?>">
                </div>
                <div class="col">
                    <label for="end">ถึง :</label>
                    <input type="date" class="form-control" id="end" name="enddate" value="<?php echo date("Y-m-d"); ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success btn-md btn-block" target="popup">ดูข้อมูล</button>
            </div>
            <div class="col">
                <a href="<?php echo site_url('member/deposit_member_seeaccount_allday/' . $result->ACCOUNT_NO) ?>" class="btn btn-success btn-md btn-block">ดูข้อมูลทั้งหมด</a>
            </div>
        </div>
    </form>
</div>
</div>