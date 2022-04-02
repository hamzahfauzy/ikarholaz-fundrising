<div class="card card-profile">
    <div class="card-header" style="background-image: url('<?=base_url().'/'.$donation->pic_url?>');background-size:cover">
    </div>
    <div class="card-body">
        <div class="user-profile text-center">
            <div class="name"><?=$donation->name?></div>
            <div class="job"><?=html_entity_decode($donation->summary)?></div>
            <div class="view-profile">
            <a href="<?=routeTo('default/donation-detail',['id'=>$donation->id], true)?>" class="btn btn-secondary btn-block">Lihat Detail Donasi</a>
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