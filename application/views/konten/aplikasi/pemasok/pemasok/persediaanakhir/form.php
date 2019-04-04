<section class="content">
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="animated fadeInUp nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#persediaan_akhir" data-toggle="tab">Persediaan Akhir</a></li>
                </ul>
                
                <form id="form" role="form" class="form-horizontal" method="post">
                    <div class="tab-content">
                        <div class="tab-pane active" id="persediaan_akhir">
                            <div class="box-body">
<?php
                                if ($konten == 'Tambah') { ?>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tanggal</label>

                                        <div id="tanggal" class="col-sm-3">
                                            <input type="text" class="tanggal form-control" name="tanggal" value="<?php echo $tanggal; ?>">
                                        </div>
                                    </div>
<?php
                                }
?>
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
                                                        <option value="<?php echo $data->NoPemasok?>">
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
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Persediaan Akhir</label>

                                    <div id="persediaan_akhir_form" class="col-sm-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp</span>
                                            
                                            <input id="persediaan_akhir" type="text" class="rupiah form-control" name="persediaan_akhir" <?php if ($konten != 'Tambah') { echo 'value="'.number_format($persediaan_akhir, 2, ',', '.').'" readonly'; } ?>>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="box-footer">
<?php
                        if ($konten == 'Tambah') {
?>
                            <button id="validasi" type="button" class="btn btn-primary">
                                <span class="fa fa-plus"></span> Tambah
                            </button>
<?php
                        } else {
?>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus">
                                <span class="fa fa-trash"></span> Hapus
                            </button>
<?php
                        }
?>                        
                        <a href="<?php echo site_url(); ?>Pemasok/PersediaanAkhirPemasok" class="btn btn-default pull-right">
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