<?php include_once("application/libraries/thaidate-functions.php");
include_once("application/libraries/Thaidate.php");
?>

<div class="col-sm-9">
    <div class="flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h1">ประวัติสมาชิก</h1>
    </div>
    <div class="card border-success">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    ชื่อ : <?php echo $FNAME ?>
                </div>
                <div class="col">
                    นามสกุล : <?php echo $LNAME ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    วันเกิด : <?php echo thaidate('j F Y ', strtotime($DMY_BIRTH))  ?>
                </div>
                <div class="col">
                    เพศ : <?php if ($SEX === "1") {
                                echo "ชาย";
                            } else {
                                echo "หญิง";
                            } ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    ชื่อบิดา : <?php echo $FATHER ?>
                </div>
                <div class="col">
                    ชื่อมารดา : <?php echo $MOTHER ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    สถานะ : <?php echo $MARRIAGE_STATUS ?>
                </div>
                <div class="col">
                    กรุ๊ปเลือด : <?php echo $BLO_GROUP ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    ที่อยู่ : <?php echo $ADDRESS ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    หมู่บ้าน : <?php echo $MOO_ADDR ?>
                </div>
                <div class="col">
                    ตำบล : <?php echo $TUMBOL ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    LINE ID : <?php echo $LINE_ID ?>
                </div>
                <div class="col">
                    EMAIL : <?php echo $EMAIL ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    โทรศัพท์ : <?php echo TelFormat($MOBILE_TEL)  ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p align="center"><a href="<?php echo site_url('member/editdata_member') ?>" class="btn btn-success btn-sm">แก้ไขข้อมูล</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- </div> -->
