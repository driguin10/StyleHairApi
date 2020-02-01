<?php

if($_GET['cod'] == "01")
{
	$titulo = "Senha Alterada Com Sucesso !!!";
	$imagem = "images/success.png";
}else
if($_GET['cod'] == "02")
{
	$titulo = "Erro ao editar !!!";
	$imagem = "images/error.png";
}
else
if($_GET['cod'] == "03")
{
	$titulo = "Usuario não encontrado !!!";
	$imagem = "images/error.png";
}
else
{
	$titulo = "Erro inesperado !!!";
	$imagem = "images/error.png";
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>StyleHair Reset</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-20 p-b-20">
				
				
					<span class="login100-form-avatar">
						<img src=<?php echo "'".$imagem."'"; ?> alt="AVATAR">
					</span>

					<span class="login100-form-title p-b-70">
						<?php echo $titulo; ?>
						<div class="container-login100-form-btn">
							<button class="login100-form-btn" type="button" onClick="history.go(-1)">voltar</button>
						</div>
					</span>
					
			</div>
		</div>
	</div>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	

</body>
</html>