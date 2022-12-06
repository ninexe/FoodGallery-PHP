<?php
//Função para carregar lista com tipo de usuário
function listaTipoUsuario($tipo){

    $opcoes = '';

    include('conexao.php');
    
    $sql = "SELECT * FROM tb_tipo_usu WHERE idTipo_Usu <> ".$tipo.";"; 

    $result = mysqli_query($conn,$sql);
    
    mysqli_close($conn);
  
    if (mysqli_num_rows($result) > 0) {	

		$lista = array();
		
		while ($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			array_push($lista,$linha);
		}

        foreach ($lista as $campo) {
            $opcoes .= '<option value = "'.$campo['idTipo_Usu'].'">'.$campo['Descricao'].'</option>';       
        }
    }
    return $opcoes;
}

//Função para retornar a descrição do tipo de usuário
function descrTipoUsuario($idTipo){

    $descricao = '';

    //Abre a conexão com o banco
    include('conexao.php');
    
    //Monta meu comando SELECT
    $sql = "SELECT Descricao FROM tb_tipo_usu WHERE idTipo_Usu = ".$idTipo.";"; 

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
            $descricao = $campo['Descricao'];            
        }

    }

    return $descricao;

}
?>

<!-- Funções dos Produtos -->

<?php
function descrTipoProduto($idTipo){

$descricao = '';

//Abre a conexão com o banco
include('conexao.php');

//Monta meu comando SELECT
$sql = "SELECT Descricao FROM tb_tipoproduto WHERE idTipoProd = ".$idTipo.";"; 

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
        $descricao = $campo['Descricao'];            
    }

}

return $descricao;

}

function listaTipoProduto($tipo){

    $opcoes = '';

    include('conexao.php');
    
    $sql = "SELECT * FROM tb_tipoproduto WHERE idTipoProd <> ".$tipo.";"; 

    $result = mysqli_query($conn,$sql);
    
    mysqli_close($conn);
  
    if (mysqli_num_rows($result) > 0) {	

		$lista = array();
		
		while ($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			array_push($lista,$linha);
		}

        foreach ($lista as $campo) {
            $opcoes .= '<option value = "'.$campo['idTipoProd'].'">'.$campo['Descricao'].'</option>';       
        }
    }
    return $opcoes;
}
?>