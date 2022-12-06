<?php

    //Verifico se a a sessão está ativa
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    
    $email = $_POST['nEmail'];

    // var_dump("bosta");
    //    die;

    //Consulta ao BD
    include('conexao.php');
    include('function.php');

    $sql = "SELECT * "
        ." FROM tb_usuario "
        ." WHERE Email = '".$email."';"; 
    $result = mysqli_query($conn,$sql);

    if (mysqli_num_rows($result) > 0) {	

		$lista = array();
		
		while ($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			array_push($lista,$linha);
		}

        foreach ($lista as $campo) {			
            $idUsu     = $campo['idUsuario'];         
        }

        $novaSenha = generatePassword(10);

        $sqlSenha = "insert into tb_GerarSenha(Descricao, idUsuario) value ('" . $novaSenha . "'," . $idUsu . ");";
        $result = mysqli_query($conn, $sqlSenha);

        $sqlSenha = "UPDATE tb_usuario "
            ." SET Senha = '".$novaSenha."'"
            ." WHERE Email = '".$email."';"; 
        $result = mysqli_query($conn,$sqlSenha);

        mysqli_close($conn);

        $_SESSION['senha'] = $novaSenha;

        header('location: ../SenhaAlterada');

    }else{
        mysqli_close($conn);
        echo "<script>alert('Email não existe.');</script>";
	    echo "<script>javascript:window.location='../erroSenha';</script>";
    }
?>