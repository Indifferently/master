<?php
function countWords($Value){

    $symbol = [",",".","-",PHP_EOL];
    $arrayAssoc=[];
    $message = str_replace($symbol,"",$Value);
    $message = mb_strtolower($message);
    $array = explode(" ",$message);
    $count = count($array);
    $insertData =[];

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

    $pdo = new PDO('mysql:host=localhost:3306;dbname=Num3',"root","root");
    $query = 'INSERT INTO uploaded_text(content,date,words_count) VALUES(?,?,?)';
    $statement = $pdo->prepare($query);
    $statement->execute([$Value,date("Y-m-d h:i:s"),$count]);
    $query = 'SELECT id FROM uploaded_text order by id desc';
    $id = $pdo->query($query)-> fetch();

    foreach ($arrayAssoc as $key => $value){

        array_push($insertData,array($id[0],$key,$value));

    }
    $statement = $pdo->prepare('INSERT INTO word(text_id,word,count) VALUES (?,?,?)');

    $pdo->beginTransaction();

    foreach ($insertData as $row){

        $statement->execute($row);
    }
    $pdo->commit();
    header("Location: /",true,307);
}

if(empty(!$_FILES['docs']['name'])){

    $value = file_get_contents($_FILES['docs']['tmp_name']);

    if(!empty($value)){
        countWords($value);
    }
}
