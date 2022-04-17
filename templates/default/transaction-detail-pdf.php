<style>
#bg{
    margin-top: 0px;margin-left: 0px;
    padding-top:130px;
    height:86%;
    background:url(./assets/img/bg-nota.jpg);
    font-size:18px;
}
</style>
<div id="bg">
    <div style="width:100%;text-align:center">INVOICE</div>
    <div  style="width:100%;text-align:center">#<?=$data->checkout_id?></div>
    <div  style="width:100%;text-align:center;margin-bottom:15px"><?=_date($data->created_at)?></div>

    <div  style="width:100%;text-align:center">Yth, <?= $data->subject?$data->subject->name:'Hamba Allah'?></div>
    <div  style="width:100%;text-align:center">Terima kasih sudah melakukan pembayaran dan berpartisipasi untuk program </div>
    <div  style="width:100%;text-align:center"><strong>"<?=$data->data->name?>"</strong></div>
    <div  style="width:100%;text-align:center;margin-bottom:15px">Berikut adalah rincian transaksi donasi anda :</div>

    <div  style="width:100%;text-align:center">Nama : <?= $data->subject?$data->subject->name:'Hamba Allah'?></div>
    <div  style="width:100%;text-align:center">Tahun Lulus : <?=$data->subject?$data->subject->NRA:'-'?></div>
    <div  style="width:100%;text-align:center">Email : <?= $data->subject?$data->subject->email:'-'?></div>
    <div  style="width:100%;text-align:center">No. WA : <?= $data->subject?$data->subject->phone:'-'?></div>
    <?php if($data->pg): ?>
    <div  style="width:100%;text-align:center">Metode Pembayaran : <?= $data->pg->Data->Channel.' ('.$data->pg->Data->Via.')' ?></div>
    <?php endif ?>
    <div  style="width:100%;text-align:center">Tanggal Transaksi : <?= _date($data->created_at) ?></div>
    <div  style="width:100%;text-align:center">Tanggal Bayar : <?= _date($data->updated_at) ?></div>
    <div  style="width:100%;text-align:center;margin-bottom:15px"><strong>Total Bayar : <?= number_format($data->amount) ?></strong></div>
    <div  style="width:100%;text-align:center;margin-bottom:15px"></div>

    <div  style="width:100%;text-align:center">Terbilang: </div>
    <div  style="width:100%;text-align:center;margin-bottom:15px;font-style:italic;"><?= terbilang($data->amount) ?></div>
    <div  style="width:100%;text-align:center;margin-bottom:15px"></div>
    <div  style="width:100%;text-align:center">Semoga kebaikan Sdr/i <?= $data->subject?$data->subject->name:'Hamba Allah'?> diberikan balasan yang berlipat ganda. Amin.</div>
</div>