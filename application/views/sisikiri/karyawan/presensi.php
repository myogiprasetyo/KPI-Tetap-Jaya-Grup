<li class="treeview <?php if (substr($konten, -8) == 'Presensi' || (!empty($up_konten) && substr($up_konten, -8) == 'Presensi')) { echo 'active'; } ?>">
    <a href="#">
        <i class="fa fa-institution"></i>
        
        <span>Presensi</span>
        
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>

    <ul class="treeview-menu">
       <li <?php if ($konten == 'Presensi Pagi' || (!empty($up_konten) && $up_konten == 'Presensi Pagi' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Presensi/PresensiPagi">
                <i class="fa fa-circle-o"></i> Presensi Pagi
            </a>
        </li>
        
        <li <?php if ($konten == 'Presensi Datang' || (!empty($up_konten) && $up_konten == 'Presensi Datang' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Presensi/PresensiDatang">
                <i class="fa fa-circle-o"></i> Presensi Datang
            </a>
        </li>
        
        <li <?php if ($konten == 'Presensi Pulang' || (!empty($up_konten) && $up_konten == 'Presensi Pulang' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Presensi/PresensiPulang">
                <i class="fa fa-circle-o"></i> Presensi Pulang
            </a>
        </li>
        
        <li <?php if ($konten == 'Presensi Kehadiran' || (!empty($up_konten) && $up_konten == 'Presensi Kehadiran' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Presensi/PresensiKehadiran">
                <i class="fa fa-circle-o"></i> Presensi Kehadiran
            </a>
        </li>
    </ul>
</li>