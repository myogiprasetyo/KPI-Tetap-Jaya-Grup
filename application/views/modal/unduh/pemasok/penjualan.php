<div class="form-group">
    <label class="col-sm-3 control-label">Tanggal</label>

    <div class="col-sm-3">
        <input type="text" class="tanggal form-control" id="tanggal_1" name="tanggal_awal" value="<?php echo $tanggal_awal; ?>">
    </div>

    <label class="col-sm-1 control-label">s/d</label>

    <div class="col-sm-3">
        <input type="text" class="tanggal form-control" id="tanggal_2" name="tanggal_akhir" value="<?php echo $tanggal_akhir; ?>">
    </div>
</div>

<div id="unduh" class="form-group">
    <label class="col-sm-3 control-label">Pemasok</label>

    <div class="col-sm-7">
        <select id="pemasok_unduh" class="form-control select2" name="pemasok">
            <option></option>

            <option value="Semua" <?php if ($pemasok_select == 'Semua' ) { echo 'selected' ; } ?>>Semua Pemasok</option>
<?php
            foreach ($pemasok as $data) {
?>
                <option value="<?php echo $data->NoPemasok; ?>" <?php if ($pemasok_select == $data->NamaPemasok) { echo 'selected'; } ?>>
<?php
                    echo $data->NoPemasok.' - '.$data->NamaPemasok;
?>
                </option>
<?php
            }
?>
        </select>
    </div>
</div>