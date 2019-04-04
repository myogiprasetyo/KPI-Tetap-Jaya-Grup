<?php
    switch ($up_konten) {
        case 'Data Pemasok' :
            $parameter = 'no_pemasok='.$no_pemasok;
            break;
        case 'Persediaan Akhir / Pemasok' :
            $parameter = 'no_pemasok='.substr($pemasok, 0, 3);
            break;
    }
?>        
<a id="validasi_hapus" href="<?php echo site_url().'Pemasok/Hapus_'.str_replace(' ', '', $up_konten).'_Proses?'.$parameter; ?>" class="btn btn-danger">
     <span class="fa fa-check"></span> Ya
</a>