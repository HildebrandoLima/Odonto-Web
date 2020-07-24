<?php
session_start();
include('Conexaodb.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> Liberar Acesso </title>
	<!-- Icone na aba do navegador -->
	<link rel="shortcut icon" href="img/icone.png">
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
  </head>
 
  <body class="bg-dark">
    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header"> Liberar Acesso </div>
        <div class="card-body">
		 <?php
				$codigo = '';
				if($_GET['codigo']){
					//$chave = preg_replace('/[^[:alnum:]]/','',$_GET["chave"]);
				?>
			<form action="Enviarsenha.php" method="POST">
			<?php
			$codigo = filter_input(INPUT_GET, 'codigo', FILTER_SANITIZE_STRING);

			$listarDados = mysqli_query($conn, "SELECT * FROM usuarios WHERE codigo = '$codigo' LIMIT 1");
			while($escrever = mysqli_fetch_array($listarDados)){
			echo '<input type="hidden" name="codigo" value="' . $escrever['codigo'] . '" />
				<div class="form-group">
				<p style="color: #FF0000;"> Para sua segurança, sua senha deve conter pelo menos, 08 Caracteres, sendo: 01 Caractere Especial, 01 Letra Maiúscula e 01 Número. </p>
				<div class="form-label-group">
					<input type="password" name="senha" id="Password" class="form-control" placeholder="Senha" maxlength="08" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Para sua segurança, sua senha deve conter pelo menos, 08 Caracteres, 01 Letra Maiúscula e 01 Número." required="required">
					<label for="Password"> Senha </label>
				</div>
				</div>';} ?>
				<input type="submit" class="btn btn-primary btn-block" />
			</form>
			<div class="text-center">
				<a class="d-block small" href="index.php"> Voltar </a>
				<p><?php
				}else{
					$_SESSION['msgErro'] = 'Página Não Encontrada...';
					header("Location: undefined.php");
				}
				if(isset($_SESSION['msgSenha'])){
					echo $_SESSION['msgSenha'];
					unset($_SESSION['msgSenha']);
				}
				?></p>
			</div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  </body>
</html>
