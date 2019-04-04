<?php if (!empty($pesan)) { ?>
    <div id="pesan" class="col-xs-12">
        <div class="alert alert-<?php if ($pesan == 'Foreign Hapus') { echo 'danger'; } else { echo 'success'; } ?> alert-dismissible">
            <?php if ($pesan == 'Sukses Tambah') { ?>
                <h4><i class="icon fa fa-check"></i> Tambah Data</h4><b>
            <?php } else if ($pesan == 'Sukses Ubah') { ?>
                <h4><i class="icon fa fa-check"></i> Ubah Data</h4><b>
            <?php } else if ($pesan == 'Sukses Hapus') { ?>
                <h4><i class="icon fa fa-check"></i> Hapus Data</h4><b>
            <?php } else if ($pesan == 'Foreign Hapus') { ?>
                <h4><i class="icon fa fa-ban"></i> Gagal Hapus</h4><b>
            <?php } ?>
            
            <?php if ($pesan == 'Foreign Hapus') { ?>
                Data <?php echo $konten; ?></b> tidak dapat dihapus karena sudah digunakan dalam Transaksi lain.
            <?php } else { ?>
                Data <?php echo $konten; ?></b> berhasil diperbarui.
            <?php } ?>
        </div>
    </div>
<?php } ?>