<?php

$success_msg = get_flash_msg('success');

if(isset($_GET['draw']))
{
    header('content-type:application/json');
    $conn = conn();
    $db   = new Database($conn);

    $draw  = $_GET['draw'];
    $start  = $_GET['start'];
    $length = $_GET['length'];
    $search = $_GET['search']['value'];
    $order  = $_GET['order'];

    $columns = [
        'transactions.id',
        'transactions.checkout_id',
        'transactions.created_at',
        'transactions.updated_at',
        'payment_method',
        'subjects.name',
        'subjects.is_anonim',
        'subjects.phone',
        'transactions.amount',
        'transactions.status',
    ];    

    $order_by = " ORDER BY ".$columns[$order[0]['column']]." ".$order[0]['dir'];

    $where = !empty($search) ? "WHERE (subjects.name LIKE '%$search%' OR transactions.created_at LIKE '%$search%')" : '';

    $db->query = "SELECT COUNT(*) as TOTAL FROM transactions JOIN subjects ON subjects.id = transactions.subject_id $where $order_by";
    $total = $db->exec('single');

    $db->query = "SELECT transactions.*, subjects.name, subjects.is_anonim, subjects.phone FROM transactions JOIN subjects ON subjects.id = transactions.subject_id $where $order_by LIMIT $start,$length";
    $transactions = $db->exec('all');
    
    $transactions = array_map(function($transaction) use ($db){
        if($transaction->pg_requests)
            $transaction->pg_requests = unserialize(html_entity_decode($transaction->pg_requests));

        $action = $transaction->status == 'confirm' ? '<a href="'.routeTo('transactions/resend',['id'=>$transaction->id]).'" class="btn btn-sm btn-success" title="Resend Notif"><i class="fas fa-redo"></i></a>' : '';
        $action .= $transaction->pg_requests && $transaction->pg_requests['payment_method'] == 'cash' && $transaction->status == 'checkout' ? '<button data-id="'.$transaction->id.'" onclick="confirmTransaction('.$transaction->id.')" class="btn btn-sm btn-success btn-confirm" title="Konfirmasi"><i class="fas fa-check"></i></button>' : '';
        $action .= '<a href="'.routeTo('default/transaction-detail',['id'=>$transaction->id,'type'=>'download'],1).'" class="btn btn-sm btn-primary" title="Download Bukti"><i class="fas fa-download"></i></a>
            <button data-id="'.$transaction->id.'" onclick="deleteTransaction('.$transaction->id.')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
        ';
        $status = '';
        if($transaction->status == 'checkout')
            $status = '<span class="badge badge-warning">'.$transaction->status.'</span>';
        elseif($transaction->status == 'confirm')
            $status = '<span class="badge badge-success">'.$transaction->status.'</span>';

        $new = [
            $transaction->id,
            $transaction->checkout_id,
            $transaction->created_at,
            $transaction->updated_at,
            $transaction->pg_requests ? $transaction->pg_requests['payment_method'] : '',
            $transaction->name,
            $transaction->is_anonim?'Ya':'Tidak',
            $transaction->phone,
            number_format($transaction->amount),
            $status,
            $action
        ];

        return $new;
        // if($transaction->pg_requests)
        //     $transaction->pg_requests = unserialize(html_entity_decode($transaction->pg_requests));
    
        // if($transaction->pg_response)
        //     $transaction->pg_response = unserialize(html_entity_decode($transaction->pg_response));
    
        // $transaction->destination = $db->single($transaction->destination_type,[
        //     'id' => $transaction->destination_id
        // ]);
    
        // $transaction->subject = $db->single('subjects',[
        //     'id' => $transaction->subject_id
        // ]);
        
        // return $transaction;
    }, $transactions);

    echo json_encode([
        "draw" => $draw,
        "recordsTotal" => (int)$total->TOTAL,
        "recordsFiltered" => (int)$total->TOTAL,
        "data" => $transactions
    ]);
    die();
}


return compact('success_msg');
