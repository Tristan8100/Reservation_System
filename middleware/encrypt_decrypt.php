<?php

$secretkey = 'azsxedfvpdosbgtrh';

function encrypt($data) {
    global $secretkey;
    return urlencode(base64_encode(openssl_encrypt($data, 'AES-128-ECB', $secretkey, 0)));
}


function decrypt($data) {
    global $secretkey;
    return openssl_decrypt(base64_decode(urldecode($data)), 'AES-128-ECB', $secretkey, 0);
}


?>