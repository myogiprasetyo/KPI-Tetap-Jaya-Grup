<?php
    if ($konten == 'Autentikasi') {
        require_once 'autentikasi.php';
    } else if ($konten == 'Menu Utama') {
        require_once 'menuutama.php';
    } else {
        require_once 'aplikasi/index.php';
    }
?>