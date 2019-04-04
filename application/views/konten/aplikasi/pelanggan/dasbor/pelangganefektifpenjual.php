<div id="dasbor_3" class="box box-warning animated fadeInDown">
    <div class="box-header ui-sortable-handle" style="cursor: move;">
        <i class="fa fa-shopping-cart"></i>

        <h3 class="box-title">Pelanggan Efektif / Penjual</h3>

        <div class="pull-right box-tools">
            <button type="button" class="btn btn-warning btn-sm" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>

            <button type="button" class="btn btn-warning btn-sm" data-widget="remove">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>

    <div class="box-body no-padding">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="header_nama">Penjual</th>
                    
                    <th class="header_status text-center">Target / Hari</th>
                    
                    <th class="header_status text-center">Sudah Belanja</th>
                    
                    <th class="header_status text-center">Belum Belanja</th>
                    
                    <th class="header_status text-center" colspan="2">Persentase</th>
                </tr>
            </thead>

            <tbody>
<?php
                for ($no = 1; $no <= $limit_penjual; $no++) {
                    if ($pelanggan_efektif_penjual[$no]['Persentase'] >= 90.5) {
                        $warna_1 = 'blue';
                    } else if ($pelanggan_efektif_penjual[$no]['Persentase'] >= 80.5) {
                        $warna_1 = 'green';
                    } else if ($pelanggan_efektif_penjual[$no]['Persentase'] >= 70.5) {
                        $warna_1 = 'yellow';
                    } else if ($pelanggan_efektif_penjual[$no]['Persentase'] >= 60.5) {
                        $warna_1 = 'orange-active';
                    } else if ($pelanggan_efektif_penjual[$no]['Persentase'] < 60.5) {
                        $warna_1 = 'red';
                    } else {
                        $warna_1 = 'red';
                    }
?>
                    <tr>
                        <td>
<?php
                            echo $pelanggan_efektif_penjual[$no]['Penjual'];
?>
                        </td>
                        
                        <td class="text-center">
<?php
                            echo $pelanggan_efektif_penjual[$no]['Target'].' Pelanggan';
?>
                        </td>
                        
                        <td class="text-center">
<?php
                            echo $pelanggan_efektif_penjual[$no]['Sudah Belanja'].' Pelanggan';
?>
                        </td>
                        
                        <td class="text-center">
<?php
                            echo $pelanggan_efektif_penjual[$no]['Belum Belanja'].' Pelanggan';
?>
                        </td>
                        
                        <td class="header_status">
                            <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-<?php echo $warna_1; ?>" style="width: <?php echo $pelanggan_efektif_penjual[$no]['Persentase']; ?>%"></div>
                            </div>
                        </td>
                        
                        <td class="text-center">
                            <span class="label bg-<?php echo $warna_1; ?>">
<?php
                                echo number_format($pelanggan_efektif_penjual[$no]['Persentase'], 1, ',', '.').'%';
?>
                            </span>
                        </td>
                    </tr>
<?php
                }
                
                if ($total_pelanggan_efektif_penjual['Persentase'] >= 90.5) {
                    $warna_2 = 'blue';
                } else if ($total_pelanggan_efektif_penjual['Persentase'] >= 80.5) {
                    $warna_2 = 'green';
                } else if ($total_pelanggan_efektif_penjual['Persentase'] >= 70.5) {
                    $warna_2 = 'yellow';
                } else if ($total_pelanggan_efektif_penjual['Persentase'] >= 60.5) {
                    $warna_2 = 'orange-active';
                } else if ($total_pelanggan_efektif_penjual['Persentase'] < 60.5) {
                    $warna_2 = 'red';
                } else {
                    $warna_2 = 'red';
                }
?>
            </tbody>
            
            <tfoot>
                <tr>
                    <th class="text-center">Total</th>
                    
                    <th class="text-center">
<?php
                        echo $total_pelanggan_efektif_penjual['Target'].' Pelanggan';
?>
                    </th>
                    
                    <th class="text-center">
<?php
                        echo $total_pelanggan_efektif_penjual['Sudah Belanja'].' Pelanggan';
?>
                    </th>
                    
                    <th class="text-center">
<?php
                        echo $total_pelanggan_efektif_penjual['Belum Belanja'].' Pelanggan';
?>
                    </th>
                    
                    <td class="header_status">
                        <div class="progress progress-xs">
                            <div class="progress-bar progress-bar-<?php echo $warna_2; ?>" style="width: <?php echo $total_pelanggan_efektif_penjual['Persentase']; ?>%"></div>
                        </div>
                    </td>
                    
                    <th class="text-center">
                        <span class="label bg-<?php echo $warna_2; ?>">
<?php
                            echo number_format($total_pelanggan_efektif_penjual['Persentase'], 1, ',', '.').'%';
?>
                        </span>
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>