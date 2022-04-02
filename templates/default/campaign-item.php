<div class="card card-profile">
    <div class="card-header" style="background-image: url('<?=base_url().'/'.$campaign->pic_url?>');background-size:cover">
    </div>
    <div class="card-body">
        <div class="user-profile text-center">
            <div class="name"><?=$campaign->name?></div>
            <div class="job"><?=html_entity_decode($campaign->summary)?></div>
            <div class="view-profile">
                <a href="<?=routeTo('default/campaign-detail',['id'=>$campaign->id],1)?>" class="btn btn-secondary btn-block">Lihat Detail Kampanye</a>
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