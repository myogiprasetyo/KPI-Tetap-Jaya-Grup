<?php
    switch ($up_konten) {
        case 'Data Pelanggan' :
            $parameter = 'no_pelanggan='.$no_pelanggan;
            break;
        case 'Target / Pelanggan' :
            $parameter = 'no='.$no;
            break;
        case 'Piutang / Pelanggan' :
            $parameter = 'no='.$no;
            break;
    }
?>        
<a id="validasi_hapus" href="<?php echo site_url().'Pelanggan/Hapus_'.str_replace(' ', '', $up_konten).'_Proses?'.$parameter; ?>" class="btn btn-danger">
     <span class="fa fa-check"></span> Ya
</a>