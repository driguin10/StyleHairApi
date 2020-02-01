<?php
if (strpos(dirname(__FILE__), '\\') !== false) {
    include_once str_replace('model', 'Conexao\dao.php', dirname(__FILE__));
} else {
    include_once str_replace('model', 'Conexao/dao.php', dirname(__FILE__));
}

class UsuarioModel
{

    protected $idUsuario;
    protected $idLogin;
    protected $topicoNotificacao;
    protected $linkImagem;
    protected $nome;
    protected $apelido;
    protected $sexo;
    protected $dataNascimento;
    protected $telefone;
    protected $cep;
    protected $endereco;
    protected $numero;
    protected $bairro;
    protected $estado;
    protected $cidade;
    protected $obs;

    protected function sav_usuario()
    {
        $query = "INSERT INTO usuarios (idLogin,linkImagem,topicoNotificacao, nome, apelido, sexo, dataNascimento, telefone, cep, endereco, numero,bairro, estado, cidade, obs) VALUES ('" .
        $this->idLogin . "','" . $this->linkImagem . "','" . $this->topicoNotificacao . "','" . $this->nome . "','" . $this->apelido . "','" . $this->sexo . "','" . $this->dataNascimento . "','" . $this->telefone . "','" . $this->cep . "','" . $this->endereco . "','" . $this->numero . "','" . $this->bairro . "','" . $this->estado . "','" . $this->cidade . "','" . $this->obs . "')";
        return Dao::getInstancia()->executeSelect2($query);
    }

    protected function alt_usuario()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "UPDATE usuarios SET linkImagem=:linkImagem, nome=:nome, apelido=:apelido, sexo=:sexo, dataNascimento=:dataNascimento, telefone=:telefone, cep=:cep, endereco=:endereco, numero=:numero,bairro=:bairro, estado=:estado,cidade=:cidade, obs=:obs WHERE idLogin=:idLogin";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idLogin", $this->idLogin);
        $stmt->bindParam("linkImagem", $this->linkImagem);
        $stmt->bindParam("nome", $this->nome);
        $stmt->bindParam("apelido", $this->apelido);
        $stmt->bindParam("sexo", $this->sexo);
        $stmt->bindParam("dataNascimento", $this->dataNascimento);
        $stmt->bindParam("telefone", $this->telefone);
        $stmt->bindParam("cep", $this->cep);
        $stmt->bindParam("endereco", $this->endereco);
        $stmt->bindParam("numero", $this->numero);
        $stmt->bindParam("bairro", $this->bairro);
        $stmt->bindParam("estado", $this->estado);
        $stmt->bindParam("cidade", $this->cidade);
        $stmt->bindParam("obs", $this->obs);
        return $stmt->execute();
    }

    protected function exc_usuario()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "DELETE FROM usuarios WHERE idLogin=:idLogin";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idLogin", $this->idLogin);
        return $stmt->execute();
    }

    protected function exc_usuario_anonimo()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "DELETE FROM usuarios WHERE idUsuario=:idUsuario";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idUsuario", $this->idUsuario);
        return $stmt->execute();
    }

    protected function get_usuario()
    {
        $query = "SELECT * FROM usuarios WHERE idLogin='" . $this->idLogin . "'";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function get_usuario_Id()
    {
        $query = "SELECT * FROM usuarios WHERE idUsuario='" . $this->idUsuario . "'";
        return Dao::getInstancia()->executeSelect($query);
    }

}
