<script>
    document.getElementById('login_nik').addEventListener('keyup', function(event) {
        event.preventDefault();

        if (event.keyCode === 13) {
            document.getElementById('autentikasi').click();
        }
    });

    document.getElementById('login_password').addEventListener('keyup', function(event) {
        event.preventDefault();

        if (event.keyCode === 13) {
            document.getElementById('autentikasi').click();
        }
    });

    $('#autentikasi').click(function() {
        $('.login-box #keterangan').remove();

        $('.login-box').append('<div id="keterangan" class="alert alert-info alert-dismissible text-center"><span class="fa fa-spinner fa-spin"></span> Mohon tunggu sebentar</div>');

        var data = $('#form').serialize();

        $.ajax({
            url: '<?php echo base_url(); ?>Autentikasi/Login',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(data) {
                $('.login-box #keterangan').remove();
                $('div').removeClass('has-error');
                $('.form-group p').remove();

                if (data == 'login_sukses') {
                    window.location.replace('<?php echo base_url().'MenuUtama'; ?>');
                } else if (data == 'invalid_nik') {
                    $('.login-box').append('<div id="keterangan" class="alert alert-danger alert-dismissible text-center"><span class="fa fa-ban"></span> <b>NIK</b> Anda tidak terdaftar, silahkan hubungi bagian IT untuk mendaftarkan NIK Anda</div>');
                } else if (data == 'invalid_password') {
                    $('.login-box').append('<div id="keterangan" class="alert alert-danger alert-dismissible text-center"><span class="fa fa-ban"></span> <b>Password</b> Anda salah, coba lagi. Atau jika Anda lupa password, silahkan hubungi bagian IT untuk me-<i>reset</i> password Anda</div>');
                } else {
                    if (data.nik !== '') {
                        $('#nik').addClass('has-error').append(data.nik).children(':last').hide().fadeIn(1000);
                    };

                    if (data.password !== '') {
                        $('#password').addClass('has-error').append(data.password).children(':last').hide().fadeIn(1000);
                    };
                };
            }
        });
    });
</script>
