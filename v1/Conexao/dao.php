<?php

class Dao
{

    private $Conexao;
    private $host = "localhost";
    private $db = "appTcc";
    private $usuario = "root";
    private $senha = "r007385rpg";

    public function OpenConn()
    {
        $this->Conexao = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db, $this->usuario, $this->senha, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $this->Conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $this->Conexao;
    }

    public function executeSelect($query)
    {
        $this->OpenConn();
        $exec = $this->Conexao->query($query);
        $resultt = $exec->fetchAll(PDO::FETCH_OBJ);
        return $resultt;
    }

    public function executeSelect2($query)
    {
        $this->OpenConn();
        $this->Conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->Conexao->exec($query);
        return $this->Conexao;
    }

    public static function getInstancia()
    {
        return new Dao();
    }

}
