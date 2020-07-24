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
	include('menufinanceiro.php');
?>

	<!-- DataTables Example -->
     <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i> Controle Financeiro - Contas a Receber </div>
        <div class="card-body">
          <!-- Icon Cards-->
          <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3"><!-- Margem total de lucro -->
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                  </div>
                  <div class="mr-5">
				  <?php
					$contarDados = mysqli_query($conn, "SELECT COUNT(*) AS status_id FROM status WHERE pagamento != 'Nullo' AND consultorio = '$_SESSION[usuarioNome]'");
					while($escrever = mysqli_fetch_array($contarDados)){ ?>
					Ao Todo Foram <span class="badge badge-danger"><?php echo $escrever['status_id']; ?></span> Vendas Realizadas <?php } ?>
				  </div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#detalheModal">
                  <span class="float-left"> Ver Detalhes </span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3"><!-- Total de vendas em dinheiro --->
              <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                  </div>
                  <div class="mr-5">
				  <?php
					$contarDados = mysqli_query($conn, "SELECT COUNT(*) AS status_id FROM status WHERE pagamento = 'Dinheiro' AND consultorio = '$_SESSION[usuarioNome]'");
					while($escrever = mysqli_fetch_array($contarDados)){ ?>
					Ao Todo <span class="badge badge-success"><?php echo $escrever['status_id']; ?></span> Vendas em Dinheiro <?php } ?>
				  </div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#detalheModal">
                  <span class="float-left"> Ver Detalhes </span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3"><!-- Total de vendas em cartão (Aprovado) -->
              <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                  </div>
                  <div class="mr-5">
				  <?php
					$contarDados = mysqli_query($conn, "SELECT COUNT(*) AS status_id FROM status WHERE pagamento = 'Cartão' AND consultorio = '$_SESSION[usuarioNome]'");
					while($escrever = mysqli_fetch_array($contarDados)){ ?>
					Ao Todo <span class="badge badge-warning text-white"><?php echo $escrever['status_id']; ?></span> Vendas em Cartão Aprovadas <?php } ?>
				  </div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#detalheModal">
                  <span class="float-left"> Ver Detalhes </span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3"><!-- Total de vendas e cartão (Não Aprovado) -->
              <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                  </div>
                  <div class="mr-5">
				   <?php
					$contarDados = mysqli_query($conn, "SELECT COUNT(*) AS status_id FROM status WHERE pagamento = 'Cartão' AND entrada = 'N' AND consultorio = '$_SESSION[usuarioNome]'");
					while($escrever = mysqli_fetch_array($contarDados)){ ?>
					Ao Todo <span class="badge badge-primary"><?php echo $escrever['status_id']; ?></span> Vendas em Cartão Não Aprovadas <?php } ?>
				  </div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#detalheModal">
                  <span class="float-left"> Ver Detalhes </span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>
            </div>
          </div>
        </div>

	<!-- Infor Modal-->
    <div class="modal fade" id="detalheModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Detalhes em Valores </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"> × </span>
            </button>
          </div>
          <div class="modal-body">
		  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		  <?php //	Margem total de lucro
			$contarVendas = mysqli_query($conn, "SELECT SUM(valor) FROM status WHERE consultorio = '$_SESSION[usuarioNome]'");
			while($escrever = mysqli_fetch_array($contarVendas)){ ?>
			<tr><td> Margem  de Lucro Total: <span class="badge badge-danger">R$<?php echo $escrever['SUM(valor)']; ?></span>. Sem incluir despesas </td> <?php } ?>

			<?php //	Total de vendas em dinheiro
			$contarVendasdinheiro = mysqli_query($conn, "SELECT SUM(valor) FROM status WHERE pagamento = 'Dinheiro' AND consultorio = '$_SESSION[usuarioNome]'");
			while($escrever = mysqli_fetch_array($contarVendasdinheiro)){ ?>
			<td> Total de Vendas em Dinheiro: <span class="badge badge-danger">R$<?php echo $escrever['SUM(valor)']; ?></span></td></tr> <?php } ?>

			<?php //	Total de vendas em cartão (Aprovado)
			$contarVendascartao = mysqli_query($conn, "SELECT SUM(valor) FROM status WHERE pagamento = 'Cartão' AND consultorio = '$_SESSION[usuarioNome]'");
			while($escrever = mysqli_fetch_array($contarVendascartao)){ ?>
			<tr><td> Total de Vendas em Cartão Aprovadas: <span class="badge badge-danger">R$<?php echo $escrever['SUM(valor)']; ?></span></td> <?php } ?>

			<?php //	Total de vendas e cartão (Não Aprovado)
			$contarVendascartaona = mysqli_query($conn, "SELECT SUM(valor) FROM status WHERE pagamento = 'Cartão' AND entrada = 'N' AND consultorio = '$_SESSION[usuarioNome]'");
			while($escrever = mysqli_fetch_array($contarVendascartaona)){ ?>
			<td> Total de Vendas em Cartão ainda não Aprovadas: <span class="badge badge-danger">R$<?php echo $escrever['SUM(valor)']; ?></span></td></tr> <?php } ?>
		  </table>
		  </div>
          <div class="modal-footer">
            <button class="btn btn-primary" type="button" data-dismiss="modal"> Fechar </button>
          </div>
        </div>
      </div>
    </div>
        <?php include('rodape.php'); ?>
  </body>
</html>