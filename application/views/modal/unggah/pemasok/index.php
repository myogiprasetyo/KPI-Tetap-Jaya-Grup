<div class="modal fade" id="modal-unggah">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form" role="form" class="form-horizontal" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center"><b>Unggah <?php echo $konten; ?></b></h4>
                </div>
                
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <input type="file" id="unggah" name="unggah" accept=".xlsx" required>
                            
                            Ukuran Maks <b>5MB</b> dan Format File <b>.xlsx</b>.<br>
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
                   </div>
                </div>

                <div class="modal-footer">
                    <button id="validasi_unggah" type="button" class="btn btn-success">
                        <span class="fa fa-upload"></span> Unggah
                    </button>
                    
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">
                        <span class="fa fa-mail-forward"></span> Kembali
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>