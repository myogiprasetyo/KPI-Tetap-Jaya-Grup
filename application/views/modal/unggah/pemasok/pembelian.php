<?php
    switch ($konten) {
        case 'Pesanan Pembelian' :
            $file = 'pembelian/PesananPembelian.xlsx';
            break;
        case 'Faktur Pembelian' :
            $file = 'pembelian/FakturPembelian.xlsx';
            break;
    }
?>
Atau jika Anda belum mempunyai format file silahkan unduh <a href="<?php echo base_url().'assets/dist/file/upload/format_example/pemasok/'.$file; ?>">disini</a>.