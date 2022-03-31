<?php

$conn = conn();
$db   = new Database($conn);

$donations = $db->all('donations');

return compact('donations');