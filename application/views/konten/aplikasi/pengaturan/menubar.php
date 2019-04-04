<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
    <?php if ($konten != 'Profil Saya') { ?>
        <ul class="nav navbar-nav">
        <?php if ($konten != 'Nilai / Pemasok' && empty($up_konten)) { ?>
            <li><a href="<?php echo site_url().'Pemasok/Tambah_'.str_replace(' ', '', $konten); ?>"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a></li>
            <li><a type="button" data-toggle="modal" data-target="#unggah-data"><span class="glyphicon glyphicon-upload" ></span> Unggah Data</a></li>
        <?php } else if (!empty($up_konten) && substr($up_konten, -9) == 'Pembelian' && $konten != 'Tambah' && $konten != 'Dorong') { ?>
            <?php if ($up_konten == 'Pesanan Pembelian') { ?>
                <li><a href="<?php echo site_url().'Pemasok/Dorong_PesananPembelian?NoPO='.$no_po.'&Pemasok='.$pemasok; ?>"><span class="glyphicon glyphicon-play-circle"></span> Buat ke Faktur Pembelian</a></li>
            <?php } ?>
        <?php } ?>
        
        <?php if (empty($up_konten)) { ?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-filter"></span> Filter <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <form role="form" method="post" action="<?php echo site_url().'Pengaturan/'.str_replace(' ', '', $konten); ?>">
                        <div class="box-body menubar_tanggal">
                            <?php if (substr($konten, -7) != 'Pemasok') { ?>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label>Tanggal</label>
                                    </div>
                                        
                                    <?php if ($konten == 'Persediaan Akhir') { ?>
                                        <div class="col-sm-12">
                                            <input type="text" class="tanggal form-control" id="datepicker1" name="tanggal_akhir" value="<?php echo $tanggal_akhir; ?>">
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-sm-5">
                                            <input type="text" class="tanggal form-control" id="datepicker1" name="tanggal_awal" value="<?php echo $tanggal_awal; ?>">
                                        </div>
                                        <div class="col-sm-2">
                                            <label id="menubar_tanggal_rentang">s/d</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="text" class="tanggal form-control" id="datepicker2" name="tanggal_akhir" value="<?php echo $tanggal_akhir; ?>">
                                        </div>
                                    <?php } ?>
                                    
                                    <br><br><br>
                                </div>
                            <?php } ?>
                            
                            <?php if (substr($konten, -7) == 'Pemasok') { ?>
                                <div class="col-sm-12 form-group">
                                    <label>Status</label><br>
                                    <input type="checkbox" class="flat-red" name="status" value="Tidak Aktif" <?php if ($filter == true) { echo 'checked'; } ?>> Tidak Aktif
                                </div>
                            <?php } else if ($konten == 'Pesanan Pembelian') { ?>
                                <div class="col-sm-12 form-group">
                                    <label>Status</label><br>
                                    <input type="checkbox" class="flat-red" name="sedang_diproses" value="1" <?php if ($status == 1 || $status == 3 || $status == 5) { echo 'checked'; }?>> Sedang Diproses
                                    <br><input type="checkbox" class="flat-red" name="diterima_penuh"  value="2" <?php if ($status == 2 || $status == 3 || $status == 6) { echo 'checked'; }?>> Diterima Penuh
                                    <br><input type="checkbox" class="flat-red" name="ditutup" value="4" <?php if ($status == 5 || $status == 5 || $status == 6) { echo 'checked'; }?>> Ditutup
                                </div>
                            <?php } else if ($konten == 'Faktur Pembelian') { ?>
                                <div class="col-sm-12 form-group">
                                    <label>Status</label><br>
                                    <input type="checkbox" class="flat-red" name="belum_lunas" value="1" <?php if ($status == 1 || $status == 3 || $status == 5) { echo 'checked'; }?>> Belum Lunas
                                    <br><input type="checkbox" class="flat-red" name="pembayaran"  value="2" <?php if ($status == 2 || $status == 3 || $status == 6) { echo 'checked'; }?>> Pembayaran
                                    <br><input type="checkbox" class="flat-red" name="lunas"  value="4" <?php if ($status == 5 || $status == 6) { echo 'checked'; }?>> Lunas
                                </div>
                            <?php } else if ($konten == 'Pembayaran Pembelian') { ?>
                                <div class="col-sm-12 form-group">
                                    <label>Status</label><br>
                                    <input type="checkbox" class="flat-red" name="buka_giro" value="1" <?php if ($status == 1 || $status == 3) { echo 'checked'; }?>> Buka Giro
                                    <br><input type="checkbox" class="flat-red" name="dicairkan"  value="2" <?php if ($status == 2 || $status == 3) { echo 'checked'; }?>> Dicairkan
                                </div>    
                            <?php } else if ($konten == 'Persediaan Akhir' || $konten == 'Penjualan') { ?>
                                <div class="col-sm-12 form-group">
                                    <label>Pemasok</label><br>
                                    <select id="pemasok" class="form-control select2" name="pemasok">
                                        <?php foreach ($pemasok as $data) { ?>
                                            <option></option>
                                            <option value="<?php echo $data->NoPemasok ?>"><?php echo $data->NoPemasok.' - '.$data->NamaPemasok; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="box-footer text-center">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Muat Ulang</button>
                        </div>

                    </form>
                </ul>
            </li>
        <?php } ?>
    </ul>
    <?php } ?>
</div>