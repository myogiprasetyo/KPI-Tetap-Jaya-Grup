<script src="<?php echo base_url(); ?>assets/plugins/jQueryMask/jquery.mask.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>

<script>
    $('.tanggal').mask('00/00/0000', {
        placeholder: '__/__/____'
    });
        
    $('.select2').select2();
    
    $('#pelanggan').select2({
        placeholder: 'Pilih Pelanggan'
    });
    
    $('#penjual').select2({
        placeholder: 'Pilih Penjual'
    });
    
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });
</script>

<?php
    if (empty($up_konten)) {
?>
        <script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/dataTables.fixedHeader.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/responsive.bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-filestyle/src/bootstrap-filestyle.min.js"></script>

        <script>
            var table = $('#tabel').DataTable( {
                responsive: true
            });
        
            $('#unggah').filestyle({
                dragdrop: false,
                btnClass: 'btn-primary',
                htmlIcon : '<span class="glyphicon glyphicon-folder-open"></span>',
                text: '',
                placeholder : 'Pilih File'
            });
            
            $('#tanggal_1').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true
            });

            $('#tanggal_2').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true
            });

            $('#pelanggan_unduh').select2({
                placeholder: 'Pilih Pelanggan'
            });
            
            $('#penjual_unduh').select2({
                placeholder: 'Pilih Penjual'
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
?>
        <script>
            $('.tanggal').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true
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
                                case 'Faktur Penjualan' :
?>
                                    if (data.no_faktur !== '') {
                                        $('#no_faktur_disabled').addClass('animated tada has-error').append(data.no_faktur);
                                    };

                                    if (data.pelanggan !== '') {
                                        $('#pelanggan_select').addClass('animated tada has-error').append(data.pelanggan);
                                    };
                            
                                    if (data.penjual !== '') {
                                        $('#penjual_select').addClass('animated tada has-error').append(data.penjual);
                                    };

                                    if (data.nilai_faktur !== '') {
                                        $('#nilai_faktur').addClass('animated tada has-error').append(data.nilai_faktur);
                                    };
<?php
                                    break;
                                case 'Retur Penjualan' :
?>
                                    if (data.no_retur !== '') {
                                        $('#no_retur_disabled').addClass('animated tada has-error').append(data.no_retur);
                                    };

                                    if (data.pelanggan !== '') {
                                        $('#pelanggan_select').addClass('animated tada has-error').append(data.pelanggan);
                                    };

                                    if (data.penjual !== '') {
                                        $('#penjual_select').addClass('animated tada has-error').append(data.penjual);
                                    };
                            
                                    if (data.nilai_retur !== '') {
                                        $('#nilai_retur').addClass('animated tada has-error').append(data.nilai_retur);
                                    };
<?php
                                    break;
                                case 'Laba Kotor Penjualan' :
?>
                                    if (data.pelanggan !== '') {
                                        $('#pelanggan_select').addClass('animated tada has-error').append(data.pelanggan);
                                    };
                                    
                                    if (data.penjual !== '') {
                                        $('#penjual_select').addClass('animated tada has-error').append(data.penjual);
                                    };

                                    if (data.laba_kotor !== '') {
                                        $('#laba_kotor_form').addClass('animated tada has-error').append(data.laba_kotor);
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
        if ($up_konten != 'Laba Kotor Penjualan' ) {
            if ($konten == 'Tambah') {
                switch ($up_konten) {
                    case 'Faktur Penjualan' :
                        $nomor = 'no_faktur';
                        break;
                    case 'Retur Penjualan' :
                        $nomor = 'no_retur';
                        break;
                }
?>
                <script>
                    
                    $('.tanggal').change(function() {
                        $('#<?php echo $nomor; ?>').val($('#penjual').val() + '.' + $('.tanggal').val().substr(6, 4) + $('.tanggal').val().substr(3, 2) + $('.tanggal').val().substr(0, 2) + '.' + '<?php echo $nomor_auto; ?>');
                    });
                    
                    $('#penjual').change(function() {
                        $('#<?php echo $nomor; ?>').val($('#penjual').val() + '.' + $('.tanggal').val().substr(6, 4) + $('.tanggal').val().substr(3, 2) + $('.tanggal').val().substr(0, 2) + '.' + '<?php echo $nomor_auto; ?>');
                    });
                </script>
<?php
            }
        }
    }
?>