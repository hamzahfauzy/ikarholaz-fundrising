<?php

$conn = conn();
$db   = new Database($conn);

$route = $db->single('transactions',[
    'id' => $_GET['id']
]);

$db->update('transactions',[
    'status' => 'confirm'
],[
    'id' => $_GET['id']
]);

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{    
    echo json_encode([
        'status' => 'success',
        'message' => 'Transaksi berhasil dikonfirmasi',
        'data'    => []
    ]);
    die();
}

set_flash_msg(['success'=>'Transaksi berhasil dikonfirmasi']);
header('location:'.routeTo().'transactions/index');
die();