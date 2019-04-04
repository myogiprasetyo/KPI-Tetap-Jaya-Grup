<section class="content">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="animated fadeInUp nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#line-chart" data-toggle="tab">Grafik Area</a>
                    </li>
                    
                    <li>
                        <a href="#sales-chart" data-toggle="tab">Grafik Donut</a>
                    </li>
                </ul>
                
                <div class="tab-content">
                    <div class="chart tab-pane active" id="line-chart" style="position: relative; height: 300px;"></div>
                    
                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
                </div>
                <div class="box-footer">
                    <a href="<?php echo site_url(); ?>Pelanggan/NilaiPelanggan" class="btn btn-default pull-right">
                        <span class="fa fa-mail-forward"></span> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>