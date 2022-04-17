<?php

$conn = conn();
$db   = new Database($conn);

$route = $db->single('transactions',[
    'id' => $_GET['id']
]);

$db->delete('transactions',[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>'Transaksi berhasil dihapus']);
header('location:'.routeTo().'transactions/index');
die();