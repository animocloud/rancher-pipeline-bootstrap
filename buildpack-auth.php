<?php

$namespace = getenv('PROJECT_NAMESPACE');
$token = getenv("PROJECT_TOKEN");

$header = ['Authorization' => "Bearer $token"];

$url = "https://kubernetes.default.svc.cluster.local/api/v1/namespaces/$namespace/secrets/";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$data = curl_exec($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

if($httpCode == 200) {
    echo "Rancher API response:\n";

    echo $data;
}