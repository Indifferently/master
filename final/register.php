<?php

require_once('config.php');

?>

<!DOCTYPE html>
<html lang="ru">
<head>
<link rel="stylesheet" type="text/css" href="style.css">

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

</head>
<body class="text-center">

<!--Шапка сайта-->

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal">Учебная страница</h5>
  <a class="btn btn-outline-primary" href="index.php" style="margin-left: 10px">Главная страница</a>
  <a class="btn btn-outline-primary" href="avtorization.php" style="margin-left: 10px">Авторизация</a>
  <a class="btn btn-outline-primary" href="loadcontent.php" style="margin-left: 10px">Загрузить фото</a>
  <a class="btn btn-outline-primary" href="PersonalArea.php" style="margin-left: 10px">Личный кабинет</a>

</div>
<?php

if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['email']))
{
  $newUser = new User($pdo);
  $newUser->register();
}

?>

<div class = "container mt-4 text-center pt-4 my-md-5 pt-md-5">
<form class="form-signin" action = "register.php" method = "post" >

  <h1 class="h3 mb-3 font-weight-normal mb-4">Регистрация</h1>
  <label for="inputLogin" class="sr-only mb-4">Введите логин</label>
  <input type="text" name = "login" id="inputLogin" class="form-control" placeholder="Login" required autofocus>
  <label for="inputPassword" class="sr-only mb-4">Введите пароль</label>
  <input type="text" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
  <label for="inputEmail" class="sr-only mb-4">Введите Email</label>
  <input type="text" name = "email" id="inputEmail" class="form-control" placeholder="email" required autofocus>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Зарегистрироваться</button>

</form>
</div>

  <footer class="pt-4 my-md-5 pt-md-5 border-top">
    <div class="row">
      <div class="col-12 col-md">
        <!--<img class="mb-2" src="/docs/4.4/assets/brand/bootstrap-solid.svg" alt="" width="24" height="24">-->
        <small class="d-block mb-3 text-muted">© 2017-2019</small>
      </div>
      <div class="col-6 col-md">
        <h5> <a class="text-muted" href="contact.php">Кoнтакты</a></h5>
        <ul class="list-unstyled text-small">
          <li><p>Адрес электронной почты:</p> <a class="text-muted" href="#">css.black@yandex.ru</a></li>
        </ul>
        
  </footer>
  </div>
  </div> 

</body>
</html>
