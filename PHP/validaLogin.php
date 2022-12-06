<?php

    //Verifico se a a sessão está ativa
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    
    $email = addslashes($_POST['nEmail']);
    $senha = addslashes($_POST['nSenha']);
    $_SESSION['emailParaSempre']  = $email; 
    $_SESSION['senhaParaSempre']  = $senha; 
    //Consulta ao BD
    include('conexao.php');
    include('function.php');
    
    $sql = "SELECT COUNT(*) AS Qtd "
            ." FROM tb_usuario "
            ." WHERE Email = '".$email."' "
            ." AND Senha = '".$senha."';";

    // var_dump($sql);
    // die;

	$result = mysqli_query($conn,$sql);
    mysqli_close($conn);

    $quantidade = 0;
    
    if (mysqli_num_rows($result) > 0) {	

		$lista = array();
		
		while ($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			array_push($lista,$linha);
		}

		foreach ($lista as $campo) {			
            $quantidade = $campo['Qtd'];            
        }

    }
    
    if($quantidade > 0){
        //Achou: Carrega o perfil na sessão e abre a tela inicial
        carregaPerfil($email,$senha);
        header('location: ../products');
    }else{
        //Não achou: Mostra mensagem na tela
        $_SESSION['msg'] = 'ACESSO NEGADO: Verifique seus dados de acesso.';
	    header('location: ../entrar');
    }

?>