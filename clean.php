<?php
// Это скрипт для CRON задачи (Очистка старых сообщений в чате).
include_once 'setting.php';
$CONNECT = mysqli_connect(HOST, USER, PASS, DB);
mysqli_query($CONNECT, "DELETE FROM `chat` WHERE `time` < SUBTIME(NOW(), '1 0:0:0')");
// Это скрипт для CRON задачи (Очистка таблицы online на каждые 5 минут).

mysqli_query($CONNECT, "DELETE FROM `online` WHERE `time` < SUBTIME(NOW(), '0 0:05:0')");
?>