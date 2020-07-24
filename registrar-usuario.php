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
        <div class="card-header"> Registrar Usuário </div>
        <div class="card-body">
          <form action="Enviarusuariodb.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
				<div class="form-label-group">
					<input type="text" id="nome" name="nome" class="form-control" placeholder="Nome e Sobrenome" required="required" autofocus="autofocus">
                    <label for="nome"> Nome e Sobrenome </label>
                </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
					<input type="hidden" id="consultorio" name="consultorio" class="form-control" value="<?php echo $_SESSION['usuarioNome']; ?>" placeholder="Nome do Consultório" required="required">
					<!-- <label for="consultorio"> Nome do Consultório </label> -->
                  </div>
                </div>
              </div>
            </div>
			<div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="date" id="date" name="inicio_plano" class="form-control" placeholder="Data: Início do Plano" required="required">
                    <label for="inicioPlano"> Data de Início do Plano </label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="date" id="date" name="data_nascimento" class="form-control" placeholder="Data de Nascimento" required="required">
                    <label for="dataNasimento"> Data de Nascimento </label>
                  </div>
                </div>
              </div>
            </div>
			<div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
					<input type="tel" id="telefone" name="telefone" class="form-control" placeholder="55+DDD+WhatsApp" maxlength="12" required="required">
					 <label for="telefone"> 55+DDD+WhatsApp </label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
					<center><select class="form-control" name="niveis_acesso_id" required="required">
					<label for="niveis_acesso_id" id="niveis_acesso_id"> Perfil de Acesso </label>
					<option> Perfil de Acesso </option>
					<option value="2"> Administrador(a) </option>
					<option value="3"> Colaborador(a) </option>
					<option value="4"> Consultório </option>
					<option value="5"> Cliente </option>
					</select></center>
                  </div>
                </div>
              </div>
            </div>
			<div class="form-group">
			<div class="form-group">
				  <div class="form-label-group">
					 <input type="text" id="endereco" name="endereco" class="form-control" placeholder="Endereço: Rua/AV." required="required">
					 <label for="endereco"> Endereço: Rua/Av. </label>
				  </div>
				</div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
				    <input type="int" id="num" name="num" class="form-control" placeholder="N°" maxlength="5" required="required">
                    <label for="num"> N° </label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="bairro" name="bairro" class="form-control" placeholder="Bairro" required="required">
                    <label for="bairro"> Bairro </label>
                  </div>
                </div>
              </div>
            </div>
			<input type="hidden" name="acao" value="enviado" />
            <input type="submit" class="btn btn-primary btn-block" value="Cadastrar" />
          </form>
			<div class="text-center">
				<a class="d-block small mt-3" href="consultorio.php"> Voltar </a>
			</div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
	<!-- Mascara do Telefone -->
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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  </body>
</html>
