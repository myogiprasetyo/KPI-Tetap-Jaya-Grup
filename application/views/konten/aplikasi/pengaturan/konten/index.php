<div class="content-wrapper">

    <?php
            require_once 'kepala.php';
            
            if (empty($up_konten)) {
                if ($konten == 'Profil Saya') {
                    require_once 'isikonten/profilsaya.php';
                } else if ($konten == 'Karyawan') {
                    require_once 'isikonten/daftar/karyawan/tabel.php';
                } else if ($konten == 'Pengguna Aplikasi') {
                    require_once 'isikonten/daftar/penggunaaplikasi.php';
                } else if ($konten == 'Pengaturan Aplikasi') {
                    require_once 'isikonten/preferensi/pengaturanaplikasi/tabel.php';
                } else if ($konten == 'Info Perusahaan') {
                    require_once 'isikonten/preferensi/infoperusahaan.php';
                } else if ($konten == 'Tentang') {
                    require_once 'isikonten/tentang.php';
                }
            } else {
                if ($up_konten == 'Karyawan') {
                    require_once 'isikonten/daftar/karyawan/form.php';
                } else if ($up_konten == 'Pengaturan Aplikasi') {
                    require_once 'isikonten/pembelian/fakturpembelian/form.php';
                }
                
                if ($konten != 'Tambah') {    
                    require_once 'application/views/pemasok/modal/hapus/index.php';
                }
            }
    ?>
    
</div>