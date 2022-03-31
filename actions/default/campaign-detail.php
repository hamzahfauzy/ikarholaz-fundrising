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
]);

return compact('campaign');