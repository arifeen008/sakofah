<div class="content">
    <div class="containner">
        <div class="card border-success">
            <table class="table table-striped">
                <thead>
                    <tr align="center">
                        <td>เลขสาขา</td>
                        <td>ชื่อสาขา</td>                
                    </tr>
                </thead>
                <?php foreach ($result->result() as $row) { ?>
                    <tr align="center">
                        <td><?= $row->BR_NO ?></td>
                        <td><?= $row->BR_NAME ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>