<?php
ini_set('max_execution_time', '300'); //300 seconds = 5 minutes
function ApiCalling($api_method, $url, $data = '', $content_type, $app_id, $app_secret, $type)
{
    if ($type == "aia") {
        $id = 'app-id:' . $app_id;
        $secret = 'app-secret:' . $app_secret;
    }
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt(
        $curl,
        CURLOPT_HTTPHEADER,
        array(
            $id,
            $secret,
            'Content-Type: ' . $content_type
        )
    );
    switch ($api_method) {
        case "GET":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
            break;
        case "POST":
            curl_setopt($curl, CURLOPT_POSTFIELDS, ($data));
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_POSTFIELDS, ($data));
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            break;
        case "DELETE":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            break;
    }
    $curl_response = curl_exec($curl);
    $err = curl_error($curl);
    if ($err) {
        echo ("curl_exec threw error . $err . ");
    }
    $data = json_decode($curl_response, true);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    if ($httpCode == 401) {
        return array('httpCode' => $httpCode, 'data' => $data);
        // header('location: include/login/logout.php');
    } else {
        return array('httpCode' => $httpCode, 'data' => $data);
    }
}
function invokeApi($api_method, $url, $data = '', $content_type, $token = "")
{
    if ($token) {
        $token = 'Authorization: Bearer ' . $token;
    }
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt(
        $curl,
        CURLOPT_HTTPHEADER,
        array(
            $token,
            'Content-Type: ' . $content_type
        )
    );
    switch ($api_method) {
        case "GET":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
            break;
        case "POST":
            curl_setopt($curl, CURLOPT_POSTFIELDS, ($data));
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_POSTFIELDS, ($data));
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            break;
        case "DELETE":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            break;
    }
    $curl_response = curl_exec($curl);
    $err = curl_error($curl);
    if ($err) {
        echo ("curl_exec threw error . $err . ");
    }
    $data = json_decode($curl_response, true);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    if ($httpCode == 401) {
        return array('httpCode' => $httpCode, 'data' => $data);
        // header('location: include/login/logout.php');
    } else {
        return array('httpCode' => $httpCode, 'data' => $data);
    }
}
function GET_API($url, $app_id, $app_secret)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'app-id: ' . $app_id,
            'app-secret: ' . $app_secret
        ),
    ));
    $curl_response = curl_exec($curl);
    $err = curl_error($curl);
    if ($err) {
        echo ("curl_exec threw error . $err . ");
    }
    $data = json_decode($curl_response, true);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    if ($httpCode == 401) {
        return array('httpCode' => $httpCode, 'data' => $data);
        // header('location: include/login/logout.php');
    } else {
        return array('httpCode' => $httpCode, 'data' => $data);
    }
}
function test_input($data)
{
    $data = trim($data);
    $data = addslashes($data);
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
    return $data;
}

