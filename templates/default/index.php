<?php load_templates('layouts/default-top') ?>
    <div class="content mt-4">
        <h1 class="text-center">Semua Kampanye</h1>
    </div>

    <div class="row">
        <?php if(empty($campaigns)): ?>
        <div class="col text-center">
            <i>Tidak ada data!</i>
        </div>
        <?php endif ?>
        <?php foreach($campaigns as $campaign): ?>
        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-header" style="background-image: url('<?=$campaign->pic_url?>');background-size:cover">
                </div>
                <div class="card-body">
                    <div class="user-profile text-center">
                        <div class="name"><?=$campaign->name?></div>
                        <div class="job"><?=html_entity_decode($campaign->summary)?></div>
                        <div class="view-profile">
                            <a href="index.php?r=default/campaign-detail&id=<?=$campaign->id?>" class="btn btn-secondary btn-block">Lihat Detail Kampanye</a>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row user-stats text-center">
                        <div class="col">
                        <div class="number">Rp. <?=number_format($campaign->total_transaction->total)?></div>
                            <div class="title">Terkumpul</div>
                        </div>
                        <div class="col">
                            <div class="number">Rp. <?=number_format($campaign->amount_target)?></div>
                            <div class="title">Target</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    </div>

    <div class="content mt-4">
        <h1 class="text-center">Semua Donasi</h1>
    </div>

    <div class="row">
        <?php if(empty($donations)): ?>
        <div class="col text-center">
            <i>Tidak ada data!</i>
        </div>
        <?php endif ?>
        <?php foreach($donations as $donation): ?>
        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-header" style="background-image: url('<?=$campaign->pic_url?>');background-size:cover">
                </div>
                <div class="card-body">
                    <div class="user-profile text-center">
                        <div class="name"><?=$donation->name?></div>
                        <div class="job"><?=html_entity_decode($donation->summary)?></div>
                        <div class="view-profile">
                        <a href="index.php?r=default/donation-detail&id=<?=$donation->id?>" class="btn btn-secondary btn-block">Lihat Detail Donasi</a>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row user-stats text-center">
                        <div class="col">
                        <div class="number">Rp. <?=number_format($donation->total_transaction->total)?></div>
                            <div class="title">Terkumpul</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    </div>
<?php load_templates('layouts/default-bottom') ?>