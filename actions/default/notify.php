<?php

$conn = conn();
$db   = new Database($conn);

if(request() == 'POST')
{
    if($_POST['status_code'] && $_POST['status'] == 'berhasil')
    {
        $data = $db->single('transactions',[
            'checkout_id' => $_POST['trx_id']
        ]);

        $data->pg = unserialize(html_entity_decode($data->pg_response));
        $data->subject = $db->single('subjects',[
            'id' => $data->subject_id
        ]);
        
        $data->data = $db->single($data->destination_type,[
            'id' => $data->destination_id
        ]);
    
        $db->update('transactions',[
            'status' => 'confirm',
            'updated_at' => date('Y-m-d H:i:s'),
        ],[
            'checkout_id' => $_POST['trx_id']
        ]);

        $detail_url = routeTo('default/transaction-detail',['id'=>$data->id,'type'=>'download'],true);
        $message = '*IKARHOLAZ - FUNDRAISING*
_Notifikasi Pembayaran SUKSES. Kode *#'.$data->pg->Data->TransactionId.'*_

Hai kak '.$data->subject->name.'

Terima kasih sudah berpartisipasi untuk program *"'.$data->data->name.'"* pada tanggal pada tanggal *'.$data->created_at.'* dengan menggunakan metode pembayaran *'.$data->pg->Data->Channel.' - '.$data->pg->Data->Via.'*.  TELAH BERHASIL.

Pembayaran sejumlah *Rp. '.number_format($data->amount).'* telah kami terima. Klik '.$detail_url.' untuk mengunduh tanda terima pembayaran.

Semoga kebaikan Kak '.$data->subject->name.' diberikan balasan yang berlipat ganda.
Amin.

Terima kasih,

_Jika ada pertanyaan silakan hubungi langsung di inbox@ikarholaz.com atau di +62 838-0661-1212_

*IKARHOLAZ FUNDRAISING*
_part of Sistem Informasi Rholaz (SIR)  2022_';

        $wablast = WaBlast::send($data->subject->phone, $message);

        echo json_encode([
            'message' => 'success',
            'wablas'  => $wablast
        ]);
        die();
    }
}