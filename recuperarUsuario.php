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
	<link rel="icon" type="image/png" href="dist/images/icons/amb.png"/>
	<link rel="stylesheet" type="text/css" href="dist/css/util.css">
	<link rel="stylesheet" type="text/css" href="dist/css/main.css">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="PHP/validaLogin.php">
					<span class="login100-form-title p-b-34">
						Login Food Gallery
                    </span>
                    
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">
						<input id="first-name" class="input100" type="text" placeholder="Email" name="nEmail">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
						<input class="input100" type="password" placeholder="Senha" name="nSenha">
						<span class="focus-input100"></span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="w-full text-center p-t-27 p-b-239">
						<span class="txt1">
							Esqueceu: 
						</span>

						<a href="#" class="txt2">
							Email / Senha?
						</a>
                    </div>
				</form>
				<div class="login100-more" style="background-image: url('dist/images/bg.jpg');"></div>
			</div>
		</div>
    </div>
	<?php
        //Verifico se a variável foi inicializada
		if (isset($_SESSION['msg'])){
			//Se sim, mostro na tela e encerro a sessão para limpar a variável
			echo $_SESSION['msg'];
			session_destroy();
		}
	?>
</body>
</html>