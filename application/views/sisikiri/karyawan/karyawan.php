<li class="treeview <?php if (substr($konten, -8) == 'Karyawan' || (!empty($up_konten) && substr($up_konten, -8) == 'Karyawan')) { echo 'active'; } ?>">
    <a href="#">
        <i class="fa fa-institution"></i>
        
        <span>Karyawan</span>
        
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>

    <ul class="treeview-menu">
        <li <?php if ($konten == 'Data Karyawan' || (!empty($up_konten) && $up_konten == 'Data Karyawan' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Karyawan/DataKaryawan">
                <i class="fa fa-circle-o"></i> Data Karyawan
            </a>
        </li>
        
        <li <?php if ($konten == 'Nilai / Karyawan' || (!empty($up_konten) && $up_konten == 'Nilai / Karyawan' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Karyawan/NilaiKaryawan">
                <i class="fa fa-circle-o"></i> Nilai / Karyawan
            </a>
        </li>
    </ul>
</li>