<?php
    switch ($up_konten) {
        case 'Profit / Penjualan' :
            $parameter = 'no='.$no;
            break;
    }
?>        
<a id="validasi_hapus" href="<?php echo site_url().'Pemasok/Hapus_'.str_replace(' ', '', $up_konten).'_Proses?'.$parameter; ?>" class="btn btn-danger">
     <span class="fa fa-check"></span> Ya
</a>