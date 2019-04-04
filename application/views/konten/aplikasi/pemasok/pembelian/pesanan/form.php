<section class="content">
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="animated fadeInUp nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#pesanan" data-toggle="tab">Pesanan</a></li>
                    
                    <li><a href="#lain_lain" data-toggle="tab">Lain - Lain</a></li>
                </ul>
                
                <form id="form" role="form" class="form-horizontal" method="post">
                    <div class="tab-content">
                        <div class="tab-pane active" id="pesanan">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">No. PO</label>

                                    <div id="no_po_disabled" class="col-sm-4">
                                        <input id="no_po" type="text" class="form-control" name="no_po" placeholder="No. PO" <?php if ($konten != 'Tambah') { echo 'value="'.$no_po.'" readonly'; } else { echo 'autofocus'; } ?> maxlength="15">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tanggal</label>

                                    <div id="tanggal" class="col-sm-3">
                                        <input type="text" <?php if ($konten == 'Tambah') { echo 'class="tanggal form-control" name="tanggal"'; } else { echo 'class="tanggal form-control" readonly'; } ?> value="<?php echo $tanggal ?>">
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
                                                    <option value="<?php echo $data->NoPemasok; ?>">
<?php
                                                        echo $data->NoPemasok.' - '.$data->NamaPemasok;
?>
                                                    </option>
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
                                            <label class="col-sm-3 control-label">Jumlah</label>

                                            <div id="jumlah" class="col-sm-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Rp</span>
                                                    
                                                    <input type="text" class="rupiah form-control" name="jumlah">
                                                </div>
                                            </div>
                                        </div>
<?php
                                    } else {
?>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Pesanan Diterima</label>

                                            <div id="diterima" class="col-sm-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Rp</span>
                                                
                                                    <input type="text" class="rupiah form-control" name="diterima" value="<?php echo number_format($diterima, 2, ',', '.'); ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Pesanan Diproses</label>

                                            <div id="diproses" class="col-sm-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Rp</span>
                                                    
                                                    <input type="text" class="rupiah form-control" name="diproses" value="<?php echo number_format($diproses, 2, ',', '.'); ?>">
                                                </div>
                                            </div>
                                        </div>
<?php
                                    }
?>
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
<?php
                                if ($konten != 'Tambah' && $status != 'Diterima Penuh') {
?>
                                    <div class="form-group">
                                        <label class="form_status col-sm-3 control-label">Status</label>

                                        <div class="col-sm-7">
                                            <input type="checkbox" name="status" class="flat-red" value="Ditutup" <?php if ($status == 'Ditutup') { echo 'checked'; } ?>> Tutup
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
                        <a href="<?php echo site_url(); ?>Pemasok/PesananPembelian" class="btn btn-default pull-right">
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