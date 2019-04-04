<section class="content">
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="animated fadeInUp nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#pembayaran" data-toggle="tab">Pembayaran</a></li>
                    
                    <li><a href="#cek" data-toggle="tab">Cek</a></li>
                    
                    <li><a href="#lain_lain" data-toggle="tab">Lain - Lain</a></li>
                </ul>
                
                <form id="form" role="form" class="form-horizontal" method="post">
                    <div class="tab-content">
                        <div class="tab-pane active" id="pembayaran">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">No. Pembayaran</label>

                                    <div id="no_pembayaran_disabled" class="col-sm-4">
                                        <input id="no_pembayaran" type="text" class="form-control" placeholder="No. Pembayaran" name="no_pembayaran" <?php if ($konten != 'Tambah') { echo 'value="'.$no_pembayaran.'" readonly'; } else { echo 'autofocus'; } ?> maxlength="15">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tanggal</label>

                                    <div id="tanggal" class="col-sm-3">
                                        <input type="text" <?php if ($konten == 'Tambah') { echo 'class="tanggal form-control" id="tanggal_1"'; } else { echo 'class="tanggal form-control" readonly'; } ?> value="<?php echo $tanggal ?>" name="tanggal">
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
                                                        <option value="<?php echo $data->NoPemasok; ?>"><?php echo $data->NoPemasok.' - '.$data->NamaPemasok; ?></option>
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
<?php
                                if ($konten == 'Tambah') {
?>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">No. Faktur</label>

                                        <div id="no_faktur_select" class="col-sm-7">
                                            <select id="faktur" class="form-control select2" multiple="multiple" data-placeholder="  Tambahkan No. Faktur" name="no_faktur[]">
                                            </select>
                                        </div>
                                    </div>
<?php
                                }
?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Total Nilai Faktur</label>

                                    <div id="total_faktur_form" class="col-sm-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp</span>
                                            
                                            <input id="total_faktur" type="text" class="rupiah form-control" name="total_faktur" <?php if ($konten != 'Tambah') { echo 'value="'.number_format($total_faktur, 2, ',', '.').'"'; } ?> readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="cek">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">No. Cek</label>

                                    <div id="no_cek" class="col-sm-4">
                                        <input type="text" class="form-control" name="no_cek" placeholder="No. Cek" <?php if ($konten != 'Tambah') { echo 'value="'.$no_cek.'"'; } ?> maxlength="9">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tanggal Cek</label>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="tanggal_2" value="<?php echo $tanggal_cek; ?>" name="tanggal_cek">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="lain_lain">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Keterangan</label>

                                    <div class="col-sm-7">
                                        <textarea class="form-control" rows="5" placeholder="Keterangan" maxlength="100" name="keterangan"><?php if ($konten != 'Tambah') { echo $keterangan; } ?></textarea> 
                                    </div>
                                </div>
                            </div>
<?php
                            if ($konten != 'Tambah') {
?>
                                <div class="form-group">
                                    <label class="form_status col-sm-3 control-label">Status</label>

                                    <div class="col-sm-7">
                                        <input type="radio" name="status" class="flat-red" value="Buka Giro" <?php if ($status == 'Buka Giro') { echo 'checked'; } ?>> Buka Giro
                                        &nbsp;&nbsp;
                                        <input type="radio" name="status" class="flat-red" value="Dicairkan" <?php if ($status == 'Dicairkan') { echo 'checked'; } ?>> Dicairkan
                                    </div>
                                </div>
<?php
                            }
?>
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
                        <a href="<?php echo site_url(); ?>Pemasok/PembayaranPembelian" class="btn btn-default pull-right">
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