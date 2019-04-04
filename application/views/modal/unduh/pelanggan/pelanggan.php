<?php
    if ($konten == 'Target / Pelanggan' || $konten == 'Piutang / Pelanggan') {
        if ($konten == 'Target / Pelanggan') {
?>                    
            <div class="form-group">
                <label class="col-sm-3 control-label">Bulan</label>

                <div class="col-sm-4">
                    <input type="text" class="bulan form-control" name="bulan" value="<?php echo $bulan; ?>">
                </div>
            </div>
<?php
        } else if ($konten == 'Piutang / Pelanggan') {
?>
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
<?php
        }
?>
        <div class="form-group">
            <label class="col-sm-3 control-label">Penjual</label>

            <div class="col-sm-7">
                <select id="penjual_unduh" class="form-control select2" name="penjual">
                    <option></option>

                    <option value="Semua" <?php if ($penjual_select == 'Semua' ) { echo 'selected' ; } ?>>Semua Penjual</option>
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
<?php
    }
?>  
<div id="unduh" class="form-group">
    <label class="form_status <?php if ($konten == 'Target / Pelanggan' || $konten == 'Piutang / Pelanggan') { echo 'col-sm-3'; } else { echo 'col-sm-6'; } ?> control-label">Status Pelanggan</label>

    <div class="col-sm-3">
        <input type="checkbox" class="flat-red" name="status" value="Tidak Aktif" <?php if ($filter == true) { echo 'checked' ; } ?>> Tidak Aktif
    </div>
</div>