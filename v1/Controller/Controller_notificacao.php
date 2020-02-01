<?php

if (strpos(dirname(__FILE__), '\\') !== false) {
    include_once str_replace('Controller', 'model\model_notificacao.php', dirname(__FILE__));
} else {
    include_once str_replace('Controller', 'model/model_notificacao.php', dirname(__FILE__));
}

class Notificacao extends NotificacaoModel
{

    public function getIdNotificacao()
    {
        return $this->idNotificacao;
    }

    public function setIdNotificacao($idNotificacao)
    {
        $this->idNotificacao = $idNotificacao;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function getCorpo()
    {
        return $this->corpo;
    }

    public function setCorpo($corpo)
    {
        $this->corpo = $corpo;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getVisualizado()
    {
        return $this->visualizado;
    }

    public function setVisualizado($visualizado)
    {
        $this->visualizado = $visualizado;
    }

    public function getNomeSalao()
    {
        return $this->nomeSalao;
    }

    public function setNomeSalao($nomeSalao)
    {
        $this->nomeSalao = $nomeSalao;
    }

//-----------------------------------------------

    public function sav_notificacao()
    {
        return parent::sav_notificacao();
    }

    public function alt_visualizacao()
    {
        return parent::alt_visualizacao();
    }

    public function exc_notificacao()
    {
        return parent::exc_notificacao();
    }

    public function get_notificacao()
    {
        return parent::get_notificacao();
    }

    public function get_logins($idSalao)
    {
        return parent::get_logins($idSalao);
    }
}
