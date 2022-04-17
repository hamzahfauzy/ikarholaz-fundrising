<?php

$conn = conn();
$db   = new Database($conn);

if(isset($_GET['jenis']))
{
    $jenis = $_GET['jenis'];
    $data = $db->all($jenis);

    echo json_encode([
        'status'  => 'success',
        'message' => 'data berhasil di ambil',
        'data'    => $data
    ]);
}

die();