<?php

$table = 'donation_amounts';
$conn = conn();
$db   = new Database($conn);

$data = $db->single($table,[
    'id' => $_GET['id']
]);

$db->delete($table,[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>'Nominal berhasil dihapus']);
header('location:'.routeTo('donations/view',['id'=>$data->campaign_id]));
die();