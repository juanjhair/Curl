<?php 

$token=generarToken();
echo "<br>";
echo prueba($token);

function generarToken(){
    $url = '';
    $ch = curl_init($url);
    $jsonData = array(
        'identificador' => '', 
        'password' => '' 
    );
    $jsonDataEncoded = json_encode($jsonData);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_POST,true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $result = curl_exec($ch);
    $response = json_decode( $result );
    if(curl_errno($ch)){
        return 'Request Error:' . curl_error($ch);
        
    }else{
        return $response->{'token'};
    }
}

function prueba($tk){
    $token=$tk;
    $url = '';
    $ch = curl_init($url);
    $headers = array();
    $headers[] = "x-auth-token: $token";
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $result = curl_exec($ch);
    $response = json_decode($result);

    if(curl_errno($ch)){
        return 'Request Error:' . curl_error($ch);
    }else{
        return $result;
    }
    
}

