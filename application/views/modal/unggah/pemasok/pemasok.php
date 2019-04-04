<?php
    switch ($konten) {
        case 'Data Pemasok' :
            $file = 'pemasok/DataPemasok.xlsx';
            break;
        case 'Persediaan Akhir / Pemasok' :
            $file = 'pemasok/PersediaanAkhirPemasok.xlsx';
            break;
    }
?>
Atau jika Anda belum mempunyai format file silahkan unduh <a href="<?php echo base_url().'assets/dist/file/upload/format_example/pemasok/'.$file; ?>">disini</a>.