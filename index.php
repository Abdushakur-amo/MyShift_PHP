<?php
include_once 'setting.php';
session_start();
$CONNECT = mysqli_connect(HOST, USER, PASS, DB);
if (!$_SESSION['USER_LOGIN_IN'] and $_COOKIE['user']) {
    //echo $_COOKIE['user'];
    $Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `users` WHERE `password` = '$_COOKIE[user]'"));
    $_SESSION['USER_LOGIN_IN'] = 1;
    foreach ($Row as $key => $value) {$_SESSION['USER_'.strtoupper($key)] = $value;}
} //else echo 'Erorr';


if ($_SERVER['REQUEST_URI'] == '/') {
    $Page = 'index';
    $Module = 'index';
} else {
    $URL_Path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $URL_Parts = explode('/', trim($URL_Path, ' /'));
    $Page = array_shift($URL_Parts);
    $Module = array_shift($URL_Parts);
    if (!empty($Module)) {
        $Param = array();
        for ($i = 0; $i < count($URL_Parts); $i++) {
            $Param[$URL_Parts[$i]] = $URL_Parts[++$i];
        }
    }
}

if ($_SESSION['USER_LOGIN_IN']) {
    if ($Page != 'notice') {
    $Num = mysqli_fetch_row(mysqli_query($CONNECT, "SELECT COUNT(`id`) FROM `notice` WHERE `status` = 0 AND `uid` = $_SESSION[USER_ID]"));
    if ($Num[0]) MessageSend(2, 'У вас есть непрочитанные уведомления. <a href="/notice"> ( <b>'.$Num[0].'</b> )</a>', '', 0);
    }
}
if ($_SESSION[USER_ID]) {
   $Count = mysqli_fetch_row(mysqli_query($CONNECT, "SELECT COUNT(`id`) FROM `dialog` WHERE `recive` = $_SESSION[USER_ID] AND `status` = 0"));
    if ($Count[0]) MessageSend(2, 'У вас есть непрочитанные диалоги ( <b>'.$Count[0].'</b> )', '', 0);
}


// Онлайн ползвател- group or login
if ($_SESSION['USER_LOGIN_IN']) $User = $_SESSION['USER_LOGIN'];
else $User = 'guest';
// Online gosty ro meshinosem
if ($User == 'guest') $Online = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `ip` FROM `online` WHERE `ip` = '$_SERVER[REMOTE_ADDR]'"));
else $Online = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `user` FROM `online` WHERE `user` = '$User'"));
if ($Online['ip']) mysqli_query($CONNECT, "UPDATE `online` SET `time` = NOW() WHERE `ip` = '$_SERVER[REMOTE_ADDR]'");
else if ($Online['user'] and $Online['user'] != 'guest') mysqli_query($CONNECT, "UPDATE `online` SET `time` = NOW() WHERE `user` = '$User'");
else mysqli_query($CONNECT, "INSERT INTO `online` SET `ip` = '$_SERVER[REMOTE_ADDR]', `user` = '$User', `time` = NOW()");
// Это скрипт для CRON задачи (Очистка таблицы online на каждые 5 минут).
mysqli_query($CONNECT, "DELETE FROM `online` WHERE `time` < SUBTIME(NOW(), '0 0:05:0')");

// Page - polzvater
if ($Page == 'index') include('page/index.php');
else if ($Page == 'login') include('page/login.php');
else if ($Page == 'register') include('page/register.php');
else if ($Page == 'account') include('form/account.php');
else if ($Page == 'profile') include('page/profile.php');
else if ($Page == 'restore') include('page/restore.php');
else if ($Page == 'chat') include('page/chat.php');
else if ($Page == 'user') include('page/user.php');
else if ($Page == 'parser') include('page/parser.php');
else if ($Page == 'search') include('page/search.php');
else if ($Page == 'api') include('page/api.php');
else if ($Page == 'notice') include('page/notice.php');
else if ($Page == 'clean') include('clean.php');
else if ($Page == 'language') include('page/language.php');

//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Module
else if ($Page == 'news') {
    if (!$Module or $Page == 'news' and $Module == 'category' or $Page == 'news' and $Module == 'main') include('module/news/main.php');
      else if ($Module == 'material'){
        include('module/comments/main.php');
        include('module/news/material.php');
      }
      else if ($Module == 'add') include('module/news/add.php');
      else if ($Module == 'edit') include('module/news/edit.php');
      else if ($Module == 'control') include('module/news/control.php');
}
else if ($Page == 'loads') {
    if (!$Module or $Page == 'loads' and $Module == 'category' or $Page == 'loads' and $Module == 'main') include('module/loads/main.php');
      else if ($Module == 'material'){
        include('module/comments/main.php');
        include('module/loads/material.php');
      }
      else if ($Module == 'add') include('module/loads/add.php');
      else if ($Module == 'edit') include('module/loads/edit.php');
      else if ($Module == 'control') include('module/loads/control.php');
      else if ($Module == 'download') include('module/loads/download.php');
}
else if ($Page == 'comments') {
    if ($Module == 'add') include('module/comments/add.php');
    else if ($Module == 'control') include('module/comments/control.php');
}
else if ($Page == 'pm') {
    if ($Module == 'send') include('module/pm/send.php');
    else if ($Module == 'dialog') include('module/pm/dialog.php');
    else if ($Module == 'message') include('module/pm/message.php');
    else if ($Module == 'control') include('module/pm/control.php');
}
else if ($Page == 'admin') {
    if ($_SESSION['ADMIN_LOGIN_IN']) {
        if (!$Module) include('module/admin/main.php');
        else if ($Module == 'stats') include('module/admin/stats.php');
        else if ($Module == 'query') include('module/admin/query.php');
    }
    else{
        if ($Module == '0001') {
            $_SESSION['ADMIN_LOGIN_IN'] = 1;
            MessageSend(3, 'Вход в Админ панель выполнен успешно.', '/admin');
        }
    }
}
else if ($Page == 'forum') {
    if ($Module == 'main') include('module/forum/main.php');
    else if ($Module == 'section') include('module/forum/section.php');
    else if ($Module == 'topic') include('module/forum/topic.php');
    else if ($Module == 'add') include('module/forum/add.php');
    else if ($Module == 'control') include('module/forum/control.php');
}


/*
->>>>>>>>>>>>>>>>>> Function
 */
function SendNotice($p1, $p2) {
    global $CONNECT;
    $Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id` FROM `users` WHERE `login` = '$p1'"));
    if (!$Row['id']) echo 'Error';
    mysqli_query($CONNECT, "INSERT INTO `notice` VALUES ('', $Row[id], 0, NOW(), '$p2')");
}

function ULogin($p1) {
    if ($p1 <= 0 and $_SESSION['USER_LOGIN_IN'] != $p1) MessageSend(1, 'Данная страница доступна только для гостей.', '/');
    else if ($_SESSION['USER_LOGIN_IN'] != $p1) MessageSend(1, 'Данная сртаница доступна только для пользователей.', '/');
}

function SendMessage($p1, $p2) {
    global $CONNECT;
    $p1 = FormChars($p1, 1);
    $p2 = FormChars($p2);
    if ($p1 == $_SESSION['USER_LOGIN']) MessageSend(1, 'Вы не можете отправить сообщение самому себе', '/');
    $ID = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id` FROM `users` WHERE `login` = '$p1'"));
    if (!$ID) MessageSend(1, 'Пользователь не найден', '/');
    $Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id` FROM `dialog` WHERE `recive` = $ID[id] AND `send` = $_SESSION[USER_ID] OR `recive` = $_SESSION[USER_ID] AND `send` = $ID[id]"));
    if ($Row) {
        $DID = $Row['id'];
        mysqli_query($CONNECT, "UPDATE `dialog` SET `status` = 0, `send` = $_SESSION[USER_ID], `recive` = $ID[id] WHERE `id` = $Row[id]");
    } else {
        mysqli_query($CONNECT, "INSERT INTO `dialog` VALUES (null, 0, $_SESSION[USER_ID], $ID[id])");
        $DID = mysqli_insert_id($CONNECT);
    }
    mysqli_query($CONNECT, "INSERT INTO `message` VALUES (null, $DID, $_SESSION[USER_ID], '$p2', NOW())");
}


function MessageSend($p1, $p2, $p3 = '', $p4 = 1) {
    if ($p1 == 1) $p1 = 'Ошибка';
    else if ($p1 == 2) $p1 = 'Подсказка';
    else if ($p1 == 3) $p1 = 'Информация';
    $_SESSION['message'] = '<div class="MessageBlock"><b>'.$p1.'</b>: '.$p2.'</div>';
    if ($p4) {
        if ($p3) $_SERVER['HTTP_REFERER'] = $p3;
        exit(header('Location: '.$_SERVER['HTTP_REFERER']));
    }
}



function MessageShow() {
if ($_SESSION['message'])$Message = $_SESSION['message'];
echo $Message;
$_SESSION['message'] = array();
}
function UserLoginName($f) {
    //$f -> $_SESSION_['USER_LOGIN'];
    $mySession = $_SESSION['USER_LOGIN'];
    global $CONNECT;
    $Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `login`, `name` FROM `users` WHERE `login` = '$mySession'"));
    if ($Row['login'] == $f) return $Row['name'];
    else  return $Row['name'];

}
function UserCountry($p1) {
if ($p1 == 0) return 'Не указан';
else if ($p1 == 1) return 'Украина';
else if ($p1 == 2) return 'Россия';
else if ($p1 == 3) return 'США';
else if ($p1 == 4) return 'Таджикистан';
}

function UserGroup($p1) {
    if ($p1 == 0) return 'Пользователь';
    else if ($p1 == 1) return 'Модератор';
    else if ($p1 == 2) return 'Администратор';
    else if ($p1 == -1) return 'Заблокирован';
}

function UAccess($p1) {
    if ($_SESSION['USER_GROUP'] < $p1) MessageSend(1, 'У вас нет прав доступа для просмотра данной страницйы сайта', '/');
}


function RandomString($p1) {
$Char = '0123456789abcdefghijklmnopqrstuvwxyz';
for ($i = 0; $i < $p1; $i ++) $String .= $Char[rand(0, strlen($Char) - 1)];
return $String;
}

function HideEmail($p1) {
$Explode = explode('@', $p1);
return $Explode[0].'@*****';
}

function SearchForm() {
global $Page;
echo '<form method="POST" action="/search/'.$Page.'"><input type="text" name="text" value="'.$_SESSION['SEARCH'].'" placeholder="Что искать?" style="float: right;height: 30px;border: none;outline: none;background: #b59d47;width: 260px;"required><input type="submit" name="enter" style="float: right;color: blanchedalmond;background: brown;margin: 0;border: none;padding: 12px;cursor: pointer;"value="Поиск"></form>';
}
function FormChars($p1, $p2 = 0) {
global $CONNECT;
if ($p2) return mysqli_real_escape_string($CONNECT, $p1);
else return nl2br(htmlspecialchars(trim($p1), ENT_QUOTES), false);
}

function GenPass ($p1, $p2) {
    return md5('MRSHIFT'.md5('321'.$p1.'123').md5('678'.$p2.'890'));
}
function user_admin($f){
    if($_SESSION['USER_ID'] == 3) echo 'Super-Admin';
    else echo  'Ползватель';
}
function Head($p1) {
    if ($_SESSION['USER_AVATAR'] == 0) $Avatar = 0;
    if($_SESSION['USER_GROUP'] == 2) {$Super_Admin = '<style>.MenuHead:before {content: "Super-Admin";color: #000;font-size: 25px;padding-left: 190px;    position: absolute;top: 30px;left: -160px;font-weight: bold;font-family: inherit;text-shadow: 1px 1px 3px #666;color: #fff;}</style>';}
    else $Avatar = $_SESSION['USER_AVATAR'].'/'.$_SESSION['USER_ID'];
    echo '<!DOCTYPE html><html><head><meta charset="utf-8" /><title>'.$p1.'</title><meta name="keywords" content="" /><meta name="description" content="" /><link href="/resource/style.css" rel="stylesheet"> <link type="image/x-icon" href="/resource/img/favicon.ico" rel="icon">

        </head>';
}




function PageSelector($p1, $p2, $p3, $p4 = 5) {
    /*
    $p1 - URL (Например: /news/main/page)
    $p2 - Текущая страница (из $Param['page'])
    $p3 - Кол-во новостей
    $p4 - Кол-во записей на странице
    */
    $Page = $p3[0] / $p4; //делим кол-во новостей на кол-во записей на странице.
    if ($Page > 1) { //А нужен ли переключатель?
        echo '<div class="PageSelector">';
        for($i = ($p2 - 3); $i < ($Page + 1); $i++) {
            if ($i > 0 and $i <= ($p2 + 3)) {
                if ($p2 == $i) $Swch = 'SwchItemCur';
                else $Swch = 'SwchItem';
                echo '<a class="'.$Swch.'" href="'.$p1.$i.'">'.$i.'</a>';
            }
        }
        echo '</div>';
    }
}
function MiniIMG($p1, $p2, $p3, $p4, $p5 = 50){
    $Scr =  imagecreatefromjpeg($p1);
    $Size = getimagesize($p1);
    $Tmp = imagecreatetruecolor($p3, $p4);
    imagecopyresampled($Tmp, $Scr, 0, 0, 0, 0, $p3, $p4, $Size[0], $Size[1]);
    imagejpeg($Tmp, $p2, $p5);
    imagedestroy($Scr);
    imagedestroy($Tmp);
}

function ModuleID($p1){
    if ($p1 == 'news') return 1;
    elseif($p1 == 'loads') return 2;
    else MessageSend(1, 'Модул не найден!', '/');
}










function AdminMenu () {
echo '<div class="MenuHead"><a href="/admin"><div class="Menu">Главная</div></a><a href="/admin/stats"><div class="Menu">Статистика</div></a><a href="/admin/query/logout/1"><div class="Menu">Выход</div></a></div>';
}


function Menu () {
    $universal = '
        <a href="/"><div class="Menu">Главная</div></a>
        <a href="/news"><div class="Menu">Новости</div></a>
        <a href="/loads"><div class="Menu">Каталог файл</div>
    ';
    if ($_SESSION['USER_LOGIN_IN'] != 1)
        echo '
            <div class="MenuHead">
                '.$universal.'
                <a href="/register"><div class="Menu">Регистрация</div></a>
                <a href="/login"><div class="Menu">Вход</div></a>
                <a href="/restore"><div class="Menu">Восстановить пароль</div></a>
            </div>';

    else echo '
        <div class="MenuHead">
            '.$universal.'
            <a href="/profile"><div class="Menu">Профиль</div></a>
            <a href="/chat"><div class="Menu">Чат</div></a>
            <a href="/pm/send"><div class="Menu">ЛС</div></a>
            <a href="/user"><div class="Menu">Люди</div></a>
            <a href="/notice"><div class="Menu">Уведомления</div></a>
            <a href="/forum/main"><div class="Menu">Форум</div></a>
        </div>';
}

function Footer () {
echo '<footer class="footer">Mr.Shift - <a href="https://www.youtube.com/channel/UCpEWlcj5rkU1H9vkIf9Lb5g" target="blank">Мой канал на You Tube</a> - Пишем свой движок на PHP</footer>';
}
?>