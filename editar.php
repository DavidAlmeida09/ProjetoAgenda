<?php
    include_once './conn.php';
?>
<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Equipamento</title>
    <link rel="stylesheet" href="style.css">
    
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    
  </head>
    </head>

    <body>
        <?php
            //recebendo o id enviando pela URL
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);   
 
                      //atualizando o usuario

                      $formdata = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                      if(!empty($formdata['send'])){
                        try{
                            //var_dump($formdata);
    
                            $query_update = "UPDATE tableEqui SET equipamento=:equipamento, descricao=:desc, status=:status, empresa=:empresa, valor=:valor,modifed=NOW() WHERE id=$id";
                            $result_up = $conn->prepare($query_update);
                            $result_up->bindParam(':equipamento', $formdata['equipamento']);
                            $result_up->bindParam(':status', $formdata['status']);
                            $result_up->bindParam(':empresa', $formdata['empresa']);
                            $result_up->bindParam(':desc', $formdata['desc']);
                            $result_up->bindParam(':valor', $formdata['valor']);
                            $result_up->execute();
    
                            if($result_up->rowCount()){
                                header('Location: index.php');
                            }
                          }catch(PDOException $mg){
                            echo "erro" .$mg->getMessage();
                          }
                      }
        ?>

        <div class="container">
            <div class="header">
                <span>Editar Registros</span>
                <button id="excluir"><a href="index.php">Voltar</i></a></button>
                <!--<button onclick="openModal()" id="new">EDITAR</i></button>-->
                
            </div>

            <div class="divTable">
                <table>
                    <thead>
                        <tr>
                        <th>#</th>
                            <th>Atividade</th>
                            <th>Descrição da atividade</th>
                            <th>Status da atividade</th>
                            <th>Data da atividade</th>    
                            <th class="acao">Editar</th>
                            <!--<th class="acao">Excluir</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            //ROTINA DE DE SELECIONAR O USUARIO PELA URL

                            $query_select = "SELECT id, equipamento, descricao, status, created, empresa, valor FROM tableEqui WHERE id=:id";
                            $result_select = $conn->prepare($query_select);
                            $result_select->bindParam(':id', $id);
                            $result_select->execute();

                            while($row = $result_select->fetch(PDO::FETCH_ASSOC)){
                                extract($row);

                                echo "<td>$id</td>";
                                echo "<td>$equipamento</td>";
                                echo "<td>$descricao</td>";
                                echo "<td>$status</td>";
                                echo "<td>$empresa</td>";
                                
                                echo "<td><button onclick='openModal()' id='new'>EDITAR</i></button></td>";
                                //echo "<td><button id='excluir'><a href='excluir.php?id=$id'>Excluir</a></button></td>";
                                echo "<tr></tr>";
                            }

                            //ROTINA DE EXCLUIR 
                            $query_excluir = "DELETE FROM tableEqui WHERE id=:id";
                            $result_excluir = $conn->prepare($query_excluir);
                            $result_excluir->bindParam('id', $dados['id']);
                            $result_excluir->execute();
                            
                        ?>
                    </tbody>
                </table>
            </div>

            
            <div class="modal-container">
                <div class="modal">
                    <form method="POST" action="">
                    
                
                        <label for="m-funcao">Atividade</label>
                        <input id="m-funcao" type="text" name="equipamento" value="<?php echo $equipamento?>" required />

                        <label for="m-funcao">Descrição da atividade</label>
                        <input id="m-funcao" type="text" name="desc" value="<?php echo $descricao?>" required />

                        <label for="m-salario">Status da atividade</label>
                        <input id="m-salario" type="text" name="status" value="<?php echo $status?>" required />

                        <label for="m-salario">Data</label>
                        <input id="m-salario"  type="date" name="empresa"  value="<?php echo $empresa?>"  required />

                        <label for="m-salario">Valor</label>


                        <input type="submit" id="new"  id="btnSalvar" value="Enviar" name="send">
                        <button id="excluir"><a href="index.php">Voltar</a></button>
                        
                    </form>             
                </div>
            </div>          
            <footer class="centralizar">Desenvolvido por David Almeida - Filial 049</footer>
        </div>
        <script src="script.js"></script>
    </body>

</html>