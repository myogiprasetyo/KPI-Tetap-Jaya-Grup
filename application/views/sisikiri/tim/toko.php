<li class="treeview <?php if (substr($konten, -4) == 'Toko' || (!empty($up_konten) && substr($up_konten, -4) == 'Toko')) { echo 'active'; } ?>">
    <a href="#">
        <i class="fa fa-home"></i>
        
        <span>Toko</span>
        
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>

    <ul class="treeview-menu">
        <li <?php if ($konten == 'Data Toko' || (!empty($up_konten) && $up_konten == 'Data Toko' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Toko/DataToko">
                <i class="fa fa-circle-o"></i> Data Toko
            </a>
        </li>

        <li <?php if ($konten == 'Nilai / Toko' || (!empty($up_konten) && $up_konten == 'Nilai / Toko' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Toko/NilaiToko">
                <i class="fa fa-circle-o"></i> Nilai / Toko
            </a>
        </li>
        
        <li <?php if ($konten == 'Kehadiran / Toko' || (!empty($up_konten) && $up_konten == 'Kehadiran / Toko' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Toko/KehadiranToko">
                <i class="fa fa-circle-o"></i> Kehadiran / Toko
            </a>
        </li>
        
        <li <?php if ($konten == 'Pencapaian / Toko' || (!empty($up_konten) && $up_konten == 'Pencapaian / Toko' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Toko/PencapaianToko">
                <i class="fa fa-circle-o"></i> Pencapaian / Toko
            </a>
        </li>
        
        <li <?php if ($konten == 'Stok Rata - Rata / Toko' || (!empty($up_konten) && $up_konten == 'Stok Rata - Rata / Toko' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Toko/StokRataRataToko">
                <i class="fa fa-circle-o"></i> Stok Rata - Rata / Toko
            </a>
        </li>
        
        <li <?php if ($konten == 'Pelanggan Efektif / Toko' || (!empty($up_konten) && $up_konten == 'Pelanggan Efektif / Toko' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Toko/PelangganEfektifToko">
                <i class="fa fa-circle-o"></i> Pelanggan Efektif / Toko
            </a>
        </li>
        
        <li <?php if ($konten == 'Pelanggan A & B / Toko' || (!empty($up_konten) && $up_konten == 'Pelanggan A & B / Toko' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Toko/PelangganA&BToko">
                <i class="fa fa-circle-o"></i> Pelanggan A & B / Toko
            </a>
        </li>
    </ul>
</li>