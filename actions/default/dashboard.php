<?php

$conn = conn();
$db   = new Database($conn);

$db->query = "SELECT SUM(amount) as total FROM transactions WHERE status = 'confirm'";
$transaction_success = $db->exec('single');

$db->query = "SELECT SUM(amount) as total FROM transactions WHERE status = 'checkout'";
$transaction_pending = $db->exec('single');

return compact('transaction_success','transaction_pending');