<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Versi Aplikasi</b> 0.0.1 (Beta)
    </div>

    <strong>Copyright &copy; 2018 <a href="http://tejagrup.com">TETAP JAYA GRUP</a>.</strong> All rights reserved.
</footer>
</div>

<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/demo.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jQueryMask/jquery.mask.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/responsive.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
    
    $('.select2').select2();
    
    <?php if (empty($up_konten)) { ?>
        <?php if ($konten == 'Profil Saya' || $konten == 'Pengguna Aplikasi') { ?>
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
    
            <?php if ($konten == 'Profil Saya') { ?>
                $(document).ready(function(){
                    $('.nik').mask('00 0000 0 000', {
                        placeholder: '00 0000 0 000'
                    });

                    $('.tanggal').mask('00/00/0000', {
                            placeholder: '__/__/____'
                    });

                    $('#jabatan #select_isi').remove();

                    var devisi = $('#devisi').val();

                    $.ajax({
                        url: '<?php echo base_url().'Pengaturan/Proses/AmbilSelect/Jabatan'; ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: {Devisi : devisi},
                        success: function(data) {
                            for(i = 0; i < data.length; i++) {
                                if (devisi == data[i].Devisi) {
                                    var select = 'selected';
                                }
                                $('#jabatan').append('<option id="select_isi" value="' + data[i].Id + '" ' + select + '>' + data[i].Jabatan + '</option>');
                            }
                        }
                    });
                });

                $('#datepicker1').datepicker({
                        format: 'dd/mm/yyyy',
                        autoclose: true
                });

                $('#datepicker2').datepicker({
                        format: 'dd/mm/yyyy',
                        autoclose: true
                });

                $('#devisi').select2({
                    placeholder: 'Pilih Devisi'
                });

                $('#jabatan').select2({
                    placeholder: 'Pilih Jabatan'
                });

                $('#devisi').change(function() {
                    $('#jabatan #select_isi').remove();

                    var devisi = $('#devisi').val();

                    $.ajax({
                        url: '<?php echo base_url().'Pengaturan/Proses/AmbilSelect/Jabatan'; ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: {Devisi : devisi},
                        success: function(data) {
                            for(i = 0; i < data.length; i++) {
                                $('#jabatan').append('<option id="select_isi" value="' + data[i].Id + '">' + data[i].Jabatan + '</option>');
                            }
                        }
                    })
                });
            <?php } else if ($konten == 'Pengguna Aplikasi') { ?>
                $('#karyawan').select2({
                    placeholder: 'Pilih Karyawan'
                });
    
                $('#karyawan').change(function() {
                    $('#status #select_isi').remove();

                    var karyawan = $('#karyawan').val();

                    $.ajax({
                        url: '<?php echo base_url().'Pengaturan/Proses/AmbilSelect/HakAkses'; ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: {Karyawan : karyawan},
                        success: function(data) {
                            if (data.length = 1) {
                                $('#status').val(data[0].Status);
                                
                            } else {
                                $('#status').val('Tanpa Akses');
                            }
                        }
                    })
                });
            <?php } ?>
        <?php } else if ($konten == 'Karyawan') { ?>
            var table = $('#tabel').DataTable( {
                responsive: true
            });

            new $.fn.dataTable.FixedHeader(table);
        <?php } else { ?>

        <?php } ?>
      
    <?php } else { ?>
    <?php } ?>
</script>

</body>