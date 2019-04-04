<script src="<?php echo base_url(); ?>assets/plugins/jQueryMask/jquery.mask.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>

<script>
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });
</script>
<?php
    if ($konten == 'Target / Pelanggan' || $up_konten == 'Target / Pelanggan' || $konten == 'Piutang / Pelanggan' || $up_konten == 'Piutang / Pelanggan') {
?>
        <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        
        <script>
            $('.select2').select2();
    
            $('#penjual').select2({
                placeholder: 'Pilih Penjual'
            });
            
            $('#penjual_unduh').select2({
                placeholder: 'Pilih Penjual'
            });
        </script>
<?php
        if ($konten == 'Target / Pelanggan' || $up_konten == 'Target / Pelanggan') {
?>            
            <script>
                $('.bulan').datepicker({
                    viewMode: 'months',
                    minViewMode: 'months',
                    format: 'MM yyyy',
                    autoclose: true
                });
            </script>
<?php        
        } else if ($konten == 'Piutang / Pelanggan' || $up_konten == 'Piutang / Pelanggan') {
?>
            <script>
                $('.tanggal').mask('00/00/0000', {
                    placeholder: '__/__/____'
                });
                
                $('.tanggal').datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true
                });
            </script>
<?php        
        }
    }

    if (empty($up_konten)) {
?>
        <script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/dataTables.fixedHeader.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/responsive.bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        
        <script>
            var table = $('#tabel').DataTable( {
                responsive: true
            });
        </script>
<?php
        if ($konten != 'Nilai / Pelanggan') {
?>
            <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-filestyle/src/bootstrap-filestyle.min.js"></script>
            
            <script>
                $('#unggah').filestyle({
                    dragdrop: false,
                    btnClass: 'btn-primary',
                    htmlIcon : '<span class="glyphicon glyphicon-folder-open"></span>',
                    text: '',
                    placeholder : 'Pilih File'
                });
            </script>
            
            <script>
                $('#validasi_unggah').click(function() {
                    $('#validasi_unggah span').removeClass('fa-upload');
                    $('#validasi_unggah span').addClass('fa-spinner fa-spin');
                    
                    var file = $('#unggah').prop('files')[0];
                    var data = new FormData();
                    
                    data.append('unggah', file);
                    
                    $.ajax({
                        url: '<?php echo base_url().'Pelanggan/Unggah_'.str_replace(' ', '', $konten).'_Proses'; ?>', 
                        type: 'POST',
                        dataType: 'json',
                        data: data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        success: function(data) {
                            $('#validasi_unggah span').addClass('fa-upload');
                            $('#validasi_unggah span').removeClass('fa-spinner fa-spin');

                            if (data == 'sukses') {
                                window.location.replace('<?php echo base_url().'Pelanggan/'.str_replace(' ', '', $konten).'?pesan=Sukses Unggah'; ?>');
                            } else if (data == 'gagal') {
                                window.location.replace('<?php echo base_url().'Pelanggan/'.str_replace(' ', '', $konten).'?pesan=Gagal Unggah'; ?>');
                            }
                        }
                    });
                });
            </script>
<?php
        }

        if (!empty($pesan)) {
?>
            <script>
                window.setTimeout(function() {
                    $("#pesan").fadeTo(500, 0).slideUp(500, function(){
                        $(this).remove(); 
                    });
                }, 3000);
            </script>
<?php
        }
    } else {
        if ($up_konten == 'Nilai / Pelanggan') {
?>
            <script src="<?php echo base_url(); ?>assets/bower_components/raphael/raphael.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.min.js"></script>

            <script>
                $(function () {
                    "use strict";

                    var donut = new Morris.Donut({
                        element: 'sales-chart',
                        resize: true,
                        colors: ["#3c8dbc", "#f56954", "#00a65a"],
                        data: [{
                            label: "Pencapaian", value: <?php echo number_format($nilai[7]['Pencapaian'], 1); ?>
                        }, {
                            label: "Profit", value: <?php echo number_format($nilai[7]['Profit'], 1); ?>
                        }, {
                            label: "UPL", value: <?php echo number_format($nilai[7]['UPL'], 1); ?>
                        }],
                        hideHover: 'auto'
                    });

                    var area = new Morris.Line({
                        element: 'line-chart',
                        resize: true,
                        data: [
<?php
                            for ($bulan = 1; $bulan <= 7; $bulan++) {
?>
                                {
                                    y: '<?php echo $nilai[$bulan]['Bulan']; ?>',
                                    a: <?php echo number_format($nilai[$bulan]['Pencapaian'], 1); ?>,
                                    b: <?php echo number_format($nilai[$bulan]['Profit'], 1); ?>,
                                    c: <?php echo number_format($nilai[$bulan]['UPL'], 1); ?>
                                },
<?php
                            }
?>
                        ],
                        xkey: 'y',
                        parseTime: false,
                        ykeys: ['a', 'b', 'c'],
                        labels: ['Pencapaian', 'Profit', 'UPL'],
                        lineColors: ["#3c8dbc", "#f56954", "#00a65a"],
                        hideHover: 'auto'
                    });
                });
            </script>
<?php
        } else {
?>
            <script>
                $('#validasi_hapus').click(function() {
                    $('#validasi_hapus span').removeClass('fa-check');
                    $('#validasi_hapus span').addClass('fa-spinner fa-spin');
                });

                $('#validasi').click(function() {
<?php
                    if ($konten == 'Tambah') {
?>
                        $('#validasi span').removeClass('fa-plus');
<?php
                    } else {
?>
                        $('#validasi span').removeClass('fa-edit');
<?php
                    }
?>
                    $('#validasi span').addClass('fa-spinner fa-spin');
<?php
                    if ($konten == 'Tambah' || $konten == 'Dorong') {
                        $url = base_url().'Pelanggan/Tambah_'.str_replace(' ', '', $up_konten).'_Proses';
                    } else {
                        $url = base_url().'Pelanggan/Ubah_'.str_replace(' ', '', $up_konten).'_Proses';
                    }
?>
                    var data = $('#form').serialize();

                    $.ajax({
                        url: '<?php echo $url; ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: data,
                        success: function(data) {
                            $('#validasi span').removeClass('fa-spinner fa-spin');
<?php
                            if ($konten == 'Tambah') {
?>
                                $('#validasi span').addClass('fa-plus');
<?php
                            } else {
?>
                                $('#validasi span').addClass('fa-edit');
<?php
                            }
?>
                            $('div').removeClass('has-error');
                            $('.form-group p').remove();

                            if (data == 'sukses') {
<?php
                                if ($konten == 'Tambah') {
                                    $pesan = 'Sukses Tambah';
                                } else {
                                    $pesan = 'Sukses Ubah';
                                }
?>
                                window.location.replace('<?php echo base_url().'Pelanggan/'.str_replace(' ', '', $up_konten).'?pesan='.$pesan;  ?>');
                            } else {
<?php
                                switch ($up_konten) {
                                    case 'Data Pelanggan' :
?>
                                        if (data.no_pelanggan !== '') {
                                            $('#no_pelanggan').addClass('animated tada has-error').append(data.no_pelanggan);
                                        };

                                        if (data.nama_pelanggan !== '') {
                                            $('#nama_pelanggan').addClass('animated tada has-error').append(data.nama_pelanggan);
                                        };

                                        if (data.no_telepon !== '') {
                                            $('#no_telepon').addClass('animated tada has-error').append(data.no_telepon);
                                        };

                                        if (data.email !== '') {
                                            $('#email').addClass('animated tada has-error').append(data.email);
                                        };

                                        if (data.alamat !== '') {
                                            $('#text_alamat').addClass('animated tada has-error').append(data.alamat);
                                        };
                                
                                        if (data.kabupaten_kota !== '') {
                                            $('#kabupaten_kota').addClass('animated tada has-error').append(data.kabupaten_kota);
                                        };
                                
                                        if (data.provinsi !== '') {
                                            $('#provinsi').addClass('animated tada has-error').append(data.provinsi);
                                        };
                                
                                        if (data.rayon !== '') {
                                            $('#rayon_select').addClass('animated tada has-error').append(data.rayon);
                                        };
                                
                                        if (data.penjual !== '') {
                                            $('#penjual_select').addClass('animated tada has-error').append(data.penjual);
                                        };
<?php
                                        break;
                                    case 'Target / Pelanggan' :
?>                                      
                                        if (data.bulan !== '') {
                                            $('#bulan').addClass('animated tada has-error').append(data.bulan);
                                        };
                                
                                        if (data.pelanggan !== '') {
                                            $('#pelanggan_select').addClass('animated tada has-error').append(data.pelanggan);
                                        };
                                        
                                        if (data.penjual !== '') {
                                            $('#penjual_select').addClass('animated tada has-error').append(data.penjual);
                                        };

                                        if (data.target !== '') {
                                            $('#text_target').addClass('animated tada has-error').append(data.target);
                                        };
<?php
                                        break;
                                    case 'Piutang / Pelanggan' :
?>
                                        if (data.tanggal !== '') {
                                            $('#tanggal').addClass('animated tada has-error').append(data.tanggal);
                                        };
                                
                                        if (data.pelanggan !== '') {
                                            $('#pelanggan_select').addClass('animated tada has-error').append(data.pelanggan);
                                        };

                                        if (data.piutang !== '') {
                                            $('#text_piutang').addClass('animated tada has-error').append(data.piutang);
                                        };
<?php
                                        break;
                                }
?>
                            };
                        }
                    });
                });
            </script>
<?php
            if ($up_konten == 'Data Pelanggan') {
?>
                <script>
                    $('.telepon').mask('000 0000 0000 00', {
                        placeholder: 'No. Telepon'
                    });

                    $('.kode_pos').mask('00000', {
                        placeholder: 'Kode Pos'
                    });
                    
                    $('#rayon').select2({
                        placeholder: 'Pilih Rayon'
                    });
                    
                    $('#penjual').select2({
                        placeholder: 'Pilih Penjual'
                    });
                </script>
<?php
                if ($up_konten == 'Tambah') {
?>
                    <script>
                        $('#rayon').change(function() {
                            $('#no_auto').val($('#rayon').val() + '.' + '<?php echo $nomor_auto; ?>');
                        });
                    </script>
<?php
                }
            } else if ($up_konten == 'Target / Pelanggan' || $up_konten == 'Piutang / Pelanggan') {
?>
                <script>
                    $('#pelanggan').select2({
                        placeholder: 'Pilih Pelanggan'
                    });
                        
                    $('.rupiah').mask('0.000.000.000,00', {
                        placeholder: 'Nilai',
                        reverse: true
                    });
                </script>
                   
                <script>
                    $('#pelanggan').change(function() {
                        var pelanggan = $('#pelanggan').val();
                        var pilihan = 'No. Penjual';
    
                        $.ajax({
                            url: '<?php echo base_url().'Pelanggan/Proses/Pilihan/AmbilData'; ?>',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                no_pelanggan: pelanggan,
                                pilihan: pilihan
                            },
                            success: function(data) {
                                $('#penjual').val(data[0].Penjual).trigger('change');
                            }
                        });
                    });
                </script>
<?php
            }
        }
    }
?>