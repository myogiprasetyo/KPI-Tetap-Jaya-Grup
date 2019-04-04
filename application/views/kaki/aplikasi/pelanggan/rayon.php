<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>

<script>
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
            var table = $('#tabel').DataTable({
                responsive: true
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
                    $("#pesan").fadeTo(500, 0).slideUp(500, function() {
                        $(this).remove();
                    });
                }, 3000);
            </script>
<?php
        }
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
                        window.location.replace('<?php echo base_url().'Pelanggan/'.str_replace(' ', '', $up_konten).'?pesan='.$pesan; ?>');
                    } else {
                        if (data.kode_rayon !== '') {
                            $('#kode_rayon').addClass('animated tada has-error').append(data.kode_rayon);
                        };

                        if (data.nama_rayon !== '') {
                            $('#nama_rayon').addClass('animated tada has-error').append(data.nama_rayon);
                        };
                    };
                }
            });
        });
    </script>
<?php
    }
?>