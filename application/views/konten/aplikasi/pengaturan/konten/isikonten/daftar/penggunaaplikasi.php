<section class="content">
    <div class="row">
        <form id="form" role="form" class="form-horizontal" method="post">
            <div class="col-md-7 col-sm-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Atur Hak Akses</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Karyawan</label>

                            <div id="karyawan_select" class="col-sm-8">
                                <select id="karyawan" class="form-control select2" name="karyawan">
                                    <option></option>
                                    <?php foreach ($semua_karyawan as $option) { ?>
                                        <option value="<?php echo $option->NIK; ?>">
                                            <?php echo $option->NIK.' - '.$option->NamaLengkap; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Password</label>

                            <div id="password" class="col-sm-3">
                                <input type="password" class="form-control" maxlength="16" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Status</label>

                            <div id="status_select" class="col-sm-4">
                                <select id="status" class="form-control" name="status">
                                    <option value="Administrator">Administrator</option>
                                    <option value="Pengguna">Pengguna</option>
                                    <option value="Tanpa Akses" selected>Tanpa Akses</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#kpi_pemasok" data-toggle="tab">KPI Pemasok</a></li>
                        <li><a href="#kpi_pelanggan" data-toggle="tab">KPI Pelanggan</a></li>
                        <li><a href="#kpi_individu" data-toggle="tab">KPI Individu</a></li>
                        <li><a href="#kpi_team" data-toggle="tab">KPI Team</a></li>
                        <li><a href="#pengaturan" data-toggle="tab">Pengaturan</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="kpi_pemasok">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label form_status">Data Pemasok</label>

                                    <div id="data_pemasok" class="col-sm-9">
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="1"> Lihat
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="2"> Buka
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="4"> Tambah
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="16"> Ubah
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="32"> Hapus
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label form_status">Nilai / Pemasok</label>

                                    <div id="nilai_pemasok" class="col-sm-9">
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="1"> Lihat
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="2"> Buka
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label form_status">Pesanan Pembelian</label>

                                    <div id="pesanan_pembelian" class="col-sm-9">
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="1"> Lihat
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="2"> Buka
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="4"> Tambah
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="16"> Ubah
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="32"> Hapus
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label form_status">Faktur Pembelian</label>

                                    <div id="faktur_pembelian" class="col-sm-9">
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="1"> Lihat
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="2"> Buka
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="4"> Tambah
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="16"> Ubah
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="32"> Hapus
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label form_status">Pembayaran Pembelian</label>

                                    <div id="faktur_pembelian" class="col-sm-9">
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="1"> Lihat
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="2"> Buka
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="4"> Tambah
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="16"> Ubah
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="32"> Hapus
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label form_status">Persediaan Akhir</label>

                                    <div id="faktur_pembelian" class="col-sm-9">
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="2"> Buka
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="4"> Tambah
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="32"> Hapus
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label form_status">Penjualan</label>

                                    <div id="faktur_pembelian" class="col-sm-9">
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="1"> Lihat
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="2"> Buka
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="4"> Tambah
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="16"> Ubah
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="32"> Hapus
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="kpi_pelanggan">
                            <div class="box-body">
                                
                            </div>
                        </div>
                        <div class="tab-pane" id="kpi_individu">
                            <div class="box-body">
                            </div>
                        </div>
                        <div class="tab-pane" id="pengaturan">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label form_status">Profil Saya</label>

                                    <div id="dasbor" class="col-sm-9">
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="Ubah"> Ubah
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label form_status">Karyawan</label>

                                    <div id="data_pemasok" class="col-sm-9">
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="Lihat"> Lihat
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="Buka"> Buka
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="Tambah"> Tambah
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="Ubah"> Ubah
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="Hapus"> Hapus
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label form_status">Pengguna Aplikasi</label>

                                    <div id="nilai_pemasok" class="col-sm-9">
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="Lihat"> Lihat
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="Ubah"> Ubah
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label form_status">Info Perusahaan</label>

                                    <div id="pesanan_pembelian" class="col-sm-9">
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="Ubah"> Ubah
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label form_status">Pengaturan Aplikasi</label>

                                    <div id="faktur_pembelian" class="col-sm-9">
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="Lihat"> Lihat
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="Buka"> Buka
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="Tambah"> Tambah
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="Ubah"> Ubah
                                        &nbsp;&nbsp;
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="Hapus"> Hapus
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label form_status">Tentang</label>

                                    <div id="faktur_pembelian" class="col-sm-9">
                                        <input type="checkbox" name="data_pemasok" class="flat-red" value="Lihat"> Lihat
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button id="validasi" type="button" class="btn btn-success"><span class="fa fa-save"></span> Simpan</button>
                    </div>
                </div>
            </div>
            <?php //require_once 'application/views/pemasok/konten/isikonten/keterangan.php'; ?>
        </form>
    </div>
</section>