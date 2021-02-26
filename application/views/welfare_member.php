<?php
include_once("application/libraries/thaidate-functions.php");
include_once("application/libraries/Thaidate.php");
?>
<div class="col-lg-9">
    <div class="col-12" id="main">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">สวัสดิการสมาชิก</h1>
        </div>
        <div class="col">
            <div class="card border-success">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr align="center">
                                <td>เลขสมาชิก</td>
                                <td>สาขา</td>
                                <td>วันครบกำหนดต่อตะกาฟุล</td>
                            </tr>
                        </thead>
                        <?php foreach ($result->result() as $row) { ?>
                            <tr align="center">
                                <td><?= $row->MEM_ID ?></td>
                                <td><?= $row->BR_NAME ?></td>
                                <td><?php echo thaidate('j M Y', strtotime($row->EXCHG_DATE))  ?> </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
