<?php
require_once('MysqliDb.php');
error_reporting(E_ALL);

$db = new MysqliDb (array(
    'host' => '127.0.0.1',
    'username' => 'root',
    'password' => '123',
    'db' => 'credits',
    'port' => 3306,
    'prefix' => '',
    'charset' => 'utf8'));


$minutes_to_add = 120;
$time = new DateTime();
$time->sub(new DateInterval('PT' . $minutes_to_add . 'M'));
$from = $time->format('Y-m-d H:i:s');
$to = date('Y-m-d H:i:s');

$params = array( $from,  $to, 'RINGNOANSWER');
$data = $db->rawQuery("SELECT distinct callid, clid
FROM queuelog inner join cdr on queuelog.callid = cdr.uniqueid
where
(time BETWEEN ? AND ?)
  and queuelog.event = ?", $params);


var_dump($data);