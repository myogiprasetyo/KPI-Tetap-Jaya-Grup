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

<div class="form-group">
    <label class="col-sm-3 control-label">Pelanggan</label>

    <div class="col-sm-7">
        <select id="pelanggan_unduh" class="form-control select2" name="pelanggan">
            <option></option>

            <option value="Semua" <?php if ($pelanggan_select=='Semua' ) { echo 'selected' ; } ?>>Semua Pelanggan</option>
<?php
            foreach ($pelanggan as $data) {
?>
                <option value="<?php echo $data->NoPelanggan; ?>" <?php if ($penjual_select == $data->NamaPelanggan) { echo 'selected'; } ?>>
<?php
                    echo $data->NoPelanggan.' - '.$data->NamaPelanggan;
?>
                </option>
<?php
            }
?>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Penjual</label>

    <div class="col-sm-7">
        <select id="penjual_unduh" class="form-control select2" name="penjual">
            <option></option>

            <option value="Semua" <?php if ($penjual_select=='Semua' ) { echo 'selected' ; } ?>>Semua Penjual</option>
<?php
            foreach ($penjual as $data) {
?>
                <option value="<?php echo $data->NoPenjual; ?>" <?php if ($penjual_select == $data->NamaPenjual) { echo 'selected'; } ?>>
<?php
                    echo $data->NoPenjual.' - '.$data->NamaPenjual;
?>
                </option>
<?php
            }
?>
        </select>
    </div>
</div>