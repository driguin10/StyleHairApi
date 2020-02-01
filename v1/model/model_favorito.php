<?php
if (strpos(dirname(__FILE__), '\\') !== false) {
    include_once str_replace('model', 'Conexao\dao.php', dirname(__FILE__));
} else {
    include_once str_replace('model', 'Conexao/dao.php', dirname(__FILE__));
}

class FavoritoModel
{

    protected $idFavorito;
    protected $idSalao;
    protected $idLogin;

    protected function consult_all()
    {
        $query = "SELECT * FROM saloes_favoritos";
        return Dao::getInstancia()->executeSelect($query);
    }

    //para usuario pegar seus favoritos
    protected function consult_id_login()
    {
        $query = "SELECT fav.idFavorito AS idFavorito, fav.idLogin AS idLogin, fav.idSalao As idSalao, s.linkImagem AS linkImagem, s.nome AS nome, s.topicoNotificacao AS topicoNotificacao FROM saloes_favoritos AS fav
				INNER JOIN saloes AS s ON s.idSalao = fav.idSalao
				WHERE idLogin='" . $this->idLogin . "'";

        return Dao::getInstancia()->executeSelect($query);
    }

//para salao pegar seus clientes
    protected function consult_id_salao()
    {

        $query = "SELECT fav.idFavorito AS idFavorito, fav.idLogin AS idLogin, fav.idSalao As idSalao,u.idUsuario AS idUsuario, u.nome AS nome, u.topicoNotificacao AS topicoNotificacao
				FROM saloes_favoritos AS fav
				INNER JOIN usuarios AS u ON u.idLogin = fav.idLogin
				WHERE idSalao='" . $this->idSalao . "'";

        return Dao::getInstancia()->executeSelect($query);
    }

    protected function consult_id_fav()
    {

        $query = "SELECT fav.idFavorito AS idFavorito, fav.idLogin AS idLogin, fav.idSalao As idSalao, s.linkImagem AS linkImagem, s.nome AS nome FROM saloes_favoritos AS fav
				INNER JOIN saloes AS s ON s.idSalao = fav.idSalao
				WHERE idFavorito='" . $this->idFavorito . "'";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function sav_favorito()
    {
        $query = "INSERT INTO saloes_favoritos (idFavorito,idSalao, idLogin )
    	 VALUES ('" . $this->idFavorito . "','" . $this->idSalao . "','" . $this->idLogin . "')";
        return Dao::getInstancia()->executeSelect2($query);
    }

    protected function exc_fav()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "DELETE FROM saloes_favoritos WHERE idFavorito=:idFavorito";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idFavorito", $this->idFavorito);
        return $stmt->execute();
    }

}
