<?php

$conn = conn();
$db   = new Database($conn);
$id   = $_GET['id'];

$data = $db->single('transactions',[
    'id' => $id
]);

$data->pg = unserialize(html_entity_decode($data->pg_response));

$data->data = $db->single($data->destination_type,[
    'id' => $data->destination_id
]);

return compact('data');