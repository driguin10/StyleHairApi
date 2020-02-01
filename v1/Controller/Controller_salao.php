<?php

if (strpos(dirname(__FILE__), '\\') !== false) {
    include_once str_replace('Controller', 'model\model_salao.php', dirname(__FILE__));
} else {
    include_once str_replace('Controller', 'model/model_salao.php', dirname(__FILE__));
}

class Salao extends SalaoModel
{

    public function setIdSalao($idSalao)
    {
        $this->idSalao = $idSalao;
    }

    public function getIdSalao()
    {
        return $this->idSalao;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setTopicoNotificacao($topicoNotificacao)
    {
        $this->topicoNotificacao = $topicoNotificacao;
    }

    public function getTopicoNotificacao()
    {
        return $this->topicoNotificacao;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
    }

    public function getComplemento()
    {
        return $this->complemento;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setTelefone1($telefone1)
    {
        $this->telefone1 = $telefone1;
    }

    public function getTelefone1()
    {
        return $this->telefone1;
    }

    public function setTelefone2($telefone2)
    {
        $this->telefone2 = $telefone2;
    }

    public function getTelefone2()
    {
        return $this->telefone2;
    }

    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }

    public function getCnpj()
    {
        return $this->cnpj;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setSobre($sobre)
    {
        $this->sobre = $sobre;
    }

    public function getSobre()
    {
        return $this->sobre;
    }

    public function setLinkImagem($linkImagem)
    {
        $this->linkImagem = $linkImagem;
    }

    public function getLinkImagem()
    {
        return $this->linkImagem;
    }

    public function setAgendamento($agendamento)
    {
        $this->agendamento = $agendamento;
    }

    public function getAgendamento()
    {
        return $this->agendamento;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setSegE($segE)
    {
        $this->segE = $segE;
    }

    public function getSegE()
    {
        return $this->segE;
    }

    public function setSegS($segS)
    {
        $this->segS = $segS;
    }

    public function getSegS()
    {
        return $this->segS;
    }

    public function setTerE($terE)
    {
        $this->terE = $terE;
    }

    public function getTerE()
    {
        return $this->terE;
    }

    public function setTerS($terS)
    {
        $this->terS = $terS;
    }

    public function getTerS()
    {
        return $this->terS;
    }

    public function setQuaE($quaE)
    {
        $this->quaE = $quaE;
    }

    public function getQuaE()
    {
        return $this->quaE;
    }

    public function setquaS($quaS)
    {
        $this->quaS = $quaS;
    }

    public function getQuaS()
    {
        return $this->quaS;
    }

    public function setQuiE($quiE)
    {
        $this->quiE = $quiE;
    }

    public function getQuiE()
    {
        return $this->quiE;
    }

    public function setQuiS($quiS)
    {
        $this->quiS = $quiS;
    }

    public function getQuiS()
    {
        return $this->quiS;
    }

    public function setSexE($sexE)
    {
        $this->sexE = $sexE;
    }

    public function getSexE()
    {
        return $this->sexE;
    }

    public function setSexS($sexS)
    {
        $this->sexS = $sexS;
    }

    public function getSexS()
    {
        return $this->sexS;
    }

    public function setSabE($sabE)
    {
        $this->sabE = $sabE;
    }

    public function getSabE()
    {
        return $this->sabE;
    }

    public function setSabS($sabS)
    {
        $this->sabS = $sabS;
    }

    public function getSabS()
    {
        return $this->sabS;
    }

    public function setDomE($domE)
    {
        $this->domE = $domE;
    }

    public function getDomE()
    {
        return $this->domE;
    }

    public function setDomS($domS)
    {
        $this->domS = $domS;
    }

    public function getDomS()
    {
        return $this->domS;
    }

    public function setTempoReserva($tempoReserva)
    {
        $this->tempoReserva = $tempoReserva;
    }

    public function getTempoReserva()
    {
        return $this->tempoReserva;
    }

    public function setTempoMinAgenda($tempoMinAgenda)
    {
        $this->tempoMinAgenda = $tempoMinAgenda;
    }

    public function getTempoMinAgenda()
    {
        return $this->tempoMinAgenda;
    }

//-----------------------------------------------

    public function sav_salao()
    {
        return parent::sav_salao();
    }

    public function alt_salao()
    {
        return parent::alt_salao();
    }

    public function alt_gerente_salao()
    {
        return parent::alt_gerente_salao();
    }

    public function alt_config_salao()
    {
        return parent::alt_config_salao();
    }

    public function alt_status_salao()
    {
        return parent::alt_status_salao();
    }

    public function exc_salao()
    {
        return parent::exc_salao();
    }

    public function get_salao()
    {
        return parent::get_salao();
    }

    public function get_salao_idSalao()
    {
        return parent::get_salao_idSalao();
    }

    public function get_config_salao()
    {
        return parent::get_config_salao();
    }

    public function buscaSalao($kilometro, $idLogin, $pagina, $qtRegistro)
    {
        return parent::buscaSalao($kilometro, $idLogin, $pagina, $qtRegistro);
    }

}
?>