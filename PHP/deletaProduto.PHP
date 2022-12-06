<?php

    //Verifico se a a sessão está ativa
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    
    //Campos que vieram da tela
    $id        = $_POST['nID'];
    

    //Abre a conexão com o banco
    include('conexao.php');
    
    //Monta meu comando SELECT
    $sql = "DELETE FROM tb_produto "
            ." WHERE idProduto = ".$id.";"; 

    //Executa o comando SQL no banco de dados
    $result = mysqli_query($conn,$sql);
    
    //Fecha a conexão com o banco
    mysqli_close($conn);

    header('location: ../products');

?>