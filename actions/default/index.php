<?php

$conn = conn();
$db   = new Database($conn);

$campaigns = $db->all('campaigns', [], [
    'id' => 'DESC'
]);
$donations = $db->all('donations', [], [
    'id' => 'DESC'
]);

$campaigns = array_map(function($campaign) use ($db){
    $db->query = "SELECT SUM(amount) as total FROM transactions WHERE destination_type = 'campaigns' AND destination_id = $campaign->id AND status = 'confirm'";
    $campaign->total_transaction = $db->exec('single');
    return $campaign;
}, $campaigns);

$donations = array_map(function($donation) use ($db){
    $db->query = "SELECT SUM(amount) as total FROM transactions WHERE destination_type = 'donations' AND destination_id = $donation->id AND status = 'confirm'";
    $donation->total_transaction = $db->exec('single');
    return $donation;
}, $donations);

return compact('campaigns','donations');