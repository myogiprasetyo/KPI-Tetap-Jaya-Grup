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
                                <th class="header_no text-center">No.</th>
                                
                                <th class="header_tanggal text-center">Bulan</th>
                                
                                <th class="header_nama">Pelanggan</th>
                                
                                <th class="header_nama">Penjual</th>
                                
                                <th class="header_rupiah text-center">Target</th>
                            </tr>
                        </thead>
                        
                        <tbody>
<?php
                            $no = 1;
                            foreach ($data_tabel as $data) {
?>
                                <tr>
                                    <td class="text-center">
                                        <a class="link_tabel" href="<?php echo site_url().'Pelanggan/Buka_TargetPelanggan?no='.$data->No; ?>">
<?php
                                            echo $no++;
?>
                                        </a>
                                    </td>
                                    
                                    <td class="text-center">
<?php
                                        echo $data->Bulan;
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
                                            echo number_format($data->Target, 2, ',', '.');
?>
                                        </span>
                                    </td>
                                </tr>
<?php
                                $total_target += $data->Target;
                            }
?>
                        </tbody>
                        
                        <tfoot>
                            <tr>
                                <th class="text-center" colspan="4">Total Target</th>
                                
                                <th>
                                    <span class="label_rupiah">Rp. </span>
                                    
                                    <span class="pull-right">
<?php
                                        echo number_format($total_target, 2, ',', '.');
?>
                                    </span>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>