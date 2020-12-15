<?php 
ULogin(0);
Head('Вход') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>
<div class="Page">
<form method="POST" action="/account/login">
<br><input type="text" name="login" placeholder="Логин" maxlength="10"  required>
<br><input type="password" name="password" placeholder="Пароль" maxlength="15"  required>
<div class="capdiv"><input type="text" class="capinp" name="captcha" placeholder="Капча" maxlength="10"  required> <img src="/resource/captcha.php" class="capimg" alt="Каптча"></div>
<br><input type="checkbox" name="remember"> Запомнить меня
<br><br><input type="submit" name="enter" value="Вход"> <input type="reset" value="Очистить">
</form>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>