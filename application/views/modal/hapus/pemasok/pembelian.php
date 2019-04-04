<?php
    switch ($up_konten) {
        case 'Pesanan Pembelian' :
            $parameter = 'no_po='.$no_po;
            break;
        case 'Faktur Pembelian' :
            $parameter = 'no_faktur='.$no_faktur;
            break;
        case 'Pembayaran Pembelian' :
            $parameter = 'no_pembayaran='.$no_pembayaran;
            break;
    }
?>        
<a id="validasi_hapus" href="<?php echo site_url().'Pemasok/Hapus_'.str_replace(' ', '', $up_konten).'_Proses?'.$parameter; ?>" class="btn btn-danger">
     <span class="fa fa-check"></span> Ya
</a>