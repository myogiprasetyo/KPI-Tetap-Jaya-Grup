<div class="box box-primary animated fadeInDown">
    <div class="box-header ui-sortable-handle" style="cursor: move;">
        <i class="fa fa-bar-chart"></i>

        <h3 class="box-title">Predikat Pelanggan</h3>

        <div class="pull-right box-tools">
            <div class="btn-group">
                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-question"></i>
                </button>

                <ul id="ketentuan_predikat" class="dropdown-menu pull-right" role="menu">
                    <li><span class="label bg-blue">Predikat A = Nilai 100 - 90,5</span></li>
                    
                    <li><span class="label bg-green">Predikat B = Nilai 90,4 - 80,5</span></li>
                    
                    <li><span class="label bg-yellow">Predikat C = Nilai 80,4 - 70,5</span></li>
                    
                    <li><span class="label bg-orange-active">Predikat D = Nilai 70,4 - 60,5</span></li>
                    
                    <li><span class="label bg-red">Predikat E = Nilai < 60,5</span></li>
                </ul>
            </div>

            <button type="button" class="btn btn-primary btn-sm" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>

            <button type="button" class="btn btn-primary btn-sm" data-widget="remove">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>

    <div class="box-body no-padding">
        <div class="chart" id="bar-chart" style="height: 300px;"></div>
    </div>

    <div class="box-footer">
        <div class="row">
            <div class="col-sm-6">
<?php
                $abjad = range('A', 'C');
                
                foreach ($abjad as $predikat) {
                    switch ($predikat) {
                        case 'A' :
                            $warna = 'blue';
                            break;
                        case 'B' :
                            $warna = 'green';
                            break;
                        case 'C' :
                            $warna = 'yellow';
                            break;
                    }
?>
                <a href="<?php echo base_url().'Pelanggan/NilaiPelanggan?predikat='.$predikat; ?>">
                    <div class="info-box bg-<?php echo $warna; ?>">
                        <span class="info-box-icon"><?php echo $predikat; ?></span>

                        <div class="info-box-content">
                            <span class="info-box-number">
<?php
                                echo number_format($persentase[$predikat], 1, ',', '.').'%';
?>
                            </span>

                            <div class="progress">
                                <div class="progress-bar" style="width: <?php echo number_format($persentase[$predikat], 1, '.', ','); ?>%"></div>
                            </div>
                               
                            <span class="progress-description">
<?php
                                echo $nilai[$predikat].' dari '.$nilai['jumlah'].' Pelanggan';
?>
                            </span>
                        </div>
                    </div>
                </a>
<?php
                }
?>
            </div>
            
            <div class="col-sm-6">
<?php
                $abjad = range('D', 'E');
                
                foreach ($abjad as $predikat) {
                    switch ($predikat) {
                        case 'D' :
                            $warna = 'orange-active';
                            break;
                        case 'E' :
                            $warna = 'red';
                            break;
                    }
?>
                <a href="<?php echo base_url().'Pelanggan/NilaiPelanggan?predikat='.$predikat; ?>">
                    <div class="info-box bg-<?php echo $warna; ?>">
                        <span class="info-box-icon"><?php echo $predikat; ?></span>

                        <div class="info-box-content">
                            <span class="info-box-number">
<?php
                                echo number_format($persentase[$predikat], 1, ',', '.').'%';
?>
                            </span>

                            <div class="progress">
                                <div class="progress-bar" style="width: <?php echo number_format($persentase[$predikat], 1, '.', ','); ?>%"></div>
                            </div>
                                
                            <span class="progress-description">
<?php
                                echo $nilai[$predikat].' dari '.$nilai['jumlah'].' Pelanggan';
?>
                            </span>
                        </div>
                    </div>
                </a>
<?php
                }
?>
            </div>
        </div>
    </div>
</div>