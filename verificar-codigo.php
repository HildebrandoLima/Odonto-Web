<?php
	//Inicializado primeira a sessão para posteriormente recuperar valores das variáveis globais. 
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
	<link rel="stylesheet" href="css/styles.css">
  </head>

  <body id="page-top">
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
      <a class="navbar-brand mr-1" href="index.php"> Odonto Web</a>
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
        </div> -->
      </form>
    </nav>

    <div id="wrapper">
      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">
			<img src="img/dente.png" width="15" height="15" />
            <span> Menu </span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<img src="img/dente.png" width="15" height="15" />
            <span> Serviços </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header"> Fazemos: </h6>
            <a class="dropdown-item"> Sites </a>
            <a class="dropdown-item"> e-comerce </a>
            <a class="dropdown-item"> Sistemas </a>
            <a class="dropdown-item"> App's </a>
          </div>
        </li>
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<img src="img/dente.png" width="15" height="15" />
            <span> Contato </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header"> Ligue: </h6>
            <a class="dropdown-item"> WhatsApp </a>
            <a class="dropdown-item"> (85) 9106-9314 </a>
			<a class="dropdown-item"> E-mail </a>
			<a class="dropdown-item"> hildebrandolima16@ </a>
			<a class="dropdown-item"> gmail.com </a>
          </div>
        </li>
		<!-- <li class="nav-item">
          <a class="nav-link" href="registrar-usuario.php">
			<img src="img/dente.png" width="15" height="15" />
            <span> Faça Já seu Cadastro </span>
          </a>
        </li> -->
      </ul>

      <div id="content-wrapper">
        <div class="container-fluid">
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i> Página Inicial </div>
				<div class="card-body">
				<div class="table-responsive">
					  <div class="container">
						<div class="card card-login mx-auto mt-5">
						<div class="card-header"> Login </div>
						<div class="card-body">
						<form action="Validarcodigo.php" method="POST">
							<div class="form-group">
							<div class="form-label-group">
								<input type="text" id="Codigo" name="codigo" class="form-control" placeholder="Digite seu Código" required="required" autofocus="autofocus">
								<label for="Codigo"> Digite seu Código </label>
							</div>
							</div>
							<input type="submit" class="btn btn-primary btn-block" />
							<div class="text-center">
								<a class="d-block small" href="index.php"> Voltar </a>
							</div>
						</form>
					<p>
					<?php
					//	Login
					if(isset($_SESSION['codigoErro'])){
						echo $_SESSION['codigoErro'];
						unset($_SESSION['codigoErro']);
					}
					?>
				</p>
					</div>
				</div>
				</div>
					  </div>
					</div>
            <div class="card-footer small text-muted"><center><b> Quem Somos? Somos uma empresa de T.I especializada em diversos serviços de automação web para seu negócio. | Onde Ficamos? Rua: Antero Quental - Apto 12, Bloco 14, Messejana - Fortaleza/CE </b></center></div>
          </div>
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span> Copyright © Totos os direitos reservados | Sistema Odontologico Desenvolvido pela <a href="http://webtec.6te.net" title="Web Tech"> Web Tech </a></span>
            </div>
          </div>
        </footer>
      </div>
      <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <!-- Bootstrap core JavaScript-->
	<script src="js/scripts-dist.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>
  </body>
</html>
