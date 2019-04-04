<body class="hold-transition skin-blue fixed layout-top-nav">
    <div class="wrapper">
        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
<?php
                        require_once 'application/views/logo.php';
?>
                    </div>

                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse"></div>
<?php
                    require_once 'application/views/miniprofil.php';
?>
                </div>
            </nav>
        </header>

        <div id="menu_utama" class="content-wrapper">
            <div class="container">
                <section class="content-header text-center">
                    <font id="judul_menu">MENU UTAMA</font>
                </section>

                <section class="content">
<?php
                    foreach ($menu_utama as $data) {
?>
                        <a href="<?php if ($data->Versi != 0.0) { echo site_url().str_replace('KPI ', '', $data->NamaAplikasi); } ?>">
                            <div class="<?php if ($data->Id == 5) { echo 'col-lg-12'; } else { echo 'col-lg-6'; } ?> col-xs-12">
                                <div id="menu_utama_<?php echo $data->Id; ?>" class="animated <?php echo $data->NamaClass; ?> small-box bg-<?php echo $data->WarnaSkin; ?>">
                                    <div class="icon"><i class="fa <?php echo $data->Logo; ?>"></i></div>

                                    <div class="inner">
                                        <font id="menu_kepala"><b><?php echo $data->NamaAplikasi; ?></b></font> <font id="versi_aplikasi">Versi Aplikasi <b><?php if ($data->Versi == 0.0) { echo 'Belum Rilis'; } else { echo $data->Versi; } ?></b></font>

                                        <?php echo $data->Deskripsi; ?>
                                    </div>
                                </div>
                            </div>
                        </a>
<?php
                        }
?>                    
                </section>
            </div>
        </div>