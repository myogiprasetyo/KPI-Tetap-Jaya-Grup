<?php
    if (!empty($pesan)) {
?>
        <div id="pesan" class="col-xs-12">
            <div class="animated fadeInUp alert alert-<?php if (substr($pesan, 0, 6) == 'Sukses') { echo 'success'; } else { echo 'danger'; } ?> alert-dismissible">
<?php
                switch ($pesan) {
                    case 'Sukses Tambah' :
                        require_once 'suksestambah.php';
                        break;
                    case 'Sukses Ubah' :
                        require_once 'suksesubah.php';
                        break;
                    case 'Sukses Hapus' :
                        require_once 'sukseshapus.php';
                        break;
                    case 'Sukses Unggah' :
                        require_once 'suksesunggah.php';
                        break;
                    case 'Sukses Unduh' :
                        require_once 'suksesunduh.php';
                        break;
                    case 'Gagal Hapus' :
                        require_once 'gagalhapus.php';
                        break;
                    case 'Gagal Unggah' :
                        require_once 'gagalunggah.php';
                        break;
                    
                }
?>
            </div>
        </div>
<?php
    }
?>