<?php

$table = 'campaigns';

if(request() == 'POST')
{
    $conn = conn();
    $db   = new Database($conn);

    if(isset($_FILES['file']) && !empty($_FILES['file']['name']))
    {
        $ext  = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $name = strtotime('now').'.'.$ext;
        $file = 'uploads/campaigns/'.$name;
        copy($_FILES['file']['tmp_name'],$file);
        $_POST[$table]['pic_url'] = $file;
    }

    $db->insert($table,$_POST[$table]);

    set_flash_msg(['success'=>'Kampanye berhasil ditambahkan']);
    header('location:'.routeTo().''.$table.'/index');
}

return compact('table');