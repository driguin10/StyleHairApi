<?php
if (strpos(dirname(__FILE__), '\\') !== false) {
    include_once str_replace('model', 'Conexao\dao.php', dirname(__FILE__));
} else {
    include_once str_replace('model', 'Conexao/dao.php', dirname(__FILE__));
}

class NotificacaoModel
{

//no android vai fica buscando pelo seu id de usuario

    protected $idNotificacao;
    protected $idUsuario;
    protected $titulo;
    protected $corpo;
    protected $data;
    protected $visualizado;
    protected $nomeSalao;

    protected function sav_notificacao()
    {
        $query = "INSERT INTO notificacoes (idUsuario,titulo,corpo,data, visualizado, nomeSalao) VALUES ('" .
        $this->idUsuario . "','" . $this->titulo . "','" . $this->corpo . "','" . $this->data . "','" . $this->visualizado .
        "','" . $this->nomeSalao . "')";
        return Dao::getInstancia()->executeSelect2($query);
    }

    protected function alt_visualizacao()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "UPDATE notificacoes SET visualizado=:visualizado WHERE idNotificacao=:idNotificacao";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("visualizado", $this->visualizado);
        $stmt->bindParam("idNotificacao", $this->idNotificacao);
        return $stmt->execute();
    }

    protected function exc_notificacao()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "DELETE FROM notificacoes WHERE idNotificacao=:idNotificacao";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idNotificacao", $this->idNotificacao);
        return $stmt->execute();
    }

    protected function get_notificacao()
    {
        $query = "SELECT * FROM notificacoes WHERE idUsuario='" . $this->idUsuario . "'";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function get_logins($idSalao)
    {
        $query = "SELECT * FROM saloes_favoritos WHERE idSalao='" . $idSalao . "'";
        return Dao::getInstancia()->executeSelect($query);
    }

}
