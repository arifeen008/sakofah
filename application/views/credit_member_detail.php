<?php
include_once("application/libraries/thaidate-functions.php");
include_once("application/libraries/Thaidate.php");
?>
<div class="col-lg-9">
    <div class="col-12" id="main">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">สินเชื่อ</h1>
        </div>
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <td>เลขที่สัญญา</td>
                    <td><?php echo $select->LCONT_ID ?></td>
                </tr>
                <tr>
                    <td>ชื่อสัญญา</td>
                    <td><?php if ($select->L_TYPE_CODE === "1" && $select->LSUB_CODE === "1") {
                            echo ' ฉุกเฉิน';
                        } elseif ($select->L_TYPE_CODE === "2" && $select->LSUB_CODE === "1") {
                            echo ' สามัญ ';
                        } elseif ($select->L_TYPE_CODE === "3" && $select->LSUB_CODE === "1") {
                            echo ' พิเศษ';
                        } elseif ($select->L_TYPE_CODE === "3" && $select->LSUB_CODE === "2") {
                            echo ' โครงการ';
                        } elseif ($select->L_TYPE_CODE === "2" && $select->LSUB_CODE === "2") {
                            echo ' สามัญฉุกเฉิน';
                        } elseif ($select->L_TYPE_CODE === "3" && $select->LSUB_CODE === "3") {
                            echo ' โครงการสินทรัพย์';
                        } else {
                            echo 'เจ้าหน้าที่';
                        }
                        ?></td>
                </tr>
                <tr>
                    <td>วันที่ทำสัญญา</td>
                    <td><?php echo thaidate('j M Y ', strtotime($select->LCONT_DATE)) ?></td>
                </tr>
                <tr>
                    <td>วันที่หมดสัญญา</td>
                    <td><?php echo thaidate('j M Y ', strtotime($select->END_PAYDEPT)) ?></td>
                </tr>
                <tr>
                    <td>ยอดอนุมัติสินเชื่อ</td>
                    <td><?php echo number_format($select->LCONT_APPROVE_SAL, 2) ?></td>
                </tr>
                <tr>
                    <td>จำนวนงวดคงเหลือ</td>
                    <td><?php echo $select->LCONT_AMOUNT_INST ?></td>
                </tr>
                <tr>
                    <td>จำนวนเงินคงเหลือ</td>
                    <td><?php echo number_format($select->LCONT_AMOUNT_SAL, 2) ?> บาท</td>
                </tr>
            </tbody>
        </table>
        <div class="col">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr align="center">
                            <td>วันที่</td>
                            <td>งวดที่</td>
                            <td>ยอดชำระ</td>
                            <td>ยอดคงเหลือ</td>
                            <td></td>
                        </tr>
                    </thead>
                    <?php foreach ($result->result() as $row) { ?>
                        <tr align="center">
                            <td><?= thaidate('j M Y ', strtotime($row->LPD_DATE)) ?></td>
                            <td><?= $row->LPD_NUM_INST ?></td>
                            <td><?= number_format($row->SUM_SAL, 2) ?></td>
                            <td><?= number_format($row->LCONT_BAL_AMOUNT, 2) ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="<?php echo site_url('member/credit_member') ?>" class="btn btn-success btn-lg btn-block">กลับ</a>
            </div>
        </div>
    </div>
</div>