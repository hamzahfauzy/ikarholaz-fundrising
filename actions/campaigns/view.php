<?php

$table = 'campaigns';
$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');
$id   = $_GET['id'];

$data = $db->single($table,[
    'id' => $id
]);

if(request() == 'POST')
{
    if(isset($_POST['campaign_amounts']))
    {
        $db->insert('campaign_amounts', $_POST['campaign_amounts']);
        set_flash_msg(['success'=>'Nominal berhasil ditambahkan']);
        header('location:index.php?r='.$table.'/view&id='.$id);
    }
}

$data->amounts = $db->all('campaign_amounts',[
    'campaign_id' => $id
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

$data->transactions = $transactions;
$data->posts = $db->all('posts',[
    'post_type' => 'campaigns',
    'post_type_id' => $id,
]);

return [
    'data' => $data,
    'table' => $table,
    'success_msg' => $success_msg
];