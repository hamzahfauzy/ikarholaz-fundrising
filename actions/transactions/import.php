<?php

$conn = conn();
$db   = new Database($conn);

if(request() == 'POST')
{
    $tmpName = $_FILES['file']['tmp_name'];
    $csvAsArray = array_map('str_getcsv', file($tmpName));
    
    unset($csvAsArray[0]);

    foreach($csvAsArray as $data)
    {
        $subject = $db->insert('subjects',[
            'name' => $data[1],
            'phone' => $data[4],
            'is_anonim' => $data[3],
            'email' => '',
            'NRA' => $data[2]=='-'?'':$data[2],
        ]);

        // $checkout_id = '00'.$subject->id.strtotime('now');

        $db->insert('transactions',[
            'checkout_id' => $data[6],
            'subject_id'  => $subject->id,
            'destination_id'  => $_POST['referensi'],
            'destination_type'  => $_POST['jenis'],
            'pg_requests' => serialize(['payment_method'=>$data[7],'payment_channel'=>'']),
            'amount'  => $data[5],
            'status'  => 'confirm',
            'created_at'  => date('Y-m-d H:i:s', strtotime($data[8])),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);
    }

    set_flash_msg(['success'=>'Data berhasil di import']);
    header('location:'.routeTo().$_POST['jenis'].'/view&id='.$_POST['referensi']);
    die();
}

return;