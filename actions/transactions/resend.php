<?php

$conn = conn();
$db   = new Database($conn);

$data = $db->single('transactions',[
    'id' => $_GET['id']
]);

$data->pg = unserialize(html_entity_decode($data->pg_response));
$data->subject = $db->single('subjects',[
    'id' => $data->subject_id
]);

$data->data = $db->single($data->destination_type,[
    'id' => $data->destination_id
]);

$detail_url = routeTo('default/transaction-detail',['id'=>$data->id],true);
$message = '*IKARHOLAZ - GALANG DANA*
-Notifikasi Pembayaran kode *#'.$data->pg->Data->TransactionId.'* Berhasil-

Yth, '.$data->subject->name.'

Terima kasih sudah berpartisipasi untuk program *"'.$data->data->name.'"* pada tanggal pada tanggal *'.$data->created_at.'* dengan menggunakan metode pembayaran *'.$data->pg->Data->Channel.' - '.$data->pg->Data->Via.'*.  TELAH BERHASIL.

_Total Pembayaran_ *'.number_format($data->amount).'*

Semoga kebaikan Sdr/i '.$data->subject->name.' diberikan balasan yang berlipat ganda.
Amin.

Hormat kami,
*IKARHOLAZ*

Terlampir kami kirim bukti pembayaran format PDF atau klik '.$detail_url.' untuk mengunduhnya. Jika ada pertanyaan silakan hubungi kami langsung di inbox@ikarholaz.com atau di +62 838-0661-1212';

$wablast = WaBlast::send($data->subject->phone, $message);

set_flash_msg(['success'=>'Notifikasi berhasil di kirim ulang']);
header('location:'.routeTo('transactions/index'));
die();