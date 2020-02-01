<?php

if (strpos(dirname(__FILE__), '\\') !== false) {
    include_once str_replace('model', 'Conexao\dao.php', dirname(__FILE__));
} else {
    include_once str_replace('model', 'Conexao/dao.php', dirname(__FILE__));
}

class LoginModel
{

    protected $id_usuario;
    protected $email;
    protected $senha;
    protected $senhaRedefinicao;

    protected function consult_usuario_senha() //consulta usuario e senha

    {
        $query = "SELECT * FROM login WHERE email='" . $this->email . "' AND senha='" . $this->senha . "'";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function sav_login() //salva login

    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "INSERT INTO login (email, senha) VALUES (:email,:senha)";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("email", $this->email);
        $stmt->bindParam("senha", $this->senha);
        return $stmt->execute();
    }

    protected function alt_login() //altera login

    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "UPDATE login SET senha=:senha, senhaRedefinicao=:senhaRedefinicao WHERE email=:email";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("email", $this->email);
        $stmt->bindParam("senha", $this->senha);
        $stmt->bindParam("senhaRedefinicao", $this->senhaRedefinicao);
        return $stmt->execute();
    }

    protected function reset_login() //salva a senha para redefinição

    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "UPDATE login SET senhaRedefinicao=:senhaRedefinicao WHERE email=:email";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("email", $this->email);
        $stmt->bindParam("senhaRedefinicao", $this->senhaRedefinicao);
        return $stmt->execute();
    }

    protected function ver_email()
    { // verifica só email
        $query = "SELECT * FROM login WHERE email='" . $this->email . "'";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function ver_senha()
    { // verifica só senha
        $query = "SELECT * FROM login WHERE senha='" . $this->senha . "'";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function ver_email_redefinicao()
    { // verifica só email
        $query = "SELECT * FROM login WHERE email='" . $this->email . "' AND senhaRedefinicao='" . $this->senhaRedefinicao . "'";
        return Dao::getInstancia()->executeSelect($query);
    }

}
