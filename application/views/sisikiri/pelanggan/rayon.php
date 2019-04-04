<?php
    if (substr($this->session->userdata('KPIPelangganAkses'), 0, 2 != 0) || substr($this->session->userdata('KPIPelangganAkses'), 2, 2) != 0) {
?>
        <li class="treeview <?php if (substr($konten, -5) == 'Rayon' || (!empty($up_konten) && substr($up_konten, -5) == 'Rayon')) { echo 'active'; } ?>">
            <a href="#">
                <i class="fa fa-map"></i>
                
                <span>Rayon</span>
                
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>

            <ul class="treeview-menu">
<?php
                if (substr($this->session->userdata('KPIPelangganAkses'), 0, 2) != 0) {
?>
                    <li <?php if ($konten == 'Data Rayon' || (!empty($up_konten) && $up_konten == 'Data Rayon' )) { echo 'class="active"' ; } ?>>
                        <a href="<?php echo site_url(); ?>Pelanggan/DataRayon">
                            <i class="fa fa-circle-o"></i> Data Rayon
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