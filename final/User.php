<?php

Class User
{
private $id;
private $login;
private $password;
private $email;
private $pdo;
    public function __construct($pdo) 
    {
        $this->pdo = $pdo;
    }
public function register()
{
    $this->login=htmlspecialchars(trim($_POST['login']));
    $this->password=md5(mb_strtolower(htmlspecialchars(trim($_POST['password']))));
    $this->email=htmlspecialchars(trim($_POST['email']));

    //Проверка на зарегестрированного пользователя в БД

    $errlog = "SELECT count(*) FROM `users` WHERE login = '$this->login'";
    $errmail= "SELECT count(*) FROM `users` WHERE email = '$this->email'";
    $result1 = $this->pdo->prepare($errlog);
    $result2 = $this->pdo->prepare($errmail);
    $result1->execute(); 
    $result2->execute();
    $number_of_rows1 = $result1->fetchColumn(); 
    $number_of_rows2 = $result2->fetchColumn(); 

    //Если пользователь зарегестрирован под введенным логином или введенный в форме email существует, регистрация не призойдёт
    //Считает количество совпадений в запросе
    
       if ($number_of_rows1 > 0 || $number_of_rows2 > 0) 
       {
       echo '<h3 class = "mx-auto d-block">Пользователь с таким логином или email существует!</h3>';
       }
       else 
       {
    // Заносим пользователя в БД // 
    
    $select_table_users = "SELECT*FROM `users`";

    // добавляем данные о пользователе в БД

    $user_insert = 'INSERT INTO `users`(login, password, email) VALUES (?, ?, ?)';
    $bd_insert = $this->pdo->prepare($user_insert);		 // добавляем данные о пользователе в БД
    $success = $bd_insert->execute([$this->login, $this->password, $this->email]); 
    $_SESSION['id'] = $this->pdo->lastInsertId();
    $this ->id = $_SESSION['id'];
    $_SESSION['login'] = $this->login;
    session_write_close();
    header("Location:/index.php");
      }
      }
public function Autorization()
{
    //Переменной ЭТОГО класса задаем значение из поста формы

    $this->login = htmlspecialchars(trim($_POST['login']));	

    //
    
    $BDlogin = "SELECT * FROM `users` WHERE login = '$this->login'";
    $rezault = $this->pdo->query($BDlogin)->fetch(PDO::FETCH_ASSOC);
    if ($rezault['login'] != $_POST['login'] || $rezault['password'] != $_POST['password']) {
              $_SESSION['msg'] = 'неправильный логин или пароль';  
              unset($_SESSION);
      }
      else 
      {
          $_SESSION['login'] = $rezault['login'];
          $this->login = $_SESSION['login'];
          $_SESSION['id'] = $rezault['id'];
          $this->id = $_SESSION['id'];
          $this->password = $rezault['password'];
          $this->email = $rezault['email'];
        header("url=\index.php");
      }
}
public function user_isset()
{
if (condition) 
{
    $_SESSION['login'] = $rezault['login'];
          $this->login = $_SESSION['login'];
          $_SESSION['id'] = $rezault['id'];
          $this->id = $_SESSION['id'];
          $this->password = $rezault['password'];
          $this->email = $rezault['email'];
}
}

} 
?>
