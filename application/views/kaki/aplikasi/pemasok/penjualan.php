<script src="<?php echo base_url(); ?>assets/plugins/jQueryMask/jquery.mask.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>

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

            $('#tanggal_1').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true
            });

            $('#tanggal_2').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true
            });
                
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
                        } else {
                            if (data.pemasok !== '') {
                                $('#pemasok_select').addClass('animated tada has-error').append(data.pemasok);
                            };

                            if (data.penjualan !== '') {
                                $('#penjualan_form').addClass('animated tada has-error').append(data.penjualan);
            
                            };

                            if (data.laba_kotor !== '') {
                                $('#laba_kotor_form').addClass('animated tada has-error').append(data.laba_kotor);
                            };
                        };
                    }
                });
            });
        </script>
<?php
    }
?>