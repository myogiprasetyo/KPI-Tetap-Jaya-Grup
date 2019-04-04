<?php
    if (substr($this->session->userdata('KPIPemasokAkses'), 5, 2 != 0) || substr($this->session->userdata('KPIPemasokAkses'), 7, 2) != 0 || substr($this->session->userdata('KPIPemasokAkses'), 9, 2) != 0) {
?>
        <li class="treeview <?php if (substr($konten, -9) == 'Penjualan' || (!empty($up_konten) && substr($up_konten, -9) == 'Penjualan')) { echo 'active'; } ?>">
            <a href="#">
                <i class="fa fa-cart-arrow-down"></i>
                
                <span>Penjualan</span>
                
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>

            <ul class="treeview-menu">
<?php
                if (substr($this->session->userdata('KPIPemasokAkses'), 5, 2) != 0) {
?>
                    <li <?php if ($konten == 'Profit / Penjualan' || (!empty($up_konten) && $up_konten == 'Profit / Penjualan' )) { echo 'class="active"' ; } ?>>
                        <a href="<?php echo site_url(); ?>Pemasok/ProfitPenjualan">
                            <i class="fa fa-circle-o"></i> Profit / Penjualan
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