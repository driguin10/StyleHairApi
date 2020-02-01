<?php

if (strpos(dirname(__FILE__), '\\') !== false) {
    include_once str_replace('Controller', 'model\model_usuario.php', dirname(__FILE__));
} else {
    include_once str_replace('Controller', 'model/model_usuario.php', dirname(__FILE__));
}

class Usuario extends UsuarioModel
{

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdLogin($idLogin)
    {
        $this->idLogin = $idLogin;
    }

    public function getIdLogin()
    {
        return $this->idLogin;
    }

    public function setTopicoNotificacao($topicoNotificacao)
    {
        $this->topicoNotificacao = $topicoNotificacao;
    }

    public function getTopicoNotificacao()
    {
        return $this->topicoNotificacao;
    }

    public function setLinkImagem($linkImagem)
    {
        $this->linkImagem = $linkImagem;
    }

    public function getLinkImagem()
    {
        return $this->linkImagem;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setApelido($apelido)
    {
        $this->apelido = $apelido;
    }

    public function getApelido()
    {
        return $this->apelido;
    }

    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    public function getSexo()
    {
        return $this->sexo;
    }

    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }

    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    public function getCep()
    {
        return $this->cep;
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

    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function setObs($obs)
    {
        $this->obs = $obs;
    }

    public function getObs()
    {
        return $this->obs;
    }

//-----------------------------------------------

    public function sav_usuario()
    {
        return parent::sav_usuario();
    }

    public function alt_usuario()
    {
        return parent::alt_usuario();
    }

    public function exc_usuario()
    {
        return parent::exc_usuario();
    }

    public function exc_usuario_anonimo()
    {
        return parent::exc_usuario_anonimo();
    }

    public function get_usuario()
    {
        return parent::get_usuario();
    }

    public function get_usuario_Id()
    {
        return parent::get_usuario_Id();
    }

}
