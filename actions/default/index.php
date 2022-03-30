<?php

$conn = conn();
$db   = new Database($conn);

$campaigns = $db->all('campaigns');
$donations = $db->all('donations');

return compact('campaigns','donations');