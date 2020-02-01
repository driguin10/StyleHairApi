<?php

if (strpos(dirname(__FILE__), '\\') !== false) {
    include_once str_replace('Controller', 'model\model_favorito.php', dirname(__FILE__));
} else {
    include_once str_replace('Controller', 'model/model_favorito.php', dirname(__FILE__));
}

class Favorito extends FavoritoModel
{

    public function setIdFavorito($idFavorito)
    {
        $this->idFavorito = $idFavorito;
    }

    public function getIdFavorito()
    {
        return $this->idFavorito;
    }

    public function setIdSalao($idSalao)
    {
        $this->idSalao = $idSalao;
    }

    public function getIdSalao()
    {
        return $this->idSalao;
    }

    public function setIdLogin($idLogin)
    {
        $this->idLogin = $idLogin;
    }

    public function getIdLogin()
    {
        return $this->idLogin;
    }

//-----------------------------------------------

    public function consult_all()
    {
        return parent::consult_all();
    }

    public function consult_id_fav()
    {
        return parent::consult_id_fav();
    }

    public function consult_id_login()
    {
        return parent::consult_id_login();
    }

    public function consult_id_salao()
    {
        return parent::consult_id_salao();
    }

    public function sav_favorito()
    {
        return parent::sav_favorito();
    }

    public function exc_fav()
    {
        return parent::exc_fav();
    }

}
