<?php

$conn = conn();
$db   = new Database($conn);

if(isset($_GET['jenis']))
{
    $limit = 10;
    $id    = $_GET['id'];
    $page  = $_GET['page'] ?? 1;
    $page  = $page - 1;
    $offset= $page * $limit;
    $jenis = $_GET['jenis'];

    $db->query = "SELECT COUNT(*) as TOTAL FROM transactions WHERE destination_type='$jenis' AND destination_id=$id";
    $total  = $db->exec('single');
    $max_page = ceil($total->TOTAL / $limit); 

    $db->query = "SELECT * FROM transactions WHERE destination_type='$jenis' AND destination_id=$id LIMIT $offset, $limit";
    $transactions  = $db->exec('all');

    $transactions = array_map(function($transaction) use ($db){
        $transaction->amount = number_format($transaction->amount);
        $transaction->subject = $db->single('subjects',[
            'id' => $transaction->subject_id
        ]);
        $transaction->subject->name = $transaction->subject->is_anonim ? 'Hamba Allah' : $transaction->subject->name;
        return $transaction;
    }, $transactions);

    echo json_encode([
        'status'  => 'success',
        'message' => 'data berhasil di ambil',
        'data'    => [
            'max_page' => $max_page,
            'data' => $transactions
        ]
    ]);
}

die();