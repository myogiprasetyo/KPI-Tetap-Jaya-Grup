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
                                <th class="header_no_po text-center">No. PO</th>
                                
                                <th class="header_tanggal text-center">Tanggal</th>
                                
                                <th class="header_nama">Pemasok</th>
                                
                                <th class="header_no text-center">Umur</th>
                                
                                <th class="header_rupiah text-center">Jumlah</th>
                                
                                <th class="header_keterangan">Keterangan</th>
                                
                                <th class="header_status text-center">Status</th>
                            </tr>
                        </thead>
                        
                        <tbody>
<?php
                            foreach ($data_tabel as $data) {
                                switch ($data->Status) {
                                    case 'Diterima Penuh' :
                                        $warna = 'green';
                                        break;
                                    case 'Sedang Diproses' :
                                        $warna = 'yellow';
                                        break;
                                    case 'Ditutup' :
                                        $warna = 'red';
                                        break;
                                    default :
                                        $warna = 'red';
                                        break;
                                }
                                    
                                if ($data->Diterima == 0) {
                                    $umur = (new datetime(date('Y-m-d', strtotime($data->Tanggal))))->diff(new datetime(date('Y-m-d')))->days;
                                } else {
                                    $umur = 'Terfaktur';
                                }
?>
                                <tr>
                                    <td class="text-center">
                                        <a class="link_tabel" href="<?php echo site_url().'Pemasok/Buka_PesananPembelian?no_po='.$data->NoPO; ?>">
<?php
                                            echo $data->NoPO;
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
                                        echo $data->NoPemasok.' - '.$data->NamaPemasok;
?>
                                    </td>
                                       
                                    <td class="text-center">
                                        <span class="label bg-<?php if ($umur == 'Terfaktur') { echo 'green'; } else { echo 'red'; } ?>">
<?php
                                            if ($umur == 'Terfaktur') {
                                                echo $umur;
                                            } else {
                                                echo $umur.' Hari';
                                            }
?>
                                        </span>
                                    </td>
                                    
                                    <td>
                                        <span class="label_rupiah">Rp. </span>
                                        
                                        <span class="pull-right">
<?php
                                            echo number_format($data->Diterima + $data->Diproses, 2, ',', '.');
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
                                if ($umur == 'Terfaktur') {
                                    $umur = 0;
                                }
                                    
                                $total_umur += $umur;
                                $jumlah_jumlah += ($data->Diterima + $data->Diproses);
                            }
?>
                        </tbody>
                        
                        <tfoot>
                            <tr>
                                <th class="text-center" colspan="3">Rerata Umur & Total Jumlah</th>
                                
                                <th class="text-center">
                                    <span class="label bg-red">
<?php
                                        if ($jumlah_data == 0) {
                                            echo '0 Hari';
                                        } else {
                                            echo round($total_umur / $jumlah_data).' Hari';
                                        }
?>
                                    </span>
                                </th>
                                
                                <th>
                                    <span class="label_rupiah">Rp. </span>
                                    
                                    <span class="pull-right">
<?php
                                        echo number_format($jumlah_jumlah, 2, ',', '.');
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