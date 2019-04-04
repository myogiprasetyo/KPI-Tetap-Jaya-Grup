<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>
        KPI
<?php
        foreach ($perusahaan as $data) {
            echo strtoupper($data->NamaPerusahaan);
        }
?>
        |
<?php
        echo strtoupper($konten);
?>
    </title>

    <link rel="icon" href="<?php echo base_url(); ?>assets/dist/img/favicon/favicon.ico" type="image/x-icon">  
    
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
<?php
    if ($konten != 'Autentikasi' && $konten != 'Menu Utama') {
        require_once 'aplikasi/index.php';
    }
?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/GoogleSansProFont/GoogleSansPro.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/animate.css-master/animate.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/DIY.min.css">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>