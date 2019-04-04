<?php
    if (empty($up_konten)) {
?>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-file"></span> Data <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">            
<?php
        if ($konten != 'Nilai / Pemasok') {
?>
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
                <form role="form" method="post" action="<?php echo site_url().'Pemasok/'.str_replace(' ', '', $konten); ?>">
                    <div class="box-body menubar_filter_1">
<?php
                        if ($konten == 'Persediaan Akhir / Pemasok') {
?>                      
                            <div class="form-group">
                                <label class="col-sm-12 control-label">Tanggal Akhir</label>

                                <div class="col-sm-9">
                                    <input type="text" class="tanggal form-control" name="tanggal_akhir" value="<?php echo $tanggal_akhir; ?>">
                                </div>
                            </div>
<?php
                        }
?>                      
                        <div class="form-group">
                            <label class="<?php if ($konten == 'Persediaan Akhir / Pemasok') { echo 'menubar_menu'; } ?> col-sm-12 control-label">Status Pemasok</label>

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