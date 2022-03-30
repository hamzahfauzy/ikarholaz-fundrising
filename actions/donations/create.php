<?php

$table = 'donations';

if(request() == 'POST')
{
    $conn = conn();
    $db   = new Database($conn);

    if(isset($_FILES['file']) && !empty($_FILES['file']['name']))
    {
        $ext  = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $name = strtotime('now').'.'.$ext;
        $file = 'uploads/donations/'.$name;
        copy($_FILES['file']['tmp_name'],$file);
        $_POST[$table]['pic_url'] = $file;
    }

    $db->insert($table,$_POST[$table]);

    set_flash_msg(['success'=>'Donasi berhasil ditambahkan']);
    header('location:index.php?r='.$table.'/index');
}

return compact('table');