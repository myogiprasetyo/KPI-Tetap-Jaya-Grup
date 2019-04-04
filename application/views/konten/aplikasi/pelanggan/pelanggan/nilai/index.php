<?php
    if (empty($up_konten)) {
        require_once 'tabel.php';
        require_once 'application/views/modal/unduh/index.php';
    } else {
        require_once 'grafik.php';
    }
?>