<?php
    $_SESSION['idUsuarioLogado'] = 0;
    session_destroy();
    header('Location: ../entrar');
?>