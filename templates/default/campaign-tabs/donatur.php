<?php if(empty($campaign->transactions)): ?>
<center><i>Tidak ada data!</i></center>
<?php endif ?>
<?php foreach($campaign->transactions as $transaction): ?>
<div class="row mt-3 mx-auto rounded bg-white shadow-sm">
    <div class="col p-4">
        <span><?=$transaction->created_at?></span>
        <h3>Rp. <?=number_format($transaction->amount)?></h3>
        <h4 class="primary-color"><?= $transaction->subject->is_anonim ? 'Hamba Allah' : $transaction->subject->name ?></h4>
    </div>
</div>
<?php endforeach ?>