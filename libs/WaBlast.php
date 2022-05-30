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
            CURLOPT_URL => "https://md.fonnte.com/api/send_message.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array(
                'phone' => $to,
                'type' => 'text',
                'text' => $message,
                'delay' => '1',
                'schedule' => '0'),
            CURLOPT_HTTPHEADER => array(
                "Authorization: ".config('WA_BLAST_DEVICE')
            ),
        ));

        $response = curl_exec($curl);


        curl_close($curl);
        sleep(1); #do not delete!
        return $response;
    }
}
