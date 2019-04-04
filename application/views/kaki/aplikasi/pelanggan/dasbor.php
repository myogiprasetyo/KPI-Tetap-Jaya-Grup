<script src="<?php echo base_url(); ?>assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.min.js"></script>

<script>
    $(function() {
        "use strict";
        
        $('.connectedSortable').sortable({
            placeholder         : 'sort-highlight',
            connectWith         : '.connectedSortable',
            handle              : '.box-header, .nav-tabs',
            forcePlaceholderSize: true,
            zIndex              : 999999
        });
        
        $('.connectedSortable .box-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move');

        var bar = new Morris.Bar({
            element: 'bar-chart',
            resize: true,
            data: [
<?php
                    for ($bulan = 1; $bulan <= 7; $bulan++) {
?>
                        {
                            y: '<?php echo $nilai[$bulan]['Bulan']; ?>',
<?php
                            $abjad = range('A', 'E');
                
                            foreach ($abjad as $data) {
?>
                                <?php echo $data; ?>: <?php echo number_format($nilai[$bulan][$data], 1); ?>,
<?php
                            }
?>
                        },
<?php
                    }
?>
                ],
            barColors: ['#0073b7', '#00a65a', '#f39c12', '#ff7701', '#dd4b39'],
            xkey: 'y',
            ykeys: ['A', 'B', 'C', 'D', 'E'],
            labels: ['A', 'B', 'C', 'D', 'E'],
            hideHover: 'auto'
        });
    });
</script>