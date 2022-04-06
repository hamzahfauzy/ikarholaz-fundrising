<?php load_templates('layouts/default-top-without-nav') ?>
<style>.btn-pc:focus {background: red!important;}</style>
<form action="" method="post" onsubmit="return false;" id="checkoutform">
    <div class="row mt-5 mx-auto rounded bg-light shadow-sm" style="max-width:500px;overflow:hidden;">
        <div class="col-12 col-md-3 p-0">
            <img src="<?= base_url().'/'.$data->pic_url?>" alt="<?=$data->name?>" width="100%" height="100%" style="object-fit:cover" class="mb-2">
        </div>
        <div class="col-12 col-md-9">
            <div class="p-2">
                <i><b><?= $_GET['type'] == 'campaigns' ? 'Kampanye' : 'Donasi' ?></b></i><br>
                <small>Terima kasih telah berdonasi untuk</small><br>
                <h2 class="primary-color"><?= $data->name ?></h2>
            </div>
        </div>
    </div>

    <div class="row mt-3 pb-4 mx-auto rounded bg-light shadow-sm" style="max-width:500px;overflow:hidden;">
        <div class="col-12 px-3 pt-3 pb-2">
            <b>Pilih Nominal Pembayaran</b>
        </div>

        <?php foreach($data->amounts as $amount): ?>
        <div class="col-12 col-md-6 mb-3">
            <button type="button" class="btn btn-secondary btn-block" onclick="document.querySelector('#amount').value=<?=$amount->amount?>">Rp. <?=number_format($amount->amount)?></button>
        </div>
        <?php endforeach ?>

        <div class="col-12">
            <div class="form-group p-0">
                <label>atau Ketik Nominal</label>
                <input type="number" id="amount" name="transactions[amount]" class="form-control" placeholder="Rp. 0" required>

            </div>
        </div>
    </div>

    <div class="row mt-3 pb-4 mx-auto rounded bg-light shadow-sm" style="max-width:500px;overflow:hidden;">
        <div class="col-12 px-3 pt-3 pb-2">
            <div class="form-group p-0 mb-3">
                <label>Info Donatur</label>
            </div>

            <div class="form-group p-0 mb-3">
                <input type="text" name="subjects[name]" class="form-control mb-2" placeholder="Nama Lengkap" required>
                <div class="d-flex align-items-center">
                    <input type="checkbox" id="is_anonim" name="subjects[is_anonim]" value="1" class="form-control" style="width:auto;margin-right:10px">
                    <label for="is_anonim" style="margin:0">
                        Tampilkan sebagai hamba Allah
                    </label>
                </div>
            </div>
            <div class="form-group p-0 mb-3">
                <input type="number" name="subjects[phone]" class="form-control" placeholder="No. WA, Format : 081234xxxxx" required>
            </div>
            <div class="form-group p-0 mb-3">
                <input type="email" name="subjects[email]" class="form-control" placeholder="Email" required>
            </div>
            <div class="form-group p-0 mb-3">
                <input type="text" name="subjects[NRA]" class="form-control" placeholder="Tahun Lulus : Opsional">
            </div>
        </div>
    </div>

    <div class="row mt-3 pb-4 mx-auto rounded bg-light shadow-sm" style="max-width:500px;overflow:hidden;">
        <div class="col-12 px-3 pt-3">
            <div class="form-group p-0">
                <label>Pilih Metode Pembayaran</label>
            </div>
        </div>
        <?php foreach(config('payment_methods') as $payment_method): ?>
        <div class="col-12">
            <label for=""><?=$payment_method['name']?></label>
        </div>

        <?php foreach($payment_method['items'] as $key => $item): ?>
        <div class="col-12 col-md-6 mb-2">
            <button type="button" onclick="setPgRequest('<?=$payment_method['code']?>','<?=$item?>')" class="btn btn-secondary btn-block btn-pc"><?=$key?></button>
        </div>
        <?php endforeach ?>
        <?php endforeach ?>
    </div>

    <div class="row mt-3 mx-auto" style="max-width:500px;">
        <input type="hidden" name="transactions[pg_requests][payment_method]" id="payment_method">
        <input type="hidden" name="transactions[pg_requests][payment_channel]" id="payment_channel">
        <button class="btn btn-primary btn-block" id="submit-btn" onclick="doSubmit()">LANJUTKAN PEMBAYARAN</button>
        <a href="<?=routeTo('default/'.$rel.'-detail',['id'=>$data->id],true)?>" class="btn btn-warning btn-block">KEMBALI</a>
    </div>
</form>
<script>
function setPgRequest(pm, pc)
{
    document.querySelector('#payment_method').value = pm
    document.querySelector('#payment_channel').value = pc
}

function doSubmit()
{
    var pm = document.querySelector('#payment_method').value
    var pc = document.querySelector('#payment_channel').value

    if(pm == '' || pc == '')
    {
        alert('Metode pembayaran harus di pilih')
        return
    }

    document.querySelector('#checkoutform').submit()
}

document.body.addEventListener('click', function(event)
{
    if(event.target.id == 'submit-btn' || event.target.classList.contains('btn-pc'))
    {
        return
    }

    setPgRequest('','')
    
})
</script>