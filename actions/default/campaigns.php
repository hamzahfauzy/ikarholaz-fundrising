<?php

$conn = conn();
$db   = new Database($conn);

$campaigns = $db->all('campaigns');

return compact('campaigns');