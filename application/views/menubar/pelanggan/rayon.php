<?php
    if (empty($up_konten)) {
?>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-file"></span> Data <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">            
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
                    <div class="box-body menubar_filter_1">
                        <div class="form-group">
                            <label class="col-sm-12 control-label">Status Rayon</label>

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