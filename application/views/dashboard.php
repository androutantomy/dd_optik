    <div class="container-fluid">
        <div class="page-title">
            <h4>SELAMAT DATANG!</h4>
        </div>
        <div class="container">
            <?php
            $tanggal = date('Y-m-d');
            $hari   = date('l', microtime($tanggal));
            $hari_indonesia = array(
                'Monday'  => 'Senin',
                'Tuesday'  => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday' => 'Kamis',
                'Friday' => 'Jumat',
                'Saturday' => 'Sabtu',
                'Sunday' => 'Minggu');
                ?>




                <div class="row">
                    <div class="col-md-4">
                        <div class="sticky">
                            <a href="#ask-1" class="card mrg-btm-15 scroll-to">
                                <div class="card-block padding-25">
                                    <ul class="list-unstyled list-info">
                                        <li>
                                            <span class="thumb-img pdd-top-10">
                                                <i class="ti-money text-primary font-size-30"></i>
                                            </span>
                                            <div class="info">
                                                <b class="text-dark font-size-18">Penjualan Kacamata</b>
                                                <p class="no-mrg-btm ">Penjualan kacamata</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </a>


                            <a href="#ask-2" class="card mrg-btm-15 scroll-to">
                                <div class="card-block padding-25">
                                    <ul class="list-unstyled list-info">
                                        <li>
                                            <span class="thumb-img pdd-top-10">
                                                <i class="ti-money text-success font-size-30"></i>
                                            </span>
                                            <div class="info">
                                                <b class="text-dark font-size-18">Penjualan Cairan</b>
                                                <p class="no-mrg-btm">Penjualan Cairan & Softlense</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8">

                        <div class="card calendar-event"  id="ask-1">
                            <div class="card-block overlay-dark bg" style="background-image: url(<?= base_url('assets/images/glases.jpg') ?>)">
                                <div class="text-center">
                                    <h1 class="font-size-65 text-light mrg-btm-5 lh-1">&nbsp;<span class="font-size-18">&nbsp;</span></h1>
                                    <h2 class="no-mrg-top">&nbsp;</h2>
                                </div>
                            </div>
                            <div class="card-block">
                                <button type="button" class="add-event btn-warning">
                                    <i class="ti-money "></i>
                                </button>
                                <ul class="event-list">

                                    <?php if(count($listnya) > 0) { foreach($listnya as $val) { 
                                        if ($val->status == 1) {
                                            $status = "Transaksi Baru";
                                        } elseif($val->status == 2) {
                                            $status = "Proses pesan lensa";
                                        } elseif($val->status == 3) {
                                            $status = "Lensa pesanan sampai";
                                        } else {
                                            $status = "Transaksi Selesai";
                                        }
                                        ?>


                                        <li class="event-items">
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#calendar-edit">
                                                <span class="bullet success"></span>
                                                <span class="event-name"> <?= $val->nama ?></span>
                                                <div class="event-detail">
                                                    <span><?= "Rp. ".number_format($val->harga_keterangan+$val->harga_frame+$val->harga_lensa); ?> - </span>
                                                    <i><?= $status; ?></i>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } } else { echo "Tidak ada data"; } ?>
                                </ul>
                            </div>
                        </div>


                        <div class="card calendar-event"  id="ask-2">
                            <div class="card-block overlay-dark bg" style="background-image: url(<?= base_url('assets/images/softlense.jpg') ?>)">
                                <div class="text-center">
                                    <h1 class="font-size-65 text-light mrg-btm-5 lh-1">&nbsp;<span class="font-size-18">&nbsp;</span></h1>
                                    <h2 class="no-mrg-top">&nbsp;</h2>
                                </div>
                            </div>
                            <div class="card-block">
                                <button type="button" class="add-event btn-warning">
                                    <i class="ti-money "></i>
                                </button>
                                <ul class="event-list">

                                    <?php if(count($listnya2) > 0) {  foreach($listnya2 as $val) { ?>

                                        <li class="event-items">
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#calendar-edit">
                                                <span class="bullet danger"></span>
                                                <span class="event-name"> <?= $val->nama ?></span>
                                                <div class="event-detail">
                                                    <span><?= "Rp. ".number_format($val->nominal); ?> - </span>
                                                    <i><?= $val->id_jenis == 1 ? 'Cairan' : 'Softlense'; ?></i>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } } else { echo "Tidak ada data"; } ?>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url() ?>assets/dist/assets/js/extras/faq.js"></script>
