<?php
if ($_POST['enter']) {
	$textSearchUser = FormChars($_POST['text']);
	$SearchUser = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT DISTINCT `name`, `login` FROM `users` WHERE `name`  LIKE '%$textSearchUser%' "));
	if (!$SearchUser['name']) {
		MessageSend(1, 'Пользователь не найден.', '/user');
	} else{
			$Query = mysqli_query($CONNECT, "SELECT DISTINCT `name`, `login`, `regdate`  FROM `users` WHERE `name`  LIKE '%$textSearchUser%'");
			while ($Row = mysqli_fetch_assoc($Query)){
				$i++;
			$Draw .= '<a href="/user/'.$Row['login'].'">
						<div class="ChatBlock">
						<span>Найден: '.$i.'| '.$Row['date'].'</span>'
						.$Row['name'].'
						</div>
					</a>';

			}

	}
}
else if ($Module) {
	$Module = FormChars($Module);
	$Info = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id`, `name`, `email`, `country`, `regdate`, `avatar`,`group` FROM `users` WHERE `login` = '$Module'"));
	if (!$Info['id']) MessageSend(1, 'Пользователь не найден.', '/user');
	if (!$Info['avatar']) $Avatar = 0;
	else $Avatar = "$Info[avatar]/$Info[id]";
	$Draw = '
		<img src="/resource/avatar/'.$Avatar.'.jpg" width="120" height="120" alt="Аватар" align="left">
		<div class="Block">
			ID '.$Info['id'].' ('.UserGroup($Info['group']).')
			<br>Имя '.$Info['name'].'
			<br>E-mail '.HideEmail($Info['email']).'
			<br>Страна '.UserCountry($Info['country']).'
			<br>Дата регистрации '.$Info['regdate'].'
		</div>
		<a href="/" class="button ProfileB">Написать</a><br><br>
		<div class="ProfileEdit">
		</div>';
	} else {
		$Query = mysqli_query($CONNECT, 'SELECT `login`, `name` FROM `users` ORDER BY `id` DESC LIMIT 10');
		while ($Row = mysqli_fetch_assoc($Query))
			$Draw .= '<a href="/user/'.$Row['login'].'">
						<div class="ChatBlock">
						<span>Найден: '.$i.'| '.$Row['date'].'</span>'
						.$Row['name'].'
						</div>
					</a>';
	}

// else echo 'Человек по именной<b>'.$_POST['text'].'</b> не найденно!';
ULogin(1);
Head('Профиль пользователя') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow();
?>
<div class="Page">
<?php
echo'<form method="POST" action="/user">
		<input type="text" name="text" value="'.$textSearchUser.'" placeholder="Кто вам нужна?" style="height: 30px;border: none;outline: none;background: #b59d47;width: 500px;"required>
		<input type="submit" name="enter" style="color: blanchedalmond;background: brown;margin: 0;border: none;padding: 12px;cursor: pointer;"value="Поиск">
	 </form>';


echo $Draw; ?>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>