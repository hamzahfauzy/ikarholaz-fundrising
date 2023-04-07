<?php

$transactions = [];

if(
    isset($_GET['from']) && !empty($_GET['from']) &&
    isset($_GET['to']) && !empty($_GET['to'])
)
{
    $conn = conn();
    $db   = new Database($conn);
    $transactions = $db->all('transactions');

    if(isset($_GET['type']) && !empty($_GET['type']))
    {
        $db->query = "SELECT * FROM transactions WHERE destination_type='$_GET[type]' AND created_at BETWEEN '$_GET[from] 00:00:00' AND '$_GET[to] 23:59:59'";
        $transactions = $db->exec('all');
        // $transactions = $db->all('transactions',[
        //     'destination_type' => $_GET['type'],
        //     'created_at' => ['LIKE', '%'.$_GET['from'].'%']
        // ]);
    }

    $transactions = array_map(function($transaction) use ($db) {
        $transaction->destination = $db->single($transaction->destination_type,[
            'id' => $transaction->destination_id
        ]);

        $transaction->subject = $db->single('subjects',[
            'id' => $transaction->subject_id
        ]);
        return $transaction;
    }, $transactions);
}

return compact('transactions');