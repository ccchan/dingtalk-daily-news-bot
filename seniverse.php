<?php
/**
 * 给心知天气写的一个 PHP Demo
 * （自豪！
 */

// 心知天气接口调用凭据
$key = '56z3zvsoqxcankqx'; // 测试用 key，请更换成您自己的 Key
$uid = 'U03B31F9B6'; // 测试用 用户ID，请更换成您自己的用户ID
// 参数
$api = 'https://api.thinkpage.cn/v3/weather/daily.json'; // 接口地址
$location = '深圳'; // 城市名称。除拼音外，还可以使用 v3 id、汉语等形式

// 生成签名。文档：https://www.seniverse.com/doc#sign
$param = [
    'ts' => time(),
    'ttl' => 300,
    'uid' => $uid,
];
$sig_data = http_build_query($param); // http_build_query会自动进行url编码
// 使用 HMAC-SHA1 方式，以 API 密钥（key）对上一步生成的参数字符串（raw）进行加密，然后base64编码
$sig = base64_encode(hash_hmac('sha1', $sig_data, $key, TRUE));

// 拼接Url中的get参数。文档：https://www.seniverse.com/doc#daily
$param['sig'] = $sig; // 签名
$param['location'] = $location;
$param['start'] = 0; // 开始日期。0=今天天气
$param['days'] = 1; // 查询天数，1=只查一天

// 构造url
return $api . '?' . http_build_query($param);
