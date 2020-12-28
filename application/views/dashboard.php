    <div class="container-fluid">
        <div class="page-title">
            <h4>SELAMAT DATANG!</h4>
        </div>
        <div class="container">





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
                                            <p class="no-mrg-btm">List Penjualan Cairan</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card" id="ask-1">
                        <div class="card-block">
                            <ul class="list-unstyled list-info">
                                <li>
                                    <span class="thumb-img pdd-top-10">
                                        <i class="ti-money text-primary font-size-30"></i>
                                    </span>
                                    <div class="info">
                                        <b class="text-dark font-size-22">Penjualan</b>
                                        <p class="no-mrg-btm ">Penjualan kacamata terbaru</p>
                                    </div>
                                </li>
                            </ul>
                            <div class="mrg-top-30">
                                <div id="accordion-ask-1" class="accordion border-less" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab">
                                            <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion-ask-1" href="#collapse-ask-1">
                                                    <span>Penjualan Kacamata</span>
                                                    <i class="icon ti-arrow-circle-down"></i> 
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse-ask-1" class="collapse panel-collapse show">
                                            <div class="panel-body">
                                                <div class="form-group row">
                                                    <?php foreach($listnya as $val) { 
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
                                                        <div class="col-md-12">              
                                                            <div class="card">
                                                                <div class="card-block">
                                                                    <h4 class="card-title mrg-btm-5">Summary</h4>
                                                                    <div class="border bottom">
                                                                        <p><?= $val->nama ?></p>
                                                                        <p>Status:  &nbsp;<span class="pull-right"> <?= $status; ?></span></p>
                                                                    </div>
                                                                    <p class="mrg-top-5">Total: <span class="pull-right text-dark font-size-18"><b><?= "Rp. ".number_format($val->harga_keterangan+$val->harga_frame+$val->harga_lensa); ?></b></span></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card" id="ask-2">
                        <div class="card-block">
                            <ul class="list-unstyled list-info">
                                <li>
                                    <span class="thumb-img pdd-top-10">
                                        <i class="ti-money text-success font-size-30"></i>
                                    </span>
                                    <div class="info">
                                        <b class="text-dark font-size-22">Penjualan Cairan</b>
                                        <p class="no-mrg-btm">Penjualan cairan terbaru</p>
                                    </div>
                                </li>
                            </ul>
                            <div class="mrg-top-30">
                                <div id="accordion-ask-2" class="accordion border-less" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab">
                                            <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion-ask-2" href="#collapse-ask-4">
                                                    <span>Penjualan Cairan</span>
                                                    <i class="icon ti-arrow-circle-down"></i> 
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse-ask-4" class="collapse panel-collapse show">
                                            <div class="panel-body">
                                                <div class="form-group row">
                                                    
                                                    <?php foreach($listnya2 as $val) { ?>
                                                        <div class="col-md-12">              
                                                            <div class="card">
                                                                <div class="card-block">
                                                                    <h4 class="card-title mrg-btm-5">Summary</h4>
                                                                    <div class="border bottom">
                                                                        <p><?= $val->nama ?></p>
                                                                        <p>Jenis:  &nbsp;<span class="pull-right"> <?= $val->id_jenis == 1 ? 'Cairan' : 'Softlense'; ?></span></p>
                                                                    </div>
                                                                    <p class="mrg-top-5">Total: <span class="pull-right text-dark font-size-18"><b><?= "Rp. ".number_format($val->nominal); ?></b></span></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
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
<script src="<?php echo base_url() ?>assets/dist/assets/js/extras/faq.js"></script>
