<?php

$conn = conn();
$db   = new Database($conn);

$route = $db->single('transactions',[
    'id' => $_GET['id']
]);

$db->delete('transactions',[
    'id' => $_GET['id']
]);

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{    
    echo json_encode([
        'status' => 'success',
        'message' => 'Delete transaction success',
        'data'    => []
    ]);
    die();
}

set_flash_msg(['success'=>'Transaksi berhasil dihapus']);
header('location:'.routeTo().'transactions/index');
die();