<body class="hold-transition skin-<?php foreach ($aplikasi as $data) { echo $data->WarnaSkin; } ?> fixed sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
<?php
            require_once 'application/views/logo.php';
?>
            <nav class="navbar navbar-static-top">
                <div class="navbar-header">
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
<?php
                    if ($konten != 'Dasbor') {
?>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
<?php
                    }
?>
                </div>
<?php
                if ($konten != 'Dasbor') {
                    require_once 'application/views/menubar/index.php';
                }
                
                require_once 'application/views/miniprofil.php';
?>
            </nav>
        </header>
<?php
        require_once 'application/views/sisikiri/index.php';
?>
        <div class="content-wrapper">
<?php
            foreach ($aplikasi as $data) {
                if ($data->NamaAplikasi == 'KPI Pemasok') {
                    require_once 'pemasok/index.php';
                } else if ($data->NamaAplikasi == 'KPI Pelanggan') {
                    require_once 'pelanggan/index.php';
                } else if ($data->NamaAplikasi == 'KPI Karyawan') {
                    require_once 'karyawan/index.php';
                } else if ($data->NamaAplikasi == 'KPI Team') {
                    require_once 'team/index.php';
                } else if ($data->NamaAplikasi == 'Pengaturan') {
                    require_once 'pengaturan/index.php';
                }
            }
?>
        </div>