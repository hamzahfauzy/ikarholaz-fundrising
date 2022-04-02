<?php load_templates('layouts/default-top') ?>
    <div class="row mt-5">
        <div class="col-12 col-md-8">
            <img src="<?= $donation->pic_url?>" alt="<?=$donation->name?>" width="100%" class="mb-2">
            <div class="py-3">
                <?= html_entity_decode($donation->summary) ?>
            </div>

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Detail</a>
                    <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Donatur</a>
                    <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Info Terbaru</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active p-3" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <?= html_entity_decode($donation->description) ?>
                </div>
                <div class="tab-pane fade p-3" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <?php require 'donation-tabs/donatur.php' ?>
                </div>
                <div class="tab-pane fade p-3" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <?php require 'donation-tabs/info.php' ?>
                </div>
            </div>
        </div>
        <div class="col col-md-4">
            <div class="card card-profile">
                <div class="card-body">
                    <div class="user-profile">
                        <small>Donasi</small>
                        <div class="name primary-color"><?=$donation->name?></div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row user-stats">
                        <div class="col">
                            <div class="number">Rp. <?=number_format($donation->total_transaction->total)?></div>
                            <div class="title">Dana Terkumpul</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="index.php?r=default/checkout&type=donations&id=<?=$donation->id?>" class="btn btn-primary btn-block">JOIN PROGRAM</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php load_templates('layouts/default-bottom') ?>