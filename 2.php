<?php
function countWords($typeFile,$message2)
{
    if($typeFile === 'файл')
    {
        $pathFile = 'Файл';
    }
    else
    {
        $pathFile = 'Input';
    }
    $symbol = [",",".","-",PHP_EOL];
    $arrayAssoc=[];
    $message2 = str_replace($symbol,"",$message2);
    $message2 = mb_strtolower($message2);
    $array = explode(" ",$message2);
    foreach ($array as $word)
    {
        if(!array_key_exists($word,$arrayAssoc))
        {
            $arrayAssoc[$word] = 1;
        }
        else
        {
            $arrayAssoc[$word] += 1;
        }
    }
    $list = array(array("Слов","Подсчитать"));
    foreach ($arrayAssoc as $key => $Value)
    {
        array_push($list,array($key,$Value));
    }
    array_push($list,array("Слов",count($arrayAssoc)));
    $path = "Result/{$pathFile}/".date("U").".csv";
    $fp = fopen($path,'w');
    foreach ($list as $lines)
    {
        fputcsv($fp,$lines);
    }
    fclose($fp);
}
if(!is_dir("Result"))
{
    mkdir("Result",0777,true);
}
if(!is_dir("Result/File"))
{
    mkdir("Result/File",0777,true);
}
if(!is_dir("Result/Input"))
{
    mkdir("Result/Input",0777,true);
}
if(!empty($_FILES['docs']['name']))
{
    $valueText = file_get_contents($_FILES['docs']['tmp_name']);
    countWords('файл',$valueText);
}
if(!empty($_POST['Message2'])){
    $text = $_POST['Message2'];
    countWords('text',$text);
}
?>
