<?php

    //Verifico se a a sessão está ativa
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    
    //Campos que vieram da tela
    $id    = $_POST['nID'];
    $nome  = $_POST['nNome'];
    $email = $_POST['nEmail'];
    $senha = $_POST['nSenha'];

    //Abre a conexão com o banco
    include('conexao.php');
    
    //Monta meu comando SELECT
    $sql = "UPDATE tb_usuario "
            ." SET Nome = '".$nome."', "
            ." Email = '".$email."', "
            ." Senha = '".$senha."' "
            ." WHERE idUsuario = ".$id.";"; 

    //var_dump($sql);
    //die();

    //Executa o comando SQL no banco de dados
    $result = mysqli_query($conn,$sql);
    
    //Fecha a conexão com o banco
    mysqli_close($conn);
/*    
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
                .'<td>Alterar Apagar</td>'
            .'</tr>';            
        }

    }
*/
    header('location: ../usuario.php');

?>