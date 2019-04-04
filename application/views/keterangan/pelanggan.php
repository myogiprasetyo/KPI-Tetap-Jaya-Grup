<li>
    Gunakan <i>button</i>
            
    <button class="btn btn-xs btn-success"><span class="fa fa-edit"></span> Ubah</button>
            
    untuk merubah
            
    <b>
<?php
        echo $up_konten;
?>
    </b>
            
    setelah Anda melakukan perubahan data.
</li>
                
<li>
    Gunakan <i>button</i>
            
    <button class="btn btn-xs btn-danger"><span class="fa fa-trash"></span> Hapus</button>
            
    untuk menghapus 
            
    <b>
<?php
        echo $up_konten;
?>
    </b>
            
    .
</li>
                
<?php
        if (substr($up_konten, -9) != 'Penjualan') {
?>
            <li>
                <b>
<?php
                    echo $up_konten;
?>
                </b>
                
                yang telah memiliki <b>Transaksi lain</b> dapat <b>di Ubah</b> tetapi tidak dapat <b>di Hapus</b>.
            </li>
<?php
        }
                
        if ($up_konten == 'Data Pemasok' || $up_konten == 'Data Rayon' || $up_konten == 'Data Penjual') {
?>
            <li>
                Pilih <i>tab</i> <b>Lain - Lain</b> untuk merubah status menjadi <b>Tidak Aktif</b> pada
                        
                <b>
<?php
                    echo $up_konten;
?>
                </b>
                        
                yang telah memiliki <b>Transaksi</b>.
            </li>
<?php
        }
?>