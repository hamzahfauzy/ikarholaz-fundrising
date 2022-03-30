<?php

$table = 'donations';
$conn = conn();
$db   = new Database($conn);

$db->delete($table,[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>'Donasi berhasil dihapus']);
header('location:index.php?r='.$table.'/index');
die();