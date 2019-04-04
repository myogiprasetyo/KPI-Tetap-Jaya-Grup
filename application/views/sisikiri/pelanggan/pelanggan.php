<?php
    if (substr($this->session->userdata('KPIPelangganAkses'), 0, 2 != 0) || substr($this->session->userdata('KPIPelangganAkses'), 2, 2) != 0) {
?>
        <li class="treeview <?php if (substr($konten, -9) == 'Pelanggan' || (!empty($up_konten) && substr($up_konten, -9) == 'Pelanggan')) { echo 'active'; } ?>">
            <a href="#">
                <i class="fa fa-street-view"></i>
                
                <span>Pelanggan</span>
                
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>

            <ul class="treeview-menu">
<?php
                if (substr($this->session->userdata('KPIPelangganAkses'), 0, 2) != 0) {
?>
                    <li <?php if ($konten == 'Data Pelanggan' || (!empty($up_konten) && $up_konten == 'Data Pelanggan' )) { echo 'class="active"' ; } ?>>
                        <a href="<?php echo site_url(); ?>Pelanggan/DataPelanggan">
                            <i class="fa fa-circle-o"></i> Data Pelanggan
                        </a>
                    </li>
<?php
                }

                if (substr($this->session->userdata('KPIPelangganAkses'), 2, 2) != 0) {
?>
                    <li <?php if ($konten == 'Nilai / Pelanggan' || (!empty($up_konten) && $up_konten == 'Nilai / Pelanggan' )) { echo 'class="active"' ; } ?>>
                        <a href="<?php echo site_url(); ?>Pelanggan/NilaiPelanggan">
                            <i class="fa fa-circle-o"></i> Nilai / Pelanggan
                        </a>
                    </li>
<?php
                }

                if (substr($this->session->userdata('KPIPelangganAkses'), 2, 2) != 0) {
?>
                    <li <?php if ($konten == 'Target / Pelanggan' || (!empty($up_konten) && $up_konten == 'Target / Pelanggan' )) { echo 'class="active"' ; } ?>>
                        <a href="<?php echo site_url(); ?>Pelanggan/TargetPelanggan">
                            <i class="fa fa-circle-o"></i> Target / Pelanggan
                        </a>
                    </li>
<?php
                }

                if (substr($this->session->userdata('KPIPelangganAkses'), 2, 2) != 0) {
?>
                    <li <?php if ($konten == 'Piutang / Pelanggan' || (!empty($up_konten) && $up_konten == 'Piutang / Pelanggan' )) { echo 'class="active"' ; } ?>>
                        <a href="<?php echo site_url(); ?>Pelanggan/PiutangPelanggan">
                            <i class="fa fa-circle-o"></i> Piutang / Pelanggan
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