<?php

$conn = conn();
$db   = new Database($conn);
$id   = $_GET['id'];

$campaign = $db->single('campaigns',[
    'id' => $id
]);

$transactions = $db->all('transactions',[
    'destination_type' => 'campaigns',
    'destination_id'   => $id,
    'status'           => 'confirm'
],[
    'id' => 'DESC'
]);

$transactions = array_map(function($transaction) use ($db){
    $transaction->subject = $db->single('subjects',[
        'id' => $transaction->subject_id
    ]);
    return $transaction;
}, $transactions);

$campaign->transactions = $transactions;
$campaign->posts = $db->all('posts',[
    'post_type'    => 'campaigns',
    'post_type_id' => $id,
],[
    'id' => 'DESC'
]);

$db->query = "SELECT SUM(amount) as total FROM transactions WHERE destination_type = 'campaigns' AND destination_id = $id AND status = 'confirm'";
$campaign->total_transaction = $db->exec('single');

return compact('campaign');