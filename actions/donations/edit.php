<?php

$table = 'donations';
$conn = conn();
$db   = new Database($conn);

$data = $db->single($table,[
    'id' => $_GET['id']
]);

if(request() == 'POST')
{
    if(isset($_FILES['file']) && !empty($_FILES['file']['name']))
    {
        $ext  = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $name = strtotime('now').'.'.$ext;
        $file = 'uploads/donations/'.$name;
        copy($_FILES['file']['tmp_name'],$file);
        $_POST[$table]['pic_url'] = $file;
    }

    $db->update($table,$_POST[$table],[
        'id' => $_GET['id']
    ]);

    set_flash_msg(['success'=>'Donasi berhasil diupdate']);
    header('location:'.routeTo().''.$table.'/index');
}

return [
    'data' => $data,
    'table' => $table
];