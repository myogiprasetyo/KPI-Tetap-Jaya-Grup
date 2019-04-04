<?php
    switch ($up_konten) {
        case 'Faktur Penjualan' :
            $parameter = 'no_faktur='.$no_faktur;
            break;
        case 'Retur Penjualan' :
            $parameter = 'no_retur='.$no_retur;
            break;
        case 'Laba Kotor Penjualan' :
            $parameter = 'no='.$no;
            break;
    }
?>        
<a id="validasi_hapus" href="<?php echo site_url().'Pelanggan/Hapus_'.str_replace(' ', '', $up_konten).'_Proses?'.$parameter; ?>" class="btn btn-danger">
     <span class="fa fa-check"></span> Ya
</a>