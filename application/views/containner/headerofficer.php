<nav class="navbar navbar-expand-sm navbar-light bg-success">
    <h5>เจ้าหน้าที่ระดับ <?php echo $LEVEL_CODE ?></h5>
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item">
            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">ออกจากระบบ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            คุณต้องการที่จะออกจากระบบหรือไม่
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                            <a href="<?php echo site_url('officer/logout_officer') ?>" class="btn btn-primary">ออกจากระบบ</a>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li class="nav-item dropdown">
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $USER_NAME ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo site_url('officer/data_officer') ?>">ดูข้อมูล</a>
                    <a class="dropdown-item" href="#">Change Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" data-toggle="modal" data-target="#staticBackdrop">ออกจากระบบ</a>
                </div>
            </div>
        </li>
    </ul>
</nav>