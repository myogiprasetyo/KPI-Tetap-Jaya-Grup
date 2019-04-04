<?php
    switch ($up_konten) {
        case 'Data Rayon' :
            $parameter = 'kode_rayon='.$kode_rayon;
            break;
    }
?>        
<a id="validasi_hapus" href="<?php echo site_url().'Pelanggan/Hapus_'.str_replace(' ', '', $up_konten).'_Proses?'.$parameter; ?>" class="btn btn-danger">
     <span class="fa fa-check"></span> Ya
</a>