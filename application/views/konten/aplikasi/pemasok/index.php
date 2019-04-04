<?php
    if ($konten == 'Dasbor') {
        require_once 'dasbor/index.php';
    } else if (substr($konten, -7) == 'Pemasok' || substr($up_konten, -7) == 'Pemasok') {
        require_once 'pemasok/index.php';
    } else if (substr($konten, -9) == 'Pembelian' || substr($up_konten, -9) == 'Pembelian') {
        require_once 'pembelian/index.php';
    } else if (substr($konten, -9) == 'Penjualan' || substr($up_konten, -9) == 'Penjualan') {
        require_once 'penjualan/index.php';
    }

    if (empty($up_konten)) {
        require_once 'application/views/notifikasi/pengingat/index.php';
    }
?>