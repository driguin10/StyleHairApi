<?php
	$email = $_GET['email'];
  $cod = $_GET['cod'];
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
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	
<!--===============================================================================================-->

<!--===============================================================================================-->

<!--===============================================================================================-->	
	
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-20 p-b-20">
				<form class="login100-form validate-form" method="POST" action="resetCod.php">
					<span class="login100-form-title p-b-70">
						
					</span>
					<span class="login100-form-avatar">
						<img src="images/logo.png" alt="AVATAR">
					</span>

					

					<div class="wrap-input100 validate-input m-b-50" data-validate="Entre com a senha, minimo 8 caracteres">
						<input type="hidden" name="email" value=<?php echo $email; ?>>
						<input type="hidden" name="codigo" value=<?php echo $cod; ?>>

						<input class="input100" type="password" name="novaSenha">
						<span class="focus-input100" data-placeholder="Senha"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-50" data-validate="Repeta a senha corretamente">
						<input class="input200" type="password" name="pass">
						<span class="focus-input100" data-placeholder="Repita a Senha"></span>
					</div>


					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Atualizar Senha
						</button>
					</div>

			
				</form>
			</div>
		</div>
	</div>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

</body>
</html>