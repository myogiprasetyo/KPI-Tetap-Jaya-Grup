<section class="content">
    <div class="row">
       <?php require_once 'application/views/pengaturan/konten/isikonten/pesan.php'; ?>
        <div class="col-xs-12">
            <div class="box box-success">                
                <div class="box-body">
                    <table id="tabel" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="header_nik text-center">NIK</th>
                                <th class="header_nama_karyawan">Nama Lengkap</th>
                                <th class="header_jabatan">Jabatan</th>
                                <th class="header_tanggal text-center">Tanggal Masuk</th>
                                <th class="header_devisi">Devisi</th>
                                <th class="header_jenis_kelamin">Jenis Kelamin</th>
                                <th class="header_tempat_tanggal">Tempat, Tanggal Lahir</th>
                                <th class="header_alamat">Alamat Lengkap</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php foreach ($tabel as $data) { ?>
                                <tr>
                                    <td class="text-center"><a class="link_tabel" href="<?php echo site_url().'Pengaturan/Buka_Karyawan?NIK='.$data->NIK.'&NamaLengkap='.$data->NamaLengkap; ?>"><?php echo $data->NIK; ?></a></td>
                                    <td><a class="link_tabel" href="<?php echo site_url().'Pengaturan/Buka_Karyawan?NIK='.$data->NIK.'&NamaLengkap='.$data->NamaLengkap; ?>"><?php echo $data->NamaLengkap; ?></a></td>
                                    <td><?php echo $data->Jabatan; ?></td>
                                    <td class="text-center"><?php echo date('d F Y', strtotime($data->TanggalMasuk)); ?></td>
                                    <td><?php echo $data->Devisi; ?></td>
                                    <td><?php echo $data->JenisKelamin; ?></td>
                                    <td><?php if ($data->TempatLahir != '') { echo $data->TempatLahir.', '; } echo date('d F Y', strtotime($data->TanggalLahir)); ?></td>
                                    <td><?php echo $data->AlamatLengkap; if ($data->KabupatenKota != null) { echo ', '.$data->KabupatenKota; } if ($data->Provinsi != null) { echo ', '.$data->Provinsi; } ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>