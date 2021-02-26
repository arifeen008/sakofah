<?php
include_once("application/libraries/thaidate-functions.php");
include_once("application/libraries/Thaidate.php");
?>
<div class="col-lg-9">
    <div class="col-12" id="main">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">เงินหุ้น</h1>
        </div>
        <div class="col">
            <div class="card border-success">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr align="center">
                                <td>เลขที่สมาชิก</td>
                                <td>สาขาที่สังกัด</td>
                                <td>เงินคงเหลือ</td>
                                <td>คะแนนสะสมคงเหลือ</td>
                            </tr>
                        </thead>

                        <tr align="center">
                            <td><?= $result->MEM_ID ?></td>
                            <td><?= $result->BR_NAME ?></td>
                            <td><?= number_format($result->SHR_SUM_BTH, 2); ?></td>
                            <td><?= $result->POINT_SHR ?></td>
                        </tr>

                    </table>
                </div>
            </div>
            <br>
            <div class="card border-success">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr align="center">
                                <td>เลขที่ใบเสร็จ</td>
                                <td>ประเภทหุ้น</td>
                                <td>วันที่ทำรายการ </td>                              
                                <td>จำนวนหุ้น</td>
                                <td>จำนวนเงิน</td>
                                <td>เงินคงเหลือ </td>
                            </tr>
                        </thead>
                        <?php foreach ($detail->result() as $row) { ?>
                            <tr align="center">
                                <td><?= $row->SLIP_NO ?></td>
                                <td><?= $row->SHR_NA ?></td>
                                <td><?= thaidate('j M Y ', strtotime($row->TMP_DATE_TODAY)) ?></td>                             
                                <td><?= $row->TMP_SHARE_QTY; ?></td>
                                <td><?= number_format($row->TMP_SHARE_BHT, 2)  ?></td>
                                <td><?= number_format($row->SHR_SUM_BTH , 2)  ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>