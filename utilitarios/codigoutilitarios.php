



<?php
/* * @abstract Tratamento de injections em formulários.3. * @return string4. */ 
function antiInjection($str) {
 # Remove palavras suspeitas de injection.
 $str = preg_replace(sql_regcase("/(\n|\r|%0a|%0d|Content-Type:|bcc:|to:|cc:|Autoreply:|from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "", $str);
  $str = trim($str);       
  # Remove espaços vazios.10.  
  $str = strip_tags($str);  # Remove tags HTML e PHP.
  $str = addslashes($str);  # Adiciona barras invertidas à uma string
  return $str;
  } 
?>








function setUser($parametros)
		{
			$sql = "INSERT INTO usuarios (nome) values (:nome) ";
		  $conn = getConn();
		  $stmt = $conn->prepare($sql);
		  $stmt->bindParam("nome",$parametros['nome']);
		  $executa = $stmt->execute();

		  if($executa)
		  {
		  	$ultID = $conn->lastInsertId();
		 		echo "salvou na posicao = " .$ultID;
		  }
		}







		/*function pegarUsuarios()
	{

		$banc =  new ConectaBanco();
		$stmt = $banc->getConn();
  	$stmt = $stmt->query("SELECT * FROM usuarios");
  	$users = $stmt->fetchAll(PDO::FETCH_OBJ);
  	$resultado["Resultado"] = $users;
  	return json_encode($resultado);
	}*/




	* --------funciono-------------
function getUser()
{
  //include_once('Controller/Controller.usuarios.php');
  $banc =  new ConectaBanco();
  $stmt = $banc->getConn();
  $stmt = $stmt->query("SELECT * FROM usuarios");
  $users = $stmt->fetchAll(PDO::FETCH_OBJ);
  $resultado["Resultado"] = $users;
  echo json_encode($resultado);
}*/



/*function getConn()
	{
	 	return new PDO('mysql:host=localhost;dbname=teste', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}*/



/*

function getUser()
{
  //$servicos["servi"]=["a","b"];
	$stmt = getConn()->query("SELECT * FROM usuarios");
  $users = $stmt->fetchAll(PDO::FETCH_OBJ);
  $resultado["Resultado"] = $users;
  echo json_encode($resultado);
  //echo json_encode($servicos);
}

function setUser($parametros)
{
  
  $email = $parametros->getParam('CadEmail');
  $senha = $parametros->getParam('CadSenha');
	$sql = "INSERT INTO usuarios (email, senha) values (:email , :senha) ";
  $conn = getConn();
  $stmt = $conn->prepare($sql);
  $stmt->bindParam("email", $email);
  $stmt->bindParam("senha", $senha);
  $executa = $stmt->execute();


  if($executa)
  {
  	//$ultID = $conn->lastInsertId();
 		//echo "salvou na posicao = " .$ultID;
    
    echo json_encode(array('action' => 'salvo', 'cod' => '200'));
  }
  else
  {
    echo "erro";
    echo json_encode(array('action' => 'erro'));
  }
  
}*/


/*

$app->get('/consulta/{apiKey}', function($request, $response, $args) {
  $apiKey = $request->getAttribute('apiKey');
 $response->getBody()->write($apiKey);
    return $response;

});


*/