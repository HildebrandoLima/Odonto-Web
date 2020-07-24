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
		echo "<script> alert('Área restrita para o consultório.'); window.location='consultorio.php'</script>";
	}elseif($_SESSION['usuarioNiveisAcessoId'] == "4"){
		// Entra o Acesso
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
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
	<link rel="stylesheet" href="css/styles.css">
  </head>

  <body id="page-top">
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
      <a class="navbar-brand mr-1" href="index.php"> Odonto Web <!-- <img src="logo.jpg" width="150" height="50" /> --></a>
      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <!-- <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <font color="white"> Aceitamos: </font>
		  <img src="img/visa.png" width="30" height="20" hspace="10"/>
		  <img src="img/mastercard.png" width="30" height="20" hspace="10"/>
		  <img src="img/hipercard.png" width="30" height="20" hspace="10"/>
		  <a href="logout.php"><font color="white"> SAIR </font></a>
        </div>
      </form> -->
    </nav>

    <div id="wrapper">
      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">
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
			<img src="img/dente.png" width="20" height="20" />
            <span> Serviços </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header"> Desenvolvemos: </h6>
            <a class="dropdown-item"> Sites </a>
            <a class="dropdown-item"> App's </a>
            <a class="dropdown-item"> E-Commerce </a>
            <a class="dropdown-item"> Sistemas Web </a>
          </div>
        </li>
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<img src="img/dente.png" width="20" height="20" />
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
		<?php
		   /*$listarDados = mysqli_query($conn, "SELECT * FROM usuarios WHERE consultorio = '$_SESSION[usuarioNome]'");
		   while($escrever = mysqli_fetch_array($listarDados)){*/ ?>
          <a class="nav-link" href="listar-perfil.php?usuario_id=<?php //$escrever ['usuario_id']; } ?>">
			<img src="img/dente.png" width="20" height="20" />
            <span> Perfil </span>
          </a>
        </li> -->
		<li class="nav-item">
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
            <li class="breadcrumb-item active"> Seja bem-vindo(a) <?php echo $_SESSION['usuarioNome'];?></li>
          </ol>

		<!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i> Consultas Marcadas </div>
            <div class="card-body">
              <div class="table-responsive">
			  	<?php
				//	Usuários marcados para hoje
				$listarDados = mysqli_query($conn, "SELECT COUNT(*) AS data_marcada FROM consulta WHERE data_marcada = DATE(NOW()) AND consultorio = '$_SESSION[usuarioNome]'");
				while($escrever = mysqli_fetch_array($listarDados)){ ?>
				<p><center><strong><font color="red"> Ao todo, <?php  $escrever['data_marcada']; ?> Pessoas agendadas para hoje </font></strong></center></p><?php } ?>

				 <form action="" method="POST" name="form_busca" title="Buscar">
					 <div class="form-label-group">
						 <input type="date" id="date" name="busca" class="form-control" placeholder="Data" required="required" onchange="this.form.submit()">
						 <label for="data"> Data </label>
					 </div>
				 </form><br />
				 <?php
				//	SISTEMA DE BUSCA
				//	Linha para capturar a palavra digitada.
				if(isset($_POST['busca'])){
				$busca = $_POST['busca'];

				//	Caso o resultado seja vazio não irá executa o código e retornará a mensagem de aviso.
				if($busca == "" or $busca == " "){
					echo '<center><strong><font color="red"> Digite algo para a busca! </font></strong></center>';
				}else{
					//	Toda vez que for encontrado um espaço na palabra busca irá por um espaço no meio.
					$busca_divida = explode(' ', $busca);
					$quant = count($busca_divida);
					$id_mostrado = array("");

				//	Nesse for terá um loop para cada palavra no banco de bados.
				for($i = 0; $i < $quant; $i++){
					$pesquisa = $busca_divida[$i];
					$sql = mysqli_query($conn, "SELECT * FROM consulta WHERE data_marcada LIKE '%$busca%' AND consultorio = '$_SESSION[usuarioNome]'");

					//	Vai contar quantas linhas a variável sql puxou.
					$quant_campos = mysqli_num_rows($sql);

				if($quant_campos == 0){
					echo '<center><strong><font color="red"> Nenhum resultado obtido! </font></strong></center>';
				}else{
					$contarDados = mysqli_query($conn, "SELECT COUNT(*) AS data_marcada FROM consulta WHERE data_marcada LIKE '%$busca%' AND consultorio = '$_SESSION[usuarioNome]'");
					$escrever = mysqli_fetch_array($contarDados);
					echo '<center><strong><font color="red"> Resultado da busca ' . $busca . '! Total da Busca: ' . date("d/m/Y", strtotime($escrever['data_marcada'])) . '</font></strong></center>';?>

					<div class="resultado">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<tr>
							<th><font color="red"> Data Marcada </font></th>
							<th> Nome </th>
							<th> Código </th>
						</tr>
					  <tfoot>
						<tr>
						  <th><font color="red"> Data Marcada </font></th>
						  <th> Nome </th>
						  <th> Código </th>
						</tr>
					  </tfoot>
				<?php //	A função mysql_fetch_array retorna todos os valores puxados da sql no banco.
				while($linha = mysqli_fetch_array($sql)){
					//	Confere se o id já está no array/pesquisa, para não repeti a pesquisa no resultado.
					$nome = $linha['nome'];
					$data_marcada = $linha['data_marcada'];
					$consulta_id = $linha['consulta_id'];

				//	Se retorna verdade ele mostra, caso contrário não mostra.
				if(!array_search($consulta_id, $id_mostrado)){
				//	Exibe o resultado. ?>
				<tbody>
					<tr>
						<td><font color="red"><?php echo date("d/m/Y", strtotime($data_marcada)); ?></font></td>
						<td><?php echo $nome; ?></td>
						<td><?php echo $consulta_id; ?></td>
						</tr>
				</tbody>

			<?php array_push($id_mostrado, $consulta_id);
			}}}echo '</table></div><br />';
			//	else
			}//	for
			}//	else campos vazio
			}//if botao pressionado
			?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
					  <th> Data </th>
					  <th> Nome </th>
					  <th> Código </th>
                    </tr>
                  <tfoot>
                    <tr>
                      <th> Data </th>
                      <th> Nome </th>
					  <th> Código </th>
                    </tr>
                  </tfoot>
                  <?php
				  $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
				  $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
				  //	SETAR A QUANTIDADE PAGINAS DE ITENS POR PAGINA
				  $qnt_result_pg = 3;
				  //	CALCULAR O INICIO VISUALIZAÇÃO
				  $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

				  $listarDados = mysqli_query($conn, "SELECT * FROM consulta WHERE data_marcada = data_marcada = DATE(NOW()) AND consultorio = '$_SESSION[usuarioNome]' LIMIT $inicio, $qnt_result_pg");
				  while($escrever = mysqli_fetch_array($listarDados)){ ?>
				  <tbody>
                    <tr>
					  <td><?php echo $escrever['consulta_id']; ?></td>
                      <td><?php echo $escrever['nome']; ?></td>
                      <td><?php echo date("d/m/Y", strtotime($escrever['data_marcada'])); ?></td>
                    </tr>
                  </tbody>

				  <?php }
				  //	PAGINAÇÃO - SOMAR A QUANTIDADE DE PATOLOGIAS
				  $result_pg = "SELECT COUNT(consulta_id) AS num_result FROM consulta WHERE consultorio = '$_SESSION[usuarioNome]'";
				  $resultado_pg = mysqli_query($conn, $result_pg);
				  $row_pg = mysqli_fetch_assoc($resultado_pg);
				  //	echo $row_pg['num_result'];
				  //	QUANTIDADE DE PAGINA
				  $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
				  //	LIMITAR OS LINKS ANTES E DEPOIS
				  $max_links = 100;
						echo "<center><a href='colaborador.php?pagina=1'>Primeira&nbsp;</a>";

				  for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
					if($pag_ant >= 1){
						echo "<a href='colaborador.php?pagina=$pag_ant'>$pag_ant</a>";
					}
				  }
						echo "&nbsp;$pagina&nbsp;";
  
				  for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
					if($pag_dep <= $quantidade_pg){
						echo "<a href='colaborador.php?pagina=$pag_dep'>$pag_dep</a>";
					}
				  }
						echo "<a href='colaborador.php?pagina=$quantidade_pg'>&nbsp;Última</a></center>";

				  // Connection close
				  mysqli_close($conn);
				?>
                </table>
              </div>
            </div>
          </div>

<?php include('rodape.php') ?>