<?php
require_once('MysqliDb.php');
error_reporting(E_ALL);

//$con = mysqli_connect("127.0.0.1","root","123","credits");
$mysqli = new mysqli("127.0.0.1","root","123","credits");

if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}
$minutes_to_add = 120;
$time = new DateTime();
$time->sub(new DateInterval('PT' . $minutes_to_add . 'M'));
$from = $time->format('Y-m-d H:i:s');
$to = date('Y-m-d H:i:s');

$sql = "SELECT distinct callid, clid
FROM queuelog inner join cdr on queuelog.callid = cdr.uniqueid
where
(time BETWEEN '{$from}' AND '{$to}')
  and queuelog.event = 'RINGNOANSWER'";
//var_dump($sql); die();
$result = $mysqli->query($sql);
var_dump($result->fetch_all());


$mysqli -> close();