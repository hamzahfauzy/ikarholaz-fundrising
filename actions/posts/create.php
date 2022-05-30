<?php

$table = 'posts';

if(request() == 'POST')
{
    $conn = conn();
    $db   = new Database($conn);

    $db->insert($table,$_POST[$table]);

    $page = $_POST[$table]['post_type'];
    $id   = $_POST[$table]['post_type_id'];

    set_flash_msg(['success'=>$page.' berhasil ditambahkan']);
    header('location:'.routeTo().$page.'/view&id='.$id);
}

return compact('table');