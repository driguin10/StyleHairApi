<?php
if (strpos(dirname(__FILE__), '\\') !== false) {
    include_once str_replace('Controller', 'model\model_servicosAgenda.php', dirname(__FILE__));
} else {
    include_once str_replace('Controller', 'model/model_servicosAgenda.php', dirname(__FILE__));
}

class ServicosAgenda extends ServicosAgendaModel
{

    public function setIdServicoAgenda($idServicoAgenda)
    {
        $this->idServicoAgenda = $idServicoAgenda;
    }

    public function getIdServicoAgenda()
    {
        return $this->idServicoAgenda;
    }

    public function setIdAgenda($idAgenda)
    {
        $this->idAgenda = $idAgenda;
    }

    public function getIdAgenda()
    {
        return $this->idAgenda;
    }

    public function setIdServicoSalao($idServicoSalao)
    {
        $this->idServicoSalao = $idServicoSalao;
    }

    public function getIdServicoSalao()
    {
        return $this->idServicoSalao;
    }

//-----------------------------------------------

    public function consult_all()
    {
        return parent::consult_all();
    }

    public function sav_servicoAgenda($values)
    {
        return parent::sav_servicoAgenda($values);
    }

    public function exc_servicoAgenda()
    {
        return parent::exc_servicoAgenda();
    }

    public function consult_sevicos_agenda()
    {
        return parent::consult_sevicos_agenda();
    }

}
