<?php

//echo $_SESSION['USER_LANGUAGE'];
//echo !in_array($p1, array('ru', 'en'));

//exit;
function SetLang($p1) {
	if (!in_array($p1, array('ru', 'en'))){
			$p1 = 'en';
		}

	$_SESSION['USER_LANGUAGE'] = $p1;
	//echo "injoyam".$_SESSION['USER_LANGUAGE'];
}




if (!$_SESSION['USER_LANGUAGE']) {
	SetLang(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));

}
//echo "include".$_SESSION['USER_LANGUAGE'];
include "resource/language/$_SESSION[USER_LANGUAGE].php";
if ($Module) {
	SetLang($Module);
	//header('Location: /language');
	MessageSend(1, $_SESSION['USER_LANGUAGE'], '/language', 0);
}





Head('Мультиязычность') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow()
?>
<div class="Page">
<a href="/language/ru" class="lol">Русский язык</a> | <a href="/language/en" class="lol">Английский язык</a>

<?php

echo '<br><br>'.L1.'<br>'.L2;


?>

</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>