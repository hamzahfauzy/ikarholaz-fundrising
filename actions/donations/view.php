<?php

$table = 'donations';
$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');
$id   = $_GET['id'];

$data = $db->single($table,[
    'id' => $id
]);

if(request() == 'POST')
{
    if(isset($_POST['donation_amounts']))
    {
        $db->insert('donation_amounts', $_POST['donation_amounts']);
        set_flash_msg(['success'=>'Nominal berhasil ditambahkan']);
        header('location:'.routeTo().''.$table.'/view&id='.$id);
    }
}

$data->amounts = $db->all('donation_amounts',[
    'donation_id' => $id
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

$data->transactions = $transactions;
$data->posts = $db->all('posts',[
    'post_type' => 'donations',
    'post_type_id' => $id,
]);

return [
    'data' => $data,
    'table' => $table,
    'success_msg' => $success_msg
];