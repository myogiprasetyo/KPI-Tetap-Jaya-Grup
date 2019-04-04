<div class="modal fade" id="modal-unduh">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?php echo site_url().'Pemasok/Unduh_'.str_replace(' ', '', $konten).'_Proses'; ?>" class="form-horizontal" method="get">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center"><b>Unduh <?php echo $konten; ?></b></h4>
                </div>
                
                <div class="modal-body">
<?php
                    if (substr($konten, -7) == 'Pemasok' || substr($up_konten, -7) == 'Pemasok') {
                        require_once 'pemasok.php';
                    } else if (substr($konten, -9) == 'Pembelian' || substr($up_konten, -9) == 'Pembelian') {
                        require_once 'pembelian.php';
                    } else if (substr($konten, -9) == 'Penjualan' || substr($up_konten, -9) == 'Penjualan') {
                        require_once 'penjualan.php';
                    }
?>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        <span class="fa fa-download"></span> Unduh
                    </button>
                    
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">
                        <span class="fa fa-mail-forward"></span> Kembali
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>