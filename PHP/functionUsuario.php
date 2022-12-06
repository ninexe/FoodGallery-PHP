<?php
//Carregar dados do usuário logado
function carregaPerfil($email,$senha){
    include('conexao.php');
    
    $sql = "SELECT * "
        ." FROM tb_usuario "
        ." WHERE Email = '".$email."' "
        ." AND Senha = '".$senha."';"; 
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);

    if (mysqli_num_rows($result) > 0) {	

		$lista = array();
		
		while ($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			array_push($lista,$linha);
		}

        foreach ($lista as $campo) {			
            $_SESSION['idUsuarioLogado']     = $campo['idUsuario'];   
            $_SESSION['idTipoUsuarioLogado'] = $campo['idTipo_Usu']; 
            $_SESSION['nomeUsuarioLogado']   = $campo['Nome']; 
            $_SESSION['emailUsuarioLogado']  = $campo['Email']; 
            $_SESSION['senhaUsuarioLogado']  = $campo['Senha']; 
            $_SESSION['fotoUsuarioLogado']   = $campo['Foto'];
            $_SESSION['dataUsuarioLogado']   = $campo['Data_Cadastro'];          
        }

    }
}

//Consulta os usuários e preenche a grid na tela de cadastro 
function listaUsuarios(){

    $usuarios = '';

    //Abre a conexão com o banco
    include('conexao.php');
    
    //Monta meu comando SELECT
    $sql = "SELECT * FROM tb_usuario;"; 

    

    //Executa o comando SQL no banco de dados
    $result = mysqli_query($conn,$sql);
    //var_dump($result);
    //die();
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
            $usuarios .= 
            '<tr>'
                .'<td>'.$campo['idUsuario'].'</td>'
                .'<td>'.$campo['Nome'].'</td>'
                .'<td>'.descrTipoUsuario($campo['idTipo_Usu']).'</td>'
                .'<td>'.$campo['Email'].'</td>'
                .'<td align="center">'
                    .'<div class="row">'
                        .'<div class="col-md-6">'
                            .'<a href="#editarUsuarioModal'.$campo['idUsuario'].'" id="edit" class="edit" data-toggle="modal">'
                                .'<h6><i class="fas fa-edit text-info" data-toggle="tooltip" title="Alterar informações"></i></h6>'
                            .'</a>'
                        .'</div>';

                        if($campo['idUsuario'] != $_SESSION['idUsuarioLogado']){
                            $usuarios .=
                            '<div class="col-md-6">'
                                .'<a href="#excluirUsuarioModal'.$campo['idUsuario'].'" id="edit" class="edit" data-toggle="modal">'
                                    .'<h6><i class="fas fa-trash-alt text-danger" data-toggle="tooltip" title="Excluir usuário"></i></h6>'
                                .'</a>'
                            .'</div>';
                        }
                        $usuarios .=

                    '</div>'
                .'</td>'

                .'<div class="modal fade" id="excluirUsuarioModal'.$campo['idUsuario'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'
                    .'<div class="modal-dialog"  style="max-width: 400px; role="document">'
                        .'<div class="modal-content">'
                            .'<div class="bg-danger" style="text-align: center;">'
                                .'<h4 class="modal-title" id="exampleModalLabel">Deseja realmente excluir o usuário?</h4>'
                            .'</div>'
                            .'<form method="POST" action="PHP/deletaUsuario.php" enctype="multipart/form-data">'
                                .'<div class="modal-footer">'
                                .'<input type="text" name="nID" visible="false" value="'.$campo['idUsuario'].'" hidden>'
                                    .'<a href="usuario" class="btn btn-danger" title="Cancelar a operação">'
                                        .'<span>Cancelar</span>'
                                    .'</a>'
                                    .'<input type="submit" class="btn btn-success" name="deletar" value="Sim" title="Deletar">'
                                .'</div>'

                            .'</form>'
                        .'</div>'
                    .'</div>'
                .'</div>'

                .'<div class="modal fade" id="editarUsuarioModal'.$campo['idUsuario'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'
                    .'<div class="modal-dialog modal-lg" role="document">'
                        .'<div class="modal-content">'
                            .'<div class="modal-header bg-info">'
                                .'<h4 class="modal-title" id="exampleModalLabel">Editar Usuário</h4>'
                                .'<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">'
                                    .'<span aria-hidden="true">&times;</span>'
                                .'</button>'
                            .'</div>'
                            .'<form method="POST" action="PHP/salvaUsuario.php" enctype="multipart/form-data">'
                                .'<div class="modal-body">'
                                    .'<div class="row">'								
                                        .'<div class="card-body">'
                                            .'<div class="row">'
                                                .'<div class="col-md-6 col-lg-8">'
                                                    .'<div class="form-group">'
                                                        .'<input type="text" name="nID" visible="false" value="'.$campo['idUsuario'].'" hidden>'
                                                        .'<label for="iNome">Nome</label>'
                                                        .'<input type="text" class="form-control form-control" name="nNome" id="iNome" value="'.$campo['Nome'].'" maxlength="80" required="true">'
                                                    .'</div>'
                                                .'</div>'
                                                .'<div class="col-md-6 col-lg-4">'
                                                    .'<div class="form-group">'
                                                        .'<label>Tipo de Usuário</label>'
                                                        .'<select name="nTipoUsuario" id="iTipoUsuario" class="form-control form-control">'
                                                            .'<option value="'.$campo['idTipo_Usu'].'">'.descrTipoUsuario($campo['idTipo_Usu']).'</option>'
                                                            .listaTipoUsuario($campo['idTipo_Usu'])
                                                        .'</select>'
                                                    .'</div>'
                                                .'</div>'
                                                .'<div class="col-md-6 col-lg-8">'
                                                    .'<div class="form-group">'
                                                        .'<label for="iEmail">E-mail</label>'
                                                        .'<input type="email" class="form-control form-control" name="nEmail" id="iEmail" value="'.$campo['Email'].'" maxlength="100" required>'
                                                    .'</div>'
                                                .'</div>'
                                                .'<div class="col-md-6 col-lg-4">'
                                                    .'<div class="form-group">'
                                                        .'<label for="iSenha">Senha</label>'
                                                        .'<input type="password" class="form-control form-control" name="nSenha" value="'.$campo['Senha'].'" id="iSenha" maxlength="8" required>'
                                                    .'</div>'
                                                .'</div>'
                                            .'</div>'
                                        .'</div>'	
                                    .'</div>'
                                .'</div>'
                                .'<div class="modal-footer">'
                                    .'<a href="usuario" class="btn btn-danger" title="Cancelar a operação">'
                                        .'<span>Cancelar</span>'
                                    .'</a>'
                                    .'<input type="submit" class="btn btn-success" value="Salvar" title="Salvar alteração">'
                                .'</div>'

                            .'</form>'
                        .'</div>'
                    .'</div>'
                .'</div>'
            .'</tr>';            
        }

    }

    return $usuarios;
}

function listaProdutos(){

    $produtos = '';

    //Abre a conexão com o banco
    include('conexao.php');
    
    //Monta meu comando SELECT
    $sql = "SELECT * FROM tb_produto;"; 

    

    //Executa o comando SQL no banco de dados
    $result = mysqli_query($conn,$sql);
    //var_dump($result);
    //die();
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
            $produtos .= 
            '<tr>'
                .'<td>'.$campo['idProduto'].'</td>'
                .'<td>'.$campo['Descricao'].'</td>'
                .'<td>'.$campo['Preco'].'</td>'
                .'<td align="center">'
                    .'<div class="row">'
                        .'<div class="col-md-12">'
                            .'<img src="dist/src/imagens/'.$campo['Foto'].'" width="90" alt="">'
                        .'</div>'
                    .'</div>'
                .'</td>'
                .'<td align="center">'
                    .'<div class="row">'
                        .'<div class="col-md-6">'
                            .'<a href="#editarProdutoModal'.$campo['idProduto'].'" id="edit" class="edit" data-toggle="modal">'
                                .'<h6><i class="fas fa-edit text-info" data-toggle="tooltip" title="Alterar informações"></i></h6>'
                            .'</a>'
                        .'</div>'
                        .'<div class="col-md-6">'
                            .'<a href="#excluirProdutoModal'.$campo['idProduto'].'" id="edit" class="edit" data-toggle="modal">'
                                .'<h6><i class="fas fa-trash-alt text-danger" data-toggle="tooltip" title="Excluir Usuário"></i></h6>'
                            .'</a>'
                        .'</div>'
                    .'</div>'
                .'</td>'

                .'<div class="modal fade" id="excluirProdutoModal'.$campo['idProduto'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'
                    .'<div class="modal-dialog"  style="max-width: 400px; role="document">'
                        .'<div class="modal-content">'
                            .'<div class="bg-danger" style="text-align: center;">'
                                .'<h4 class="modal-title" id="exampleModalLabel">Deseja realmente excluir o produto?</h4>'
                            .'</div>'
                            .'<form method="POST" action="PHP/deletaProduto.php" enctype="multipart/form-data">'
                                .'<div class="modal-footer">'
                                .'<input type="text" name="nID" visible="false" value="'.$campo['idProduto'].'" hidden>'
                                    .'<a href="usuario" class="btn btn-danger" title="Cancelar a operação">'
                                        .'<span>Cancelar</span>'
                                    .'</a>'
                                    .'<input type="submit" class="btn btn-success" name="deletar" value="Sim" title="Deletar">'
                                .'</div>'

                            .'</form>'
                        .'</div>'
                    .'</div>'
                .'</div>'

                .'<div class="modal fade" id="editarProdutoModal'.$campo['idProduto'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'
                    .'<div class="modal-dialog modal-lg" role="document">'
                        .'<div class="modal-content">'
                            .'<div class="modal-header bg-info">'
                                .'<h4 class="modal-title" id="exampleModalLabel">Editar Produto</h4>'
                                .'<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">'
                                    .'<span aria-hidden="true">&times;</span>'
                                .'</button>'
                            .'</div>'
                            .'<form method="POST" action="PHP/salvaProduto.php" enctype="multipart/form-data">'
                                .'<div class="modal-body">'
                                    .'<div class="row">'								
                                        .'<div class="card-body">'
                                            .'<div class="row">'
                                                .'<div class="col-md-6 col-lg-8">'
                                                    .'<div class="form-group">'
                                                        .'<input type="text" name="nID" visible="false" value="'.$campo['idProduto'].'" hidden>'
                                                        .'<label for="iDesc">Descrição</label>'
                                                        .'<input type="text" class="form-control form-control" name="nDesc" id="iDesc" value="'.$campo['Descricao'].'" maxlength="80" required="true">'
                                                    .'</div>'
                                                .'</div>'
                                                .'<div class="col-md-6 col-lg-4">'
                                                    .'<div class="form-group">'
                                                        .'<label>Tipo de Produto</label>'
                                                        .'<select name="nTipoProduto" id="iTipoProduto" class="form-control form-control">'
                                                            .'<option value="'.$campo['idTipoProd'].'">'.descrTipoProduto($campo['idTipoProd']).'</option>'
                                                            .listaTipoProduto($campo['idTipoProd'])
                                                        .'</select>'
                                                    .'</div>'
                                                .'</div>'
                                                .'<div class="col-md-6 col-lg-8">'
                                                    .'<div class="form-group">'
                                                        .'<label for="iFoto">Foto</label>'
                                                        .'<input type="file" class="form-control form-control" name="nFoto" id="iFoto" value="'.$campo['Foto'].'" maxlength="100" required>'
                                                    .'</div>'
                                                .'</div>'
                                                .'<div class="col-md-6 col-lg-4">'
                                                    .'<div class="form-group">'
                                                        .'<label for="iPreco">Preço</label>'
                                                        .'<input type="text" class="form-control form-control" name="nPreco" value="'.$campo['Preco'].'" id="iPreco" maxlength="8" required>'
                                                    .'</div>'
                                                .'</div>'
                                            .'</div>'
                                        .'</div>'	
                                    .'</div>'
                                .'</div>'
                                .'<div class="modal-footer">'
                                    .'<a href="usuario" class="btn btn-danger" title="Cancelar a operação">'
                                        .'<span>Cancelar</span>'
                                    .'</a>'
                                    .'<input type="submit" class="btn btn-success" value="Salvar" name="salvar" title="Salvar alteração">'
                                .'</div>'

                            .'</form>'
                        .'</div>'
                    .'</div>'
                .'</div>'
            .'</tr>';            
        }

    }

    return $produtos;
}

function generatePassword($qtyCaraceters = 8)
{
    //Letras minúsculas embaralhadas
    $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');
 
    //Letras maiúsculas embaralhadas
    $capitalLetters = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
 
    //Números aleatórios
    $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
    $numbers .= 1234567890;
 
    //Caracteres Especiais
    $specialCharacters = str_shuffle('!@#$%*-');
 
    //Junta tudo
    $characters = $capitalLetters.$smallLetters.$numbers.$specialCharacters;
 
    //Embaralha e pega apenas a quantidade de caracteres informada no parâmetro
    $password = substr(str_shuffle($characters), 0, $qtyCaraceters);
 
    //Retorna a senha
    return $password;
}
?>

<!--.'<td align="center">'
                    .'<div class="row">'
                        .'<div class="col-md-6">'
                            .'<a href="#editarUsuarioModal'.$campo['idUsuario'].'" id="edit" class="edit" data-toggle="modal">'
                                .'<h6><i class="fas fa-edit text-info" data-toggle="tooltip" title="Alterar informações"></i></h6>'
                            .'</a>'
                        .'</div>'
                        .'<div class="col-md-6">'
                            .'<a href="#excluirUsuarioModal'.$campo['idUsuario'].'" id="edit" class="edit" data-toggle="modal">'
                                .'<h6><i class="fas fa-trash-alt text-danger" data-toggle="tooltip" title="Excluir Usuário"></i></h6>'
                            .'</a>'
                        .'</div>'
                    .'</div>'
                .'</td>'
            .'</tr>';   -->