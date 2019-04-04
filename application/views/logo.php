<?php
    foreach ($perusahaan as $data) {
?>
        <a <?php if ($konten == 'Menu Utama') { echo 'id="tanpa_menubar_logo"'; } ?> href="<?php echo $data->Website; ?>" class="<?php if ($konten == 'Menu Utama') { echo 'navbar-brand'; } else { echo 'logo'; }?>" <?php if ($konten == 'Menu Utama') { echo 'style="background-color: transparent;"'; } ?>>
<?php
            if ($konten != 'Menu Utama') {
?>
                <span class="logo-mini">
                    <img src="<?php echo base_url().'assets/dist/img/logo/'.$data->Logo; ?>" class="img-circle" width="32px" height="40px">
                </span>
<?php
            }
?>
            <span class="logo-lg">
                <img src="<?php echo base_url().'assets/dist/img/logo/'.$data->Logo; ?>" class="img-circle" width="32px" height="40px">
            
                <b>
<?php
                    echo strtoupper($data->NamaPerusahaan);
?>
                </b>
            </span>
        </a>
<?php
    }
?>