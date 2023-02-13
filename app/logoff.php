<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    session_unset(
        $_SESSION['login_time'],
        $_SESSION['usuarioStatus'],
        $_SESSION['usuarioId'],
        $_SESSION['usuarioNiveisAcessoId'],
        $_SESSION['usuarioSetorId'],
        $_SESSION['usuarioNome'],
        $_SESSION['usuarioEmail']
    );

    session_destroy();
    session_start();
    $_SESSION['logoff'] = "Logoff realizado com sucesso !";
    header('Location: ../index.php');
    die();
?>