<?php
	UAccess(2);
	$Param['id'] += 0;
	if (!$Param['id']) MessageSend(1, 'Не указан ID файл ', '/loads');
	$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `cat`, `name`, `text`, `dfile`, `dimg`, `link` FROM `loads` WHERE `id` = $Param[id]"));
	if (!$Row['name']) MessageSend(1, 'Материял  не найдена', '/loads');
	if ($Row['link'] and !$Row['dfile']) $Link = $Row['link'];
	if ($_POST['enter'] and $_POST['text'] and $_POST['name'] and $_POST['cat']) {
		$_POST['name'] = FormChars($_POST['name']);
		$_POST['text'] = FormChars($_POST['text']);
		$_POST['link'] = FormChars($_POST['link']);
		$_POST['cat'] += 0;

		if($_FILES['file']['tmp_name']) move_uploaded_file($_FILES['file']['tmp_name'], 'catalog/file/'.$Row['dfile'].'/'.$Param['id'].'.zip');
		if($_POST['link']){
			$filenameImg  = 'catalog/img/'.$Row['dimg'].'/'.$Param['id'].'.jpg';
			if(file_exists($filenameImg)) unlink($filenameImg);
			$Link_add = ", `link` = '$_POST[link]', `dfile` = 0";
		}
		if($_FILES['img']['tmp_name']) move_uploaded_file($_FILES['img']['tmp_name'], 'catalog/img/'.$Row['dimg'].'/'.$Param['id'].'.jpg');
		mysqli_query($CONNECT, "UPDATE `loads` SET `name` = '$_POST[name]', `cat` = $_POST[cat], `text` = '$_POST[text]'  $Link_add WHERE `id` = $Param[id]");
		MessageSend(2, 'Материял отредактирована.', '/loads/material/id/'.$Param['id']);
	}










	Head('Редактировать материял');
?>
	<body>
	<div class="wrapper">
	<div class="header"></div>
	<div class="content">
	<?php Menu();MessageShow()?>
<div class="Page">
<?php
echo '
	<form method="POST" action="/loads/edit/id/'.$Param['id'].'" enctype="multipart/form-data">
		<br> <input type="text" name="name" placeholder="Название новости" value="'.$Row['name'].'" required>
		<br><select size="1" name="cat">'.str_replace(' value=" '.$Row['cat'], ' selected value="'.$Row['cat'], '<option value="1">Категория 1</option><option value="2">Категория 2</option><option value="3">Категория 3</option>').'</select>
		<br><input type="url" name="link" value="'.$Link.'" >
		<br><input type="file" name="file">(Files)
		<br><input type="file" name="img"> (images)
		<br><textarea class="Add" name="text" required>'.str_replace('<br>', '', $Row['text']).'</textarea>
		<br><input type="submit" name="enter" value="Сохранить"> <input type="reset" value="Очистить">
		<br>
	</form>'
?>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>