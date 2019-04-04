<section class="content">
    <div class="row">
        <form id="form" role="form" class="form-horizontal" method="post">
            <div class="col-md-4 col-sm-12">
                <div class="box box-success">
                    <div class="box-header with-border text-center">
                        <h3 class="box-title">Foto Profil</h3>
                    </div>
                    <div class="box-body">
                        <div class="user-header text-center">
                            <?php if ($data->Foto == null) { ?>
                                <img src="<?php echo base_url(); ?>assets/dist/img/profile_photo/default/<?php if ($data->JenisKelamin == 'Laki - Laki') { echo 'male'; } else if ($data->JenisKelamin == 'Perempuan') { echo 'female'; } ?>.png" class="img-circle" alt="<?php echo $data->NamaLengkap; ?>">
                            <?php } else { ?>
                                <img src="<?php echo base_url(); ?>assets/dist/img/profile_photo/<?php echo $data->Foto; ?>" class="img-circle" alt="<?php echo $data->NamaLengkap; ?>">
                            <?php } ?>
                        </div>
                        <br>
                        <div>
                            <label for="ganti_foto">Ganti Foto</label>
                            
                            <input type="file" id="ganti_foto" name="pilih_foto">
                            
                            <p class="help-block">
                                File ekstensi .png / .jpg / .jpg <br>
                                Ukuran Maks. 1MB
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#data_saya" data-toggle="tab">Data Saya</a></li>
                        <li><a href="#posisi" data-toggle="tab">Posisi</a></li>
                        <li><a href="#alamat" data-toggle="tab">Alamat</a></li>
                    </ul>
                    <?php foreach ($karyawan as $data) { ?>
                        <div class="tab-content">
                            <div class="tab-pane active" id="data_saya">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">NIK</label>

                                        <div id="nik" class="col-sm-3">
                                            <input type="text" class="form-control nik" placeholder="NIK" name="nik" value="<?php echo $data->NIK; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nama Lengkap</label>

                                        <div id="nama_lengkap" class="col-sm-5">
                                            <input type="text" class="form-control" placeholder="Nama Lengkap" maxlength="25" name="nama_lengkap" value="<?php echo $data->NamaLengkap; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label form_status">Jenis Kelamin</label>

                                        <div id="jenis_kelamin" class="col-sm-7">
                                            <input type="radio" name="jenis_kelamin" class="flat-red" value="Laki - Laki" <?php if ($data->JenisKelamin == 'Laki - Laki') { echo 'checked'; } ?>> Laki - Laki
                                            &nbsp;&nbsp;
                                            <input type="radio" name="jenis_kelamin" class="flat-red" value="Perempuan" <?php if ($data->JenisKelamin == 'Perempuan') { echo 'checked'; } ?>> Perempuan
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tempat Lahir</label>

                                        <div id="tempat_lahir" class="col-sm-7">
                                            <textarea class="form-control" rows="2" placeholder="Tempat Lahir" maxlength="50" name="tempat_lahir"><?php echo $data->TempatLahir; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tanggal Lahir</label>

                                        <div id="tanggal_lahir" class="col-sm-3">
                                            <input type="text" class="tanggal form-control" id="datepicker1" name="tanggal_lahir" value="<?php echo date('d/m/Y', strtotime($data->TanggalLahir)); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="posisi">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Devisi</label>

                                        <div id="devisi_select" class="col-sm-5">
                                            <select id="devisi" class="form-control select2" name="devisi">
                                                <option></option>
                                                <?php foreach ($devisi as $option) { ?>
                                                    <option value="<?php echo $option->Id; ?>" <?php if ($data->Devisi == $option->Devisi) { echo 'selected'; } ?>><?php echo $option->Devisi; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Jabatan</label>

                                        <div id="jabatan_select" class="col-sm-6">
                                            <select id="jabatan" class="form-control select2" name="jabatan">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tanggal Masuk</label>

                                        <div id="tanggal_masuk" class="col-sm-3">
                                            <input type="text" class="tanggal form-control" id="datepicker2" name="tanggal_masuk" value="<?php echo date('d/m/Y', strtotime($data->TanggalMasuk)); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="alamat">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Alamat Lengkap</label>

                                        <div id="text_alamat" class="col-sm-7">
                                            <textarea class="form-control" rows="3" placeholder="Alamat" maxlength="100" name="alamat"><?php echo $data->AlamatLengkap; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Kabupaten / Kota</label>

                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" placeholder="Kabupaten / Kota" maxlength="20" value="<?php echo $data->KabupatenKota; ?>" name="kabupaten_kota">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Provinsi</label>

                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" placeholder="Provinsi" maxlength="20" value="<?php echo $data->Provinsi; ?>" name="provinsi">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button id="validasi" type="button" class="btn btn-success"><span class="fa fa-refresh"></span> Perbarui</button>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </form>
    </div>
</section>