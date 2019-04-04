<?php
    if ($konten != 'Autentikasi') {
?>
        <footer class="main-footer">         
<?php
        if ($konten != 'Menu Utama') {
            foreach ($aplikasi as $data) {
?>
                <div class="pull-right hidden-xs">
<?php
                        echo $data->NamaAplikasi;
?>                
                    <b>
<?php
                        echo $data->Versi;
?>
                    </b>
                </div>

<?php
            }
        }
            
        foreach ($perusahaan as $data) {
            if ($konten == 'Menu Utama') {
?>
                <div class="container">
<?php
            }
?>
            <strong>
                Copyright &copy; 2018

                <a href="<?php echo $data->Website; ?>">
<?php
                    echo $data->NamaPerusahaan.'.';
?>
                </a>
            </strong>
                
            &nbsp;All rights reserved.
<?php
            if ($konten == 'Menu Utama') {
?>
                </div>
<?php
            }
        }
    }
?>
        </footer>
    </div>
    
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/fastclick/lib/fastclick.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/demo.min.js"></script>
<?php
    if ($konten == 'Autentikasi') {
        require_once 'autentikasi.php';
    } else if ($konten == 'Menu Utama') {
        require_once 'menuutama.php';
    } else {
        require_once 'aplikasi/index.php';
    }
?>
</body>