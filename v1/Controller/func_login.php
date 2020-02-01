<?php
	include_once('Controller_login.php');
	include_once('Controller_usuario.php');
	include_once('Controller_favorito.php');
	include_once('Controller_salao.php');
	include_once('Controller_funcionarios.php');
	include_once('mail.php');

	class FuncLogin	{

		function Logar($request)
		{
			$email = $request->getParam('email');
	  	$senha = base64_encode($request->getParam('senha'));

			if($email!="" && $senha !="")
			{
		    $getLogin = new Login();
		    $getLogin->setEmail($email);
		    $getLogin->setSenha($senha);
		    $retornoLogin = $getLogin->consult_usuario_senha();
		    if(sizeof($retornoLogin) > 0)//se achar algum regstro
		    {
		      $resultado["login"] = $retornoLogin; // retorna objeto de login
		      $idLogin = $retornoLogin[0]->idLogin;
	       	$favoritoUser = new Favorito();
				  $favoritoUser->setIdLogin($idLogin);
			    $retornoFavorito = $favoritoUser->consult_id_login();

		      if(sizeof($retornoFavorito)>0)
		      {
		        $resultado["favoritos"] = $retornoFavorito;
		      }
		      else
		      {
		      	$resultado["favoritos"] = [];
		      }

		      $Usuario = new Usuario();
			    $Usuario->setIdLogin($idLogin);
			    $retornoUsuario = $Usuario->get_usuario();
		      if(sizeof($retornoUsuario)>0)
		      {
		      	$resultado["topico"] = $retornoUsuario[0]->topicoNotificacao;
		      	$resultado["idUser"] = $retornoUsuario[0]->idUsuario;
	      		$resultado["nomeUser"] = $retornoUsuario[0]->nome;
	      		$resultado["linkImagem"] = $retornoUsuario[0]->linkImagem;
		      }
		      else
		      {
		      	$resultado["topico"] = "";
		      	$resultado["idUser"] = "";
		      	$resultado["nomeUser"] ="";
	      		$resultado["linkImagem"] = "";
		      }
					header('HTTP/1.1 200 01');
					echo json_encode($resultado);
		    }
		    else
		    {
		    	header('HTTP/1.1 400 01');//nao encontrado
	        exit(0);
		    }
			}
			else
	    {
	    		header('HTTP/1.1 400 02');//parametros incorretos
	        exit(0);
	    }
	  }

	  // verifica se usuario é gerente 
		function UsuarioPgerente($request)
		{
			$email = $request->getParam('email');
	  	$senha = base64_encode($request->getParam('senha'));

			if($email!="" && $senha !="")
			{
		    $getLogin = new Login();
		    $getLogin->setEmail($email);
		    $getLogin->setSenha($senha);
		    $retornoLogin = $getLogin->consult_usuario_senha();
		    if(sizeof($retornoLogin) > 0)//se achar algum regstro
		    { 
		      $resultado["login"] = $retornoLogin; // retorna objeto de login
		      $idLogin = $retornoLogin[0]->idLogin;
	       	$favoritoUser = new Favorito();
				  $favoritoUser->setIdLogin($idLogin);
			    $retornoFavorito = $favoritoUser->consult_id_login();

		      if(sizeof($retornoFavorito)>0)
		      {
		        $resultado["favoritos"] = $retornoFavorito;
		      }
		      else
		      {
		      	$resultado["favoritos"] = [];
		      }

		      $Usuario = new Usuario();
			    $Usuario->setIdLogin($idLogin);
			    $retornoUsuario = $Usuario->get_usuario();
		      if(sizeof($retornoUsuario)>0)
		      {
			      	$Salao = new Salao();
					    $Salao->setIdUsuario($retornoUsuario[0]->idUsuario);
					    $retornoSalao = $Salao->get_salao();
				      if(sizeof($retornoSalao)>0)
				      {
				        header('HTTP/1.1 400 09'); // usuario já é um gerente
				        exit;
				      }
				      else
				      {
									$resultado["topico"] = $retornoUsuario[0]->topicoNotificacao;
					      	$resultado["idUser"] = $retornoUsuario[0]->idUsuario;
				      		$resultado["nomeUser"] = $retornoUsuario[0]->nome;
				      		$resultado["linkImagem"] = $retornoUsuario[0]->linkImagem;
				      		header('HTTP/1.1 200 01');
									echo json_encode($resultado);
				      }
			      
		      }
		      else
		      {
		      	header('HTTP/1.1 400 10');
						exit;
		      }

		    }
		    else
		    {
		    	header('HTTP/1.1 400 01');//nao encontrado
	        exit(0);
		    }
			}
			else
	    {
	    		header('HTTP/1.1 400 02');//parametros incorretos
	        exit(0);
	    }
	  }

	  // verifica se usuario é funcionario 
	  function usuarioPfuncionario($request)
		{
			$email = $request->getParam('email');
	  	$senha = base64_encode($request->getParam('senha'));

			if($email!="" && $senha !="")
			{
		    $getLogin = new Login();
		    $getLogin->setEmail($email);
		    $getLogin->setSenha($senha);
		    $retornoLogin = $getLogin->consult_usuario_senha();

		    if(sizeof($retornoLogin) > 0)//se achar algum regstro
		    {
		      $resultado["login"] = $retornoLogin; // retorna objeto de login
		      $idLogin = $retornoLogin[0]->idLogin;
	       	$favoritoUser = new Favorito();
				  $favoritoUser->setIdLogin($idLogin);
			    $retornoFavorito = $favoritoUser->consult_id_login();

		      if(sizeof($retornoFavorito)>0)
		      {
		        $resultado["favoritos"] = $retornoFavorito;
		      }
		      else
		      {
		      	$resultado["favoritos"] = [];
		      }

		      $Usuario = new Usuario();
			    $Usuario->setIdLogin($idLogin);
			    $retornoUsuario = $Usuario->get_usuario();

		      if(sizeof($retornoUsuario)>0)
		      {
		      	$resultado["topico"] = $retornoUsuario[0]->topicoNotificacao;
		      	$resultado["idUser"] = $retornoUsuario[0]->idUsuario;
	      		$resultado["nomeUser"] = $retornoUsuario[0]->nome;
	      		$resultado["linkImagem"] = $retornoUsuario[0]->linkImagem;
		      }
		      else
		      {
		      	$resultado["topico"] = "";
		      	$resultado["idUser"] = "";
		      	$resultado["nomeUser"] ="";
	      		$resultado["linkImagem"] = "";
		      }

		      $funcionario = new Funcionario();
			    $funcionario->setIdUsuario($retornoUsuario[0]->idUsuario);
			    $retornoFuncionario = $funcionario->consult_funcionarios_idUsuario();
		      if(sizeof($retornoFuncionario)>0)
		      {
		      		header('HTTP/1.1 400 08');//usuario já é um funcionario
	        		exit(0);
		      }
		      else
		      {
						header('HTTP/1.1 200 01');
						echo json_encode($resultado);
		      }

		    }
		    else
		    {
		    	header('HTTP/1.1 400 01');//nao encontrado
	        exit(0);
		    }
			}
			else
	    {
	    		header('HTTP/1.1 400 02');//parametros incorretos
	        exit(0);
	    }
	  }

		function salvar($request)
		{
			$email = $request->getParam('email');
	  	$senha = base64_encode($request->getParam('senha'));

			if($email!="" && $senha !="")
		  {
		    $getUsuario = new Login();
		    $getUsuario->setEmail($email);
		    $getUsuario->setSenha($senha);
		    $retornNewUser = $getUsuario->ver_email();

		    if(sizeof($retornNewUser) > 0)
		    {
		       header('HTTP/1.1 403 01');// usuario já existe
		       exit(0);
		    }
		    else
		    {
		      $retorno = $getUsuario->sav_login();
		      if($retorno)
		      {
		      	header('HTTP/1.1 204 01');// salvo
						exit(0);
		      }
		      else
		      {
		        header('HTTP/1.1 400 03');// erro ao salvar
						exit(0);
		      }
		    }
		  }
		  else
		  {
		    header('HTTP/1.1 400 02');// paramentros incorretos
				exit(0);
		  }
		}

		function alterar($request)
		{
			$email = $request->getParam('email');
	  	$senhaAtual = base64_encode($request->getParam('senhaAtual'));
	  	$novaSenha = base64_encode($request->getParam('novaSenha'));

			if($email!="" && $senhaAtual !="" && $novaSenha !="")
		  {
		    $getUsuario = new Login();
		    $getUsuario->setEmail($email);
		    $getUsuario->setSenha($senhaAtual);
		    $retornEmail = $getUsuario->ver_email();

		    if(sizeof($retornEmail) > 0)
		    {
					$retornSenha = $getUsuario->ver_senha();

					if(sizeof($retornSenha) > 0)
		    	{
						$getUsuario->setSenha($novaSenha);
						$retornNewLogin = $getUsuario->alt_login();
						$retornConsulta = $getUsuario->consult_usuario_senha();

						if($retornConsulta[0]->email == $email && $retornConsulta[0]->senha ==$novaSenha)
						{
							header('HTTP/1.1 204 01');// editado com sucesso
							exit(0);
						}
						else
						{
							header('HTTP/1.1 400 04');// ERRO AO EDITAR
							exit(0);
						}
		    	}
		    	else
		    	{
		    		header('HTTP/1.1 400 06');// SENHA INCORRETA
		       	exit(0);
		    	}
		    }
		  }
		  else
		  {
		  	header('HTTP/1.1 400 2');// parametros incorretos
		    exit(0);
		  }
		}
		    
		function resetSenha($request)
		{
	    $email = $request->getParam('email');
	  	
			if($email!="")
		  {
		    $getUsuario = new Login();
		    $getUsuario->setEmail($email);
		    $retornEmail = $getUsuario->ver_email();

		    if(sizeof($retornEmail) > 0)
		    {
					$newSenha = base64_encode(md5(microtime()).$email);
					$getUsuario->setSenhaRedefinicao($newSenha);
					$retornNewLogin = $getUsuario->reset_login();

	    		if($retornNewLogin)
	    		{
	    			$mail = new Email();   
	    			$link = "http://stylehair.xyz/reset/v1/reset.php?email=".$email."&cod=".$newSenha; 		
	    			$menssagem ="Clique no link para atualizar a senha do sistema StyleHair !! --> ";
	    			$menssagem.=$link;
	    			$retornoEmail = $mail->sendMail($email,"codigo reset de senha",$menssagem);
	    			if($retornoEmail){
	    				header('HTTP/1.1 204 01');//salvo
	       			exit(0);
	       		} 	
	    		}
	    		else
	    		{
	    		 	header('HTTP/1.1 400 03');// ERRO AO salvar
	       		exit(0);
	    		}
		    }
		    else
		    {
		    	header('HTTP/1.1 400 06');// email não existe
		      exit(0);
		    }
		  }
		  else
		  {
		  	header('HTTP/1.1 400 2');// parametros incorretos
		    exit(0);
		  }
		}

		function alterarSenha($request)
		{
			$email = $request->getParam('email');
	  	$senhaGerada = $request->getParam('senhaGerada');
	  	$novaSenha = base64_encode($request->getParam('novaSenha'));

			if($email!="" && $senhaGerada !="" && $novaSenha !="")
		  {
		    $getUsuario = new Login();
		    $getUsuario->setEmail($email);
		    $retornEmail = $getUsuario->ver_email();

		    if(sizeof($retornEmail) > 0)
		    {
					if($retornEmail[0]->senhaRedefinicao == $senhaGerada)
					{
						$getUsuario->setSenha($novaSenha);
						$getUsuario->setSenhaRedefinicao(null);
						$retornNewLogin = $getUsuario->alt_login();
						$retornConsulta = $getUsuario->consult_usuario_senha();

						if($retornConsulta[0]->email == $email && $retornConsulta[0]->senha ==$novaSenha)
						{
							header('HTTP/1.1 204 01');// editado com sucesso
							exit(0);
						}
						else
						{
							header('HTTP/1.1 400 04');// ERRO AO EDITAR
							exit(0);
						}
					}
					else
					{
						header('HTTP/1.1 400 07');// codigo de redefinição incorreto
						exit(0);
					}
				}
	    	else
	    	{
	    		header('HTTP/1.1 400 06');// email não encontrado
	       	exit(0);
	    	}
		  }
		  else
		  {
		  	header('HTTP/1.1 400 2');// parametros incorretos
		    exit(0);
		  }
		}
}// fim da classe
?>