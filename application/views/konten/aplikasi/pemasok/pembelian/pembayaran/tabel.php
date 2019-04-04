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
                                <th class="header_no_pembayaran text-center">No. Pembayaran</th>
                                
                                <th class="header_tanggal text-center">Tanggal</th>
                                
                                <th class="header_nama">Pemasok</th>
                                
                                <th class="header_no_cek text-center">No. Cek</th>
                                
                                <th class="header_tanggal text-center">Tanggal Cek</th>
                                
                                <th class="header_rupiah text-center">Total Faktur</th>
                                
                                <th class="header_keterangan">Keterangan</th>
                                
                                <th class="header_status text-center">Status</th>
                            </tr>
                        </thead>
                        
                        <tbody>
<?php
                            foreach ($data_tabel as $data) {
                                switch ($data->Status) {
                                    case 'Buka Giro' :
                                        $warna = 'yellow';
                                        break;
                                    case 'Dicairkan' :
                                        $warna = 'green';
                                        break;
                                    default :
                                        $warna = 'yellow';
                                        break;
                                }
?>
                                <tr>
                                    <td class="text-center">
                                        <a class="link_tabel" href="<?php echo site_url().'Pemasok/Buka_PembayaranPembelian?no_pembayaran='.$data->NoPembayaran; ?>">
<?php
                                            echo $data->NoPembayaran;
?>
                                        </a>
                                    </td>
                                       
                                    <td class="text-center" >
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
<?php
                                        echo $data->NoCek;
?>
                                    </td>
                                    
                                    <td class="text-center">
<?php
                                        echo date('d', strtotime($data->TanggalCek)).' '.bulan(date('m', strtotime($data->TanggalCek)), 'F').' '.date('Y', strtotime($data->TanggalCek));
?>
                                    </td>
                                       
                                    <td>
                                        <span class="label_rupiah">Rp. </span>
                                        
                                        <span class="pull-right">
<?php
                                            echo number_format($data->TotalFaktur, 2, ',', '.'); 
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
                                $jumlah_jumlah_faktur += $data->TotalFaktur;
                            }
?>
                        </tbody>
                        
                        <tfoot>
                            <tr>
                                <th class="text-center" colspan="5">Total</th>
                                
                                <th>
                                    <span class="label_rupiah">Rp. </span>
                                    
                                    <span class="pull-right">
<?php
                                        echo number_format($jumlah_jumlah_faktur, 2, ',', '.');
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