<?php
    switch ($konten) {
        case 'Data Pelanggan' :
            $file = 'pelanggan/DataPelanggan.xlsx';
            break;
        case 'Target / Pelanggan' :
            $file = 'pelanggan/TargetPelanggan.xlsx';
            break;
        case 'Piutang / Pelanggan' :
            $file = 'pelanggan/PiutangPelanggan.xlsx';
            break;
    }
?>
Atau jika Anda belum mempunyai format file silahkan unduh <a href="<?php echo base_url().'assets/dist/file/upload/format_example/pelanggan/'.$file; ?>">disini</a>.