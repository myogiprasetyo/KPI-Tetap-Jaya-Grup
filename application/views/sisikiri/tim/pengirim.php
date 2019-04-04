<li class="treeview <?php if (substr($konten, -8) == 'Pengirim' || (!empty($up_konten) && substr($up_konten, -8) == 'Pengirim')) { echo 'active'; } ?>">
    <a href="#">
        <i class="fa fa-ambulance"></i>
        
        <span>Pengirim</span>
        
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>

    <ul class="treeview-menu">
        <li <?php if ($konten == 'Data Pengirim' || (!empty($up_konten) && $up_konten == 'Data Pengirim' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Distribusi/DataDistribusi">
                <i class="fa fa-circle-o"></i> Data Pengirim
            </a>
        </li>

        <li <?php if ($konten == 'Nilai / Pengirim' || (!empty($up_konten) && $up_konten == 'Nilai / Distribusi' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Distribusi/NilaiDistribusi">
                <i class="fa fa-circle-o"></i> Nilai / Pengirim
            </a>
        </li>
    </ul>
</li>