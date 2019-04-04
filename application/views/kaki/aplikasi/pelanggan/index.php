<?php
    if ($konten == 'Dasbor') {
        require_once 'dasbor.php';
    } else if (substr($konten, -9) == 'Pelanggan' || substr($up_konten, -9) == 'Pelanggan') {
        require_once 'pelanggan.php';
    } else if (substr($konten, -5) == 'Rayon' || substr($up_konten, -5) == 'Rayon') {
        require_once 'rayon.php';
    } else if (substr($konten, -7) == 'Penjual' || substr($up_konten, -7) == 'Penjual') {
        require_once 'penjual.php';
    } else if (substr($konten, -9) == 'Penjualan' || substr($up_konten, -9) == 'Penjualan') {
        require_once 'penjualan.php';
    }
?>