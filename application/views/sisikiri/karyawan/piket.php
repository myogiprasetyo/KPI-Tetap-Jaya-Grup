<?php
    if (substr($this->session->userdata('KPIPelangganAkses'), 0, 2 != 0) || substr($this->session->userdata('KPIPelangganAkses'), 2, 2) != 0) {
?>
        <li class="treeview <?php if (substr($konten, -9) == 'Piket' || (!empty($up_konten) && substr($up_konten, -9) == 'Piket')) { echo 'active'; } ?>">
            <a href="#">
                <i class="fa fa-street-view"></i>
                
                <span>Piket</span>
                
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>

            <ul class="treeview-menu">
<?php
                if (substr($this->session->userdata('KPIPiketAkses'), 0, 2) != 0) {
?>
                    <li <?php if ($konten == 'Piket' || (!empty($up_konten) && $up_konten == 'Data Piket' )) { echo 'class="active"' ; } ?>>
                        <a href="<?php echo site_url(); ?>Piket/DataPiket">
                            <i class="fa fa-circle-o"></i> Data Piket
                        </a>
                    </li>
<?php
                }

                if (substr($this->session->userdata('KPIPiketAkses'), 2, 2) != 0) {
?>
                    <li <?php if ($konten == 'Nilai / Piket' || (!empty($up_konten) && $up_konten == 'Nilai / Piket' )) { echo 'class="active"' ; } ?>>
                        <a href="<?php echo site_url(); ?>Piket/NilaiPiket">
                            <i class="fa fa-circle-o"></i> Nilai / Piket
                        </a>
                    </li>
<?php
                }

                if (substr($this->session->userdata('KPIPiketAkses'), 2, 2) != 0) {
?>
                    <li <?php if ($konten == 'Target / Piket' || (!empty($up_konten) && $up_konten == 'Target / Piket' )) { echo 'class="active"' ; } ?>>
                        <a href="<?php echo site_url(); ?>Piket/TargetPiket">
                            <i class="fa fa-circle-o"></i> Target / Piket
                        </a>
                    </li>
<?php
                }

                if (substr($this->session->userdata('KPIPiketAkses'), 2, 2) != 0) {
?>
                    <li <?php if ($konten == 'Piutang / Piket' || (!empty($up_konten) && $up_konten == 'Piutang / Piket' )) { echo 'class="active"' ; } ?>>
                        <a href="<?php echo site_url(); ?>Piket/PiutangPiket">
                            <i class="fa fa-circle-o"></i> Piutang / Piket
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