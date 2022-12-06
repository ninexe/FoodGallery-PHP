<?php

    //Verifico se a a sessão está ativa
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    include('function.php');

    $id = $_SESSION['idUsuarioLogado'];
    $nome = $_POST['nNome'];
    $email = $_POST['nEmail'];
    $senha = $_POST['nSenha'];
    $foto      = $_FILES['nFoto'];
    $data = $_POST['nDataNascimento'];
    
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

    //Abre a conexão do banco de dados
    include('conexao.php');

    $sql = "UPDATE tb_usuario "
           ." SET Nome = '".$nome."' " 
           .", Email = '".$email."' "
           .", Senha = '".$senha."' "
           .", Foto = '".'dist/img/'.$name_file."' "
           .", Data_Cadastro = '".$data."' "
           ." WHERE idUsuario = ".$id.";";

    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);
   // var_dump($_SESSION['emailParaSempre'],$_SESSION['senhaParaSempre']);
   // var_dump($sql);
   // die;
    carregaPerfil($email,$senha);

    header('location: ../perfil');
?>