<aside class="main-sidebar">
    <section class="sidebar">
        <form action="<?php echo site_url(); ?>Pengaturan" method="post" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="cari_menu" class="form-control" placeholder="Cari Halaman">
                <span class="input-group-btn">
                    <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="header text-center">MENU PENGATURAN</li>
            <li <?php if ($konten == 'Profil Saya') { echo 'class="active"'; } ?>>
                <a href="<?php echo site_url(); ?>Pengaturan">
                    <i class="fa fa-user"></i> <span>Profil Saya</span>
                </a>
            </li>
            
            <li class="treeview <?php if (($konten == 'Karyawan' || (!empty($up_konten) && $up_konten == 'Karyawan')) || ($konten == 'Pengguna Aplikasi' || (!empty($up_konten) && $up_konten == 'Pengguna Aplikasi'))) { echo 'active'; } ?>">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Daftar</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                
                <ul class="treeview-menu">
                    <li <?php if ($konten == 'Karyawan' || (!empty($up_konten) && $up_konten == 'Karyawan')) { echo 'class="active"'; } ?>><a href="<?php echo site_url(); ?>Pengaturan/Karyawan"><i class="fa fa-circle-o"></i> Karyawan</a></li>
                    <li <?php if ($konten == 'Pengguna Aplikasi' || (!empty($up_konten) && $up_konten == 'Pengguna Aplikasi')) { echo 'class="active"'; } ?>><a href="<?php echo site_url(); ?>Pengaturan/PenggunaAplikasi"><i class="fa fa-circle-o"></i> Pengguna Aplikasi</a></li>
                </ul>
            </li>
            
            <li class="treeview <?php if (($konten == 'Info Perusahaan' || (!empty($up_konten) && $up_konten == 'Info Perusahaan')) || ($konten == 'Pengaturan Aplikasi' || (!empty($up_konten) && $up_konten == 'Pengaturan Aplikasi'))) { echo 'active'; } ?>">
                <a href="#">
                    <i class="fa fa-gear"></i>
                    <span>Preferensi</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                
                <ul class="treeview-menu">
                    <li <?php if ($konten == 'Info Perusahaan' || (!empty($up_konten) && $up_konten == 'Info Perusahaan')) { echo 'class="active"'; } ?>><a href="<?php echo site_url(); ?>Pengaturan/InfoPerusahaan"><i class="fa fa-circle-o"></i> Info Perusahaan</a></li>
                    <li <?php if ($konten == 'Pengaturan Aplikasi' || (!empty($up_konten) && $up_konten == 'Pengaturan Aplikasi')) { echo 'class="active"'; } ?>><a href="<?php echo site_url(); ?>Pengaturan/PengaturanAplikasi"><i class="fa fa-circle-o"></i> Pengaturan Aplikasi</a></li>
                </ul>
            </li>
            
            <li <?php if ($konten == 'Tentang' || (!empty($up_konten) && $up_konten == 'Tentang')) { echo 'class="active"'; } ?>>
                <a href="<?php echo site_url(); ?>Pengaturan/Tentang">
                    <i class="fa fa-info"></i> <span>Tentang</span>
                </a>
            </li>
        </ul>
    </section>
</aside>