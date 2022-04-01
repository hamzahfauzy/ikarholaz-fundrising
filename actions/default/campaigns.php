<?php

$conn = conn();
$db   = new Database($conn);

$campaigns = $db->all('campaigns');

$campaigns = array_map(function($campaign) use ($db){
    $db->query = "SELECT SUM(amount) as total FROM transactions WHERE destination_type = 'campaigns' AND destination_id = $campaign->id AND status = 'confirm'";
    $campaign->total_transaction = $db->exec('single');
    return $campaign;
}, $campaigns);

return compact('campaigns');