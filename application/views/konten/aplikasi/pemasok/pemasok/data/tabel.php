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
                                
                                <th class="header_alamat">Alamat</th>
                                
                                <th class="header_no_telepon">No. Telepon</th>
                                
                                <th class="header_email">Email</th>
                                
                                <th class="header_website">Website</th>
                                
                                <th class="header_nama_kontak">Nama Kontak</th>
                                
                                <th class="header_no_telepon">No. Telepon Kontak</th>
                                
                                <th class="header_rupiah">Saldo Awal</th>
                                
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
                                        <a class="link_tabel" href="<?php echo site_url().'Pemasok/Buka_DataPemasok?no_pemasok='.$data->NoPemasok; ?>">
<?php
                                            echo $data->NoPemasok.' - '.$data->NamaPemasok;
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
                                        echo $data->NoTelepon1;
?>
                                    </td>

                                    <td>
<?php
                                        echo $data->Email;
?>
                                    </td>
                                       
                                    <td>
<?php
                                        echo $data->Website;
?>
                                    </td>
                                       
                                    <td>
<?php
                                        echo $data->NamaKontak;
?>
                                    </td>
                                    
                                    <td>
<?php
                                        echo $data->NoTelepon2;
?>
                                    </td>
                                       
                                    <td>
                                       <span class="label_rupiah">Rp. </span>
                                       
                                       <span class="pull-right">
<?php
                                            echo number_format($data->SaldoAwal, 2, ',', '.');
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
                            }
?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>