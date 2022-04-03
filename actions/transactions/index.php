<?php

$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');

$transactions = $db->all('transactions');

$transactions = array_map(function($transaction) use ($db){
    $transaction->destination = $db->single($transaction->destination_type,[
        'id' => $transaction->destination_id
    ]);

    $transaction->subject = $db->single('subjects',[
        'id' => $transaction->subject_id
    ]);
    
    return $transaction;
}, $transactions);

return compact('transactions');
