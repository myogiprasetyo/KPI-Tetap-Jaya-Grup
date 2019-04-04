<?php
    if (substr($this->session->userdata('KPIPelangganAkses'), 5, 2 != 0) || substr($this->session->userdata('KPIPelangganAkses'), 7, 2) != 0 || substr($this->session->userdata('KPIPelangganAkses'), 9, 2) != 0) {
?>
        <li class="treeview <?php if (substr($konten, -9) == 'Penjualan' || (!empty($up_konten) && substr($up_konten, -9) == 'Penjualan')) { echo 'active'; } ?>">
            <a href="#">
                <i class="fa fa-shopping-cart"></i>
                
                <span>Penjualan</span>
                
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>

            <ul class="treeview-menu">
<?php
                if (substr($this->session->userdata('KPIPelangganAkses'), 0, 2) != 0) {
?>
                    <li <?php if ($konten == 'Faktur Penjualan' || (!empty($up_konten) && $up_konten == 'Faktur Penjualan' )) { echo 'class="active"' ; } ?>>
                        <a href="<?php echo site_url(); ?>Pelanggan/FakturPenjualan">
                            <i class="fa fa-circle-o"></i> Faktur Penjualan
                        </a>
                    </li>
<?php
                }

                if (substr($this->session->userdata('KPIPelangganAkses'), 7, 2) != 0) {
?>
                    <li <?php if ($konten == 'Retur Penjualan' || (!empty($up_konten) && $up_konten == 'Retur Penjualan' )) { echo 'class="active"' ; } ?>>
                        <a href="<?php echo site_url(); ?>Pelanggan/ReturPenjualan">
                            <i class="fa fa-circle-o"></i> Retur Penjualan
                        </a>
                    </li>
<?php
                }

                if (substr($this->session->userdata('KPIPelangganAkses'), 9, 2) != 0) {
?>
                    <li <?php if ($konten == 'Laba Kotor Penjualan' || (!empty($up_konten) && $up_konten == 'Laba Kotor Penjualan' )) { echo 'class="active"' ; } ?>>
                        <a href="<?php echo site_url(); ?>Pelanggan/LabaKotorPenjualan">
                            <i class="fa fa-circle-o"></i> Laba Kotor Penjualan
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