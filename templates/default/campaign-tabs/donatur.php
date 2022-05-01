<?php if(empty($campaign->transactions)): ?>
<center><i>Tidak ada data!</i></center>
<?php endif ?>
<?php foreach($campaign->transactions as $transaction): ?>
<div class="row mt-3 mx-auto rounded bg-white shadow-sm">
    <div class="col p-4">
        <div class="flex">
            <span><?= $transaction->subject->is_anonim ? 'Hamba Allah' : $transaction->subject->name ?></span>
            <span><?=$transaction->created_at?></span>
            <h3>Rp. <?=number_format($transaction->amount)?></h3>
        </div>
    </div>
</div>
<?php endforeach ?>