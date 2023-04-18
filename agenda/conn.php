<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "agenda";

    try{
        $conn = new PDO("mysql:host=$host;dbname=" .$dbname, $user, $pass);
        //echo "Conexão realizada com sucesso";
    }catch(PDOException $erro){
        echo "Erro ao conectar ".$erro->getMessage();
    }
?>