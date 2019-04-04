<li class="treeview <?php if (substr($konten, -6) == 'Kanvas' || (!empty($up_konten) && substr($up_konten, -6) == 'Kanvas')) { echo 'active'; } ?>">
    <a href="#">
        <i class="fa fa-institution"></i>
        
        <span>Kanvas</span>
        
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>

    <ul class="treeview-menu">
        <li <?php if ($konten == 'Nilai Kanvas' || (!empty($up_konten) && $up_konten == 'Nilai Kanvas' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Kanvas/NilaiKanvas">
                <i class="fa fa-circle-o"></i> Nilai Kanvas
            </a>
        </li>
        
        <li <?php if ($konten == 'Kehadiran Kanvas' || (!empty($up_konten) && $up_konten == 'Kehadiran Kanvas' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Kanvas/KehadiranKanvas">
                <i class="fa fa-circle-o"></i> Kehadiran Kanvas
            </a>
        </li>
        
        <li <?php if ($konten == 'Pencapaian Kanvas' || (!empty($up_konten) && $up_konten == 'Pencapaian Kanvas' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Kanvas/PencapaianKanvas">
                <i class="fa fa-circle-o"></i> Pencapaian Kanvas
            </a>
        </li>
        
        <li <?php if ($konten == 'Stok Rata - Rata Kanvas' || (!empty($up_konten) && $up_konten == 'Stok Rata - Rata Kanvas' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Kanvas/Stok Rata - RataKanvas">
                <i class="fa fa-circle-o"></i> Stok Rata - Rata Kanvas
            </a>
        </li>
        
        <li <?php if ($konten == 'Kesesuaian Stok Kanvas' || (!empty($up_konten) && $up_konten == 'Kesesuaian Stok Kanvas' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Kanvas/KesesuaianStokKanvas">
                <i class="fa fa-circle-o"></i> Kesesuaian Stok Kanvas
            </a>
        </li>
        
        <li <?php if ($konten == 'Pelanggan A & B Kanvas' || (!empty($up_konten) && $up_konten == 'Pelanggan A & B Kanvas' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Kanvas/PelangganABKanvas">
                <i class="fa fa-circle-o"></i> Pelanggan A & B Kanvas
            </a>
        </li>
    </ul>
</li>