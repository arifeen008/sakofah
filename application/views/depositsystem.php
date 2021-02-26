<div class="col-lg-9">
    <div class="flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h1">สรุปรายการเงินฝากพนักงานประจำวัน</h1>
    </div>
    <form action="<?php echo site_url('officer/depositreport_summary') ?>" method="post" target="_blank">
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="start">จาก :</label>
                    <input type="date" class="form-control" id="start" name="startdate" value="<?php echo date("Y-m-d"); ?>">
                </div>
                <div class="col">
                    <label for="end">ถึง :</label>
                    <input type="date" class="form-control" id="end" name="enddate" value="<?php echo date("Y-m-d", strtotime("+1 day")); ?>">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success mb-2">ดึงข้อมูล</button>
    </form>

    <form action="<?php echo site_url('officer/print_datebook') ?>" method="post" target="_blank">
        <div class="flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h1">พิมพ์สมุดย้อนวันที่</h1>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="AccountNumber">เลขที่บัญชี...</label>
                    <input type="text" name="account_number" class="form-control" placeholder="เลขที่บัญชี..." id="AccountNumber" maxlength="11" required autofocus>
                </div>
                <div class="col">
                    <label for="startdate">วันที่เริ่มพิมพ์ :</label>
                    <input type="date" name="startdate_print" class="form-control" id="startdate" value="<?php echo date("Y-m-d"); ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="startdate">หน้าที่พิมพ์ :</label>
                    <input class="form-control" type="text" placeholder="หน้าที่..." disabled>
                </div>
                <div class="col">
                    <label for="startdate">บรรทัดที่พิมพ์ :</label>
                    <input class="form-control" type="text" placeholder="บรรทัดที่..." disabled>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" disabled>
                        <label class="form-check-label" for="inlineRadio1">พิมพ์สมุด</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" disabled>
                        <label class="form-check-label" for="inlineRadio2">พิมพ์บัญชีเงินฝาก</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled>
                        <label class="form-check-label" for="inlineRadio3">พิมพ์ statement</label>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success mb-2">ดึงข้อมูล</button>
    </form>

    <form action="<?php echo site_url('officer/account_book_balance') ?>" method="post" target="_blank">
        <div class="flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h1">สอบถามยอดเงินในสมุดของบัญชี</h1>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="mem_id">เลขที่สมาชิก :</label>
                    <input class="form-control" type="text" id="mem_id" placeholder="เลขที่สมาชิก..." name="mem_id" maxlength="5" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="branch_number">เลือกสาขา</label>
                    <select class="form-control" id="branch_number" name="branch_number">
                        <?php foreach ($result->result() as $row) { ?>
                            <option value="<?php echo $row->BR_NO ?>"> <?php echo $row->BR_NO ?> &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp; <?php echo $row->BR_NAME ?></option>
                        <?php  } ?>

                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success mb-2">ดึงข้อมูล</button>
    </form>
</div>
</div>