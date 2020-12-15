<?php
    $Param['id'] += 0;
    if ($Param['id'] == 0) MessageSend(1, 'URL адрес указан неверно.', '/loads');
        $Row = mysqli_fetch_assoc(mysqli_query($CONNECT, 'SELECT * FROM `loads` WHERE  `id` = '.$Param['id']));
    if (!$Row['name']) MessageSend(1, 'Такой новости не существует.', '/loads');
        $sql = "UPDATE `loads` SET `rate` = '1' WHERE `loads`.`id` = 5";
    if (!$Row['active'] and $_SESSION['USER_GROUP'] != 2)  MessageSend(1, 'Новсть ождаеть модератсии...', '/loads');
        mysqli_query($CONNECT, 'UPDATE `loads` SET `rate` = `rate` + 1 WHERE `loads`.`id` = '.$Param['id']);
        Head($Row['name']);
    if ($Row['link'] and !$Row['dfile']) $Download = $Row['link'];
    else $Download = '/loads/download/id/'.$Param['id'];
?>
<body>
    <div class="wrapper">
        <div class="header"></div>
            <div class="content">
                <?php Menu(); MessageShow(); ?>
                <div class="Page">
                <?php
                    if ( !$Row['active'] ) $Active = '<li><a  href="/loads/control/id/'.$Param['id'].'/command/active">Active</a></li>';
                    if ($_SESSION['USER_GROUP'] == 2) {
                        $editloads = '<li><a href="/loads/edit/id/'.$Param['id'].'">Редактировани</a></li>';
                        $deletloads = '<li><a href="/loads/control/id/'.$Param['id'].'/command/delete">Удалить новости!</a></li>';
                    }
                    echo '
                        <ul class="newsChat">
                            <li>Просомтров: '.($Row['rate'] + 1).'</li>
                            <li>Добавил:    '.$Row['added'].' </li>
                            <li>Скачали:    '.$Row['download'].' </li>
                            <li>Дата:       '.$Row['date'].'</li>
                            '.$editloads.$deletloads.$Active.'

                        </ul>
                    ';
                    echo '<br><br>
                        <h3 style="clear:both;">'.$Row['name'].'</h3><br>
                        <img src="/catalog/img/'.$Row['dimg'].'/'.$Param['id'].'.jpg" alt="IMG '.$Row['name'].'" width="250"><br>
                        <p>'.$Row['text'].'</p><br>
                        <br><a style="color:#666;" href="'.$Download.'">Скачать файл</a>
                    ';
                    COMMENTS();
                ?>
                </div>
        </div>
        <?php Footer() ?>
    </div>
</body>
</html>