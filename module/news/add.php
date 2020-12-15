<?php
ULogin(1);
if ($_SESSION['USER_GROUP'] == 2) $Active = 1;
else $Active = 0;


if ($_POST['enter'] and $_POST['text'] and $_POST['name'] and $_POST['cat']) {
	$_POST['name'] = FormChars($_POST['name']);
	$_POST['text'] = FormChars($_POST['text']);
	$_POST['cat'] += 0;
	$sql = "INSERT INTO `news` (`id`, `name`, `cat`, `added`, `text`, `date`, `active`, `rate`, `rateusers`) VALUES (NULL, '$_POST[name]', $_POST[cat], '$_SESSION[USER_LOGIN]', '$_POST[text]', NOW(), $Active, 0, 0)";
	mysqli_query($CONNECT, $sql);
	MessageSend(2, 'Новость добавлена', '/news');

}



Head('Добавление новостей') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow()
?>
<div class="Page">
	<form method="POST" action="/news/add">
		<br>
		<input type="text" name="name" placeholder="Имя">
		<br>
		<select size="1" name="cat">
			<option value="1">Категория 1</option>
			<option value="2">Категория 2</option>
			<option value="3">Категория 3</option>
			<option value="4">Категория 4</option>
		</select>
		<br>
		<textarea name="text" required></textarea>
		<br>
		<input type="submit" name="enter" value="Добавить">
		<input type="reset" value="Очистить">
	</form>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>