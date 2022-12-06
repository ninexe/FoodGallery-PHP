<?php

//Verifico se a a sessão está ativa
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

//Campos que vieram da tela
$descricao = $_POST['nDesc'];
$tipoProd  = $_POST['nTipoProduto'];
$foto      = $_POST['nFoto'];
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
$sql =  "insert into tb_produto(Descricao , Preco, Foto, idTipoProd ) value ('" . $descricao . "'," . $Preco . ",'" . $name_file . "'," . $tipoProd . ");";

//Executa o comando SQL no banco de dados
$result = mysqli_query($conn, $sql);

//Fecha a conexão com o banco
mysqli_close($conn);

header('location: ../products.php');
