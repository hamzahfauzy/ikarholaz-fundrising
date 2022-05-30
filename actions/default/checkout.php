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
    $subject = $db->insert('subjects',$_POST['subjects']);
    $pg_requests = $_POST['transactions']['pg_requests'];

    if($pg_requests['payment_method'] == 'cash')
    {
        $unique_id = strtotime('now').rand(0,1000);
        $payment = json_decode('{
            "Status": 200,
            "Message": "success",
            "Data": {
              "SessionId": "'.$unique_id.'",
              "TransactionId": '.$unique_id.',
              "ReferenceId": "'.$unique_id.'",
              "Via": "CASH",
              "Channel": "cash",
              "PaymentNo": "'.$unique_id.'",
              "PaymentName": "CASH",
              "Total": '.$_POST['transactions']['amount'].',
              "Fee": 0,
              "Expired": "'.date('Y-m-d H:i:s', strtotime('+1 day')).'"
            }
        }');
    }
    else
    {
        $ipaymu = new Ipaymu;
        $payment = $ipaymu->directPayment([
            'referenceId' => $data->id,
            'name' => $data->name,
            'subject' => $_POST['subjects'],
            'payment_method' => $pg_requests['payment_method'],
            'payment_channel' => $pg_requests['payment_channel'],
            'amount' => $_POST['transactions']['amount']
        ]);
    }
    $_POST['transactions']['checkout_id'] = $payment->Data->TransactionId;
    $_POST['transactions']['subject_id'] = $subject->id;
    $_POST['transactions']['destination_type'] = $type;
    $_POST['transactions']['destination_id'] = $id;
    $_POST['transactions']['status'] = 'checkout';
    $_POST['transactions']['pg_requests'] = serialize($pg_requests);
    $_POST['transactions']['pg_response'] = serialize($payment);
    $transaction = $db->insert('transactions',$_POST['transactions']);

    $va = $payment->Data->Via == 'VA' ? '_Nomor VA_ : '. $payment->Data->PaymentNo : ($payment->Data->Via == 'CASH' ? 'Hubungi mimin untuk info/panduan pembayaran CASH.' :'');

    $detail_url = routeTo('default/transaction-detail',['id'=>$transaction->id],true);
    $message = '*IKARHOLAZ - FUNDRAISING*
_Notifikasi Tagihan Pembayaran *#'.$payment->Data->TransactionId.'*_

Hai kak '.$_POST['subjects']['name'].'

Terima kasih sudah berpartisipasi dalam program *"'.$data->name.'"* pada tanggal *'.date('d-m-Y H:i').'* dengan menggunakan metode pembayaran *'.$pg_requests['payment_method'].' - '.$pg_requests['payment_channel'].'*. Silahkan klik link dibawah ini untuk menyelesaikan pembayaran:

'.$detail_url.'

_Total Pembayaran_ *'.number_format($_POST['transactions']['amount']).'*

'.$va.'

_Jangan lewatkan kesempatan Anda menjadi #OrangBaik._
_Kami berharap Anda dapat menyelesaikan pembayaran sebelum *'.$payment->Data->Expired.'*_

_Keterangan:_
1. Jika link tidak muncul harap simpan dulu nomor pengirim ke daftar kontak Anda (kebijakan security Whatsapp)
2. Update penerimaan dan penggunaan donasi dapat dilihat di aplikasi galang dana IKARHOLAZ FUNDRAISING menu LAPORAN.

Terima kasih,
*IKARHOLAZ FUNDRAISING*
_part of Sistem Informasi Rholaz (SIR) 2022_

Info ini hanya sebagai pemberitahuan. Mohon tidak di-reply dan abaikan jika sudah membayar. Jika ada pertanyaan silakan hubungi langsung di inbox@ikarholaz.com atau di +62 838-0661-1212';

    WaBlast::send($_POST['subjects']['phone'], $message);

    header('location:'.$detail_url);

    die();
}

return compact('data','rel');