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
                                <th class="header_nama">Pelanggan</th>
                                
                                <th class="header_alamat">Alamat Lengkap</th>
                                
                                <th class="header_no_telepon">No. Telepon</th>
                                
                                <th class="header_email">Email</th>
                                
                                <th class="header_rayon">Rayon</th>
                                
                                <th class="header_nama">Default Penjual</th>
                                
                                <th class="header_no text-center">Level Harga</th>
                                
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
                                        <a class="link_tabel" href="<?php echo site_url().'Pelanggan/Buka_DataPelanggan?no_pelanggan='.$data->NoPelanggan; ?>">
<?php
                                            echo $data->NoPelanggan.' - '.$data->NamaPelanggan;
?>
                                        </a>
                                    </td>
                                    
                                    <td>
<?php
                                        echo $data->AlamatLengkap;
                                
                                        if ($data->KabupatenKota != null) {
                                            echo ', '.$data->KabupatenKota;
                                        }
                                
                                        if ($data->Provinsi != null) {
                                            echo ', '.$data->Provinsi;
                                        }
                                
                                        if ($data->KodePos != null) {
                                            echo ', '.$data->KodePos;
                                        }
?>
                                    </td>
                                       
                                    <td>
<?php
                                        echo $data->NoTelepon;
?>
                                    </td>
                                       
                                    <td>
<?php
                                        echo $data->Email;
?>
                                    </td>
                                        
                                    <td>
<?php
                                        echo $data->NamaRayon;
?>
                                    </td>
                                    
                                    <td>
<?php
                                        echo $data->NamaPenjual;
?>
                                    </td>
                                    
                                    <td class="text-center">
<?php
                                        echo $data->LevelHarga;
?>
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