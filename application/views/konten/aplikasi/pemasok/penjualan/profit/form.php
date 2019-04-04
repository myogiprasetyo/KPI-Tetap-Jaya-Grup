<section class="content">
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="animated fadeInUp nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#profit_penjualan" data-toggle="tab">Profit / Penjualan</a></li>
                </ul>
                <form id="form" role="form" class="form-horizontal" method="post">
                    <div class="tab-content">
                        <div class="tab-pane active" id="profit_penjualan">
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
                                        <input type="text" <?php if ($konten == 'Tambah') { echo 'class="tanggal form-control"'; } else { echo 'class="tanggal form-control" readonly'; } ?> value="<?php echo $tanggal ?>" name="tanggal">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Pemasok</label>

                                    <div id="pemasok_select" class="col-sm-7">
<?php
                                        if ($konten == 'Tambah') {
?>
                                            <select id="pemasok" class="form-control select2" name="pemasok">
                                                <option></option>
<?php
                                                foreach ($pemasok as $data) {
?>
                                                    <option value="<?php echo $data->NoPemasok?>"><?php echo $data->NoPemasok.' - '.$data->NamaPemasok; ?></option>
<?php
                                                }
?>
                                            </select>
<?php
                                        } else {
?>
                                            <input type="text" class="form-control" name="pemasok" value="<?php echo $pemasok; ?>" readonly>
<?php
                                        }
?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Penjualan</label>

                                    <div id="penjualan_form" class="col-sm-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp</span>
                                            
                                            <input id="penjualan" type="text" class="rupiah form-control" <?php if ($konten != 'Tambah') { echo 'value="'.number_format($penjualan, 2, ',', '.').'"'; } ?> name="penjualan">
                                        </div>
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
                        <a href="<?php echo site_url(); ?>Pemasok/ProfitPenjualan" class="btn btn-default pull-right">
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