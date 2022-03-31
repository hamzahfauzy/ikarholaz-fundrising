<?php if(empty($campaign->transactions)): ?>
<center><i>Tidak ada data!</i></center>
<?php endif ?>
<?php foreach($campaign->transactions as $transaction): ?>
<div class="row">
    <div class="col col-md-3">
        
    </div>
    <div class="col col-md-9">
        <span><?=$transaction->created_at?></span>
        <h2>Rp. <?=number_format($transaction->amount)?></h2>
        <h3 class="primary-color"><?= $transaction->subject->is_anonim ? 'Hamba Allah' : $transaction->subject->name ?></h3>
    </div>
</div>
<?php endforeach ?>