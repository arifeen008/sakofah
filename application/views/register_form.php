<style>
    @import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);


    body {
        margin: 0;
        font-size: 2rem;
        font-weight: 400;
        line-height: 1.6;
        color: #000000;
        text-align: left;
        background-color: #28a745;
    }

    .navbar-laravel {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0);
    }

    .navbar-brand,
    .nav-link,
    .my-form,
    .login-form {
        font-family: Raleway, sans-serif;
    }

    .my-form {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
    }

    .my-form .row {
        margin-left: 0;
        margin-right: 0;
    }

    .login-form {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
    }

    .login-form .row {
        margin-left: 0;
        margin-right: 0;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
        <img src="<?php echo base_url('picture/sakofag-logo.png'); ?>" style="width: 4%;">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    สมัครสมาชิกผู้ใช้ระบบ
                </ul>
            </div>
        </div>
    </nav>

    <main class="my-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Register</div>
                        <div class="card-body">
                            <form name="my-form" onsubmit="return validform()" action="<?php echo site_url('login/register_form') ?>" method="post">
                                <div class="form-group row">
                                    <label for="full_name" class="col-md-4 col-form-label text-md-right">Username :</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="USERNAME" id="username" placeholder="กรุณาใส่ Username...">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">Password :</label>
                                    <div class="col-md-6">
                                        <input type="password" class="form-control" name="PASSWORD" id="password" placeholder="กรุณาใส่ Password...">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="user_name" class="col-md-4 col-form-label text-md-right">Firstname :</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="FIRSTNAME" id="firstname" placeholder="กรุณาใส่ชื่อ...">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone_number" class="col-md-4 col-form-label text-md-right">Lastname :</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="LASTNAME" id="lastname" placeholder="กรุณาใส่นามสกุล...">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="present_address" class="col-md-4 col-form-label text-md-right">E-mail :</label>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" name="EMAIL" id="email" aria-describedby="emailHelp" placeholder="กรุณาใส่ email...">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="present_address" class="col-md-4 col-form-label text-md-right">Phone :</label>
                                    <div class="col-md-6">
                                        <input type="tel" class="form-control" name="PHONE" id="phone" placeholder="กรุณาใส่เบอร์โทรศัพท์...">
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                    <a href="<?php echo site_url('login/index') ?>" class="btn btn-success">Back</a>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </main>
</body>

<script>
    function validform() {

        var a = document.forms["my-form"]["username"].value;
        var b = document.forms["my-form"]["password"].value;
        var c = document.forms["my-form"]["firstname"].value;
        var d = document.forms["my-form"]["lastname"].value;
        var e = document.forms["my-form"]["email"].value;

        if (a === null || a === "") {
            alert("กรุณาใส่ Username");
            return false;
        } else if (b === null || b === "" || b === "1234") {
            alert("กรุณาใส่ Password");
            return false;
        } else if (c === null || c === "") {
            alert("กรุณาใส่ชื่อ");
            return false;
        } else if (d === null || d === "") {
            alert("กรุณาใส่นามสกุล");
            return false;
        } else if (e === null || e === "") {
            alert("กรุณาใส่ Email");
            return false;
        }

    }
</script>