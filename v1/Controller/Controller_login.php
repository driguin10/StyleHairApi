<?php

if (strpos(dirname(__FILE__), '\\') !== false) {
    include_once str_replace('Controller', 'model\model_login.php', dirname(__FILE__));
} else {
    include_once str_replace('Controller', 'model/model_login.php', dirname(__FILE__));
}

class Login extends LoginModel
{

    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenhaRedefinicao($senhaRedefinicao)
    {
        $this->senhaRedefinicao = $senhaRedefinicao;
    }

    public function getSenhaRedefinicao()
    {
        return $this->senhaRedefinicao;
    }

    //-----------------------------------------------

    public function consult_usuario_senha()
    {
        return parent::consult_usuario_senha();
    }

    public function sav_login()
    {
        return parent::sav_login();
    }

    public function alt_login()
    {
        return parent::alt_login();
    }

    public function ver_email()
    {
        return parent::ver_email();
    }

    public function ver_senha()
    {
        return parent::ver_senha();
    }

    public function reset_login()
    {
        return parent::reset_login();
    }

    public function ver_email_redefinicao()
    {
        return parent::ver_email_redefinicao();
    }

}
