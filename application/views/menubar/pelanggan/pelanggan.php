<?php
    if (empty($up_konten)) {
?>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-file"></span> Data <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
<?php
                if ($konten != 'Nilai / Pelanggan') {
?>                    
                    <li>
                        <a href="<?php echo site_url().'Pelanggan/Tambah_'.str_replace(' ', '', $konten); ?>">
                            <span class="glyphicon glyphicon-plus"></span> Tambah Data
                        </a>
                    </li>
                    
                    <li class="divider"></li>
                    
                    <li>
                        <a href="#" data-toggle="modal" data-target="#modal-unggah">
                            <span class="glyphicon glyphicon-cloud-upload"></span> Unggah Data
                        </a>
                    </li>
<?php
                }
?>                  
                <li>
                    <a href="#" data-toggle="modal" data-target="#modal-unduh">
                        <span class="glyphicon glyphicon-cloud-download"></span> Unduh Data
                    </a>
                </li>
            </ul>
        </li>

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-filter"></span> Filter <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
                <form role="form" method="post" action="<?php echo site_url().'Pelanggan/'.str_replace(' ', '', $konten); ?>">
                    <div class="<?php if ($konten == 'Target / Pelanggan' || $konten == 'Piutang / Pelanggan') { echo 'box-body menubar_filter_2'; } else { echo 'box-body menubar_filter_1'; } ?>">

<?php
                        if ($konten == 'Target / Pelanggan' || $konten == 'Piutang / Pelanggan') {
                            if ($konten == 'Target / Pelanggan') {
?>                    
                                <div class="form-group">
                                    <label class="col-sm-12 control-label">Bulan</label>

                                    <div class="col-sm-7">
                                        <input type="text" class="bulan form-control" name="bulan" value="<?php echo $bulan; ?>">
                                    </div>
                                </div>
<?php
                            } else if ($konten == 'Piutang / Pelanggan') {
?>
                                <div class="form-group">
                                    <label class="col-sm-12 control-label">Tanggal</label>

                                    <div class="col-sm-5">
                                        <input type="text" class="tanggal form-control" id="tanggal_1" name="tanggal_awal" value="<?php echo $tanggal_awal; ?>">
                                    </div>

                                    <div class="col-sm-2">
                                        <label id="menubar_tanggal_rentang">s/d</label>
                                    </div>

                                    <div class="col-sm-5">
                                        <input type="text" class="tanggal form-control" id="tanggal_2" name="tanggal_akhir" value="<?php echo $tanggal_akhir; ?>">
                                    </div>
                                </div>
<?php
                            }
?>
                            <div class="form-group">
                                <label class="menubar_menu col-sm-12 control-label">Penjual</label>

                                <div class="col-sm-12">
                                    <select id="penjual" class="form-control select2" name="penjual">
                                        <option></option>

                                        <option value="Semua" <?php if ($penjual_select == 'Semua') { echo 'selected'; } ?>>Semua Penjual</option>

<?php
                                        foreach ($penjual as $data) {
?>
                                            <option value="<?php echo $data->NoPenjual; ?>" <?php if ($penjual_select == $data->NoPenjual) { echo 'selected'; } ?>>
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
<?php
                        }
?>                    
                        <div class="form-group">
                            <label class="<?php if ($konten == 'Target / Pelanggan' || $konten == 'Piutang / Pelanggan') { echo 'menubar_menu'; } ?> col-sm-12 control-label">Status Pelanggan</label>

                            <div class="col-sm-12">
                                <input type="checkbox" class="flat-red" name="status" value="Tidak Aktif" <?php if ($filter == true) { echo 'checked' ; } ?>> Tidak Aktif
                            </div>
                        </div>
                    </div>

                    <div class="box-footer text-center">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Muat Ulang</button>
                    </div>
                </form>
            </ul>
        </li>
<?php
    }
?>