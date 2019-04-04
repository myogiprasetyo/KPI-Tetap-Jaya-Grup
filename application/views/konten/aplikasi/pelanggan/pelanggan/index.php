<?php
    require_once 'application/views/breadcrumb.php';

    if ($konten == 'Data Pelanggan' || $up_konten == 'Data Pelanggan') {
        require_once 'data/index.php';
    } else if ($konten == 'Nilai / Pelanggan' || $up_konten == 'Nilai / Pelanggan') {
        require_once 'nilai/index.php';
    } else if ($konten == 'Piutang / Pelanggan' || $up_konten == 'Piutang / Pelanggan') {
        require_once 'piutang/index.php';
    } else if ($konten == 'Target / Pelanggan' || $up_konten == 'Target / Pelanggan') {
        require_once 'target/index.php';
    }
?>