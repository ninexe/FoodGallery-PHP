<?php

    //Verifico se a a sessão está ativa
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    include('function.php');
    //Campos que vieram da tela
    $id        = $_POST['nID'];
    $descricao = $_POST['nDesc'];
    $tipoProd  = $_POST['nTipoProduto'];
    $foto      = $_FILES['nFoto'];
    $Preco     = $_POST['nPreco'];
     
    if (isset($_POST['salvar'])) {
        $name_file = $_FILES['nFoto']['name'];
        $tmp_name = $_FILES['nFoto']['tmp_name'];
        if (isset($name_file)) {
            if (!empty($name_file)) {
                $uploaddir = '../dist/src/imagens/';
                move_uploaded_file($tmp_name,$uploaddir.$name_file);
            }
        }
    }
    //Abre a conexão com o banco
    include('conexao.php');
    
    //Monta meu comando SELECT
    $sql = "UPDATE tb_produto "
            ." SET Descricao = '".$descricao."', "
            ." idTipoProd = '".$tipoProd."', "
            ." Foto = '".$name_file."', "
            ." Preco = '".$Preco."' "
            ." WHERE idProduto = ".$id.";"; 

    

    //Executa o comando SQL no banco de dados
    $result = mysqli_query($conn,$sql);
    
    //Fecha a conexão com o banco
    mysqli_close($conn);
    
    header('location: ../products');

?>