<?php
    if (empty($up_konten)) {
?>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-file"></span> Data <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">            
                <li>
                    <a href="<?php echo site_url().'Pemasok/Tambah_'.str_replace(' ', '', $konten); ?>">
                        <span class="glyphicon glyphicon-plus"></span> Tambah Data
                    </a>
                </li>
                    
                <li class="divider"></li>
                 
                <li>
                    <a href="#" data-toggle="modal" data-target="#modal-unggah">
                        <span class="glyphicon glyphicon-cloud-upload"></span> Unggah Data
                    </a>
                </li>
                
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
                <form role="form" method="post" action="<?php echo site_url().'Pemasok/'.str_replace(' ', '', $konten); ?>">
                    <div class="box-body menubar_filter_2">
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

                        <div class="form-group">
                            <label class="menubar_menu col-sm-12 control-label">Pemasok</label>
                                
                            <div class="col-sm-12">
                                <select id="pemasok" class="form-control select2" name="pemasok">
                                    <option></option>
                                    
                                    <option value="Semua" <?php if ($pemasok_select == 'Semua') { echo 'selected'; } ?>>Semua Pemasok</option>
<?php
                                    foreach ($pemasok as $data) {
?>
                                        <option value="<?php echo $data->NoPemasok; ?>" <?php if ($pemasok_select == $data->NamaPemasok) { echo 'selected'; } ?>>
<?php
                                            echo $data->NoPemasok.' - '.$data->NamaPemasok;
?>
                                        </option>
<?php
                                    }
?>
                                </select>
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