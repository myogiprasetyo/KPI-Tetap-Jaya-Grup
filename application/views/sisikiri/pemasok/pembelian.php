<?php
    if (substr($this->session->userdata('KPIPemasokAkses'), 5, 2 != 0) || substr($this->session->userdata('KPIPemasokAkses'), 7, 2) != 0 || substr($this->session->userdata('KPIPemasokAkses'), 9, 2) != 0) {
?>
        <li class="treeview <?php if (substr($konten, -9) == 'Pembelian' || (!empty($up_konten) && substr($up_konten, -9) == 'Pembelian')) { echo 'active'; } ?>">
            <a href="#">
                <i class="fa fa-cart-plus"></i>
                
                <span>Pembelian</span>
                
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>

            <ul class="treeview-menu">
<?php
                if (substr($this->session->userdata('KPIPemasokAkses'), 5, 2) != 0) {
?>
                    <li <?php if ($konten == 'Pesanan Pembelian' || (!empty($up_konten) && $up_konten == 'Pesanan Pembelian' )) { echo 'class="active"' ; } ?>>
                        <a href="<?php echo site_url(); ?>Pemasok/PesananPembelian">
                            <i class="fa fa-circle-o"></i> Pesanan Pembelian
                        </a>
                    </li>
<?php
                }

                if (substr($this->session->userdata('KPIPemasokAkses'), 7, 2) != 0) {
?>
                    <li <?php if ($konten == 'Faktur Pembelian' || (!empty($up_konten) && $up_konten == 'Faktur Pembelian' )) { echo 'class="active"' ; } ?>>
                        <a href="<?php echo site_url(); ?>Pemasok/FakturPembelian">
                            <i class="fa fa-circle-o"></i> Faktur Pembelian
                        </a>
                    </li>
<?php
                }

                if (substr($this->session->userdata('KPIPemasokAkses'), 9, 2) != 0) {
?>
                    <li <?php if ($konten == 'Pembayaran Pembelian' || (!empty($up_konten) && $up_konten == 'Pembayaran Pembelian' )) { echo 'class="active"' ; } ?>>
                        <a href="<?php echo site_url(); ?>Pemasok/PembayaranPembelian">
                            <i class="fa fa-circle-o"></i> Pembayaran Pembelian
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