<?php

$conn = conn();
$db   = new Database($conn);
$id   = $_GET['id'];
$type = $_GET['type'];
$rel  = rtrim($type, "s");

$data = $db->single($type,[
    'id' => $id
]);

$data->amounts = $db->all($rel.'_amounts',[
    $rel.'_id' => $id,
]);

if(request() == 'POST')
{
    $ipaymu = new Ipaymu;
    $payment = $ipaymu->directPayment([
        'referenceId' => $data->id,
        'name' => $data->name,
        'subject' => $_POST['subjects'],
        'payment_method' => $_POST['transactions']['pg_requests']['payment_method'],
        'payment_channel' => $_POST['transactions']['pg_requests']['payment_channel'],
        'amount' => $_POST['transactions']['amount']
    ]);

    $subject = $db->insert('subjects',$_POST['subjects']);
    $pg_requests = $_POST['transactions']['pg_requests'];
    $_POST['transactions']['checkout_id'] = $payment->Data->TransactionId;
    $_POST['transactions']['subject_id'] = $subject->id;
    $_POST['transactions']['destination_type'] = $type;
    $_POST['transactions']['destination_id'] = $id;
    $_POST['transactions']['status'] = 'checkout';
    $_POST['transactions']['pg_requests'] = serialize($pg_requests);
    $_POST['transactions']['pg_response'] = serialize($payment);
    $transaction = $db->insert('transactions',$_POST['transactions']);

    // print_r($payment);

    $detail_url = routeTo('default/transaction-detail',['id'=>$transaction->id],true);
    $message = '*IKARHOLAZ - GALANG DANA*
-Notifikasi Tagihan Pembayaran kode *#'.$payment->Data->TransactionId.'*-

Yth, '.$_POST['subjects']['name'].'

Terima kasih sudah berpartisipasi untuk program *"'.$data->name.'"* pada tanggal *'.date('d-m-Y H:i').'* dengan menggunakan metode pembayaran *'.$pg_requests['payment_method'].'*. Silahkan klik link dibawah ini untuk menyelesaikan pembayaran:

'.$detail_url.'

_Total Pembayaran_ *'.number_format($_POST['transactions']['amount']).'*

_Jangan lewatkan kesempatan Anda menjadi #OrangBaik._
_Kami berharap Anda dapat menyelesaikan pembayaran sebelum *'.$payment->Data->Expired.'*_

_Keterangan:_
1. Jika link tidak muncul harap simpan dulu nomor pengirim ke daftar kontak Anda (kebijakan security Whatsapp)
2. Update penerimaan dan penggunaan donasi dapat dilihat di aplikasi galang dana IKARHOLAZ menu LAPORAN.

Hormat kami,
*IKARHOLAZ*

Info ini hanya sebagai pemberitahuan. Mohon jangan di-reply dan abaikan jika sudah membayar. Jika ada pertanyaan silakan hubungi kami langsung di inbox@ikarholaz.com atau di +62 838-0661-1212
';

    WaBlast::send($_POST['subjects']['phone'], $message);

    header('location:'.$detail_url);

    die();
}

return compact('data','rel');