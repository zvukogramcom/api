<? 
$resultId = 1900000; //Получаем $resultId из предыдущего шага (apiLongTextCreateTask.php)
$error = null;
if($resultId){
    $data = [
        'token' => 'yourTokenValue',
        'email' => 'yourMail@gmail.com',
        'id'=>$resultId, 
    ];    
    $url = "https://zvukogram.com/index.php?r=api/result";
 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);                
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); 
    $response = curl_exec($ch); 
    $response = json_decode($response,true);
    // $response - данные ответа
    // var_dump($response);
    if (curl_errno($ch)) {
        $error = "Ошибка соединения с сервером распознавания текстов, ".curl_error($ch);
    }else{ 
        if($response["status"] == 1){            
            //Скопируем себе файл
            copy($response["file"], 'yourFileName.mp3' . $response["format"]);            
            // Сохраним информацию о завершение задачи $resultId
            //...
        }elseif($response["status"] == 0){
            //Еще не готово
        }else{
            //Ошибка, озвучка невозможна
            $error = $response["error"];            
        }
    }
    if($error){
        // Сохраним информацию об ошибке для задачи $resultId
        //...
    }
    curl_close($ch);
}
?>
