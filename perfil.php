<?php
	//Inicializar a sessão
    session_start();

    //Verifica se o usuário está logado para liberar a página
    if($_SESSION['idUsuarioLogado'] == 0){
        //Se não estiver logado, volta para a tela de login
        header('location: entrar');
    }
    
    include('PHP/function.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FoodGallery</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ÍCONE do navegador -->
    <link rel="icon" href="dist/images/icons/amb.png" type="image/x-icon"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <!-- Botão que recolhe o menu -->
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>


        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <!-- Ícone de alerta -->
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">10</span>
                </a>                
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Logo na barra de menu -->
        <a href="#" class="brand-link">
            <!-- Ícone da barra de menu -->
            <img src="dist/images/icons/amb.png" alt="AdminLTE Logo" class="brand-image elevation-3"
                     style="opacity: .8">
            <span class="brand-text font-weight-light">FoodGallery</span>
        </a>

        <!-- Sidebar -->
        <!-- COR do MENU: #2B2D7D no arquivo de CSS (dist/css/adminlte.min.css) -->
        <div class="sidebar ">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex ">
                <div class="image ">
                    <!-- Foto do Usuário -->
                    <img src="<?php echo $_SESSION['fotoUsuarioLogado'];?>" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <!-- Nome do Usuário -->
                    <a href="perfil" class="d-block"><?php echo $_SESSION['nomeUsuarioLogado'];?></a>
                </div>
            </div>

            <?php echo carregaMenu('');?>

        </div>
        <!-- /.sidebar -->
</aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <!-- TEXTO OPCIONAL -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    Meu Perfil
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="PHP/salvarUsuario.php" enctype="multipart/form-data">
									<div class="card-body">
										<div class="row">	
											
											<div class="col-lg-12">
												<div class="row">	
													<div class="col-lg-12 text-center">
														<div class="foto-perfil mx-auto">
															<img alt="<?php echo $_SESSION['nomeUsuarioLogado']; ?>" style="width: 150; height: 150px;" src="<?php echo $_SESSION['fotoUsuarioLogado']; ?>"  class="foto img-circle">
															<div class="trocar-imagem">
															  <i class="fal fa-2x fas icon-camera upload-button"></i>
															  <p>Alterar Foto</p>
															  <input class="arquivo" name="nFoto" type="file" title="" required accept="image/*"/>
															</div>
														</div>
													</div>												
                                                    <div class="col-lg-8">
                                                        <div class="form-group">
                                                            <label>Nome</label>
                                                            <input name="nNome" type="text" maxlength="80" class="form-control form-control-sm" value="<?php echo $_SESSION['nomeUsuarioLogado']; ?>" required>
                                                        </div>
                                                    </div>					
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Data de nascimento</label>
                                                            <input name="nDataNascimento" type="date" class="form-control form-control-sm" value="<?php echo $_SESSION['dataUsuarioLogado']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="form-group">
                                                            <label for="iEmail">E-mail</label>
                                                            <input readonly="true" type="email" class="form-control form-control-sm" name="nEmail" id="iEmail" value="<?php echo $_SESSION['emailUsuarioLogado'];?>">
                                                        </div>
                                                    </div>					
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Senha</label>
                                                            <input name="nSenha" type="password" class="form-control form-control-sm" value="">
                                                        </div>
                                                    </div>						
												</div>
											</div>
											
										</div>
									</div>								
									<div class="card-action" align="right">
										<a href="perfil" class="btn btn-danger" data-toggle="tooltip" title="Cancelar a operação">
											<span>Cancelar</span>
										</a>
										<input type="submit" class="btn btn-success" value="Salvar" name="salvar" data-toggle="tooltip" title="Salvar as alterações no perfil">
									</div>
								</form>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<script src="dist/js/sa.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
</body>
</html>
