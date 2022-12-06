<?php
//Inicializar a sessão
session_start();

//Verifica se o usuário está logado para liberar a página
if ($_SESSION['idUsuarioLogado'] == 0) {
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
    <link rel="icon" href="dist/images/icons/amb.png" type="image/x-icon" />
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
                <img src="dist/images/icons/amb.png" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">FoodGallery</span>
            </a>

            <!-- Sidebar -->
            <!-- COR do MENU: #2B2D7D no arquivo de CSS (dist/css/adminlte.min.css) -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <!-- Foto do Usuário -->
                        <img src="<?php echo $_SESSION['fotoUsuarioLogado']; ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <!-- Nome do Usuário -->
                        <a href="perfil" class="d-block"><?php echo $_SESSION['nomeUsuarioLogado']; ?></a>
                    </div>
                </div>

                <?php echo carregaMenu('Funcionarios'); ?>


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
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h3 class="card-title">Usuários</h3>
                                        </div>
                                        <div class="col-md-3" align="right">
                                            <a href="usuario" class="btn btn-success" data-toggle="modal" data-target="#novoUsuarioModal" title="Inserir um novo usuário">
                                                <i class="fas fa-plus-circle"></i>
                                                <span>Novo Usuário</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="iTabela" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Tipo</th>
                                                <th>E-mail</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php echo listaUsuarios(); ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="novoUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-success">
                                    <h4 class="modal-title" id="exampleModalLabel">Novo Usuário</h4>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="PHP/inserirUsuario.php" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6 col-lg-8">
                                                        <div class="form-group">
                                                            <input type="text" name="nID" visible="false" value="0" hidden>
                                                            <label for="iNome">Nome</label>
                                                            <input type="text" class="form-control form-control" name="nNome" id="iNome" value="" maxlength="80" required="true">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-4">
                                                        <div class="form-group">
                                                            <label>Tipo de Usuário</label>
                                                            <select name="nTipoUsuario" id="iTipoUsuario" class="form-control form-control">
                                                                <?php echo listaTipoUsuario(0); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-8">
                                                        <div class="form-group">
                                                            <label for="iEmail">E-mail</label>
                                                            <input type="email" class="form-control form-control" name="nEmail" id="iEmail" value="" maxlength="100" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-4">
                                                        <div class="form-group">
                                                            <label for="iSenha">Senha</label>
                                                            <input type="password" class="form-control form-control" name="nSenha" value="" id="iSenha" maxlength="8" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-5">
                                                        <div class="form-group">
                                                            <label for="iEmail">Foto</label>
                                                            <input type="file" class="form-control form-control" name="nFoto" id="iFoto" value="" maxlength="100" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Data de nascimento</label>
                                                            <input name="nDataNascimento" type="date" class="form-control form-control-sm" value="<?php echo $_SESSION['dataUsuarioLogado']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="usuario" class="btn btn-danger" title="Cancelar a operação">
                                            <span>Cancelar</span>
                                        </a>
                                        <input type="submit" class="btn btn-success" value="Salvar" name="salvar" title="Salvar o novo usuário">
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Fim Modal -->

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
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- page script -->
    <script>
        $(function() {
            $("#iTabela").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>
</body>

</html>