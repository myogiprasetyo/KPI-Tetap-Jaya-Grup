<?php
    require_once 'application/views/breadcrumb.php';

    if ($konten == 'Pesanan Pembelian' || $up_konten == 'Pesanan Pembelian') {
        require_once 'pesanan/index.php';
    } else if ($konten == 'Faktur Pembelian' || $up_konten == 'Faktur Pembelian') {
        require_once 'faktur/index.php';
    } else if ($konten == 'Pembayaran Pembelian' || $up_konten == 'Pembayaran Pembelian') {
        require_once 'pembayaran/index.php';
    }
?>