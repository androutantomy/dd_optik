<!DOCTYPE html>
<html>



<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <title>Konco.co </title>

    <!-- Favicon -->


    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/dist/assets/images/logo/favicon.png">

    <!-- plugins css -->
    <script src="<?php echo base_url() ?>assets/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/PACE/themes/red/pace-theme-minimal.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/summernote/dist/summernote.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/assets/css/sweetalert.css" />
    <!-- page plugins css -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bower-jvectormap/jquery-jvectormap-1.2.2.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/nvd3/build/nv.d3.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables/media/css/jquery.dataTables.css" />

    <!-- core css -->
    <link href="<?php echo base_url() ?>assets/dist/assets/css/ei-icon.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/dist/assets/css/themify-icons.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/dist/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/dist/assets/css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/dist/assets/css/app.css" rel="stylesheet">

</head>
<body>

    <div class="app is-collapsed">

        <div class="layout">

            <!-- Side Nav START -->
            <div class="side-nav">
                <div class="side-nav-inner">
                    <div class="side-nav-logo">
                        <a href="">
                            <!-- <p class="mrg-btm-15 font-size-15">Konco.co</p> -->
                            <div class="logo logo-dark" style="background-image: url('<?php echo base_url() ?>assets/images/logo/dd-logo.png')"></div>
                            <!-- <div class="logo logo-white" style="background-image: url('<?php echo base_url() ?>assets/images/logo/dd-logo.png')"></div> -->
                        </a><br><br>
                        <div class="mobile-toggle side-nav-toggle">
                            <a href="#">
                                <i class="ti-arrow-circle-left"></i>
                            </a>
                        </div>
                    </div>
                    <ul class="side-nav-menu scrollable mrg-top-30">
                        <li class="nav-item ">
                            <a href="<?= site_url('dashboard') ?>">
                                <span class="icon-holder"><i class="ei-bank"></i></span>
                                <span class="title">DASHBOARD</span>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class='dropdown-toggle' href='javascript:void(0);'>
                                <span class='icon-holder'><i class='ei-business-card'></i></span>
                                <span class='title'>MASTER DATA</span>
                                <span class='arrow'><i class='ti-angle-right'></i></span>
                            </a>
                            <ul class='dropdown-menu'>
                                <li class="nav-item">
                                    <a href="<?= site_url('master-data-gudang') ?>">
                                        <span class='arrow'><i class='ti-angle-left'></i></span>
                                        <span class='title'>Master Gudang</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class='dropdown-menu'>
                                <li class="nav-item">
                                    <a href="<?= site_url('master-data-jenis-barang') ?>">
                                        <span class='arrow'><i class='ti-angle-left'></i></span>
                                        <span class='title'>Master Jenis Barang</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class='dropdown-menu'>
                                <li class="nav-item">
                                    <a href="<?= site_url('master-frame') ?>">
                                        <span class='arrow'><i class='ti-angle-left'></i></span>
                                        <span class='title'>Master Frame</span>
                                    </a>
                                </li>
                            </ul>                            
                            <ul class='dropdown-menu'>
                                <li class="nav-item">
                                    <a href="<?= site_url('master-cairan') ?>">
                                        <span class='arrow'><i class='ti-angle-left'></i></span>
                                        <span class='title'>Master Cairan</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item ">
                            <a href="<?= site_url('dashboard') ?>">
                                <span class="icon-holder"><i class="ei-diamond"></i></span>
                                <span class="title">RE-STOK TOKO</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- Side Nav END -->

            <!-- Page Container START -->
            <div class="page-container">
                <!-- Header START -->
                <div class="header navbar">
                    <div class="header-container">
                        <ul class="nav-left">
                            <li>
                                <a class="side-nav-toggle" href="javascript:void(0);">
                                    <i class="ti-view-grid"></i>
                                </a>
                            </li>

                        </li>
                    </ul>

                    <ul class="nav-right">
                        <li class="user-profile dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                                <div class="user-info">
                                    <span class="name pdd-right-5"><?php echo $this->session->userdata('nama_lengkap') ?></span>
                                    <i class="ti-angle-down font-size-10"></i>
                                </div>
                            </a>
                            <ul class="dropdown-menu">

                                <li role="separator" class="divider"></li>
                                <li>
                                    <?php echo anchor('Auth/logout', '<i class="ti-power-off pdd-right-10"></i>
                                    <span>Logout</span>') ?>


                                </li>
                            </div>
                        </div>
                        <!-- Header END -->


                        <div class="main-content content">
                            <div class="container-fluid">