<div class="modal fade" id="modal-hapus">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                
                <h4 class="modal-title text-center"><b>Hapus <?php echo $up_konten.' '.$konten; ?></b></h4>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus <b><?php echo $konten; ?></b> dari <b><?php echo $up_konten; ?></b></p>
            </div>
            
            <div class="modal-footer">
<?php
                if (substr($konten, -9) == 'Pelanggan' || substr($up_konten, -9) == 'Pelanggan') {
                    require_once 'pelanggan.php';
                } else if (substr($konten, -5) == 'Rayon' || substr($up_konten, -5) == 'Rayon') {
                    require_once 'rayon.php';
                } else if (substr($konten, -7) == 'Penjual' || substr($up_konten, -7) == 'Penjual') {
                    require_once 'penjual.php';
                } else if (substr($konten, -9) == 'Penjualan' || substr($up_konten, -9) == 'Penjualan') {
                    require_once 'penjualan.php';
                }
?>
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><span class="fa fa-close"></span> Tidak</button>
            </div>
        </div>
    </div>
</div>