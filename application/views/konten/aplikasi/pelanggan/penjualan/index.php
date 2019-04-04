<?php
    require_once 'application/views/breadcrumb.php';

    if ($konten == 'Faktur Penjualan' || $up_konten == 'Faktur Penjualan') {
        require_once 'faktur/index.php';
    } else if ($konten == 'Retur Penjualan'  || $up_konten ==  'Retur Penjualan') {
        require_once 'retur/index.php';
    } else if ($konten == 'Laba Kotor Penjualan'  || $up_konten == 'Laba Kotor Penjualan') {
        require_once 'labakotor/index.php';
    }
?>