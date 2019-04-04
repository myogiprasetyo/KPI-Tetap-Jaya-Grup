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
                                <th class="header_nama">Pemasok</th>
                                
                                <th class="header_rupiah text-center">Persediaan Akhir</th>
                            </tr>
                        </thead>
                        
                        <tbody>
<?php
                            foreach ($data_tabel as $data) {
?>
                                <tr>
                                    <td>
                                        <a class="link_tabel" href="<?php echo site_url().'Pemasok/Buka_PersediaanAkhirPemasok?no_pemasok='.$data->NoPemasok; ?>">
<?php
                                            echo $data->NoPemasok.' - '.$data->NamaPemasok;
?>
                                        </a>
                                    </td>
                                       
                                    <td>
                                        <span class="label_rupiah">Rp. </span>
                                        
                                        <span class="pull-right">
<?php
                                            echo number_format($data->PersediaanAkhir, 2, ',', '.');
?>
                                        </span>
                                    </td>
                                </tr>
<?php
                                $total_persediaan_akhir += $data->PersediaanAkhir;
                            }
?>
                        </tbody>
                        
                        <tfoot>
                            <tr>
                                <th class="text-center">Total Persediaan Akhir</th>
                                
                                <th>
                                    <span class="label_rupiah">Rp. </span>
                                    
                                    <span class="pull-right">
<?php
                                        echo number_format($total_persediaan_akhir, 2, ',', '.');
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