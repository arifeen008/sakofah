<div class="col-lg-9">
    <div class="col-12" id="main">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">แก้ไขประวัติสมาชิก</h1>
        </div>
        <div class="card-body">
            <form action="<?php echo site_url('member/updateeditdata_member') ?>" method="post">
                <!-- <div class="form-group">
                <label>ชื่อ</label>
                <input type="text" class="form-control" name="">
            </div>
            <div class="form-group">
                <label>นามสกุล</label>
                <input type="text" class="form-control" name="">
            </div>
            <div class="form-group">
                <label>ที่อยู่</label>
                <input type="text" class="form-control" name="">
            </div>
            <div class="form-group">
                <label>หมู่</label>
                <input type="text" class="form-control" name="">
            </div>-->
                <div class="form-group">
                    <label>ID LINE</label>
                    <input type="text" class="form-control" name="LINE_ID" placeholder="Enter Line ID" value="<?php echo $LINE_ID ?>">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="EMAIL" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo $EMAIL ?>">
                </div>
                <div class="form-group">
                    <label>โทรศัพท์</label>
                    <input type="text" class="form-control" name="MOBILE_TEL" placeholder="เบอร์โทรศัพท์" value="<?php echo $MOBILE_TEL ?>">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

    </div>
</div>
