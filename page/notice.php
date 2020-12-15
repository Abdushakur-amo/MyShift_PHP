<?php
ULogin(1);
if ($Module == 'delete' and $Param['id']) {
	$Param['id'] += 0;
	$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `uid` FROM `notice` WHERE `id` = $Param[id]"));
	if (!$Row['uid']) MessageSend(1, 'Уведомление не найдено.', '/notice');
	else if ($Row['uid'] != $_SESSION['USER_ID']) MessageSend(1, 'Доступ запрещен.', '/notice');
	mysqli_query($CONNECT, "DELETE FROM `notice` WHERE `id` = $Param[id]");
	MessageSend(1, 'Уведомление удалено.', '/notice');
}

Head('Уведомления') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow()
?>
<div class="Page">
	<?php
		//Танҳо уведомлениёй маро ҳисоб кардааст
		$Count = mysqli_fetch_row(mysqli_query($CONNECT, "SELECT COUNT(`id`) FROM `notice` WHERE `uid` = $_SESSION[USER_ID]"));
		if (!$Module) {
			$Module = 1;
			//Аз 0 то 5 запсро барор
			$Result = mysqli_query($CONNECT, "SELECT * FROM `notice` WHERE `uid` = $_SESSION[USER_ID] ORDER BY `id` DESC LIMIT 0, 5");
		} else {
			$Start = ($Module - 1) * 5;
			$Result = mysqli_query($CONNECT, str_replace('START', $Start, "SELECT * FROM `notice` WHERE `uid` = $_SESSION[USER_ID] ORDER BY `id` DESC LIMIT START, 5"));
		}
		PageSelector('/notice/', $Module, $Count);
		while ($Row = mysqli_fetch_assoc($Result)) {
			if ($Row['status']) $Status = 'Прочитано';
			else $Status = 'Не прочитано';
			echo '<div>
					<div class="ChatBlock">
						<span>'.$Status.'Дата: | '.$Row['date'].' | <a href="/notice/delete/id/'.$Row['id'].'">Удалить</a> | '.$Status.'</span>
						<h3>'.$Row['title'].'</h3>
						<br>
						<p>'.$Row['text'].'</p>
					</div>
				  </div>';
		}
		mysqli_query($CONNECT, "UPDATE `notice` SET `status` = 1 WHERE `uid` = $_SESSION[USER_ID] AND `status` = 0");
	?>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>