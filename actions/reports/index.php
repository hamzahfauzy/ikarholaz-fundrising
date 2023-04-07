<?php

$conn = conn();
$db   = new Database($conn);

$transactions = [];
$campaigns = $db->all('campaigns');
$donations = $db->all('donations');

$campaigns = array_map(function($d){
    $d->id = '1_'.$d->id;
    return $d;
}, $campaigns);

$donations = array_map(function($d){
    $d->id = '2_'.$d->id;
    return $d;
}, $donations);

$types = array_merge($campaigns, $donations);

if(
    isset($_GET['from']) && !empty($_GET['from']) &&
    isset($_GET['to']) && !empty($_GET['to']) &&
    isset($_GET['type']) && !empty($_GET['type'])
)
{
    
    $transactions = $db->all('transactions');

    $destination_type = substr($_GET['type'],0,2) == '1_' ? 'campaigns' : 'donations';
    $destination_id = substr($_GET['type'],2,1);

    $db->query = "SELECT * FROM transactions WHERE destination_type='$destination_type' AND destination_id=$destination_id AND created_at BETWEEN '$_GET[from] 00:00:00' AND '$_GET[to] 23:59:59'";
    $transactions = $db->exec('all');

    $transactions = array_map(function($transaction) use ($db) {
        $transaction->destination = $db->single($transaction->destination_type,[
            'id' => $transaction->destination_id
        ]);

        $transaction->subject = $db->single('subjects',[
            'id' => $transaction->subject_id
        ]);
        
        $transaction->destination = $db->single($transaction->destination_type,[
            'id' => $transaction->destination_id
        ]);
        return $transaction;
    }, $transactions);
}

return compact('transactions', 'types');