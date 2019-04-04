<?php
    if (substr($this->session->userdata('KPIPelangganAkses'), 0, 2 != 0) || substr($this->session->userdata('KPIPelangganAkses'), 2, 2) != 0) {
?>
        <li class="treeview <?php if (substr($konten, -7) == 'Penjual' || (!empty($up_konten) && substr($up_konten, -7) == 'Penjual')) { echo 'active'; } ?>">
            <a href="#">
                <i class="fa fa-tags"></i>
                
                <span>Penjual</span>
                
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>

            <ul class="treeview-menu">
<?php
                if (substr($this->session->userdata('KPIPelangganAkses'), 0, 2) != 0) {
?>
                    <li <?php if ($konten == 'Data Penjual' || (!empty($up_konten) && $up_konten == 'Data Penjual' )) { echo 'class="active"' ; } ?>>
                        <a href="<?php echo site_url(); ?>Pelanggan/DataPenjual">
                            <i class="fa fa-circle-o"></i> Data Penjual
                        </a>
                    </li>
<?php
                }
?>
            </ul>
        </li>
<?php
    }
?>