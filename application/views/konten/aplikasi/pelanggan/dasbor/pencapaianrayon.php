<div id="dasbor_5" class="box box-info animated fadeInDown">
    <div class="box-header ui-sortable-handle" style="cursor: move;">
        <i class="fa fa-check-square-o"></i>

        <h3 class="box-title">Pencapaian / Rayon</h3>

        <div class="pull-right box-tools">
            <button type="button" class="btn btn-info btn-sm" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>

            <button type="button" class="btn btn-info btn-sm" data-widget="remove">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>

    <div class="box-body no-padding">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="header_nama">Rayon</th>
                    
                    <th class="header_rupiah text-center">Target / Hari</th>
                    
                    <th class="header_rupiah text-center">Pencapaian</th>
                    
                    <th class="header_status text-center" colspan="2">Persentase</th>
                </tr>
            </thead>

            <tbody>
<?php
                for ($no = 1; $no <= $limit_rayon; $no++) {
                    if ($pencapaian_rayon[$no]['Persentase'] >= 90.5) {
                        $warna_1 = 'blue';
                    } else if ($pencapaian_rayon[$no]['Persentase'] >= 80.5) {
                        $warna_1 = 'green';
                    } else if ($pencapaian_rayon[$no]['Persentase'] >= 70.5) {
                        $warna_1 = 'yellow';
                    } else if ($pencapaian_rayon[$no]['Persentase'] >= 60.5) {
                        $warna_1 = 'orange-active';
                    } else if ($pencapaian_rayon[$no]['Persentase'] < 60.5) {
                        $warna_1 = 'red';
                    } else {
                        $warna_1 = 'red';
                    }
?>
                    <tr>
                        <td>
<?php
                            echo $pencapaian_rayon[$no]['Rayon'];
?>
                        </td>
                        
                        <td>
                            <span class="label_rupiah">Rp. </span>
                            
                            <span class="pull-right">
<?php
                                echo number_format($pencapaian_rayon[$no]['Target'], 2, ',', '.');
?>
                            </span>
                        </td>
                        
                        <td>
                            <span class="label_rupiah">Rp. </span>
                            
                            <span class="pull-right">
<?php
                                echo number_format($pencapaian_rayon[$no]['Pencapaian'], 2, ',', '.');
?>
                            </span>
                        </td>
                        
                        <td class="header_status">
                            <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-<?php echo $warna_1; ?>" style="width: <?php echo $pencapaian_rayon[$no]['Persentase']; ?>%"></div>
                            </div>
                        </td>
                        
                        <td class="text-center">
                            <span class="label bg-<?php echo $warna_1; ?>">
<?php
                                echo number_format($pencapaian_rayon[$no]['Persentase'], 1, ',', '.').'%';
?>
                            </span>
                        </td>
                    </tr>
<?php
                }
                
                if ($total_pencapaian_rayon['Persentase'] >= 90.5) {
                    $warna_2 = 'blue';
                } else if ($total_pencapaian_rayon['Persentase'] >= 80.5) {
                    $warna_2 = 'green';
                } else if ($total_pencapaian_rayon['Persentase'] >= 70.5) {
                    $warna_2 = 'yellow';
                } else if ($total_pencapaian_rayon['Persentase'] >= 60.5) {
                    $warna_2 = 'orange-active';
                } else if ($total_pencapaian_rayon['Persentase'] < 60.5) {
                    $warna_2 = 'red';
                } else {
                    $warna_2 = 'red';
                }
?>
            </tbody>
            
            <tfoot>
                <tr>
                    <th class="text-center">Total</th>
                    
                    <th>
                        <span class="label_rupiah">Rp. </span>
                        
                        <span class="pull-right">
<?php
                            echo number_format($total_pencapaian_rayon['Target'], 2, ',', '.');
?>
                        </span>
                    </th>
                    
                    <th>
                        <span class="label_rupiah">Rp. </span>
                        
                        <span class="pull-right">
<?php
                            echo number_format($total_pencapaian_rayon['Pencapaian'], 2, ',', '.');
?>
                        </span>
                    </th>
                    
                    <td class="header_status">
                        <div class="progress progress-xs">
                            <div class="progress-bar progress-bar-<?php echo $warna_2; ?>" style="width: <?php echo $total_pencapaian_rayon['Persentase']; ?>%"></div>
                        </div>
                    </td>
                    
                    <th class="text-center">
                        <span class="label bg-<?php echo $warna_2; ?>">
<?php
                            echo number_format($total_pencapaian_rayon['Persentase'], 1, ',', '.').'%';
?>
                        </span>
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>