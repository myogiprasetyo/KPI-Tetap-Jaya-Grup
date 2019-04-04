<?php
    if (empty($up_konten)) {
        require_once 'tabel.php';        
        require_once 'application/views/modal/unggah/index.php';
        require_once 'application/views/modal/unduh/index.php';
    } else {
        require_once 'form.php';
                
        if ($konten != 'Tambah') {    
            require_once 'application/views/modal/hapus/index.php';
        }
    }
?>