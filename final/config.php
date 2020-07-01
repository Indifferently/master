?php

session_start();
ini_set('default_charset', 'UTF-8');
mb_internal_encoding("UTF-8");

define("HOST", "localhost");
define("DBNAME", "media");
define("DBUSER", "root");
define("DBPASSWORD", "");

//подключение через PDO
    $pdo = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBUSER, DBPASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
//автозагрузка классов

spl_autoload_register(function  ($className) {
  $className = str_replace( '\\', '/', $className );
  require_once('classes/'.$className.'.php');
});
?>
