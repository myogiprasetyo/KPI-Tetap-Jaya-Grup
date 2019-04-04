<li class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>
        <span class="label label-default">
<?php
            echo $notifikasi_total;
?>
        </span>
    </a>

<?php
    if ($notifikasi_total > 0) {
?>
        <ul class="dropdown-menu">
            <li class="header">
<?php
                echo 'Anda memiliki '.$notifikasi_total.' notifikasi';
?>
            </li>

            <li>
                <ul class="menu">
<?php
                    foreach ($aplikasi as $data) {
                        if ($data->NamaAplikasi == 'KPI Pemasok') {
                            require_once 'pemasok.php';
                        } else if ($data->NamaAplikasi == 'KPI Pelanggan') {
                            require_once 'pelanggan.php';
                        } else if ($data->NamaAplikasi == 'KPI Karyawan') {
                            require_once 'karyawan.php';
                        } else if ($data->NamaAplikasi == 'KPI Team') {
                            require_once 'tim.php';
                        } else if ($data->NamaAplikasi == 'Pengaturan') {
                            require_once 'pengaturan.php';
                        }
                    }
?>
                </ul>
            </li>

            <li class="footer"><a href="#">Lihat Semua</a></li>
        </ul>
<?php
    }
?>
</li>