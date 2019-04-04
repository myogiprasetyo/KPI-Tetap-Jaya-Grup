<section class="content">
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="animated fadeInUp nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#pelanggan" data-toggle="tab">Pelanggan</a></li>
                    
                    <li><a href="#alamat" data-toggle="tab">Alamat</a></li>
                    
                    <li><a href="#lain_lain" data-toggle="tab">Lain - Lain</a></li>
                </ul>
                <form id="form" role="form" class="form-horizontal" method="post">
                    <div class="tab-content">
                        <div class="tab-pane active" id="pelanggan">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">No. Pelanggan</label>

                                    <div id="no_pelanggan" class="col-sm-3">
                                        <input type="text" class="form-control" placeholder="No. Pelanggan" maxlength="9" <?php if ($konten != 'Tambah') { echo 'value="'.$no_pelanggan.'" readonly'; } else { echo 'id="no_auto" autofocus'; } ?> name="no_pelanggan">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Nama Pelanggan</label>

                                    <div id="nama_pelanggan" class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="Nama Pelanggan" maxlength="50" <?php if ($konten != 'Tambah') { echo 'value="'.$nama_pelanggan.'" autofocus'; } ?> name="nama_pelanggan">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">No. Telepon</label>

                                    <div id="no_telepon" class="col-sm-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">+62</span>
                                            <input type="text" class="telepon form-control" <?php if ($konten != 'Tambah') { echo 'value="'.$no_telepon.'"'; } ?> name="no_telepon">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">E - Mail</label>

                                    <div id="email" class="col-sm-5">
                                        <input type="text" class="form-control" placeholder="E - Mail" maxlength="50" <?php if ($konten != 'Tambah') { echo 'value="'.$email.'"'; } ?> name="email">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="alamat">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Alamat</label>

                                    <div id="text_alamat" class="col-sm-7">
                                        <textarea class="form-control" rows="3" placeholder="Alamat" maxlength="100" name="alamat">
<?php
                                            if ($konten != 'Tambah') {
                                                echo $alamat;
                                            }
?>
                                        </textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Kabupaten / Kota</label>

                                    <div id="kabupaten_kota" class="col-sm-5">
                                        <input type="text" class="form-control" placeholder="Kabupaten / Kota" maxlength="20" <?php if ($konten != 'Tambah') { echo 'value="'.$kabupaten_kota.'"'; } ?> name="kabupaten_kota">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Provinsi</label>

                                    <div id="provinsi" class="col-sm-5">
                                        <input type="text" class="form-control" placeholder="Provinsi" maxlength="20" <?php if ($konten != 'Tambah') { echo 'value="'.$provinsi.'"'; } ?> name="provinsi">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Kode Pos</label>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" placeholder="Kode Pos" maxlength="5" <?php if ($konten != 'Tambah') { echo 'value="'.$kode_pos.'"'; } ?> name="kode_pos">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="lain_lain">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Rayon</label>

                                    <div id="rayon_select" class="col-sm-7">
                                        <select id="rayon" class="form-control select2" name="rayon">
                                            <option></option>
<?php
                                            foreach ($rayon as $data) {
?>
                                                <option <?php if ($konten != 'Tambah') { if ($data->KodeRayon == $no_rayon) { echo 'selected'; } } ?> value="<?php echo $data->KodeRayon; ?>">
<?php
                                                    echo $data->KodeRayon.' - '.$data->NamaRayon;
?>
                                                </option>
<?php
                                            }
?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Default Penjual</label>

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
                                    <label class="col-sm-3 control-label">Level Harga</label>

                                    <div class="col-sm-2">
                                        <select class="form-control" name="level_harga">
<?php
                                            for ($level = 1; $level <= 5; $level++) {
?>
                                                <option <?php if ($konten != 'Tambah') { if ($level == $level_harga) { echo 'selected'; } } ?> value="<?php echo $level; ?>">
<?php
                                                    echo $level;
?>
                                                </option>
<?php
                                            }
?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Keterangan</label>

                                    <div class="col-sm-7">
                                        <textarea class="form-control" rows="5" placeholder="Keterangan" maxlength="500" name="keterangan"><?php if ($konten != 'Tambah') { echo $keterangan; } ?></textarea>
                                    </div>
                                </div>
                                
<?php
                                if ($konten != 'Tambah') {
?>
                                    <div class="form-group">
                                        <label class="form_status col-sm-3 control-label">Status</label>

                                        <div class="col-sm-7">
                                            <input type="radio" name="status" class="flat-red" value="Aktif" <?php if ($status == 'Aktif') { echo 'checked'; } ?>> Aktif
                                            &nbsp;&nbsp;
                                            <input type="radio" name="status" class="flat-red" value="Tidak Aktif" <?php if ($status == 'Tidak Aktif') { echo 'checked'; } ?>> Tidak Aktif
                                        </div>
                                    </div>
<?php
                                }
?>
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
                        <a href="<?php echo site_url(); ?>Pelanggan/DataPelanggan" class="btn btn-default pull-right">
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