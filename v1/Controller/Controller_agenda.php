<?php

if (strpos(dirname(__FILE__), '\\') !== false) {
    include_once str_replace('Controller', 'model\model_agenda.php', dirname(__FILE__));
} else {
    include_once str_replace('Controller', 'model/model_agenda.php', dirname(__FILE__));
}

class Agenda extends AgendaModel
{

    public function setIdAgenda($idAgenda)
    {
        $this->idAgenda = $idAgenda;
    }

    public function getIdAgenda()
    {
        return $this->idAgenda;
    }

    public function setIdSalao($idSalao)
    {
        $this->idSalao = $idSalao;
    }

    public function getIdSalao()
    {
        return $this->idSalao;
    }

    public function setIdFuncionario($idFuncionario)
    {
        $this->idFuncionario = $idFuncionario;
    }

    public function getIdFuncionario()
    {
        return $this->idFuncionario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setHoraIni($horaIni)
    {
        $this->horaIni = $horaIni;
    }

    public function getHoraIni()
    {
        return $this->horaIni;
    }

    public function setHoraFim($horaFim)
    {
        $this->horaFim = $horaFim;
    }

    public function getHoraFim()
    {
        return $this->horaFim;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

//-----------------------------------------------

    public function consult_all()
    {
        return parent::consult_all();
    }

    public function consult_id_agenda()
    {
        return parent::consult_id_agenda();
    }

    public function consult_id_func()
    {
        return parent::consult_id_func();
    }

    public function consult_id_user()
    {
        return parent::consult_id_user();
    }

    public function sav_agenda()
    {
        return parent::sav_agenda();
    }

    public function alt_status()
    {
        return parent::alt_status();
    }

    public function alt_todos_status()
    {
        return parent::alt_todos_status();
    }

    public function alt_status_func()
    {
        return parent::alt_status_func();
    }

    public function exc_agenda()
    {
        return parent::exc_agenda();
    }

}
