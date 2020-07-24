<?php
session_start();
include('conexaoBD.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> Redefinir Senha </title>
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
        <div class="card-header"> 4° Passo de 4/4 </div>
        <div class="card-body">
          <div class="text-center mb-4">
            <h4> Informe sua nova senha </h4>
          </div>
				<?php
				if(isset($_SESSION['retorno'])){
					echo $_SESSION['retorno'];
					unset($_SESSION['retorno']);
				}
				if(isset($_SESSION['erroSenha'])){
					echo $_SESSION['erroSenha'];
					unset($_SESSION['erroSenha']);
				}
				?>
				<p style="color: #FF0000;"> Para sua segurança, sua senha deve conter pelo menos, 08 Caracteres, 01 Letra Maiúscula e 01 Número. </p>
				<form action="alterar-senhaBD.php" method="POST">
				<div class="form-group">
				  <div class="form-label-group">
				  <?php
					$usuario_id = '';
					if($_GET['usuario_id']){
					$usuario_id = FILTER_INPUT(INPUT_GET, 'usuario_id', FILTER_SANITIZE_NUMBER_INT);
					$listarDados = mysqli_query($conn, "SELECT * FROM usuarios WHERE usuario_id = '$usuario_id'");
					while($escrever = mysqli_fetch_array($listarDados)){
					echo '<input type="hidden" name="usuario_id" value="' . $escrever['usuario_id'] . '">';}
				  ?>
				  </div>
				</div>
				<div class="form-group">
				  <div class="form-label-group">
                    <input type="password" name="senha" id="Password" class="form-control" placeholder="Senha" maxlength="08" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Para sua segurança sua senha deve conter 08 Caracteres, 01 Letra Maiúscula e 01 Número." required="required">
                    <label for="Password"> Senha </label>
				  </div>
				</div>
				<input type="submit" class="btn btn-primary btn-block" value="Alterar">
			  </form>
			   <?php
				}else{
					$_SESSION['msgErro'] = 'Página Não Encontrada...';
					header("Location: undefined.php");
				}
			  ?>
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
