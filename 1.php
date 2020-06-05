<?php

require_once __DIR__ . '/vendor/autoload.php';

$authKey = 'AIzaSyDn9ibIGIRIYJQBy8C_Xxx2citad_R_sys';

$connector = \App\FirebaseConnector::make($authKey);

try {
    $response = $connector->auth()->login('antropofffff@gmail.com', '123');

    var_dump($response->isRegistered());
}
catch (\App\Exception\FirebaseApiException $e) {
    var_dump($e->getErrorCode());
}

//php -c "C:\Program Files (x86)\php-7.4.6\php.ini-development" 1.php