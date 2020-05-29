<?php

$namespace = getenv('PROJECT_NAMESPACE');
$token = getenv("PROJECT_TOKEN");

$header = ["Authorization: Bearer $token"];

$url = "https://kubernetes.default.svc.cluster.local/api/v1/namespaces/$namespace/secrets/buildpack-meta";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
$data = curl_exec($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

if($httpCode == 200) {
    // K8 JSON Secret Schema
    $jsonData = json_decode($data, true);

    echo base64_decode($jsonData['data']['buildpack_url_token']);

    exit(0);

} else {
    echo "An error occured\n";

    echo $httpCode . "\n";

    echo $data . "\n";

    // Exit the program: 1 is unsuccessful
    exit(1);
}