<?php
session_start();
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
        <div class="card-header"> 1° Passo de 1/4 </div>
        <div class="card-body">
          <div class="text-center mb-4">
            <h4> Esqueceu sua Senha? </h4>
            <p> Digite seu CPF e cada passo irá explicar sobre como redefinir sua senha. </p>
          </div>
          <form action="enviar-senhaBD.php" method="POST">
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" name="cpf" id="CPF" class="form-control" placeholder="CPF" maxlength="14" onkeypress="mascara(this, '###.###.###-##')" required="required">
                <label for="CPF"> CPF </label>
              </div>
            </div>
			<input type="submit" class="btn btn-primary btn-block" value="Redefinir">
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="cadastrar-usuario.php"> Registrar Conta </a>
            <a class="d-block small" href="index.php"> Login </a>
          </div>
			<p>
				<?php 
				//Recuperando o valor da variável global, os erro de login.
				if(isset($_SESSION['retorno'])){
					echo $_SESSION['retorno'];
					unset($_SESSION['retorno']);
				}
				if(isset($_SESSION['retornoErro'])){
					echo $_SESSION['retornoErro'];
					unset($_SESSION['retornoErro']);
				}?>
			</p>
        </div>
      </div>
    </div>



	<!-- Mascara do CPF -->
	<script language="JavaScript">
	function mascara(t, mask){
		var i = t.value.length;
		var saida = mask.substring(1,0);
		var texto = mask.substring(i)
		if (texto.substring(0,1) != saida){
		t.value += texto.substring(0,1);
		}
	}
	</script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  </body>
</html>
