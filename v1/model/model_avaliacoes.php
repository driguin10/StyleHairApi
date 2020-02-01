<?php
if (strpos(dirname(__FILE__), '\\') !== false) {
    include_once str_replace('model', 'Conexao\dao.php', dirname(__FILE__));
} else {
    include_once str_replace('model', 'Conexao/dao.php', dirname(__FILE__));
}

class AvaliacaoModel
{

    protected $idAvaliacao;
    protected $idSalao;
    protected $pontos;
    protected $comentario;
    protected $data;

    protected function consult_avaliacao()
    {
        $query = "SELECT * FROM avaliacao_salao WHERE idSalao ='" . $this->idSalao . "'";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function sav_avaliacao()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "INSERT INTO avaliacao_salao (idSalao, pontos, comentario, data) VALUES (:idSalao, :pontos, :comentario, :data)";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idSalao", $this->idSalao);
        $stmt->bindParam("pontos", $this->pontos);
        $stmt->bindParam("comentario", $this->comentario);
        $stmt->bindParam("data", $this->data);
        return $stmt->execute();
    }

    protected function exc_avaliacao()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "DELETE FROM avaliacao_salao WHERE idAvaliacao=:idAvaliacao";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idAvaliacao", $this->idAvaliacao);
        return $stmt->execute();
    }

    protected function exc_comentario()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "UPDATE avaliacao_salao SET comentario=:comentario WHERE idAvaliacao=:idAvaliacao";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("comentario", $this->comentario);
        $stmt->bindParam("idAvaliacao", $this->idAvaliacao);
        return $stmt->execute();
    }

}
