<div <?php if ($konten == 'Menu Utama' || $konten == 'Dasbor') { echo 'id="tanpa_menubar_miniprofil"'; } ?> class="navbar-custom-menu">
    <ul class="nav navbar-nav">
<?php
        if ($konten != 'Menu Utama' && empty($up_konten)) {
            require_once 'application/views/notifikasi/menubar/index.php';
        }

        foreach ($pengguna as $data) {
            if ($data->Foto == null) {
                if ($data->JenisKelamin == 'Laki - Laki') {
                    $foto = base_url().'assets/dist/img/profile_photo/default/male.png';
                } else if ($data->JenisKelamin == 'Perempuan') {
                    $foto = base_url().'assets/dist/img/profile_photo/default/female.png';
                }
            } else {
                $foto = base_url().'assets/dist/img/profile_photo/'.$data->Foto;
            }
?>
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo $foto; ?>" class="user-image" alt="<?php echo $data->NamaLengkap; ?>">
                    
                    <span class="hidden-xs">
<?php
                        echo $data->NamaLengkap;
?>
                   </span>
                </a>

                <ul class="dropdown-menu">
                    <li class="user-header">
                            <img src="<?php echo $foto; ?>" class="img-circle" alt="User Image">
                        <p>
<?php 
                            echo strtoupper($data->NamaLengkap);
?>
                            <br>
                            
                            <small>
<?php
                                echo strtoupper($data->Jabatan);
?>
                                <br>
                                
                                Terdaftar sejak
<?php
                                echo date('d', strtotime($data->TanggalMasuk)).' '.bulan(date('m', strtotime($data->TanggalMasuk)), 'F').' '.date('Y', strtotime($data->TanggalMasuk));
?>
                           </small>
                        </p>
                    </li>

                    <li class="user-footer">
                        <div class="col-md-12 text-center">
<?php
                            if ($konten == 'Menu Utama') {
?>
                                <a href="<?php echo site_url(); ?>Autentikasi/Logout" class="btn btn-default btn-flat col-md-12">Keluar</a>
<?php
                            } else {
?>
                                <a href="<?php echo site_url(); ?>MenuUtama" class="btn btn-default btn-flat col-md-12">Kembali ke Menu Utama</a>
<?php
                            }
?>
                        </div>
                    </li>
                </ul>
            </li>
<?php
        }
?>
    </ul>
</div>