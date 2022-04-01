<?php load_templates('layouts/default-top-without-nav') ?>
<div class="row mt-5 mx-auto rounded bg-light shadow-sm" style="max-width:500px;overflow:hidden;">
    <div class="col-12 col-md-3 p-0">
        <img src="<?= $data->data->pic_url?>" alt="<?=$data->data->name?>" width="100%" height="100%" style="object-fit:cover" class="mb-2">
    </div>
    <div class="col-12 col-md-9">
        <div class="p-2">
            <i><b><?= $data->destination_type == 'campaigns' ? 'Kampanye' : 'Donasi' ?></b></i><br>
            <small>Terima kasih telah berdonasi untuk</small><br>
            <h2 class="primary-color"><?= $data->data->name ?></h2>
        </div>
    </div>
</div>

<div class="row mt-3 pb-4 mx-auto rounded bg-light shadow-sm" style="max-width:500px;overflow:hidden;">
    <div class="col-12 px-3 pt-3 pb-2">
        <div class="form-group p-0 mb-3">
        <b>Metode Pembayaran - <?=$data->pg->Data->Channel.' ('.$data->pg->Data->Via.')'?></b>
        </div>

        <div class="form-group p-0 mb-3">
            <label for="">Nomor Pembayaran</label>
            <p><?=$data->pg->Data->PaymentNo?></p>
        </div>
        <div class="form-group p-0 mb-3">
            <label for="">Nama Pembayaran</label>
            <p><?=$data->pg->Data->PaymentName?></p>
        </div>
        <div class="form-group p-0 mb-3">
            <label for="">Total Pembayaran</label>
            <p>Rp. <?=number_format($data->pg->Data->Total)?></p>
        </div>
        <?php if($data->status == 'checkout'): ?>
        <div class="form-group p-0 mb-3">
            <label for="">Berlaku Sampai</label>
            <p><?=$data->pg->Data->Expired?></p>
        </div>
        <?php elseif($data->status == 'confirm'): ?>
        <div class="form-group p-0 mb-3">
            <label for="">Status</label>
            <p>Pembayaran diterima</p>
        </div>
        <?php endif ?>

        <a href="index.php?r=default/<?=$data->destination_type?>" class="btn btn-block btn-warning">Kembali</a>
    </div>
</div>