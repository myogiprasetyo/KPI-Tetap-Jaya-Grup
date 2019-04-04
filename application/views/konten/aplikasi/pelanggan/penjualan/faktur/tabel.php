<section class="content">
    <div class="row">
<?php
        require_once 'application/views/pesan/index.php';
?>
        <div class="col-xs-12">
            <div class="animated fadeInUp box box-warning">                
                <div class="box-body">
                    <table id="tabel" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="header_no_faktur text-center">No. Faktur</th>
                                
                                <th class="header_tanggal text-center">Tanggal</th>
                                
                                <th class="header_nama">Pelanggan</th>
                                
                                <th class="header_nama">Penjual</th>
                                
                                <th class="header_rupiah text-center">Nilai Faktur</th>
                                
                                <th class="header_keterangan">Keterangan</th>
                            </tr>
                        </thead>
                        
                        <tbody>
<?php
                            foreach ($data_tabel as $data) {
?>
                                <tr>
                                    <td class="text-center">
                                        <a class="link_tabel" href="<?php echo site_url().'Pelanggan/Buka_FakturPenjualan?no_faktur='.$data->NoFaktur; ?>">
<?php
                                            echo $data->NoFaktur;
?>
                                        </a>
                                    </td>
                                    
                                    <td class="text-center">
<?php
                                        echo date('d', strtotime($data->Tanggal)).' '.bulan(date('m', strtotime($data->Tanggal)), 'F').' '.date('Y', strtotime($data->Tanggal));
?>
                                    </td>
                                    
                                    <td>
<?php
                                        echo $data->NoPelanggan.' - '.$data->NamaPelanggan;
?>
                                    </td>
                                    
                                    <td>
<?php
                                        echo $data->NoPenjual.' - '.$data->NamaPenjual;
?>
                                    </td>
                                    
                                    <td>
                                        <span class="label_rupiah">Rp. </span>
                                        
                                        <span class="pull-right">
<?php
                                            echo number_format($data->NilaiFaktur, 2, ',', '.');
?>
                                        </span>
                                    </td>
                                    
                                    <td>
<?php
                                        echo $data->Keterangan;
?>
                                    </td>
                                </tr>
<?php
                                $jumlah_nilai_faktur += $data->NilaiFaktur;
                            }
?>
                        </tbody>
                        
                        <tfoot>
                            <tr>
                                <th class="text-center" colspan="4">Total Nilai Faktur</th>
                                
                                <th>
                                    <span class="label_rupiah">Rp. </span>
                                    
                                    <span class="pull-right">
<?php
                                        echo number_format($jumlah_nilai_faktur, 2, ',', '.');
?>
                                    </span>
                                </th>
                                
                                <th colspan="1"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>