<style>
    .sidebar {
        margin: 0;
        padding: 0;
        width: 200px;
        background-color: #f1f1f1;
        position: absolute;
        height: 100%;
        overflow: auto;
    }

    .dropdown-btn {
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        color: #4CAF50;
        display: block;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
        outline: none;
    }

    .dropdown-btn:hover {
        color: #f1f1f1;
    }

    .main {
        margin-left: 200px;
        font-size: 20px;
        padding: 0px 10px;
    }

    .active {
        background-color: green;
        color: white;
    }

    .dropdown-container {
        display: none;
        background-color: #f1f1f1;
    }

    .fa-caret-down {
        float: right;
        padding-right: 8px;
    }

    .sidebar a {
        display: block;
        color: black;
        padding: 16px;
        text-decoration: none;
    }

    .sidebar a.active {
        background-color: #4CAF50;
        color: white;
    }

    .sidebar a:hover:not(.active) {
        background-color: #4CAF50;
        color: white;
    }

    div.content {
        margin-left: 200px;
        padding: 1px 16px;
        height: 1000px;
    }

    @media screen and (max-width: 700px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
        }

        .sidebar a {
            float: left;
        }

        div.content {
            margin-left: 0;
        }
    }

    @media screen and (max-width: 400px) {
        .sidebar a {
            text-align: center;
            float: none;
        }
    }
</style>


<div class="sidebar">
    <a href="<?php echo site_url('officer/goto_data_officer') ?>">ประวัติเจ้าหน้าที่</a>
    <a href="#">ระบบข้อมูลร่วมและกำหนดผู้ใช้งาน</a>
    <a href="#">ระบบทะเบียนสมาชิกและหุ้น</a>
    <a href="<?php echo site_url('officer/depositsystem') ?>">ระบบเงินฝาก</a>
    <a href="<?php echo site_url('officer/creditsystem') ?>">ระบบงานสินเชื่อ</a>
    <a href="#">ระบบเงินฝาก ATM</a>
    <a href="#">ระบบบัญชี</a>
    <a href="#">ระบบประมวลผล</a>
    <a href="#">ระบบกองทุนตะกาฟุล</a>
</div>