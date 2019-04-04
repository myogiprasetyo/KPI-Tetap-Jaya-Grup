<?php
    if ($konten == 'Dasbor') {
        require_once 'dasbor/index.php';
    } else if (substr($konten, -4) == 'Toko' || substr($up_konten, -4) == 'Toko') {
        require_once 'toko/index.php';
    } else if (substr($konten, -6) == 'Kanvas' || substr($up_konten, -6) == 'Kanvas') {
        require_once 'kanvas/index.php';
    } else if (substr($konten, -5) == 'Sales' || substr($up_konten, -5) == 'Sales') {
        require_once 'sales/index.php';
    } else if (substr($konten, -8) == 'Pengirim' || substr($up_konten, -8) == 'Pengirim') {
        require_once 'pengirim/index.php';
    }
?>