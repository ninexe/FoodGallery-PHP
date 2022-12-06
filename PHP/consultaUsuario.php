<?php

    //Verifico se a a sessão está ativa
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    
    //Campos que vieram da tela
    $nome                     = $_POST['nNome'];
    $_SESSION['consultaNome'] = $_POST['nNome'];

    //Inicializando uma variável de sessão p/ retornar os registros
    $_SESSION['regUsuario'] = '';

    //Tratamento para o campo ID
    if($idUsuario == ''){
        $idUsuario = '0';
    }

    //Abre a conexão com o banco
    include('conexao.php');
    
    //Monta meu comando SELECT
    $sql = "SELECT * "
            ." FROM tb_usuario "
            ." WHERE Nome LIKE '%".$nome."%';";

    //var_dump($sql);
    //die();

    //Executa o comando SQL no banco de dados
    $result = mysqli_query($conn,$sql);
    
    //Fecha a conexão com o banco
    mysqli_close($conn);
    
    //Verificação do retono do comando SQL
    if (mysqli_num_rows($result) > 0) {	

		$lista = array();
		
		while ($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			array_push($lista,$linha);
		}

        //Estrutura de repetição dos dados retornados do banco
        foreach ($lista as $campo) {			
            //Concatenação das linhas retornadas
            $_SESSION['regUsuario'] .= 
            '<tr>'
                .'<td>'.$campo['idUsuario'].'</td>'
                .'<td>'.$campo['Nome'].'</td>'
                .'<td>'.$campo['Email'].'</td>'
                .'<td>'.$campo['Senha'].'</td>'
                .'<td><a href="edit-usuario.php?id='.$campo['idUsuario']
                                            .'&nome='.$campo['Nome']
                                            .'&email='.$campo['Email']
                                            .'&senha='.$campo['Senha'].'">Alterar</a></td>'
            .'</tr>';            
        }

    }

    header('location: ../usuario.php');

?>