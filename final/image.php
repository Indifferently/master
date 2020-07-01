<?php

Class Image
{
private $id;
private $user_id;
private $path;
private $tags;
private $title;
private $views;
private $created_at;
private $image_date;
private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function loadimage()

    {

        $this->user_id = $_SESSION['id'];
        $this->tags = $_POST['tags'];
        $this->title = $_POST['title'];

// Допустимые параметры файла

    $size = 5120000;
    $types = array('image/gif', 'image/png', 'image/jpeg');
    $time = date("YmdHis");
function reArrayFiles(&$file_post) 
{
  $file_ary = array();
  $file_count = count($file_post['name']);
  $file_keys = array_keys($file_post);
  for ($i=0; $i<$file_count; $i++) {
      foreach ($file_keys as $key) {
          $file_ary[$i][$key] = $file_post[$key][$i];

      }

  }

  return $file_ary;

}

$file_ary = reArrayFiles($_FILES['userfile']);
  foreach ($file_ary as $key_file => $value_file) {
    if (in_array($value_file['type'], $types) && $value_file['size']<=$size) {

              // Пути загрузки файлов

               $path1 = 'image';
               $img_type = trim(stristr($value_file['type'],'/'),'/');

               //Переименовываем каждый файл

      $loadfilename = $_SESSION['id']."_".$time."_".rand(1,100);
      $value_file["name"] = "$loadfilename";

      // Прописываем путь к файлу для SQL запросов

      $this->path = addslashes($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR).'image'.$value_file["name"].".".$img_type;

      // Вставка информации о загруженном файле в БД

      $insertQueryPhoto = "INSERT INTO `photos` (user_id,path,created_at,tags,title) VALUES('$this->user_id','$this->path',NOW(),'$this->tags','$this->title')";
      $this->pdo-> query($insertQueryPhoto) or die(print_r($this->pdo->errorInfo(), true));
      move_uploaded_file($value_file["tmp_name"],$this->path);

    }

   else{echo "Недопустимый размер или расширение файла";}
  }

}

public function show_image()

{
    $image_information = "SELECT * FROM `photos` ORDER BY created_at DESC";
    $image_information = $this->pdo-> query($image_information)->fetchALL(PDO::FETCH_ASSOC);
    foreach ($image_information as $image_keys => $value_image) {
      $this->id = $value_image['id'];
      $this->user_id = $value_image['user_id'];
      $this->path = stristr($value_image['path'],'\image');
      $this->views = $value_image['views'];
      $this->created_at = $value_image['created_at'];
      $this->tags = $value_image['tags'];
      echo'<div class="card mb-4 shadow-sm">
            <img src="'.$this->path.'" alt="'.$this->tags.'" class="img-fluid mx-auto d-block" width="600" height="800">
            <div class="card-body">
              <p class="card-text">'.$this->tags.'</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                <i class="far fa-eye">'.$this->views.'</i>
                <a class="text-white bg-dark" href="report.php?id='.$this->id.'"style="margin-left: 2px"> Развернуть фото </a>
                </div>
                <small class="text-muted">$this->'.$this->created_at.'</small>
              </div>
            </div>
          </div>
  ';
    echo '</br>';
}

}

public function show_personal_photo()

{
  $this->user_id = $_SESSION['id'];
  $user_image = "SELECT * FROM `photos` WHERE user_id = $this->user_id ORDER BY created_at DESC";
  $user_image = $this->pdo-> query($user_image)->fetchALL(PDO::FETCH_ASSOC);
  foreach ($user_image as $image_keys => $value_image) 
  {
    $this->id = $value_image['id'];
    $this->path = stristr($value_image['path'],'\image');
    $this->created_at = $value_image['created_at'];
    $this->tags = $value_image['tags'];
    $this->views = $value_image['views'];
    echo'<div class="card mb-4 shadow-sm">
    <img src="'.$this->path.'" alt="'.$this->tags.'" class="img-fluid mx-auto d-block" width="600" height="800">
    <div class="card-body">
      <p class="card-text">'.$this->tags.'</p>
      <div class="d-flex justify-content-between align-items-center">
        <div class="btn-group">
        <i class="far fa-eye">'.$this->views.'</i>
        <a class="text-white bg-dark" href="/classes/image.php?id='.$this->id.'&action=delete"style="margin-left: 2px"> <i class="fas fa-backspace">Удалить это фото!</i> </a>
        </div>
        <small class="text-muted">$this->'.$this->created_at.'</small>

      </div>
    </div>
  </div>

';
echo '</br>';
  }

}

public function show_one_photo()

{
  $this->id = $_GET['id'];
  $one_image = "SELECT * FROM `photos` WHERE id = '$this->id'";
  $one_image = $this->pdo-> query($one_image)->fetchALL(PDO::FETCH_ASSOC);
  $image_views_update=$this->pdo->query("UPDATE `photos` SET `views` = `views` + 1 WHERE `id`= '$this->id'");
  foreach ($one_image as $image_keys => $value_image) {
    $this->id = $value_image['id'];
    $this->path = stristr($value_image['path'],'\image');
    $this->created_at = $value_image['created_at'];
    $this->tags = $value_image['tags'];
    $this->views = $value_image['views'];
    echo $this->views;
    echo '<img src="'.$this->path.'" alt="'.$this->tags.'" class="img-fluid mx-auto d-block" width="800" height="1000">';
  }
}

//Удаление не работает

public function delete_photo()
{
  $this->id = $_GET['id'];
  var_dump($this->id);
  $image_del=$this->pdo->query("DELETE FROM `photos` WHERE `id`= '$this->id'");
}

}
//Окончание свойств и методов класса 

//Удаление не работает

if (($_GET['action'])) 
{
$deleteImage = new Image($pdo);
$deleteImage ->delete_photo();
var_dump($this->id);
header("Location:/PersonalArea.php");
}

?>
