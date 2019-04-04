<script src="<?php echo base_url(); ?>assets/plugins/jQueryMask/jquery.mask.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>

<script>
    $('.tanggal').mask('00/00/0000', {
        placeholder: '__/__/____'
    });
        
    $('.select2').select2();
        
    $('#pemasok').select2({
        placeholder: 'Pilih Pemasok'
    });
    
    $('#pemasok_unduh').select2({
        placeholder: 'Pilih Pemasok'
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

        <script>
            var table = $('#tabel').DataTable( {
                responsive: true
            });
            
            $('#tanggal_1').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true
            });

            $('#tanggal_2').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true
            });
        </script>
<?php        
        if ($konten != 'Pembayaran Pembelian') {
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
                        url:'<?php echo base_url().'Pemasok/Unggah_'.str_replace(' ', '', $konten).'_Proses'; ?>', 
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
        if ($up_konten == 'Pembayaran Pembelian') {
?>
            <script>
                $('#tanggal_1').datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true
                });

                $('#tanggal_2').datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true
                });
            </script>
<?php
        } else {
?>
            <script>
                $('.tanggal').datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true
                });
            </script>
<?php
        }
?>
        <script>
            $('.rupiah').mask('0.000.000.000,00', {
                placeholder: 'Nilai',
                reverse: true
            });
        </script>

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
                        } else if (data == 'invalid_nilai') {
<?php
                            switch ($up_konten) {
                                case 'Pesanan Pembelian' :
?>
                                    $('#diterima').addClass('animated tada has-error').append('<p><span class="animated tada help-block fa fa-times-circle-o"> Jumlah PO tidak boleh dikuraingi</span></p>');
<?php
                                    break;
                                case 'Faktur Pembelian' :
?>
                                    $('#nilai_faktur').addClass('animated tada has-error').append('<p><span class="animated tada help-block fa fa-times-circle-o"> Nilai Faktur tidak boleh lebih besar dari Pesanan yang sedang diproses</span></p>');
<?php
                                    break;
                            }
?>
                        } else {
<?php
                            switch ($up_konten) {
                                case 'Pesanan Pembelian' :
?>
                                    if (data.no_po !== '') {
                                        $('#no_po_disabled').addClass('animated tada has-error').append(data.no_po);
                                    };

                                    if (data.pemasok !== '') {
                                        $('#pemasok_select').addClass('animated tada has-error').append(data.pemasok);
                                    };

<?php
                                    if ($konten == 'Tambah') {
?>
                                        if (data.jumlah !== '') {
                                            $('#jumlah').addClass('animated tada has-error').append(data.jumlah);
                                        };
<?php
                                    } else {
?>
                                        if (data.diproses !== '') {
                                            $('#diproses').addClass('animated tada has-error').append(data.diproses);
                                        };
<?php
                                    }
                                        
                                    break;    
                                case 'Faktur Pembelian' :
?>
                                    if (data.no_faktur !== '') {
                                        $('#no_faktur_disabled').addClass('animated tada has-error').append(data.no_faktur);
                                    };

                                    if (data.pemasok !== '') {
                                        $('#pemasok_select').addClass('animated tada has-error').append(data.pemasok);
                                    };

                                    if (data.nilai_faktur !== '') {
                                        $('#nilai_faktur').addClass('animated tada has-error').append(data.nilai_faktur);
                                    };

                                    if (data.no_po !== '') {
                                        $('#no_po_disabled').addClass('animated tada has-error').append(data.no_po);
                                    };
<?php
                                    break;
                                case 'Pembayaran Pembelian' :
?>
                                    if (data.no_pembayaran !== '') {
                                        $('#no_pembayaran_disabled').addClass('animated tada has-error').append(data.no_pembayaran);
                                    };

                                    if (data.pemasok !== '') {
                                        $('#pemasok_select').addClass('animated tada has-error').append(data.pemasok);
                                    };

                                    if (data.total_faktur !== '') {
                                        $('#total_faktur_form').addClass('animated tada has-error').append(data.total_faktur);
                                    };

                                    if (data.no_cek !== '') {
                                        $('#no_cek').addClass('animated tada has-error').append(data.no_cek);
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
        if ($konten == 'Tambah' || $konten == 'Dorong') {
            switch ($up_konten) {
                case 'Pesanan Pembelian' :
                    $nomor = 'no_po';
                    $nota = 'PB';
                    break;
                case 'Faktur Pembelian' :
                    $nomor = 'no_faktur';
                    $nota = 'FB';
                    
                    if ($konten == 'Tambah') {
?>
                        <script>
                            $('#po').select2({
                                placeholder: 'Pilih No. PO'
                            });
                        </script>
<?php
                    }
?>                  
                    <script>
                        $('#pemasok').change(function() {
                            $('#po #select_isi').remove();
                                
                            var pemasok = $('#pemasok').val();
                            var pilihan = 'No. PO';

                            $.ajax({
                                url: '<?php echo base_url().'Pemasok/Proses/Pilihan/AmbilData'; ?>',
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    no_pemasok : pemasok, 
                                    pilihan : pilihan
                                },
                                success: function(data) {
                                    for(i = 0; i < data.length; i++) {
                                        $('#po').append( '<option id="select_isi" value="' + data[i].NoPO + '">' + data[i].NoPO + '</option>');
                                    }
                                }
                            })
                        });
                    </script>
<?php
                    break;
                case 'Pembayaran Pembelian' :
                    $nomor = 'no_pembayaran';
                    $nota = 'BB';
?>                      
                    
                    <script>
                        $('#pemasok').change(function() {
                            $('#faktur #select_isi').remove();

                            var pemasok = $('#pemasok').val();
                            var pilihan = 'No. Faktur';

                            $.ajax({
                                url: '<?php echo base_url().'Pemasok/Proses/Pilihan/AmbilData'; ?>',
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    no_pemasok : pemasok, 
                                    pilihan : pilihan
                                },
                                success: function(data) {
                                    for(i = 0; i < data.length; i++) {
                                        $('#faktur').append('<option id="select_isi" value="' + data[i].NoFaktur + '">' + data[i].NoFaktur + '</option>');
                                    }   

                                    $('#total_faktur').val('');
                                }
                            })
                        });

                        $('#faktur').change(function() {
                            $('#total_faktur').val('');

                            $('#faktur option:selected').each(function() {
                                var no_faktur = $(this).val();
                                var pilihan = 'Nilai Faktur';
                                    
                                $.ajax({
                                    url: '<?php echo base_url().'Pemasok/Proses/Pilihan/AmbilData'; ?>',
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {
                                        no_faktur : no_faktur,
                                        pilihan : pilihan
                                    },
                                    success: function(data) {
                                        var nilai = 0;

                                        if ($('#total_faktur').val() == '') {
                                            nilai = parseFloat(data[0].NilaiFaktur).toFixed(2);
                                        } else {
                                            nilai = (parseFloat(($('#total_faktur').val().split('.').join('')).split(',').join('.')) + parseFloat(data[0].NilaiFaktur)).toFixed(2);
                                        }

                                        $('#total_faktur').mask('0.000.000.000,00', {reverse: true}).val(nilai).trigger('input');
                                    }
                                })

                            });
                        });
                    </script>
<?php
                    break;
            }
            
            if ($konten == 'Dorong') {
?>
                <script>
                    $('#<?php echo $nomor; ?>').val(<?php if ($konten == 'Dorong') { echo "$('#pemasok_disabled').val().substr(0, 3)"; } else { echo "$('#pemasok').val()"; } ?> + $('.tanggal').val().substr(6, 4) + $('.tanggal').val().substr(3, 2) + $('.tanggal').val().substr(0, 2) + '<?php echo $nota; ?>' + '<?php echo $nomor_auto; ?>');
                </script>
<?php 
            }
?>
            <script>
                $('.tanggal').change(function() {
                    $('#<?php echo $nomor; ?>').val(<?php if ($konten == 'Dorong') { echo "$('#pemasok_disabled').val().substr(0, 3)"; } else { echo "$('#pemasok').val()"; } ?> + $('.tanggal').val().substr(6, 4) + $('.tanggal').val().substr(3, 2) + $('.tanggal').val().substr(0, 2) + '<?php echo $nota; ?>' + '<?php echo $nomor_auto; ?>');
                });

                $('#pemasok').change(function() {
                    $('#<?php echo $nomor; ?>').val($('#pemasok').val() + $('.tanggal').val().substr(6, 4) + $('.tanggal').val().substr(3, 2) + $('.tanggal').val().substr(0, 2) + '<?php echo $nota; ?>' + '<?php echo $nomor_auto; ?>');
                });
            </script>
<?php 
        }
    }
?>