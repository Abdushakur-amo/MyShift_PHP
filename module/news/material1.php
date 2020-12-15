<?php
    $Param['id'] += 0;
    if ($Param['id'] == 0) MessageSend(1, 'URL адрес указан неверно.', '/news');
    $Row = mysqli_fetch_assoc(mysqli_query($CONNECT, 'SELECT `id`, `name`, `cat`, `added`, `text`, `date`, `active`, `rate`, `rateusers` FROM `news` WHERE  `id` = '.$Param['id']));
    if (!$Row['name']) MessageSend(1, 'Такой новости не существует.', '/news');
    $sql = "UPDATE `news` SET `rate` = '1' WHERE `news`.`id` = 5";
    if (!$Row['active'] and $_SESSION['USER_GROUP'] != 2)  MessageSend(1, 'Новсть ождаеть модератсии...', '/news');
    mysqli_query($CONNECT, 'UPDATE `news` SET `rate` = `rate` + 1 WHERE `news`.`id` = '.$Param['id']);
    Head($Row['name']);
?>
<body>
    <div class="wrapper">
        <div class="header"></div>
            <div class="content">
                <?php Menu(); MessageShow(); ?>
                <div class="Page">
                <?php
                    if ( !$Row['active'] ) $Active = '<li><a  href="/news/control/id/'.$Param['id'].'/command/active">Active</a></li>';
                    if ($_SESSION['USER_GROUP'] == 2) {
                        $editNews = '<li><a href="/news/edit/id/'.$Param['id'].'">Редактировани</a></li>';
                        $deletNews = '<li><a href="/news/control/id/'.$Param['id'].'/command/delete">Удалить новости!</a></li>';
                    }
                    echo '
                        <ul class="newsChat">
                            <li>Просомтров: '.($Row['rate'] + 1).'</li>
                            <li>Добавил:    '.$Row['added'].' </li>
                            <li>Дата:       '.$Row['date'].'</li>
                            '.$editNews.$deletNews.$Active.'

                        </ul>
                    ';
                    echo '<br><br>
                        <h3 style="clear:both;">'.$Row['name'].'</h3><br>
                        <p>'.$Row['text'].'</p>
                    ';
                    COMMENTS();
                ?>
                </div>
        </div>
        <?php Footer() ?>
    </div>
</body>
</html>