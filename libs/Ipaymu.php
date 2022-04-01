<?php

class Ipaymu 
{
    private $va;
    private $secret;
    private $api_url;

    function __construct()
    {
        $this->va = config('ipaymu_virtual_account');
        $this->secret = config('ipaymu_api_key');
        $this->api_url = config('ipaymu_api_url');
    }

    function directPayment($payload)
    {
        $method       = 'POST'; //method
        //Request Body//
        $body['product']    = array($payload['name']);
        $body['qty']        = array('1');
        $body['referenceId'] = $payload['subject']['referenceId'];
        $body['name']       = $payload['subject']['name'];
        $body['phone']      = $payload['subject']['phone'];
        $body['email']      = $payload['subject']['email'];
        $body['paymentMethod']  = $payload['payment_method'];
        $body['paymentChannel'] = $payload['payment_channel'];
        $body['amount']     = $payload['amount'];
        $body['price']      = array($payload['amount']);
        $body['notifyUrl']  = config('base_url').'/index.php?r=default/notify';
        //End Request Body//

        //Generate Signature
        // *Don't change this
        $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
        $requestBody  = strtolower(hash('sha256', $jsonBody));
        $stringToSign = strtoupper($method) . ':' . $this->va . ':' . $requestBody . ':' . $this->secret;
        $signature    = hash_hmac('sha256', $stringToSign, $this->secret);
        $timestamp    = Date('YmdHis');
        //End Generate Signature

        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'va: ' . $this->va,
            'signature: ' . $signature,
            'timestamp: ' . $timestamp
        );

        $ch = curl_init($this->api_url . 'payment/direct');

        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_POST, count($body));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $err = curl_error($ch);
        $ret = curl_exec($ch);
        curl_close($ch);
        if($err) {
            echo $err;
        } else {

            //Response
            $ret = json_decode($ret);
            // if($ret->Status == 200) {
            //     // $sessionId  = $ret->Data->SessionID;
            //     // $url        =  $ret->Data->Url;
            //     // header('Location:' . $url);
                return $ret;
            // } else {
            //     echo $ret;
            // }
            //End Response
        }
    }
    
    function redirectPayment($payload)
    {
        $method       = 'POST'; //method
        //Request Body//
        $body['product']    = array($payload['name']);
        $body['qty']        = array('1');
        $body['price']      = array($payload['amount']);
        $body['returnUrl']  = config('base_url').'/index.php?r=default/thankyou';
        $body['cancelUrl']  = config('base_url').'/index.php?r=default/cancel';
        $body['notifyUrl']  = config('base_url').'/index.php?r=default/notify';
        //End Request Body//

        //Generate Signature
        // *Don't change this
        $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
        $requestBody  = strtolower(hash('sha256', $jsonBody));
        $stringToSign = strtoupper($method) . ':' . $this->va . ':' . $requestBody . ':' . $this->secret;
        $signature    = hash_hmac('sha256', $stringToSign, $this->secret);
        $timestamp    = Date('YmdHis');
        //End Generate Signature

        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'va: ' . $this->va,
            'signature: ' . $signature,
            'timestamp: ' . $timestamp
        );

        $ch = curl_init($this->api_url . 'payment');

        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_POST, count($body));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $err = curl_error($ch);
        $ret = curl_exec($ch);
        curl_close($ch);
        if($err) {
            echo $err;
        } else {

            //Response
            $ret = json_decode($ret);
            // if($ret->Status == 200) {
            //     // $sessionId  = $ret->Data->SessionID;
            //     // $url        =  $ret->Data->Url;
            //     // header('Location:' . $url);
                return $ret;
            // } else {
            //     echo $ret;
            // }
            //End Response
        }
    }
}