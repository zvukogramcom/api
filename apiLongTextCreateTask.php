<?
$text = "озвучиваемый текст";
$error = null;
$resultId = 0;
$data = [
    'token' => 'yourTokenValue',
    'email' => 'yourMail@gmail.com',
    'voice' => 'Владимир',
    'text' => $text,
    'format' => 'mp3',
    'speed' => 1,
    'pitch' => 0,
    'emotion' => 'good',
];
$url = "https://zvukogram.com/index.php?r=api/longtext"; 
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); 
$response = curl_exec($ch);
$response = json_decode($response, true);
if (curl_errno($ch)) {
    $error = "Ошибка соединения с сервером распознавания текстов, " . curl_error($ch);
} else {
    if ($response["status"] == 1) {
        //Запомними идентификатор задачи на озвучку
        $resultId = $response["id"];
    } else {
        $error =  $response["error"];
    }
}
curl_close($ch);
echo  $resultId;
?>
