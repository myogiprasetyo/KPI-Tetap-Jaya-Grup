<section class="content">
    <div class="row">
<?php
        require_once 'application/views/pesan/index.php';
?>
        <div class="col-xs-12">
            <div class="animated fadeInUp box box-success">                
                <div class="box-body">
                    <table id="tabel" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="header_no_faktur text-center">No. Faktur</th>
                                
                                <th class="header_tanggal text-center">Tanggal</th>
                                
                                <th class="header_nama">Pemasok</th>
                                
                                <th class="header_no text-center">Umur</th>
                                
                                <th class="header_no_po text-center">No. PO</th>
                                
                                <th class="header_rupiah text-center">Nilai Faktur</th>
                                
                                <th class="header_keterangan">Keterangan</th>
                                
                                <th class="header_status">Status</th>
                            </tr>
                        </thead>
                        
                        <tbody>
<?php
                            foreach ($data_tabel as $data) {
                                switch ($data->Status) {
                                    case 'Lunas' :
                                        $warna = 'green';
                                        break;
                                    case 'Pembayaran' :
                                        $warna = 'yellow';
                                        break;
                                    case 'Belum Lunas' :
                                        $warna = 'red';
                                        break;
                                    default :
                                        $warna = 'red';
                                        break;
                                }
                                    
                                if ($data->TanggalPO == null) {
                                    $umur = 0;
                                } else {
                                    $umur = (new datetime(date('Y-m-d', strtotime($data->TanggalFaktur))))->diff(new datetime(date('Y-m-d', strtotime($data->TanggalPO))))->days;
                                }
?>
                                <tr>
                                    <td class="text-center">
                                       <a class="link_tabel" href="<?php echo site_url().'Pemasok/Buka_FakturPembelian?no_faktur='.$data->NoFaktur; ?>">
<?php
                                            echo $data->NoFaktur;
?>
                                       </a>
                                    </td>
                                       
                                    <td class="text-center">
<?php
                                        echo date('d', strtotime($data->TanggalFaktur)).' '.bulan(date('m', strtotime($data->TanggalFaktur)), 'F').' '.date('Y', strtotime($data->TanggalFaktur));
?>
                                    </td>
                                    
                                    <td>
<?php
                                        echo $data->NoPemasok.' - '.$data->NamaPemasok;
?>
                                    </td>
                                       
                                    <td class="text-center">
                                        <span class="label bg-green">
<?php
                                            echo $umur.' Hari';
?>
                                        </span>
                                    </td>
                                       
                                    <td class="text-center">
<?php
                                        if ($data->NoPO == null) {
                                            echo 'Tidak ada No. PO';
                                        } else {
                                            echo $data->NoPO;
                                        }
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
                                       
                                    <td class="text-center">
                                        <span class="label bg-<?php echo $warna; ?>">
<?php
                                            echo $data->Status;
?>
                                        </span>
                                    </td>
                                </tr>
<?php
                                $total_umur += $umur;
                                $jumlah_nilai_faktur += $data->NilaiFaktur;
                            }
?>
                        </tbody>
                        
                        <tfoot>
                            <tr>
                                <th class="text-center" colspan="3">Rerata Umur & Total Nilai Faktur</th>
                                
                                <th class="text-center">
                                    <span class="label bg-green">
<?php
                                        if ($jumlah_data == 0) {
                                            echo '0 Hari';
                                        } else {
                                            echo round($total_umur / $jumlah_data).' Hari';
                                        }
?>
                                    </span>
                                </th>
                                
                                <th></th>
                                
                                <th>
                                    <span class="label_rupiah">Rp. </span>
                                    
                                    <span class="pull-right">
<?php
                                        echo number_format($jumlah_nilai_faktur, 2, ',', '.');
?>
                                    </span>
                                </th>
                                
                                <th colspan="2"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>