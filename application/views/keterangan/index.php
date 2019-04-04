<div class="animated fadeInRight col-md-4 col-sm-12">
    <div class="callout callout-info">
        <h4><span class="fa fa-info-circle"></span> Petunjuk dan Bantuan</h4>

        <ol>
<?php
            if ($konten == 'Tambah') {
?>
                <li>
                    Isi <b><?php echo $up_konten; ?></b> selengkap dan sebenar mungkin.
                </li>
                
                <li>
                    Gunakan <i>button</i>
                    
                    <button class="btn btn-xs btn-primary"><span class="fa fa-plus"></span> Tambah</button>
                    untuk menambahkan <b><?php echo $up_konten; ?></b>.
                </li>
<?php
            } else {
                foreach ($aplikasi as $data) {
                    if ($data->NamaAplikasi == 'KPI Pemasok') {
                        require_once 'pemasok.php';
                    } else if ($data->NamaAplikasi == 'KPI Pelanggan') {
                        require_once 'pelanggan.php';
                    } else if ($data->NamaAplikasi == 'KPI Karyawan') {
                        require_once 'karyawan.php';
                    } else if ($data->NamaAplikasi == 'KPI Team') {
                        require_once 'team.php';
                    } else if ($data->NamaAplikasi == 'Pengaturan') {
                        require_once 'pengaturan.php';
                    }
                }
            }
?>
        </ol>
                
        <p>
            Untuk <b>Keterangan</b> dan <b>Informasi</b> lebih lanjut silahkan hubungi <b>Bagian IT (Information & Technology)</b>
        </p>
    </div>
</div>