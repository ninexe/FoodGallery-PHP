<?php

    //Verifico se a a sessão está ativa
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    
    //Campos que vieram da tela
    $nome    = $_POST['nNome'];
    $tipoUsu = $_POST['nTipoUsuario'];
    $email   = $_POST['nEmail'];
    $senha   = $_POST['nSenha'];
    $foto    = $_FILES['nFoto'];
    $data    = $_POST['nDataNascimento'];
    // var_dump($foto);
    // die;

    if (isset($_POST['salvar'])) {

        $name_file = $_FILES['nFoto']['name'];
        $tmp_name = $_FILES['nFoto']['tmp_name'];
        if (isset($name_file)) {
            if (!empty($name_file)) {
                $uploaddir = '../dist/img/';
                move_uploaded_file($tmp_name,$uploaddir.$name_file);
            }
        }
    }
    //Abre a conexão com o banco
    include('conexao.php');
    
    //Monta meu comando insert
    $sql =  "insert into tb_usuario(Nome , idTipo_Usu, Email, Senha, Foto, Data_Cadastro ) value ('".$nome."'," .$tipoUsu.",'" .$email."','" .$senha."','" .'dist/img/'.$name_file."','"."$data". "');";
    //Executa o comando SQL no banco de dados
    $result = mysqli_query($conn,$sql);
    
    //Fecha a conexão com o banco
    mysqli_close($conn);
    
    header('location: ../usuario');

?>