<li class="treeview <?php if (substr($konten, -5) == 'Sales' || (!empty($up_konten) && substr($up_konten, -5) == 'Sales')) { echo 'active'; } ?>">
    <a href="#">
        <i class="fa fa-users"></i>
        
        <span>Sales</span>
        
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>

    <ul class="treeview-menu">
        <li <?php if ($konten == 'Data Sales' || (!empty($up_konten) && $up_konten == 'Data Sales' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Sales/DataSales">
                <i class="fa fa-circle-o"></i> Data Sales
            </a>
        </li>

        <li <?php if ($konten == 'Nilai / Sales' || (!empty($up_konten) && $up_konten == 'Nilai / Sales' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Sales/NilaiSales">
                <i class="fa fa-circle-o"></i> Nilai / Sales
            </a>
        </li>
        
        <li <?php if ($konten == 'Pencapaian / Sales' || (!empty($up_konten) && $up_konten == 'Pencapaian / Sales' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Sales/PencapaianSales">
                <i class="fa fa-circle-o"></i> Pencapaian / Sales
            </a>
        </li>
        
        <li <?php if ($konten == 'UPL / Sales' || (!empty($up_konten) && $up_konten == 'UPL / Sales' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Sales/PelangganBaruSales">
                <i class="fa fa-circle-o"></i> UPL / Sales
            </a>
        </li>
        
        <li <?php if ($konten == 'Pelanggan Efektif / Sales' || (!empty($up_konten) && $up_konten == 'Pelanggan Efektif / Sales' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Sales/PelangganEfektifSales">
                <i class="fa fa-circle-o"></i> Pelanggan Efektif / Sales
            </a>
        </li>
        
        <li <?php if ($konten == 'Pelanggan A & B / Sales' || (!empty($up_konten) && $up_konten == 'Pelanggan A & B / Sales' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Sales/PelanggaABSales">
                <i class="fa fa-circle-o"></i> Pelanggan A & B / Sales
            </a>
        </li>
        
        <li <?php if ($konten == 'Pelanggan Baru / Sales' || (!empty($up_konten) && $up_konten == 'Pelanggan Baru / Sales' )) { echo 'class="active"' ; } ?>>
            <a href="<?php echo site_url(); ?>Sales/PelangganBaruSales">
                <i class="fa fa-circle-o"></i> Pelanggan Baru / Sales
            </a>
        </li>
    </ul>
</li>