<section class="content">
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="animated fadeInUp nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#laba_kotor" data-toggle="tab">Laba Kotor</a></li>
                </ul>
                
                <form id="form" role="form" class="form-horizontal" method="post">
                    <div class="tab-content">
                        <div class="tab-pane active" id="laba_kotor">
                            <div class="box-body">
<?php
                                if ($konten != 'Tambah') {
?>
                                    <input name="no" value="<?php echo $no; ?>" hidden>
<?php
                                }
?>                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tanggal</label>

                                    <div id="tanggal" class="col-sm-3">
                                        <input type="text" <?php if ($konten == 'Tambah') { echo 'class="tanggal form-control" name="tanggal"'; } else { echo 'class="form-control" readonly'; } ?> value="<?php echo $tanggal ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Pelanggan</label>

                                    <div id="pelanggan_select" class="col-sm-7">
<?php
                                        if ($konten == 'Tambah') {
?>
                                            <select id="pelanggan" class="form-control select2" name="pelanggan">
                                                <option></option>
<?php
                                                foreach ($pelanggan as $data) {
?>
                                                    <option value="<?php echo $data->NoPelanggan; ?>">
<?php
                                                        echo $data->NoPelanggan.' - '.$data->NamaPelanggan;
?>
                                                    </option>
<?php
                                                }
?>
                                            </select>
<?php
                                        } else {
?>
                                            <input type="text" class="form-control" name="pelanggan" value="<?php echo $pelanggan; ?>" readonly>
<?php
                                        }
?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Penjual</label>

                                    <div id="penjual_select" class="col-sm-7">
                                        <select id="penjual" class="form-control select2" name="penjual">
                                            <option></option>
<?php
                                            foreach ($penjual as $data) {
?>
                                                <option <?php if ($konten != 'Tambah') { if ($data->NoPenjual == $no_penjual) { echo 'selected'; } } ?> value="<?php echo $data->NoPenjual; ?>">
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
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Laba Kotor</label>

                                    <div id="laba_kotor_form" class="col-sm-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp</span>
                                            
                                            <input id="laba_kotor" type="text" class="rupiah form-control" <?php if ($konten != 'Tambah') { echo 'value="'.number_format($laba_kotor, 2, ',', '.').'"'; } ?> name="laba_kotor">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="box-footer">
                        <button id="validasi" type="button" class="btn btn-<?php if ($konten == 'Tambah') { echo 'primary'; } else { echo 'success'; } ?>">
                            <span class="fa fa-<?php if ($konten == 'Tambah') { echo 'plus'; } else { echo 'edit'; } ?>"></span>
<?php
                                if ($konten == 'Tambah') {
                                    echo 'Tambah';
                                } else {
                                    echo 'Ubah';
                                }
?>
                        </button>
<?php
                        if ($konten != 'Tambah') {
?>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus">
                                <span class="fa fa-trash"></span> Hapus
                            </button>
<?php
                        }
?>                        
                        <a href="<?php echo site_url(); ?>Pelanggan/LabaKotorPenjualan" class="btn btn-default pull-right">
                            <span class="fa fa-mail-forward"></span> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
<?php
        require_once 'application/views/keterangan/index.php';
?>
    </div>
</section>