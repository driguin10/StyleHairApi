<?php

if (strpos(dirname(__FILE__), '\\') !== false) {
    include_once '..\..\v1\Controller\Controller_login.php';
} else {
    include_once '../../v1/Controller/Controller_login.php';
}

if (isset($_POST['email']) && isset($_POST['codigo']) && isset($_POST['novaSenha'])) {
    $email = $_POST['email'];
    $senhaGerada = $_POST['codigo'];
    $novaSenha = base64_encode($_POST['novaSenha']);

    if ($email != "" && $senhaGerada != "" && $novaSenha != "") {
        $getUsuario = new Login();
        $getUsuario->setEmail($email);
        $getUsuario->setSenhaRedefinicao($senhaGerada);
        $retornEmail = $getUsuario->ver_email_redefinicao();
        if (sizeof($retornEmail) > 0) {
            $getUsuario->setSenha($novaSenha);
            $getUsuario->setSenhaRedefinicao(null);
            $retornNewLogin = $getUsuario->alt_login();
            $retornConsulta = $getUsuario->consult_usuario_senha();

            if ($retornConsulta[0]->email == $email && $retornConsulta[0]->senha == $novaSenha) {
                header("Location:" . "/reset/v1/result.php?cod=01");exit;
            } else {
                header("Location:" . "/reset/v1/result.php?cod=02");exit;
            }

        } else {
            header("Location:" . "/reset/v1/result.php?cod=03");exit;
        }
    } else {
        header("Location:" . "/reset/v1/result.php?cod=04");exit;
    }
} else {
    header("Location:" . "/reset/v1/result.php?cod=04");exit;
}
