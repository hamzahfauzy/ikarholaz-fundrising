<?php

$conn = conn();
$db   = new Database($conn);
$id   = $_GET['id'];

$campaign = $db->single('campaigns',[
    'id' => $id
]);

$campaign->posts = $db->all('posts',[
    'post_type'    => 'campaigns',
    'post_type_id' => $id,
    'status' => 'publish',
],[
    'id' => 'DESC'
]);

$db->query = "SELECT SUM(amount) as total FROM transactions WHERE destination_type = 'campaigns' AND destination_id = $id AND status = 'confirm'";
$campaign->total_transaction = $db->exec('single');

return compact('campaign');