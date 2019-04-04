<?php
    require_once 'application/views/breadcrumb.php';

    if ($konten == 'Data Pemasok' || $up_konten == 'Data Pemasok') {
        require_once 'data/index.php';
    } else if ($konten == 'Nilai / Pemasok' || $up_konten == 'Nilai / Pemasok') {
        require_once 'nilai/index.php';
    } else if ($konten == 'Persediaan Akhir / Pemasok' || $up_konten == 'Persediaan Akhir / Pemasok') {
        require_once 'persediaanakhir/index.php';
    }
?>