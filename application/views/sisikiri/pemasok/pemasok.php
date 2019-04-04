<?php
    if (substr($this->session->userdata('KPIPemasokAkses'), 0, 2 != 0) || substr($this->session->userdata('KPIPemasokAkses'), 2, 2) != 0) {
?>
        <li class="treeview <?php if (substr($konten, -7) == 'Pemasok' || (!empty($up_konten) && substr($up_konten, -7) == 'Pemasok')) { echo 'active'; } ?>">
            <a href="#">
                <i class="fa fa-user-secret"></i>
                
                <span>Pemasok</span>
                
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>

            <ul class="treeview-menu">
<?php
                if (substr($this->session->userdata('KPIPemasokAkses'), 0, 2) != 0) {
?>
                    <li <?php if ($konten == 'Data Pemasok' || (!empty($up_konten) && $up_konten == 'Data Pemasok' )) { echo 'class="active"' ; } ?>>
                        <a href="<?php echo site_url(); ?>Pemasok/DataPemasok">
                            <i class="fa fa-circle-o"></i> Data Pemasok
                        </a>
                    </li>
<?php
                }

                if (substr($this->session->userdata('KPIPemasokAkses'), 0, 2) != 0) {
?>
                    <li <?php if ($konten == 'Nilai / Pemasok' || (!empty($up_konten) && $up_konten == 'Nilai / Pemasok' )) { echo 'class="active"' ; } ?>>
                        <a href="<?php echo site_url(); ?>Pemasok/NilaiPemasok">
                            <i class="fa fa-circle-o"></i> Nilai / Pemasok
                        </a>
                    </li>
<?php
                }
                                                                                                                                           
                if (substr($this->session->userdata('KPIPemasokAkses'), 0, 2) != 0) {
?>
                    <li <?php if ($konten == 'Persediaan Akhir / Pemasok' || (!empty($up_konten) && $up_konten == 'Persediaan Akhir / Pemasok' )) { echo 'class="active"' ; } ?>>
                        <a href="<?php echo site_url(); ?>Pemasok/PersediaanAkhirPemasok">
                            <i class="fa fa-circle-o"></i> Persediaan Akhir / Pemasok
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