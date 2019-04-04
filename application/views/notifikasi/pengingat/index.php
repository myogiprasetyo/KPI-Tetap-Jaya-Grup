<?php
    if ($notifikasi > 0) {
?>
        <div class="modal fade" id="modal-pengingat">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        
                        <h4 class="modal-title text-center">
                            <b>
<?php
                            echo 'Anda memiliki '.$notifikasi_total.' notifikasi';
?>
                            </b>
                        </h4>
                    </div>
                    
                    <div class="modal-body">
<?php
                        foreach ($aplikasi as $data) {
                            if ($data->NamaAplikasi == 'KPI Pemasok') {
                                require_once 'pemasok.php';
                            } else if ($data->NamaAplikasi == 'KPI Pelanggan') {
                                require_once 'pelanggan.php';
                            } else if ($data->NamaAplikasi == 'KPI Karyawan') {
                                require_once 'karyawan.php';
                            } else if ($data->NamaAplikasi == 'KPI Team') {
                                require_once 'tim.php';
                            } else if ($data->NamaAplikasi == 'Pengaturan') {
                                require_once 'pengaturan.php';
                            }
                        }
?>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="fa fa-check"></span> Oke</button>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
?>