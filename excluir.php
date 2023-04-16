<?php   
    require_once 'conn.php';

    $excluir = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    var_dump($excluir);

    $query_excluir = "DELETE FROM tableEqui WHERE id=:id LIMIT 1";
    $result_excluir = $conn->prepare($query_excluir);
    $result_excluir->bindParam(':id', $excluir);
    $result_excluir->execute();
    if($result_excluir->rowCount()){
        header('Location: index.php');
    }
    