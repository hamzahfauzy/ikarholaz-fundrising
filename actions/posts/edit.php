<?php

$table = 'posts';
$conn = conn();
$db   = new Database($conn);

$data = $db->single($table,[
    'id' => $_GET['id']
]);

if(request() == 'POST')
{
    $db->update($table,$_POST[$table],[
        'id' => $_GET['id']
    ]);

    $page = $data->post_type;
    $id   = $data->post_type_id;

    set_flash_msg(['success'=>$page.' berhasil diupdate']);
    header('location:'.routeTo().$page.'/view&id='.$id);
}

return [
    'data' => $data,
    'table' => $table
];