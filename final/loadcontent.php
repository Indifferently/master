<?php require_once('config.php'); 

?>

<!DOCTYPE html>
<html lang="ru">
<head>

    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!--<link rel="stylesheet" href="/feedback/vendors/bootstrap/css/bootstrap.min.css">-->
    <!--<link rel="stylesheet" href="/feedback/css/main.css">-->
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
  <a class="btn btn-outline-primary" href="avtorization.php" style="margin-left: 10px">Авторизация</a>
  <a class="btn btn-outline-primary" href="index.php" style="margin-left: 10px">Главная страница</a>
  <a class="btn btn-outline-primary" href="PersonalArea.php" style="margin-left: 10px">Личный кабинет</a>
</div>

<?php

if (!empty($_SESSION['login']) && !empty($_SESSION['id']) ) {

echo'

<div class = "container mt-4 text-center pt-4 my-md-5 pt-md-5">
<form class="form-signin" action = "loadcontent.php" method = "post" enctype="multipart/form-data">
  <h1 class="h3 mb-3 font-weight-normal mb-4">Загрузка файлов</h1>
  <label for="inputTitle" class="sr-only mb-4">Заголовок</label>
  <input type="text" name = "title" id="inputLogin" class="form-control" placeholder="Заголовок" required autofocus>
  <label for="inputPassword" class="sr-only mb-4">Теги</label>
  <input type="text" name="tags" id="inputTags" class="form-control" placeholder="Теги в формате (#тег)" required>
  <div class="custom-file px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center"> 
  <input type="file" name="userfile[]" class="custom-file-input" id="customFile" multiple>
  <label class="custom-file-label" for="customFile">Выбор файлов...</label>
  <button type = "submit" name="button" class = "btn btn-success">Отправить</button>
</div>
</form>
</div>';

?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$newImage = new Image($pdo);
$newImage->loadimage();
}

}
else
{
echo "<p>Зарегестрируйтесь или авторизируйтесь, чтобы загрузить фото!</p>";}

?>

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

<!--

<label for="inputTitle" class="sr-only mb-4">Заголовок</label>
  <input type="text" name = "title" id="inputLogin" class="form-control" placeholder="Заголовок" required autofocus>
  <label for="inputPassword" class="sr-only mb-4">Теги</label>
  <input type="text" name="tags" id="inputTags" class="form-control" placeholder="Теги в формате (#тег)" required>
  <div class="custom-file px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center"> 
  -->
</html>
