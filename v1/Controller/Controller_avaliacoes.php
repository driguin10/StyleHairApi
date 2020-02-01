<?php

if (strpos(dirname(__FILE__), '\\') !== false) {
    include_once str_replace('Controller', 'model\model_avaliacoes.php', dirname(__FILE__));
} else {
    include_once str_replace('Controller', 'model/model_avaliacoes.php', dirname(__FILE__));
}

class Avaliacao extends AvaliacaoModel
{

    public function setIdAvaliacao($idAvaliacao)
    {
        $this->idAvaliacao = $idAvaliacao;
    }

    public function getIdAvaliacao()
    {
        return $this->idAvaliacao;
    }

    public function setIdSalao($idSalao)
    {
        $this->idSalao = $idSalao;
    }

    public function getIdSalao()
    {
        return $this->idSalao;
    }

    public function setPontos($pontos)
    {
        $this->pontos = $pontos;
    }

    public function getPontos()
    {
        return $this->pontos;
    }

    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }

    public function getComentario()
    {
        return $this->comentario;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

//-----------------------------------------------

    public function consult_avaliacao()
    {
        return parent::consult_avaliacao();
    }

    public function sav_avaliacao()
    {
        return parent::sav_avaliacao();
    }

    public function exc_avaliacao()
    {
        return parent::exc_avaliacao();
    }

    public function exc_comentario()
    {
        return parent::exc_comentario();
    }

}
