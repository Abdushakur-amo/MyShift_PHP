<?php
UAccess(2);
if ($Param['id'] and $Param['command']) {
	if($Param['command'] == 'delete'){
		mysqli_query($CONNECT, "DELETE FROM `news` WHERE `id` = $Param[id]");
		mysqli_query($CONNECT, "DELETE FROM `comments` WHERE `material` = $Param[id] AND `module` = 2");
		MessageSend(3, 'Новсть удалена.!', '/news');
	}
} elseif ($Param['command'] == 'active') {
	mysqli_query($CONNECT, "UPDATE `news` SET `active` = 1 WHERE `id` = $Param[id]");
	MessageSend(3, 'Новсть активирована.', '/news/material/id/'.$Param['id']);
}

?>