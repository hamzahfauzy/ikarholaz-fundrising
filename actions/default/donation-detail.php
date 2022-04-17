<?php

$conn = conn();
$db   = new Database($conn);
$id   = $_GET['id'];

$donation = $db->single('donations',[
    'id' => $id
]);

$donation->posts = $db->all('posts',[
    'post_type'    => 'donations',
    'post_type_id' => $id,
],[
    'id' => 'DESC'
]);

$db->query = "SELECT SUM(amount) as total FROM transactions WHERE destination_type = 'donations' AND destination_id = $id AND status = 'confirm'";
$donation->total_transaction = $db->exec('single');

return compact('donation');