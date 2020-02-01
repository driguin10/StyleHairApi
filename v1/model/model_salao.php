<?php

if (strpos(dirname(__FILE__), '\\') !== false) {
    include_once str_replace('model', 'Conexao\dao.php', dirname(__FILE__));
} else {
    include_once str_replace('model', 'Conexao/dao.php', dirname(__FILE__));
}

class SalaoModel
{

    protected $idSalao;
    protected $idUsuario;
    protected $topicoNotificacao;
    protected $nome;
    protected $endereco;
    protected $numero;
    protected $complemento;
    protected $cep;
    protected $bairro;
    protected $cidade;
    protected $estado;
    protected $latitude;
    protected $longitude;
    protected $telefone1;
    protected $telefone2;
    protected $cnpj;
    protected $email;
    protected $sobre;
    protected $linkImagem;
    protected $agendamento;
    protected $status;
    protected $segE;
    protected $segS;
    protected $terE;
    protected $terS;
    protected $quaE;
    protected $quaS;
    protected $quiE;
    protected $quiS;
    protected $sexE;
    protected $sexS;
    protected $sabE;
    protected $sabS;
    protected $domE;
    protected $domS;
    protected $tempoReserva;
    protected $tempoMinAgenda;

    protected function sav_salao()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "INSERT INTO saloes (idUsuario,topicoNotificacao, nome, endereco, numero,complemento, cep, bairro, cidade, estado,latitude,longitude, telefone1, telefone2,cnpj, email, sobre, linkImagem,agendamento, status, segE, segS, terE, terS, quaE, quaS, quiE, quiS, sexE, sexS, sabE, sabS, domE, domS,tempoReserva, tempoMinAgenda) VALUES (:idUsuario,:topicoNotificacao, :nome, :endereco, :numero,:complemento, :cep, :bairro, :cidade, :estado,:latitude,:longitude, :telefone1, :telefone2,:cnpj, :email, :sobre, :linkImagem, :agendamento, :status,:segE,:segS,:terE,:terS,:quaE,:quaS,:quiE,:quiS,:sexE,:sexS,:sabE,:sabS,:domE,:domS,:tempoReserva, :tempoMinAgenda)";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idUsuario", $this->idUsuario);
        $stmt->bindParam("topicoNotificacao", $this->topicoNotificacao);
        $stmt->bindParam("nome", $this->nome);
        $stmt->bindParam("endereco", $this->endereco);
        $stmt->bindParam("numero", $this->numero);
        $stmt->bindParam("complemento", $this->complemento);
        $stmt->bindParam("cep", $this->cep);
        $stmt->bindParam("bairro", $this->bairro);
        $stmt->bindParam("cidade", $this->cidade);
        $stmt->bindParam("estado", $this->estado);
        $stmt->bindParam("latitude", $this->latitude);
        $stmt->bindParam("longitude", $this->longitude);
        $stmt->bindParam("telefone1", $this->telefone1);
        $stmt->bindParam("telefone2", $this->telefone2);
        $stmt->bindParam("cnpj", $this->cnpj);
        $stmt->bindParam("email", $this->email);
        $stmt->bindParam("sobre", $this->sobre);
        $stmt->bindParam("linkImagem", $this->linkImagem);
        $stmt->bindParam("agendamento", $this->agendamento);
        $stmt->bindParam("status", $this->status);
        $stmt->bindParam("segE", $this->segE);
        $stmt->bindParam("segS", $this->segS);
        $stmt->bindParam("terE", $this->terE);
        $stmt->bindParam("terS", $this->terS);
        $stmt->bindParam("quaE", $this->quaE);
        $stmt->bindParam("quaS", $this->quaS);
        $stmt->bindParam("quiE", $this->quiE);
        $stmt->bindParam("quiS", $this->quiS);
        $stmt->bindParam("sexE", $this->sexE);
        $stmt->bindParam("sexS", $this->sexS);
        $stmt->bindParam("sabE", $this->sabE);
        $stmt->bindParam("sabS", $this->sabS);
        $stmt->bindParam("domE", $this->domE);
        $stmt->bindParam("domS", $this->domS);
        $stmt->bindParam("tempoReserva", $this->tempoReserva);
        $stmt->bindParam("tempoMinAgenda", $this->tempoMinAgenda);
        return $stmt->execute();
    }

    protected function alt_salao()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "UPDATE saloes SET nome=:nome, endereco=:endereco, numero=:numero, complemento=:complemento, cep=:cep, bairro=:bairro, cidade=:cidade, estado=:estado,latitude=:latitude,longitude=:longitude, telefone1=:telefone1, telefone2=:telefone2, cnpj=:cnpj, email=:email, sobre=:sobre, linkImagem=:linkImagem, agendamento=:agendamento WHERE idSalao=:idSalao";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("nome", $this->nome);
        $stmt->bindParam("endereco", $this->endereco);
        $stmt->bindParam("numero", $this->numero);
        $stmt->bindParam("complemento", $this->complemento);
        $stmt->bindParam("cep", $this->cep);
        $stmt->bindParam("bairro", $this->bairro);
        $stmt->bindParam("cidade", $this->cidade);
        $stmt->bindParam("estado", $this->estado);
        $stmt->bindParam("latitude", $this->latitude);
        $stmt->bindParam("longitude", $this->longitude);
        $stmt->bindParam("telefone1", $this->telefone1);
        $stmt->bindParam("telefone2", $this->telefone2);
        $stmt->bindParam("cnpj", $this->cnpj);
        $stmt->bindParam("email", $this->email);
        $stmt->bindParam("sobre", $this->sobre);
        $stmt->bindParam("linkImagem", $this->linkImagem);
        $stmt->bindParam("agendamento", $this->agendamento);
        $stmt->bindParam("idSalao", $this->idSalao);
        return $stmt->execute();
    }

    protected function alt_config_salao()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "UPDATE saloes SET segE=:SegE, segS=:SegS, terE=:TerE, terS=:TerS, quaE=:QuaE, quaS=:QuaS, quiE=:QuiE, quiS=:QuiS, sexE=:SexE, sexS=:SexS, sabE=:SabE,sabS=:SabS,domE=:DomE,domS=:DomS, tempoReserva=:tempoReserva, tempoMinAgenda=:tempoMinAgenda WHERE idSalao=:idSalao";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("SegE", $this->segE);
        $stmt->bindParam("SegS", $this->segS);
        $stmt->bindParam("TerE", $this->terE);
        $stmt->bindParam("TerS", $this->terS);
        $stmt->bindParam("QuaE", $this->quaE);
        $stmt->bindParam("QuaS", $this->quaS);
        $stmt->bindParam("QuiE", $this->quiE);
        $stmt->bindParam("QuiS", $this->quiS);
        $stmt->bindParam("SexE", $this->sexE);
        $stmt->bindParam("SexS", $this->sexS);
        $stmt->bindParam("SabE", $this->sabE);
        $stmt->bindParam("SabS", $this->sabS);
        $stmt->bindParam("DomE", $this->domE);
        $stmt->bindParam("DomS", $this->domS);
        $stmt->bindParam("tempoReserva", $this->tempoReserva);
        $stmt->bindParam("tempoMinAgenda", $this->tempoMinAgenda);
        $stmt->bindParam("idSalao", $this->idSalao);
        return $stmt->execute();
    }

    protected function alt_gerente_salao()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "UPDATE saloes SET idUsuario=:idUsuario WHERE idSalao=:idSalao";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idUsuario", $this->idUsuario);
        $stmt->bindParam("idSalao", $this->idSalao);
        return $stmt->execute();
    }

    protected function alt_status_salao()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "UPDATE saloes SET status=:status WHERE idSalao=:idSalao";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("status", $this->status);
        $stmt->bindParam("idSalao", $this->idSalao);
        return $stmt->execute();
    }

    protected function exc_salao()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "DELETE FROM saloes WHERE idSalao=:idSalao";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idSalao", $this->idSalao);
        return $stmt->execute();
    }

    protected function get_salao()
    {
        $query = "SELECT * FROM saloes WHERE idUsuario='" . $this->idUsuario . "'";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function get_salao_idSalao()
    {
        $query = "SELECT * FROM saloes WHERE idSalao='" . $this->idSalao . "'";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function get_config_salao()
    {
        $query = "SELECT segE,segS,terE,terS,quaE,quaS,quiE,quiS,sexE,sexS,sabE,sabS,domE,domS, agendamento,tempoReserva, tempoMinAgenda FROM saloes WHERE idSalao='" . $this->idSalao . "'";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function buscaSalao($kilometro, $idLogin, $pagina, $qtRegistro)
    {
        $query = "SELECT 	saloes.idSalao AS 'idSalao', saloes.topicoNotificacao AS 'topicoNotificacao',
			saloes.nome AS 'nome', saloes.endereco AS 'endereco', saloes.numero AS 'numero',
			saloes.bairro AS 'bairro',saloes.cidade AS 'cidade', saloes.estado AS 'estado',
		  saloes.linkImagem AS 'linkImagem',saloes.agendamento  AS 'agendamento',
		  saloes.latitude AS 'latitude',saloes.longitude AS 'longitude' ,
		   IFNULL(saloes_favoritos.idFavorito,-1) AS 'idFavorito'";

        $flagDistancia = 0;
        if ($this->latitude != null && $this->longitude != null) {
            $query .= ", (6371 * acos(cos(radians(" . $this->latitude . ")) * cos(radians(saloes.latitude))
			 * cos(radians(saloes.longitude) - radians(" . $this->longitude . ")) + sin(radians(" . $this->latitude . "))
			 * sin(radians(saloes.latitude)))) AS 'distancia'";
            $flagDistancia = 1;
        }

        $query .= ", saloes.status AS 'status', (SELECT SUM(pontos) totalpontos FROM avaliacao_salao WHERE avaliacao_salao.idSalao = saloes.idSalao) as 'pontos'
		 		FROM saloes LEFT JOIN saloes_favoritos ON saloes_favoritos.idSalao = saloes.idSalao AND saloes_favoritos.idLogin ='" . $idLogin . "'";

        $clausula = "";

        if ($this->nome != null) {
            $clausula = "WHERE ";
            $query .= $clausula;
            $query .= " saloes.nome LIKE '%" . $this->nome . "%' ";
        }

        if ($this->cidade != null && $this->nome == null) {
            if ($clausula == "") {
                $clausula = "WHERE ";
            } else {
                $clausula = "AND ";
            }

            $query .= $clausula;
            $query .= "saloes.cidade LIKE '%" . $this->cidade . "%'";
        }

        if ($flagDistancia == 1 && $this->nome == null) {
            if ($this->cidade != null) {
                $query .= " ORDER BY pontos DESC";
            } else {
                $query .= " HAVING distancia <= " . $kilometro;
                $query .= " ORDER BY distancia ASC, pontos DESC";
            }
        } else {
            $query .= " ORDER BY pontos DESC";
        }

        $query .= " LIMIT " . $pagina . "," . $qtRegistro;

        return Dao::getInstancia()->executeSelect($query);
    }

}
