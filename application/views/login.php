
<!DOCTYPE html>
<html>



<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <title>Konco.co</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/dist/assets/images/logo/favicon.png">

    <!-- plugins css -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.css" />

    <!-- core css -->
    <link href="<?php echo base_url() ?>assets/dist/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/dist/assets/css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/dist/assets/css/app.css" rel="stylesheet">
</head>

<body>
    <div class="app">
        <div class="authentication">
            <div class="sign-in-2">
                <div class="container-fluid no-pdd-horizon bg" style="background-image: url('<?php echo base_url() ?>assets/dist/assets/images/others/clear.png')">
                    <div class="row">
                        <div class="col-md-10 mr-auto ml-auto">
                            <div class="row">
                                <div class="mr-auto ml-auto full-height height-100">
                                    <div class="vertical-align full-height">
                                        <div class="table-cell">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="pdd-horizon-30 pdd-vertical-30">
                                                        <div class="mrg-btm-30">
                                                            <h2 class="inline- center no-mrg-vertical pdd-top-15"><center>SI POINT of SALES</h2>
                                                                <h2 class="inline- center no-mrg-vertical pdd-top"><center>DD - OPTIK</h2>
                                                                </div>
                                                                <p class="mrg-btm-5 font-size-13">Masukkan username dan password untuk masuk</p>
                                                                <?php echo form_open('Auth/login') ?>
                                                                <div class="form-group">
                                                                    <input type="text" name="username" required="" class="form-control" placeholder="User name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="password" required="" name="password" class="form-control" placeholder="Password">
                                                                </div>
                                                                <div class="mrg-top-20 text-right">

                                                                    <button type="submit" name="submit" class="btn btn-info">Login</button>
                                                                </div>
                                                                <p class="mrg-btm-15 font-size-9">*Kontak Admin jika lupa username dan password</p>
                                                                <?php form_close() ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="<?php echo base_url() ?>assets/dist/assets/js/vendor.js"></script>

            <script src="<?php echo base_url() ?>assets/dist/assets/js/app.min.js"></script>

            <!-- page js -->
        </body>
        </html>