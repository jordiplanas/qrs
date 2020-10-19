<?php
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $acceptLang = ['es', 'ca']; 
    $lang = in_array($lang, $acceptLang) ? $lang : 'es';
    $langJson = file_get_contents('data/lang.json');
    $data = json_decode($langJson, true); // decode the JSON into an associative array
    $langData = $data[$lang];
    echo $langData["id"];
?>