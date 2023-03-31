<?php

class WaBlast
{
    
    static function send($to, $message, $file_url = '')
    {
        if(config('WA_BLAST_PLATFORM') == 'fonnte')
        {
            return self::sendFonnte($to, $message);
        }
        $curl = curl_init();

        if($to[0] == "0")
            $to = "+62".substr($to,1);
        
        $postfields = [
            'device_id' => config('WA_BLAST_DEVICE'),
            'number'    => $to,
            'message'   => $message
        ];
        if($file_url)
            $postfields['file'] = $file_url;
        $postfields = http_build_query($postfields);

        curl_setopt_array($curl, array(
            CURLOPT_URL => config('WA_BLAST_URL')."/api/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postfields,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            // return ['status'=>'error','data'=>"cURL Error #:" . $err];
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    static function sendFonnte($to, $message)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
        'target' => $to,
        'message' => $message,
        'schedule' => '0',
        'typing' => false,
        'delay' => '2',
        'countryCode' => '0',
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: TOKEN'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }
}
