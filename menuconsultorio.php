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
		echo "<script> alert('Desculpe, mas está área é restrita.'); window.location='administrador.php'</script>";
	}elseif($_SESSION['usuarioNiveisAcessoId'] == "2"){
		echo "<script> alert('Desculpe, mas está área é restrita.'); window.location='financeiro.php'</script>";
	}elseif($_SESSION['usuarioNiveisAcessoId'] == "3"){
		// Entra o Acesso
	}elseif($_SESSION['usuarioNiveisAcessoId'] == "4"){
		echo "<script> alert('Desculpe, mas está área é restrita.'); window.location='colaborador.php'</script>";
	}elseif($_SESSION['usuarioNiveisAcessoId'] == "5"){
		echo "<script> alert('Desculpe, mas está área é restrita.'); window.location='usuario.php'</script>";
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
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
  </head>

  <body id="page-top">
        <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
      <a class="navbar-brand mr-1" href="consultorio.php"> Odonto Web <!-- <img src="logo.jpg" width="150" height="50" /> --></a>
      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <!-- <div class="input-group">
          <font color="white"> Aceitamos: </font>
		  <img src="img/visa.png" width="30" height="20" hspace="10"/>
		  <img src="img/mastercard.png" width="30" height="20" hspace="10"/>
		  <img src="img/hipercard.png" width="30" height="20" hspace="10"/>
		  <a href="logout.php"><font color="white"> SAIR </font></a>
        </div> -->
      </form>
    </nav>

    <div id="wrapper">
      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="consultorio.php">
            <!--<i class="fas fa-fw fa-tachometer-alt"></i>-->
			<img src="img/dente.png" width="20" height="20" />
            <span> Menu </span>
          </a>
        </li>
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <!--<i class="fas fa-fw fa-folder"></i>-->
			<img src="img/dente.png" width="20" height="20" />
            <span> Suporte </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header"> Telefone/Tutoriais: </h6>
            <a class="dropdown-item" href=""> (85) 9.9106-9314 </a>
            <a class="dropdown-item" href="Manual-do-Usuário.pdf"> Manual: Baixe Agora </a>
            <a class="dropdown-item" href=""> Vídeos: Tutoriais </a>
			</div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <!--<i class="fas fa-fw fa-folder"></i>-->
			<img src="img/dente.png" width="20" height="20" />
            <span> Registrar </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header"> Registrar: </h6>
            <a class="dropdown-item" href="registrar-usuario.php"> Registrar Usuário </a>
			<a class="dropdown-item" href="registrar-consulta.php"> Registrar Consulta </a>
          </div>
        </li>
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<img src="img/dente.png" width="20" height="20" />
            <span> Filtro de Pesquisa </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header"> Filtro de Pesquisa: </h6>
			<a class="dropdown-item" href="historico.php"> Histórico de Clientes
			<?php
			/*$listarDados = mysqli_query($conn, "SELECT COUNT(*) AS status_id FROM status");
			while($escrever = mysqli_fetch_array($listarDados)){
			echo '<span class="badge badge-danger">' . $escrever['status_id'] . '</span>';
			}*/
			?>
			</a>
			<a class="dropdown-item" href="listar-usuarios.php"> Listar Clientes
			<?php
			/*$listarDados = mysqli_query($conn, "SELECT COUNT(*) AS usuario_id FROM usuarios");
			while($escrever = mysqli_fetch_array($listarDados)){
			echo '<span class="badge badge-danger">' . $escrever['usuario_id'] . '</span>';
			}*/
			?>
			</a>
            <a class="dropdown-item" href="cancelar-plano.php"> Cancelar Plano
			<?php
			/*$listarDados = mysqli_query($conn, "SELECT COUNT(*) AS usuario_id FROM usuarios");
			while($escrever = mysqli_fetch_array($listarDados)){
			echo '<span class="badge badge-danger">' . $escrever['usuario_id'] . '</span>';
			}*/
			?>
			</a>
          </div>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="registrar-consulta.php">
			<img src="img/dente.png" width="20" height="20" />
            <span> Marcar Consultas </span></a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="Manual do Usuário.pdf">
			<img src="img/dente.png" width="20" height="20" />
            <span> Manual do Usuário </span></a>
        </li> -->
		<li class="nav-item active">
          <a class="nav-link" href="#" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#logoutModal">
			<img src="img/dente.png" width="20" height="20" />
            <span> Sair </span>
          </a>
        </li>
      </ul>

      <div id="content-wrapper">
        <div class="container-fluid">
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item active"> Seja bem vindo(a) <?php echo $_SESSION['usuarioNome']; ?></li>
          </ol>

<?php include('alertavencimento.php'); ?>