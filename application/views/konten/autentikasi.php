<body class="hold-transition login-page">
    <div class="login-box">
        <div class="animated tada login-logo">
            KPI

            <b>
<?php
                foreach ($perusahaan as $data) {
                    echo strtoupper($data->NamaPerusahaan);
                }
?>
            </b>
        </div>

        <div class="animated fadeInUp login-box-body">
            <p class="login-box-msg">
                Silahkan masukan NIK dan Password Anda
            </p>

            <form id="form" role="form" method="post">
                <div id="nik" class="form-group has-feedback">
                    <input id="login_nik" type="text" class="form-control" placeholder="NIK" name="nik">

                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div id="password" class="form-group has-feedback">
                    <input id="login_password" type="password" class="form-control" placeholder="Password" name="password">

                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <button id="autentikasi" type="button" class="btn btn-primary btn-block btn-flat">
                            <span class="glyphicon glyphicon-log-in"></span> Masuk
                        </button>
                    </div>
                </div>
            </form>
        </div>
