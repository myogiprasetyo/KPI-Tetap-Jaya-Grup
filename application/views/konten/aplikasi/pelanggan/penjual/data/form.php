<section class="content">
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="animated fadeInUp nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#penjual" data-toggle="tab">Penjual</a></li>
                    
                    <li><a href="#lain_lain" data-toggle="tab">Lain - Lain</a></li>
                </ul>
                
                <form id="form" role="form" class="form-horizontal" method="post">
                    <div class="tab-content">
                        <div class="tab-pane active" id="penjual">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">No. Penjual</label>

                                    <div id="no_penjual" class="col-sm-3">
                                        <input type="text" class="form-control" placeholder="No. Penjual" maxlength="3" <?php if ($konten != 'Tambah') { echo 'value="'.$no_penjual.'"'; } ?> name="no_penjual" <?php if ($konten != 'Tambah') { echo 'readonly'; } else { echo 'autofocus'; } ?>>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Nama Penjual</label>

                                    <div id="nama_penjual" class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="Nama Penjual" maxlength="50" <?php if ($konten != 'Tambah') { echo 'value="'.$nama_penjual.'" autofocus'; } ?> name="nama_penjual">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="lain_lain">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Keterangan</label>

                                    <div class="col-sm-7">
                                        <textarea class="form-control" rows="5" placeholder="Keterangan" maxlength="500" name="keterangan">
<?php
                                            if ($konten != 'Tambah') {
                                                echo $keterangan;
                                            }
?>
                                        </textarea>
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
                        <a href="<?php echo site_url(); ?>Pelanggan/DataPenjual" class="btn btn-default pull-right">
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