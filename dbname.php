<?php

try{
//    $connect=new PDO("mysql:host=localhost;dbname=youtube_db_project;charset=utf8","root","");
//    $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   echo "successful connected to db named 'youtube_db_project'";
   $db_connection = pg_connect("host=localhost port=8080 dbname=test user=masoud password=mdar");
}catch (PDOException $e){
    die("error database : ".$e->getMessage());
    echo "unsuccessful";
}


?>