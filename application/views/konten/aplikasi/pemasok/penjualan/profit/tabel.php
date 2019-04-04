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
                                <th class="header_no text-center">No.</th>
                                
                                <th class="header_tanggal text-center">Tanggal</th>
                                
                                <th class="header_nama">Pemasok</th>
                                
                                <th class="header_rupiah text-center">Penjualan</th>
                                
                                <th class="header_rupiah text-center">Laba Kotor</th>
                                
                                <th class="header_nilai text-center">Profit</th>
                            </tr>
                        </thead>
                        
                        <tbody>
<?php
                            $no = 1;
                            
                            foreach ($data_tabel as $data) {
?>
                                <tr>
                                    <td class="text-center">
                                        <a class="link_tabel" href="<?php echo site_url().'Pemasok/Buka_ProfitPenjualan?no='.$data->No; ?>">
<?php
                                            echo $no++;
?>
                                        </a>
                                    </td>
                                       
                                    <td class="text-center">
<?php
                                        echo date('d', strtotime($data->Tanggal)).' '.bulan(date('m', strtotime($data->Tanggal)), 'F').' '.date('Y', strtotime($data->Tanggal));
?>
                                    </td>
                                        
                                    <td>
                                        <a class="link_tabel" href="<?php echo site_url().'Pemasok/Buka_ProfitPenjualan?no='.$data->No; ?>">
<?php
                                            echo $data->NoPemasok.' - '.$data->NamaPemasok;
?>
                                        </a>
                                    </td>
                                    
                                    <td>
                                        <span class="label_rupiah">Rp. </span>
                                        
                                        <span class="pull-right">
<?php
                                            echo number_format($data->Penjualan, 2, ',', '.');
?>
                                        </span>
                                    </td>
                                    
                                    <td>
                                        <span class="label_rupiah">Rp. </span>
                                        
                                        <span class="pull-right">
<?php
                                            echo number_format($data->LabaKotor, 2, ',', '.');
?>
                                        </span>
                                    </td>
                                    
                                    <td class="text-center">
<?php
                                        echo number_format($data->Profit, 1, ',', '.').'%';
?>
                                    </td>
                                </tr>
<?php
                                $total_penjualan += $data->Penjualan;
                                $total_laba_kotor += $data->LabaKotor;
                                $rerata_profit = $total_laba_kotor / $total_penjualan * 100;
                            }
?>
                        </tbody>
                        
                        <tfoot>
                            <tr>
                                <th class="text-center" colspan="3">Total</th>
                                
                                <th>
                                    <span class="label_rupiah">Rp. </span>
                                    
                                    <span class="pull-right">
<?php
                                        echo number_format($total_penjualan, 2, ',', '.');
?>
                                    </span>
                                </th>
                                
                                <th>
                                    <span class="label_rupiah">Rp. </span>
                                    
                                    <span class="pull-right">
<?php
                                        echo number_format($total_laba_kotor, 2, ',', '.');
?>
                                    </span>
                                </th>
                                
                                <th class="text-center">
<?php
                                    echo number_format($rerata_profit, 1, ',', '.').'%';
?>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>