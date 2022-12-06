<?php
//Função para carregar o menu de forma automática
function carregaMenu($n1){
    $menu = '';
    $MenuProdutos = '';
    $MenuFuncionarios = '';

    switch($n1){
        case 'Funcionarios':
            $MenuFuncionarios = 'active';
        break;
        case 'Produtos':    
            $MenuProdutos = 'active';
        break;
    }


    $menu = '<nav class="mt-2">'
                .'<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">'
                    
                    .'<li class="nav-item">'
                        .'<a href="products.php" style="" class="nav-link '.$MenuProdutos.'">'
                            .'<i class="nav-icon fas fa-utensils"></i>'
                            .'<p>Produtos</p>'
                        .'</a>'
                    .'</li>'
                    .'<li class="nav-item">'
                        .'<a href="usuario.php" class="nav-link '.$MenuFuncionarios.'">'
                            .'<i class="nav-icon fas fa-users"></i>'
                            .'<p>Funcionários</p>'
                        .'</a>'
                    .'</li>'
                    .'<li class="nav-item">'
                        .'<a href="PHP/validaLogoff.php" class="nav-link">'
                            .'<i class="nav-icon fas fa-power-off"></i>'
                            .'<p>Sair</p>'
                        .'</a>'
                    .'</li>';

                    /* if($_SESSION['idTipoUsuarioLogado'] == '1'){
                        $menu .=
                        '<li class="nav-header">CATEGORIA</li>'
                            .'<li class="nav-item">'
                                .'<a href="#" class="nav-link">'
                                    .'<i class="nav-icon far fa-image"></i>'
                                    .'<p>Menu 4</p>'
                                .'</a>'
                            .'</li>'
                            .'<li class="nav-item">'
                                .'<a href="#" class="nav-link">'
                                    .'<i class="nav-icon far fa-image"></i>'
                                    .'<p>Menu 5</p>'
                                .'</a>'
                            .'</li>';
                    }
                    */ 
                $menu .=
                '</ul>'
            .'</nav>';

    return $menu;
}

?>


<!--
    Examples    
.'<li class="nav-item has-treeview menu-open">'
                        .'<a href="#" class="nav-link active">'
                            .'<i class="nav-icon fas fa-tachometer-alt"></i>'
                            .'<p>Administrador<i class="right fas fa-angle-left"></i></p>'
                        .'</a>'
                        .'<ul class="nav nav-treeview">'
                            .'<li class="nav-item">'
                                .'<a href="tela-modelo.php" class="nav-link active">'
                                    .'<p>Tela Modelo</p>'
                                .'</a>'
                            .'</li>'
                            .'<li class="nav-item">'
                                .'<a href="usuario.php" class="nav-link">'
                                    .'<p>Usuário</p>'
                                .'</a>'
                            .'</li>'
                        .'</ul>'
                    .'</li>'
                
                
                
                .'<li class="nav-item has-treeview">'
                        .'<a href="#" class="nav-link">'
                            .'<i class="nav-icon fas fa-copy"></i>'
                            .'<p>Menu 3<i class="fas fa-angle-left right"></i>'
                                .'<span class="badge badge-info right">6</span>'
                            .'</p>'
                        .'</a>'
                        .'<ul class="nav nav-treeview">'
                            .'<li class="nav-item">'
                                .'<a href="#" class="nav-link">'
                                    .'<p>Opção 1</p>'
                                .'</a>'
                            .'</li>'
                            .'<li class="nav-item">'
                                .'<a href="#" class="nav-link">'
                                    .'<p>Opção 2</p>'
                                .'</a>'
                            .'</li>'
                            .'<li class="nav-item">'
                                .'<a href="#" class="nav-link">'
                                    .'<p>Opção 3</p>'
                                .'</a>'
                            .'</li>'
                        .'</ul>'
                    .'</li>';--> 