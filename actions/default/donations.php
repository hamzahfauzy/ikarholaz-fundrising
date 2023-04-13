<?php

$conn = conn();
$db   = new Database($conn);

$donations = $db->all('donations', [], [
    'id' => 'DESC'
]);

$donations = array_map(function($donation) use ($db){
    $db->query = "SELECT SUM(amount) as total FROM transactions WHERE destination_type = 'donations' AND destination_id = $donation->id AND status = 'confirm'";
    $donation->total_transaction = $db->exec('single');
    return $donation;
}, $donations);

return compact('donations');