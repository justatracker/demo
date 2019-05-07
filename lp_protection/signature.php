<?php
/**
 * Created by PhpStorm.
 * User: 小码农
 * Date: 2019/5/7
 * Time: 20:13
 */



//cloak逻辑


$timestamp = time();  // 当前时间
$private_key = "kGJ8FCCslmSzgh9kYF5I";   // 私钥
$signedHash = hash_hmac('sha1', $timestamp, $private_key);   // 根据私钥和时间生成签名
$arr["timestamp"] = $timestamp;
$arr["signedHash"] = $signedHash;
$signature = base64_encode(json_encode($arr)); // 生成签名

// 重定向到lp
$lp = "https://demo.justatracker.com/lp_protection/test_lp.php?key=".$signature;
header("Location: $lp");