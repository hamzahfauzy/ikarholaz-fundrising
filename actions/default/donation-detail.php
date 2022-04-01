<?php

$conn = conn();
$db   = new Database($conn);
$id   = $_GET['id'];

$donation = $db->single('donations',[
    'id' => $id
]);

$transactions = $db->all('transactions',[
    'destination_type' => 'donations',
    'destination_id'   => $id,
    'status'           => 'confirm'
]);

$transactions = array_map(function($transaction) use ($db){
    $transaction->subject = $db->single('subjects',[
        'id' => $transaction->subject_id
    ]);
    return $transaction;
}, $transactions);

$donation->transactions = $transactions;
$donation->posts = $db->all('posts',[
    'post_type'    => 'donations',
    'post_type_id' => $id,
]);

$db->query = "SELECT SUM(amount) as total FROM transactions WHERE destination_type = 'donations' AND destination_id = $id AND status = 'confirm'";
$donation->total_transaction = $db->exec('single');

return compact('donation');