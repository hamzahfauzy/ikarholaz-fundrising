<?php

$table = 'campaigns';
$conn = conn();
$db   = new Database($conn);

$db->delete($table,[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>'Kampanye berhasil dihapus']);
header('location:'.routeTo().''.$table.'/index');
die();