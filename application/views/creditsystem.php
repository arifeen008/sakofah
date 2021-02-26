<div class="col-lg-9">
    <div class="flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h1">สรุปรายการสินเชื่อพนักงานประจำวัน</h1>
    </div>
    <form action="<?php echo site_url('officer/creditreport_summary') ?>" method="post" target="_blank">
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="start">จาก :</label>
                    <input type="date" class="form-control" name="startdate" value="<?php echo date("Y-m-d"); ?>">
                </div>
                <div class="col">
                    <label for="end">ถึง :</label>
                    <input type="date" class="form-control" name="enddate" value="<?php echo date("Y-m-d", strtotime("+1 day")); ?>">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success mb-2">ดึงข้อมูล</button>
    </form>

    <div class="flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h1">พิมพ์สมุดสินเชื่อย้อนวันที่</h1>
    </div>
    <form action="<?php echo site_url('officer/print_credit_datebook') ?>" method="post" target="_blank">
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="mem_id">เลขที่สมาชิก</label>
                    <input class="form-control" type="text" id="AccountNumber" placeholder="เลขที่บัญชี..." name="account_number" maxlength="11" required>

                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="startdate">วันที่เริ่มพิมพ์ :</label>
                    <input type="date" class="form-control" name="startdate_print" value="<?php echo date("Y-m-d"); ?>">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success mb-2">ดึงข้อมูล</button>
    </form>

    <div class="flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h1">สอบถามยอดสินเชื่อในสมุดของบัญชี</h1>
    </div>
    <form action="<?php echo site_url('officer/credit_officer') ?>" method="post">
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="mem_id">เลขที่สมาชิก</label>
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

    <div class="flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h1">อัพโหลดไฟล์</h1>
    </div>
    <form action="<?php echo site_url('officer/uploadfile') ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="myfile" id="customFile" size="" required accept="application/pdf,application/vnd.ms-excel" />
                <label class="custom-file-label" for="customFile">เลือก....</label>
            </div>
            <?php echo $error;?>
        </div>
        <button type="submit" class="btn btn-success mb-2">Upload</button>
    </form>
</div>
</div>
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>