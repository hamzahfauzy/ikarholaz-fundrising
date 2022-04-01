<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                        <h5 class="text-white op-7 mb-2">Fundrising Dashboard</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row mt--2">
                <div class="col col-md-6">
                    <div class="card full-height">
                        <div class="card-body">
                            <div class="card-title">Total transaksi sukses dan pending</div>
                            <div class="row py-3">
                                <div class="col d-flex flex-column justify-content-around">
                                    <div>
                                        <h6 class="fw-bold text-uppercase text-success op-8">Total Transaksi Sukses</h6>
                                        <h3 class="fw-bold">Rp. <?=number_format($transaction_success->total)?></h3>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-uppercase text-danger op-8">Total Transaksi Pending</h6>
                                        <h3 class="fw-bold">Rp. <?=number_format($transaction_pending->total)?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php load_templates('layouts/bottom') ?>