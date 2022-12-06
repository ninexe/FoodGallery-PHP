<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
	<title>Food Gallery</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="dist/images/icons/amb.png" />
	<link rel="stylesheet" type="text/css" href="dist/css/util.css">
	<link rel="stylesheet" type="text/css" href="dist/css/main.css">
</head>

<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="PHP/validaNovaSenha.php">
				<label><h3>Digite o seu email : </h3></label>
					<div class="wrap-input100 rs1-wrap-input200 validate-input m-b-20" data-validate="Type user name">
						<input id="iEmail" class="input100" type="text" placeholder="Email" name="nEmail" value="">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn"> Mudar Senha </button>
						
					</div>
					<div class="w-full text-center p-t-27 p-b-239">
					</div>
				</form>
				<div class="login100-more" style="background-image: url('dist/images/bg.jpg');"></div>
			</div>
		</div>
	</div>
	
</body>

</html>