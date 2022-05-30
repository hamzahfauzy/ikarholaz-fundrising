<?php

$table = 'posts';
$conn = conn();
$db   = new Database($conn);

$data = $db->single($table,[
    'id' => $_GET['id']
]);

$page = $data->post_type;
$id   = $data->post_type_id;

$db->delete($table,[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>$page.' berhasil dihapus']);
header('location:'.routeTo().$page.'/view&id='.$id);
die();