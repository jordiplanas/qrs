<?php
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $acceptLang = ['es', 'ca']; 
    $lang = in_array($lang, $acceptLang) ? $lang : 'es';
    $langJson = file_get_contents('data/copy/' . $lang . '.json');
    $copy = json_decode($langJson, true);
?>