<?php
define('SIGNATURE_TTL', 10); // 过期时间(默认10秒)
define('SIGNATURE_GET_PARAM', 'key'); // 指定使用的参数名

// 判断是否有key
if (isset($_GET[SIGNATURE_GET_PARAM])){
    $signature = rawurldecode($_GET[SIGNATURE_GET_PARAM]);
}else{
    NotFound();
}
if (!$signature = base64_decode($signature)) {
    NotFound();
}
if (!$signature = json_decode($signature, true)) {
    NotFound();
}
if (!isset($signature['timestamp']) || !isset($signature['signedHash'])) {
    NotFound();
}

// 根据 时间 和 私钥重新重新签名、
$signedHash = hash_hmac('sha1', $signature['timestamp'], "kGJ8FCCslmSzgh9kYF5I");

//判断 签名是否相等，是否过期。
if ($signedHash !== $signature['signedHash'] || (time()-$signature['timestamp']) > SIGNATURE_TTL ) {
    NotFound();
}
function NotFound(){
    header('HTTP/1.1 404 Not Found');
    header("status: 404 Not Found");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
This is test
</body>
</html>