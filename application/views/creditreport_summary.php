<?php
include_once("application/libraries/thaidate-functions.php");
include_once("application/libraries/Thaidate.php");
?>
<div class="col-lg-9">
    <div class="col-12" id="main">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">สินเชื่อ</h1>
        </div>
        <a href="<?php echo site_url('member/checkcredit_member') ?>" class="btn btn-success btn-sm">สัญญาสินเชื่อที่ปิดไปแล้ว</a>
        <div class="col">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr align="center">
                            <td>เลขที่สัญญา</td>
                            <td>ชื่อสัญญา</td>
                            <td>วันที่ทำสัญญา</td>
                            <td>วันที่หมดสัญญา</td>
                            <td>ยอดอนุมัติสินเชื่อ</td>
                            <td>จำนวนงวดคงเหลือ</td>
                            <td>ยอดคงเหลือ</td>
                            <td></td>
                        </tr>
                    </thead>
                    <?php if ($result->result() == null) { ?>
                        <td colspan="7" align="center">ไม่มีข้อมูลสินเชื่อ</td>
                    <?php  } ?>
                    <?php foreach ($result->result() as $row) { ?>
                        <tr align="center">
                            <td><?= $row->LCONT_ID ?></td>
                            <td><?php if ($row->L_TYPE_CODE === "1" && $row->LSUB_CODE === "1") {
                                    echo 'ฉุกเฉิน';
                                } elseif ($row->L_TYPE_CODE === "2" && $row->LSUB_CODE === "1") {
                                    echo 'สามัญ ';
                                } elseif ($row->L_TYPE_CODE === "3" && $row->LSUB_CODE === "1") {
                                    echo 'พิเศษ';
                                } elseif ($row->L_TYPE_CODE === "3" && $row->LSUB_CODE === "2") {
                                    echo 'โครงการ';
                                } elseif ($row->L_TYPE_CODE === "2" && $row->LSUB_CODE === "2") {
                                    echo 'สามัญฉุกเฉิน';
                                } elseif ($row->L_TYPE_CODE === "3" && $row->LSUB_CODE === "3") {
                                    echo 'โครงการสินทรัพย์';
                                } else {
                                    echo 'เจ้าหน้าที่';
                                }
                                ?>
                            </td>
                            <td><?= thaidate('j M Y ', strtotime($row->LCONT_DATE))  ?></td>
                            <td><?= thaidate('j M Y ', strtotime($row->END_PAYDEPT)) ?></td>
                            <td><?= number_format($row->LCONT_APPROVE_SAL, 2); ?> </td>
                            <td><?= $row->LCONT_AMOUNT_INST ?></td>
                            <td><?= number_format($row->LCONT_AMOUNT_SAL, 2);  ?></td>
                            <td><a href="<?php echo site_url('member/credit_member_detail/' . $row->CODE . '')  ?>" class="btn btn-primary"><i class="fas fa-eye"></i></a></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>