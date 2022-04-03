<table>
    <tr>
        <td width="370">
            <img src="./assets/img/main-logo.png" width="60" height="60" alt=""><br>
            <b>IKARHOLAZ</b>
        </td>
        <td width="370" style="text-align:right">
            <h1 style="margin:0;">Invoice <br>#<?=$data->checkout_id?></h1>
            <span><?=$data->created_at?></span>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <hr>

            <p>
            Yth. <?=$data->subject->name?>,<br><br>
            Terima kasih sudah melakukan pembayaran dan berpartisipasi untuk program "<?=$data->data->name?>". <br><br>
            Berikut adalah rincian transaksi anda<br>
            <br><br>
            <table cellspacing="5" cellpadding="5" align="center">
                <tr>
                    <td>Metode Pembayaran</td>
                    <td>: <?=$data->pg->Data->Channel.' ('.$data->pg->Data->Via.')'?></td>
                </tr>
                <tr>
                    <td>Nomor Pembayaran</td>
                    <td>: 
                        <?php if($data->pg->Data->Channel == 'QRIS') : ?>
                            <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?=$data->pg->Data->PaymentNo?>&choe=UTF-8" title="QRIS" />
                        <?php else: ?>
                            <?=$data->pg->Data->PaymentNo?>
                        <?php endif ?>
                    </td>
                </tr>
                <tr>
                    <td>Nama Pembayaran</td>
                    <td>: <?=$data->pg->Data->PaymentName?></td>
                </tr>
                <tr>
                <td>Total Pembayaran</td>
                <td>: Rp. <?=number_format($data->pg->Data->Total)?></td>
                </tr>
                <?php if($data->status == 'checkout'): ?>
                <tr>
                    <td>Berlaku Sampai</td>
                    <td>: <?=$data->pg->Data->Expired?></td>
                </tr>
                <?php elseif($data->status == 'confirm'): ?>
                <tr>
                    <td>Status</td>
                    <td>: Pembayaran diterima</td>
                </tr>
                <?php endif ?>
            </table>
            </p>
        </td>
    </tr>
</table>