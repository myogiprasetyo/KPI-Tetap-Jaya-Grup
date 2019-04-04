<script src="<?php echo base_url(); ?>assets/plugins/jQueryMask/jquery.mask.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>

<script>
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });
</script>
<?php
    if ($konten == 'Persediaan Akhir / Pemasok' || $up_konten == 'Persediaan Akhir / Pemasok') {
?>            
        <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
                
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
        if ($konten != 'Nilai / Pemasok') {
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
                        url: '<?php echo base_url().'Pemasok/Unggah_'.str_replace(' ', '', $konten).'_Proses'; ?>', 
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
                                window.location.replace('<?php echo base_url().'Pemasok/'.str_replace(' ', '', $konten).'?pesan=Sukses Unggah'; ?>');
                            } else if (data == 'gagal') {
                                window.location.replace('<?php echo base_url().'Pemasok/'.str_replace(' ', '', $konten).'?pesan=Gagal Unggah'; ?>');
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
        if ($up_konten == 'Nilai / Pemasok') {
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
                            label: "Profit", value: <?php echo number_format($nilai[7]['Profit'], 1); ?>
                        }, {
                            label: "SH VS PA", value: <?php echo number_format($nilai[7]['SH VS PA'], 1); ?>
                        }, {
                            label: "Terpenuhi", value: <?php echo number_format($nilai[7]['Terpenuhi'], 1); ?>
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
                                    a: <?php echo number_format($nilai[$bulan]['Profit'], 1); ?>,
                                    b: <?php echo number_format($nilai[$bulan]['SH VS PA'], 1); ?>,
                                    c: <?php echo number_format($nilai[$bulan]['Terpenuhi'], 1); ?>
                                },
<?php
                            }
?>
                        ],
                        xkey: 'y',
                        parseTime: false,
                        ykeys: ['a', 'b', 'c'],
                        labels: ['Profit', 'SH VS PA', 'Terpenuhi'],
                        lineColors: ["#3c8dbc", "#f56954", "#00a65a"],
                        hideHover: 'auto'
                    });
                });
            </script>
<?php
        } else {
            if ($up_konten == 'Persediaan Akhir / Pemasok') {
?>
                <script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
                
                <script>
                    $('.select2').select2();

                    $('#pemasok').select2({
                        placeholder: 'Pilih Pemasok'
                    });
                    
                    $('.rupiah').mask('0.000.000.000,00', {
                        placeholder: 'Nilai',
                        reverse: true
                    });
                </script>
<?php
            } else {
?>                      
                <script>
                    $('.telepon').mask('000 0000 0000 00', {
                        placeholder: 'No. Telepon'
                    });

                    $('.kode_pos').mask('00000', {
                        placeholder: 'Kode Pos'
                    });
                </script>
<?php
            }
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
                        $url = base_url().'Pemasok/Tambah_'.str_replace(' ', '', $up_konten).'_Proses';
                    } else {
                        $url = base_url().'Pemasok/Ubah_'.str_replace(' ', '', $up_konten).'_Proses';
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
                                window.location.replace('<?php echo base_url().'Pemasok/'.str_replace(' ', '', $up_konten).'?pesan='.$pesan;  ?>');
                            } else {
<?php
                                switch ($up_konten) {
                                    case 'Data Pemasok' :
?>
                                        if (data.no_pemasok !== '') {
                                            $('#no_pemasok').addClass('animated tada has-error').append(data.no_pemasok);
                                        };

                                        if (data.nama_pemasok !== '') {
                                            $('#nama_pemasok').addClass('animated tada has-error').append(data.nama_pemasok);
                                        };

                                        if (data.no_telepon_1 !== '') {
                                            $('#no_telepon_1').addClass('animated tada has-error').append(data.no_telepon_1);
                                        };

                                        if (data.email !== '') {
                                            $('#email').addClass('animated tada has-error').append(data.email);
                                        };

                                        if (data.website !== '') {
                                            $('#website').addClass('animated tada has-error').append(data.website);
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
<?php
                                        break;
                                    case 'Persediaan Akhir / Pemasok' :
?>
                                        if (data.pemasok !== '') {
                                            $('#pemasok_select').addClass('animated tada has-error').append(data.pemasok);
                                        };

                                        if (data.persediaan_akhir !== '') {
                                            $('#persediaan_akhir_form').addClass('animated tada has-error').append(data.persediaan_akhir);
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
        }
    }
?>