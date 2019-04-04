<?php
    switch ($konten) {
        case 'Faktur Penjualan' :
            $file = 'penjualan/FakturPenjualan.xlsx';
            break;
        case 'Retur Penjualan' :
            $file = 'penjualan/ReturPenjualan.xlsx';
            break;
        case 'Laba Kotor Penjualan' :
            $file = 'penjualan/LabaKotorPenjualan.xlsx';
            break;
    }
?>
Atau jika Anda belum mempunyai format file silahkan unduh <a href="<?php echo base_url().'assets/dist/file/upload/format_example/pelanggan/'.$file; ?>">disini</a>.