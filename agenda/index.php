<?php
    include_once './conn.php';
?>
<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de manutenção</title>
    <link rel="stylesheet" href="style.css">
    
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    
  </head>
    </head>

    <body>
        <?php 
        
                $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                if(!empty($dados['salva'])){
                              //var_dump($dados);
                    $query_insert = "INSERT INTO tableEqui (equipamento, descricao, status, empresa, created) VALUES (:equipamento, :descricao, :status, :empresa, NOW())";
                    $result_insert = $conn->prepare($query_insert);
                    $result_insert->bindParam(':equipamento', $dados['equipamento']);
                    $result_insert->bindParam(':descricao', $dados['desc']);
                    $result_insert->bindParam(':status', $dados['status']);
                    $result_insert->bindParam(':empresa', $dados['empresa']);
                    $result_insert->execute();
        
                    if($result_insert->rowCount()){
                        //echo "Dados inseridos com sucesso";
                        header('Location: index.php');
                        die();
                    }else{
                        //echo "ERRO AO INSERIR";
                    }     
                }
      
        ?>
        <div class="container">
            <div class="header">
                <span>Agenda</span>
                <button onclick="openModal()" id="new">Incluir</i></button>
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
                            <th class="acao">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            //ROTINA DE DE SELECIONAR 

                            $query_select = "SELECT id, equipamento, descricao, status, created, empresa, valor, modifed FROM tableEqui ORDER BY id DESC";
                            $result_select = $conn->prepare($query_select);
                            $result_select->execute();

                            while($row = $result_select->fetch(PDO::FETCH_ASSOC)){
                                extract($row);
                                echo "<td>$id</td>";
                                echo "<td>$equipamento</td>";
                                echo "<td>$descricao</td>";
                                echo "<td>$status</td>";
                                echo "<td>$empresa</td>";
                                
                                
                                echo "<td><button id='edit'><a href='editar.php?id=$id'>Editar</a></button></td>";
                                echo "<td><button id='excluir'><a href='excluir.php?id=$id'>Excluir</a></button></td>";
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
                        <label for="m-nome">Atividade</label>
                        <input id="m-nome" type="text" name="equipamento" placeholder="Correr no parque"  required />

                        <label for="m-funcao">Descrição da atividade</label>
                        <input id="m-atividade" type="text" name="desc" placeholder="Ir no campo correr" required />

                        <label for="m-salario">Status da atividade</label>
                        <input id="m-desc" type="text" name="status" placeholder="Realizada" required />

                        <label for="m-salario">Data</label>
                        <input id="m-data" type="date" name="empresa" required />

                        <input id="new" type="submit" id="btnSalvar" value="Enviar" name="salva">

                        <button id="excluir"><a href="index.php">Voltar</a></button>
                    </form>

                    <?php
                      ///Livre     
                    ?>
                </div>
            </div>           
            <footer class="centralizar">Desenvolvido por David Almeida</footer>
        </div>    
        <script src="script.js"></script>
    </body>

</html>