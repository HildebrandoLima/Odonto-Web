<?php
	// A sessão precisa ser iniciada em cada página diferente
	if (!isset($_SESSION)) session_start();
	// Verifica se não há a variável da sessão que identifica o usuário
	if (!isset($_SESSION['usuarioId'])) {
	// Destrói a sessão por segurança
	session_destroy();
	// Redireciona o visitante de volta pro login
	echo "<script> alert('É necessário está logado para acessar está página.'); window.location='index.php'</script>";
	exit;
	}
	include('Conexaodb.php');
	//	Vericica o Id da sessão e executa ação para direcionar a devida página/mantém a segurança de acesso para cada página
    if($_SESSION['usuarioNiveisAcessoId'] == "1"){
		echo "<script> alert('Área restrita para o consultório.'); window.location='administrador.php'</script>";
	}elseif($_SESSION['usuarioNiveisAcessoId'] == "2"){
		echo "<script> alert('Área restrita para o consultório.'); window.location='financeiro.php'</script>";
	}elseif($_SESSION['usuarioNiveisAcessoId'] == "3"){
		// Entra o Acesso
	}elseif($_SESSION['usuarioNiveisAcessoId'] == "4"){
		echo "<script> alert('Área restrita para o consultório.'); window.location='colaborador.php'</script>";
	}elseif($_SESSION['usuarioNiveisAcessoId'] == "5"){
		echo "<script> alert('Área restrita para o consultório.'); window.location='usuario.php'</script>";
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> Odonto Web </title>
	<!-- Icone na aba do navegador -->
	<link rel="shortcut icon" href="img/dente.png">
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
  </head>

  <body class="bg-dark">
    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header"> Registrar Consulta </div>
        <div class="card-body">
          <form action="Enviarconultadb.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
			<div class="form-group">
			<div class="form-label-group">
				<input type="hidden" id="consultorio" name="consultorio" class="form-control" value="<?php echo $_SESSION['usuarioNome']; ?>" placeholder="Nome do Consultório" required="required">
				<label for="consultorio"> Nome do Consultório </label>
              </div>
			  </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
				  <select name="nome" class="form-control" required="required" autofocus="autofocus">
				    <label for="escolha" id="escolha"> Selecione o Nome </label>
					<option value="escolha"> Selecione o Nome </option>
				    <?php
						$listarDados = mysqli_query($conn, "SELECT * FROM usuarios WHERE consultorio = '$_SESSION[usuarioNome]' AND niveis_acesso_id = '4' ORDER BY nome");
						while($escrever = mysqli_fetch_array($listarDados)){
						echo '<option value="' . $escrever['nome'] . '"> ' . $escrever['nome'] . ' </option>';}
					?>
				    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="date" id="date" name="data_marcada" class="form-control" placeholder="Data" required="required">
                    <label for="data"> Data </label>
                  </div>
                </div>
              </div>
            </div>
			<input type="hidden" name="acao" value="enviado" />
            <input type="submit" class="btn btn-primary btn-block" value="Marcar" />
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="consultorio.php"> Voltar </a>
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
