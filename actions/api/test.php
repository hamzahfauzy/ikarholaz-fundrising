<?php

$message = 'this is testing from website';

$wablast = WaBlast::send("082369378823", $message);

echo json_encode([
    'msg' => 'hello world',
    'result' => $wablast
]);

die();