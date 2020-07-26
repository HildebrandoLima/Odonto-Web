<?php include('menufinanceiro.php'); ?>

		<!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i> Controle Financeiro | Despesas custos_diretoss </div>
            <div class="card-body">
                <div class="container">
					<div class="card-body">
						<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<tr>
						  <th> Equipamento </th>
						  <th> Quantidade </th>
						  <th> Valor Custos Diretos </th>
						  <th> Mais </th>
						</tr>
					  <tfoot>
						<tr>
						  <th> Equipamento </th>
						  <th> Quantidade </th>
						  <th> Valor Custos Diretos </th>
						  <th> Mais </th>
						</tr>
					  </tfoot>
					  <?php
					  $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
					  $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
					  //	SETAR A QUANTIDADE PAGINAS DE ITENS POR PAGINA
					  $qnt_result_pg = 3;
					  //	CALCULAR O INICIO VISUALIZAÇÃO
					  $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;
					  $listarCustosdiretos = mysqli_query($conn, "SELECT * FROM custos_diretos WHERE consultorio = '$_SESSION[usuarioNome]' LIMIT $inicio, $qnt_result_pg");
					  while($escrever = mysqli_fetch_array($listarCustosdiretos)){ ?>
					  <tbody>
						<tr>
						  <td><?php echo $escrever['equipamento']; ?></td>
						  <td><span class="badge badge-success"><?php echo $escrever['quantidade']; ?></span></td>
						  <td><span class="badge badge-danger">R$ <?php echo $escrever['valor_custo_direto']; ?></span></td>
						  <td><a href="#" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#detalhecustodireto<?php echo $escrever['custo_direto_id']; ?>"><svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-eye" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
						  <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
						  </svg></a>
						  <a href="editar-custo-direto.php?custo_direto_id=<?php echo $escrever['custo_direto_id']; ?>"><svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
						  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
						  </svg></a>
						  <a href="#" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#removecustodireto<?php echo $escrever['custo_direto_id']; ?>"><svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
						  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
						  </svg></a></td>
						</tr>
					  </tbody>

					  <?php } // // Fim do while da tabela despesas de custos_diretos.
					  //	PAGINAÇÃO - SOMAR A QUANTIDADE DE PATOLOGIAS
					  $result_pg = "SELECT COUNT(custo_direto_id) AS num_result FROM custos_diretos WHERE consultorio = '$_SESSION[usuarioNome]'";
					  $resultado_pg = mysqli_query($conn, $result_pg);
					  $row_pg = mysqli_fetch_assoc($resultado_pg);
					  //	echo $row_pg['num_result'];
					  //	QUANTIDADE DE PAGINA
					  $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
					  //	LIMITAR OS LINKS ANTES E DEPOIS
					  $max_links = 100;
						echo "<center><a href='custos-diretos.php?pagina=1'>Primeira&nbsp;</a>";

					  for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
						if($pag_ant >= 1){
							echo "<a href='custos-diretos.php?pagina=$pag_ant'>$pag_ant</a>";
						}
					  }
							echo "&nbsp;$pagina&nbsp;";
	  
					  for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
						if($pag_dep <= $quantidade_pg){
							echo "<a href='custos-diretos.php?pagina=$pag_dep'>$pag_dep</a>";
						}
					  }
							echo "<a href='custos-diretos.php?pagina=$quantidade_pg'>&nbsp;Última</a></center>";?>
					</table>
				  <div class="text-center">
					<a class="d-block small mt-3" href="financeiro.php"> Voltar </a>
				  </div>
				</div>
				</div>
			</div>
           </div>
          </div>
        </div>
	<?php
	//	Despesas de custos_diretoss - Detalhes
	$listarcustos_diretoss = mysqli_query($conn, "SELECT * FROM custos_diretos WHERE consultorio = '$_SESSION[usuarioNome]'");
	while($escrever = mysqli_fetch_array($listarcustos_diretoss)){
	?><!-- Infor Modal-->
    <div class="modal fade" id="detalhecustodireto<?php echo $escrever['custo_direto_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Detalhes de <?php echo $escrever['equipamento']; ?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"> × </span>
            </button>
          </div>
          <div class="modal-body">
		  <div class="table-responsive">
		  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<tr>
				<th> Equip. </th>
				<th> Qtd </th>
				<th> Valor Equip. </th>
				<th> Data de Entrada </th>
				<th> Total Equip. </th>
			</tr>
			<tfoot>
			<tr>
				<th> Equip. </th>
				<th> Qtd </th>
				<th> Valor Equip. </th>
				<th> Data de Entrada </th>
				<th> Total Equip. </th>
			</tr>
			</tfoot>
				<td><?php echo $escrever['equipamento']; ?></td>
				<td><span class="badge badge-danger"><?php echo $escrever['quantidade']; ?></span></td>
				<td>R$<?php echo $escrever['valor_custo_direto']; ?></td>
				<td><?php echo  date("d/m/Y", strtotime($escrever['data_registro']));?></td>;
				<?php $contarCustosdiretos = mysqli_query($conn, "SELECT quantidade, valor_custo_direto, (quantidade * valor_custo_direto) AS total FROM custos_diretos WHERE custo_direto_id = " . $escrever['custo_direto_id'] . " AND consultorio = '$_SESSION[usuarioNome]'");
				while($escreverTotal = mysqli_fetch_array($contarCustosdiretos)){echo '<td><span class="badge badge-danger">R$' . $escreverTotal['total'] . '</span></td>';}?>
		  </table>
		  </div>
		  </div>
          <div class="modal-footer">
            <button class="btn btn-primary" type="button" data-dismiss="modal"> Fechar </button>
          </div>
        </div>
      </div>
    </div><?php }

	//	Remover Despesas de custos_diretos
	$listarDados = mysqli_query($conn, "SELECT * FROM custos_diretos WHERE consultorio = '$_SESSION[usuarioNome]'");
	while($escrever = mysqli_fetch_array($listarDados)){
	?><!-- Infor Modal-->
    <div class="modal fade" id="removecustodireto<?php echo $escrever['custo_direto_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Detalhes de <?php echo $escrever['equipamento']; ?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"> × </span>
            </button>
          </div>
          <div class="modal-body"> Selecione "Sim" para remove a categoria ou "Não" caso tenha clicado por engano. </div>
          <div class="modal-footer">
			<button class="btn btn-secondary" type="button" data-dismiss="modal"> Não </button>
			<a class="btn btn-primary" href="custos-diretos.php?custo_direto_id=<?php echo $escrever['custo_direto_id'];?>"> Sim </a>
          </div>
        </div>
      </div>
    </div><?php }
	//	Esse Código irá excluir os Dados Eescolhidos pelo Administrador				
	$custo_direto_id = FILTER_INPUT(INPUT_GET, 'custo_direto_id', FILTER_SANITIZE_NUMBER_INT);
	if(!empty($custo_direto_id)){
		$removerDados = mysqli_query($conn, "DELETE FROM custos_diretos WHERE custo_direto_id = '$custo_direto_id'");
		echo "<script> alert('Informações removidas com Sucesso.'); window.location='custos-diretos.php'</script>";
	}

	include('rodape.php'); ?>
  </body>
</html>