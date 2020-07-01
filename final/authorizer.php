<?php

require_once('config.php');

?>

<!DOCTYPE html>
<html lang="ru">
<head>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<link rel="stylesheet" type="text/css" href="style.css">

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>

<!--Шапка сайта-->

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">

  <h5 class="my-0 mr-md-auto font-weight-normal">Учебная страница</h5>
  <a class="btn btn-outline-primary" href="register.php" style="margin-left: 10px">Регистрация</a>
  <a class="btn btn-outline-primary" href="index.php" style="margin-left: 10px">Главная страница</a>
  <a class="btn btn-outline-primary" href="loadcontent.php" style="margin-left: 10px">Загрузить фото</a>
  <a class="btn btn-outline-primary" href="PersonalArea.php" style="margin-left: 10px">Личный кабинет</a>

</div>

<?php

//Если пользователь не зарегестрирован и его данных нет в сессии, предоставить право на регестрацию, открыв форму авторизации

if (empty($_SESSION['login']) && empty($_SESSION['id']) ) {
echo '<div class = "container mt-4 text-center pt-4 my-md-5 pt-md-5">

<form class="form-signin" action = "avtorization.php" method = "post" >
  <h1 class="h3 mb-3 font-weight-normal mb-4">Авторизация</h1>
  <label for="inputLogin" class="sr-only mb-4">Введите логин</label>
  <input type="text" name = "login" id="inputLogin" class="form-control" placeholder="Login" required autofocus>
  <label for="inputPassword" class="sr-only mb-4">Введите пароль</label>
  <input type="text" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Авторизироваться</button>
</form>
</div>';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['login']) && !empty($_POST['password'])) {
$newUser = new User($pdo);
$newUser->Autorization();
}
}
else
{
  echo'<p>'.$_SESSION['login'].', вы авторизованы !</p>'; 
}
?>

  <footer class="pt-4 my-md-5 pt-md-5 border-top">
    <div class="row">
      <div class="col-12 col-md">
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
