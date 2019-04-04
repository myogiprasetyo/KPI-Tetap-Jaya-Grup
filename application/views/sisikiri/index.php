<?php
    foreach ($aplikasi as $data) {
?>
        <aside class="main-sidebar">
            <section class="sidebar">
                <form action="<?php echo site_url().str_replace('KPI', '', $data->NamaAplikasi); ?>" method="post" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="cari_menu" class="form-control" placeholder="Cari Halaman">
                        <span class="input-group-btn">
                            <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>

                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header text-center">MENU <?php echo strtoupper($data->NamaAplikasi); ?></li>
<?php
                    if ($data->NamaAplikasi == 'KPI Pemasok') {
                        require_once 'pemasok/index.php';
                    } else if ($data->NamaAplikasi == 'KPI Pelanggan') {
                        require_once 'pelanggan/index.php';
                    } else if ($data->NamaAplikasi == 'KPI Karyawan') {
                        require_once 'karyawan/index.php';
                    } else if ($data->NamaAplikasi == 'KPI Tim') {
                        require_once 'tim/index.php';
                    } else if ($data->NamaAplikasi == 'Pengaturan') {
                        require_once 'pengaturan/index.php';
                    }
?>
                </ul>
            </section>
        </aside>
<?php
    }
?>