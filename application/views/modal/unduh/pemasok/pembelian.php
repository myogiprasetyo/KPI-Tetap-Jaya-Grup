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
    if ($konten == 'Pesanan Pembelian') {
?>
        <div class="form-group">
            <label class="form_status col-sm-3 control-label">Status Pesanan</label>

            <div id="status" class="col-sm-4">
                <input type="checkbox" class="flat-red" name="sedang_diproses" value="1" <?php if ($status == 1 || $status == 3 || $status == 5 || $status == 7) { echo 'checked'; }?>> Sedang Diproses
            </div>
            
            <div id="status" class="col-sm-3">
                <input type="checkbox" class="flat-red" name="diterima_penuh" value="2" <?php if ($status == 2 || $status == 3 || $status == 6 || $status == 7) { echo 'checked'; }?>> Diterima Penuh
            </div>
            
            <div id="status" class="col-sm-2">
                <input type="checkbox" class="flat-red" name="ditutup" value="4" <?php if ($status == 4 || $status == 5 || $status == 6 || $status == 7) { echo 'checked'; }?>> Ditutup
            </div>
        </div>
<?php
    } else if ($konten == 'Faktur Pembelian') {
?>
        <div class="form-group">
            <label class="form_status col-sm-3 control-label">Status Faktur</label>

            <div id="status" class="col-sm-12">
                <input type="checkbox" class="flat-red" name="belum_lunas" value="1" <?php if ($status == 1 || $status == 3 || $status == 5 || $status == 7) { echo 'checked'; }?>> Belum Lunas
            </div>

            <div id="status" class="col-sm-12">
                <input type="checkbox" class="flat-red" name="pembayaran" value="2" <?php if ($status == 2 || $status == 3 || $status == 6 || $status == 7) { echo 'checked'; }?>> Pembayaran
            </div>

            <div id="status" class="col-sm-12">
                <input type="checkbox" class="flat-red" name="lunas" value="4" <?php if ($status == 4 || $status == 5 || $status == 6 || $status == 7) { echo 'checked'; }?>> Lunas
            </div>
        </div>
<?php
    } else if ($konten == 'Pembayaran Pembelian') {
?>
        <div class="form-group">
            <label class="form_status col-sm-3 control-label">Status Faktur</label>

            <div id="status" class="col-sm-12">
                <input type="checkbox" class="flat-red" name="buka_giro" value="1" <?php if ($status == 1 || $status == 3) { echo 'checked'; }?>> Buka Giro
            </div>

            <div id="status" class="col-sm-12">
                <input type="checkbox" class="flat-red" name="dicairkan" value="2" <?php if ($status == 2 || $status == 3) { echo 'checked'; }?>> Dicairkan
            </div>
        </div>
<?php
     }
?>
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