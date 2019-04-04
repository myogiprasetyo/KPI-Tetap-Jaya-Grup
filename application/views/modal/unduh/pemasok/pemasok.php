<?php
    if ($konten == 'Persediaan Akhir / Pemasok') {
?>
        <div class="form-group">
            <label class="col-sm-6 control-label">Tanggal Akhir</label>

            <div class="col-sm-3">
                <input type="text" class="tanggal form-control" name="tanggal_akhir" value="<?php echo $tanggal_akhir; ?>">
            </div>
        </div>
<?php
    }
?>
<div id="unduh" class="form-group">
    <label class="form_status col-sm-6 control-label">Status Pemasok</label>

    <div class="col-sm-3">
        <input type="checkbox" class="flat-red" name="status" value="Tidak Aktif" <?php if ($filter == true) { echo 'checked' ; } ?>> Tidak Aktif
    </div>
</div>