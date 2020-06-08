<?php
function countWords($typeFile,$message)
{
    if($typeFile === 'file')
    {
        $pathFile = 'File';
    }
    else
    {
        $pathFile = 'Input';
    }
    $symbol = [",",".","-",PHP_EOL];
    $arrayAssoc=[];
    $message = str_replace($symbol,"",$message);
    $message = mb_strtolower($message);
    $array = explode(" ",$message);
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
    $list = array(array("Word","Count"));
    foreach ($arrayAssoc as $key => $Value)
    {
        array_push($list,array($key,$Value));
    }
    array_push($list,array("total words",count($arrayAssoc)));
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
    countWords('file',$valueText);
}
if(!empty($_POST['Message'])){
    $text = $_POST['Message'];
    countWords('text',$text);
}
?>
