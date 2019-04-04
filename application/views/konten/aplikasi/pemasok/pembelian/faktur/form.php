<section class="content">
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="animated fadeInUp nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#faktur" data-toggle="tab">Faktur</a></li>
                    
                    <li><a href="#lain_lain" data-toggle="tab">Lain - Lain</a></li>
                </ul>
                
                <form id="form" role="form" class="form-horizontal" method="post">
                    <div class="tab-content">
                        <div class="tab-pane active" id="faktur">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">No. Faktur</label>

                                    <div id="no_faktur_disabled" class="col-sm-4">
                                        <input id="no_faktur" type="text" class="form-control" placeholder="No. Faktur" name="no_faktur" <?php if ($konten != 'Tambah' && $konten != 'Dorong') { echo 'value="'.$no_faktur.'" readonly'; } else { echo 'autofocus'; } ?> maxlength="15">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tanggal</label>

                                    <div id="tanggal" class="col-sm-3">
                                        <input type="text" <?php if ($konten == 'Tambah' || $konten == 'Dorong') { echo 'class="tanggal form-control" name="tanggal"'; } else { echo 'class="form-control" readonly'; } ?> value="<?php echo $tanggal ?>">
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
                                            <input id="pemasok_disabled" type="text" class="form-control" name="pemasok" value="<?php echo $pemasok; ?>" readonly>
<?php
                                        }
?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">No. PO</label>

                                    <div id="no_po_disabled" class="col-sm-4">
<?php
                                        if ($konten == 'Tambah') {
?>
                                            <select id="po" class="form-control select2" name="no_po">
                                                <option></option>
                                                
                                                <option value="Saldo Awal">Saldo Awal</option>
                                                
                                                <option value="Tidak ada No. PO">Tidak ada No. PO</option>
                                            </select>
<?php
                                        } else {
                                            if ($no_po == null) {
?>
                                                <input type="text" id="po" class="form-control" name="no_po" value="Tidak ada No. PO" readonly>
<?php
                                            } else {
?>
                                                <input type="text" id="po" class="form-control" name="no_po" value="<?php echo $no_po; ?>" readonly>
<?php
                                            }
                                        }
?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Nilai Faktur</label>

                                    <div id="nilai_faktur" class="col-sm-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp</span>
                                            
                                            <input type="text" class="rupiah form-control" name="nilai_faktur" <?php if ($konten != 'Tambah' && $konten != 'Dorong') { echo 'value="'.number_format($nilai_faktur, 2, ',', '.').'"'; } ?>>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="lain_lain">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Keterangan</label>

                                    <div class="col-sm-7">
                                        <textarea class="form-control" rows="5" placeholder="Keterangan" maxlength="100" name="keterangan">
<?php
                                            if ($konten != 'Tambah' && $konten != 'Dorong') {
                                                echo $keterangan;
                                            }
?>
                                        </textarea> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="box-footer">
                        <button id="validasi" type="button" class="btn btn-<?php if ($konten == 'Tambah' || $konten == 'Dorong') { echo 'primary'; } else { echo 'success'; } ?>">
                            <span class="fa fa-<?php if ($konten == 'Tambah' || $konten == 'Dorong') { echo 'plus'; } else { echo 'edit'; } ?>"></span>
<?php
                                if ($konten == 'Tambah' || $konten == 'Dorong') {
                                    echo 'Tambah';
                                } else {
                                    echo 'Ubah';
                                }
                            ?>
                        </button>                      
<?php
                        if ($konten != 'Tambah' && $konten != 'Dorong') {
?>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus">
                                <span class="fa fa-trash"></span> Hapus
                            </button>
<?php
                        }
?>                        
                        <a href="<?php echo site_url(); ?>Pemasok/<?php if ($konten == 'Dorong') { echo 'PesananPembelian'; } else { echo 'FakturPembelian'; } ?>" class="btn btn-default pull-right">
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