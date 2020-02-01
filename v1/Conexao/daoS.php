<?php

class Dao
{

    private $Conexao;
    private $host = "mysql.hostinger.com.br";
    private $db = "u697979504_apix";
    private $usuario = "u697979504_uapix";
    private $senha = "r007385rpg";

    public function OpenConn()
    {
        $this->Conexao = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db, $this->usuario, $this->senha, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        return $this->Conexao;
    }

    public function executeSelect($query)
    {
        $this->OpenConn();
        $exec = $this->Conexao->query($query);
        $resultt = $exec->fetchAll(PDO::FETCH_OBJ);
        //$resultado["Resultado"] = $resultt;
        //return json_encode($resultt);
        return $resultt;
    }

    public static function getInstancia()
    {
        return new Dao();
    }

}
