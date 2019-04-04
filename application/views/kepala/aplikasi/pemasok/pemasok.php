<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/all.css">
<?php
    if ($konten == 'Persediaan Akhir / Pemasok' || $up_konten == 'Persediaan Akhir / Pemasok') {
?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<?php
    }

    if (empty($up_konten)) {
?>
        
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/fixedHeader.bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
<?php
    } else {
        if ($up_konten == 'Nilai / Pemasok') {
?>
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.css">
<?php
        } else if ($up_konten == 'Persediaan Akhir / Pemasok') {
?>
                <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2.min.css">
<?php
        }
    }
?>