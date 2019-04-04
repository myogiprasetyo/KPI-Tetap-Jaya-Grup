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
                                <th class="header_rayon">Rayon</th>
                                
                                <th class="header_keterangan">Keterangan</th>
                                
                                <th class="header_status text-center">Status</th>
                            </tr>
                        </thead>
                        
                        <tbody>
<?php
                            foreach ($data_tabel as $data) { 
                                switch ($data->Status) {
                                    case 'Aktif' :
                                        $warna = 'green';
                                        break;
                                    case 'Tidak Aktif' :
                                        $warna = 'red';
                                        break;
                                    default :
                                        $warna = 'red';
                                        break;
                                }
?>
                                <tr>
                                    <td>
                                        <a class="link_tabel" href="<?php echo site_url().'Pelanggan/Buka_DataRayon?kode_rayon='.$data->KodeRayon; ?>">
<?php
                                            echo $data->KodeRayon.' - '.$data->NamaRayon;
?>
                                        </a>
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
                            }
?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>