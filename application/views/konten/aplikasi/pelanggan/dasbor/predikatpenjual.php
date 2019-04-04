<div id="dasbor_2" class="box box-danger animated fadeInDown">
    <div class="box-header ui-sortable-handle" style="cursor: move;">
        <i class="fa fa-bar-chart"></i>

        <h3 class="box-title">Predikat / Penjual</h3>

        <div class="pull-right box-tools">
            <button type="button" class="btn btn-danger btn-sm" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>

            <button type="button" class="btn btn-danger btn-sm" data-widget="remove">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>

    <div class="box-body no-padding">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="header_nama">Penjual</th>
                    
                    <th class="header_status text-center">Predikat A</th>
                    
                    <th class="header_status text-center">Predikat B</th>
                    
                    <th class="header_status text-center">Predikat C</th>
                    
                    <th class="header_status text-center">Predikat D</th>
                    
                    <th class="header_status text-center">Predikat E</th>
                    
                    <th class="header_status text-center" colspan="2">Persentase Predikat A & B</th>
                </tr>
            </thead>

            <tbody>
<?php
                for ($no = 1; $no <= $limit_penjual; $no++) {
                    if ($predikat_penjual[$no]['Pesentase Predikat A & B'] >= 90.5) {
                        $warna_1 = 'blue';
                    } else if ($predikat_penjual[$no]['Pesentase Predikat A & B'] >= 80.5) {
                        $warna_1 = 'green';
                    } else if ($predikat_penjual[$no]['Pesentase Predikat A & B'] >= 70.5) {
                        $warna_1 = 'yellow';
                    } else if ($predikat_penjual[$no]['Pesentase Predikat A & B'] >= 60.5) {
                        $warna_1 = 'orange-active';
                    } else if ($predikat_penjual[$no]['Pesentase Predikat A & B'] < 60.5) {
                        $warna_1 = 'red';
                    } else {
                        $warna_1 = 'red';
                    }
?>
                    <tr>
                        <td>
<?php
                            echo $predikat_penjual[$no]['Penjual'];
?>
                        </td>
                        
                        <td class="text-center">
<?php
                            echo $predikat_penjual[$no]['Predikat A'].' Pelanggan';
?>
                        </td>
                        
                        <td class="text-center">
<?php
                            echo $predikat_penjual[$no]['Predikat B'].' Pelanggan';
?>
                        </td>
                        
                        <td class="text-center">
<?php
                            echo $predikat_penjual[$no]['Predikat C'].' Pelanggan';
?>
                        </td>
                        
                        <td class="text-center">
<?php
                            echo $predikat_penjual[$no]['Predikat D'].' Pelanggan';
?>
                        </td>
                        
                        <td class="text-center">
<?php
                            echo $predikat_penjual[$no]['Predikat E'].' Pelanggan';
?>
                        </td>
                        
                        <td class="header_status">
                            <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-<?php echo $warna_1; ?>" style="width: <?php echo $predikat_penjual[$no]['Pesentase Predikat A & B']; ?>%"></div>
                            </div>
                        </td>
                        
                        <td class="text-center">
                            <span class="label bg-<?php echo $warna_1; ?>">
<?php
                                echo number_format($predikat_penjual[$no]['Pesentase Predikat A & B'], 1, ',', '.').'%';
?>
                            </span>
                        </td>
                    </tr>
<?php
                    }
                
                    if ($total_predikat_penjual['Persentase'] >= 90.5) {
                        $warna_2 = 'blue';
                    } else if ($total_predikat_penjual['Persentase'] >= 80.5) {
                        $warna_2 = 'green';
                    } else if ($total_predikat_penjual['Persentase'] >= 70.5) {
                        $warna_2 = 'yellow';
                    } else if ($total_predikat_penjual['Persentase'] >= 60.5) {
                        $warna_2 = 'orange-active';
                    } else if ($total_predikat_penjual['Persentase'] < 60.5) {
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
                        echo $total_predikat_penjual['Predikat A'].' Pelanggan';
?>
                    </th>
                    
                    <th class="text-center">
<?php
                        echo $total_predikat_penjual['Predikat B'].' Pelanggan';
?>
                    </th>
                    
                    <th class="text-center">
<?php
                        echo $total_predikat_penjual['Predikat C'].' Pelanggan';
?>
                    </th>
                    
                    <th class="text-center">
<?php
                        echo $total_predikat_penjual['Predikat D'].' Pelanggan'; ?></th>
                    
                    <th class="text-center"><?php echo $total_predikat_penjual['Predikat E']; ?> Pelanggan</th>
                    
                    <td class="header_status">
                        <div class="progress progress-xs">
                            <div class="progress-bar progress-bar-<?php echo $warna_2; ?>" style="width: <?php echo $total_predikat_penjual['Persentase']; ?>%"></div>
                        </div>
                    </td>
                    <th class="text-center">
                        <span class="label bg-<?php echo $warna_2; ?>"><?php echo number_format($total_predikat_penjual['Persentase'], 1, ',', '.'); ?>%</span>
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>