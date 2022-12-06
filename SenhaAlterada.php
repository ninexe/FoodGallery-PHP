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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" method="POST" action="PHP/validaNovaSenha.php">
                    <div>
                        <label>
                            <h3>Sua nova Senha é : </h3>
                        </label>&nbsp<label>
                            <h3>
                                <font color="red"><?php echo $_SESSION['senha']; ?></font>
                            </h3>
                        </label>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn">
                    <a href="entrar.php"  type="button" class="login100-form-btn">Voltar a página inicial</a>
						
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
