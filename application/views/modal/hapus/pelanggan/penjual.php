<?php
    switch ($up_konten) {
        case 'Data Penjual' :
            $parameter = 'no_penjual='.$no_penjual;
            break;
    }
?>        
<a id="validasi_hapus" href="<?php echo site_url().'Pelanggan/Hapus_'.str_replace(' ', '', $up_konten).'_Proses?'.$parameter; ?>" class="btn btn-danger">
     <span class="fa fa-check"></span> Ya
</a>