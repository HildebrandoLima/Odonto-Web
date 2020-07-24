<?php include('menufinanceiro.php'); ?>

	<!-- DataTables Example -->
    <div class="card mb-3">
       <div class="card-header">
		<i class="fas fa-table"></i> Controle Financeiro - Demonstração de Lucro </div>
       <div class="card-body">
		<div class="table-responsive">
		<form action="" method="POST" name="form_busca" title="Buscar">
			<select name="busca" class="form-control" autofocus="autofocus" onchange="this.form.submit()">
			<label for="busca" id="busca"> Selecione o Mês </label>
				<option value="busca"> Selecione o Mês </option>
				<option value="01"> Janeiro </option>
				<option value="02"> Feveriro </option>
				<option value="03"> Março </option>
				<option value="04"> Abril </option>
				<option value="05"> Maio </option>
				<option value="06"> Junho </option>
				<option value="07"> Julho </option>
				<option value="08"> Agosto </option>
				<option value="09"> Setembro </option>
				<option value="10"> Outubro </option>
				<option value="11"> Novembro </option>
				<option value="12"> Dezembro </option>
			</select>
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
			$sql = mysqli_query($conn, "SELECT * FROM demonstracao_lucro WHERE data_entrada LIKE '%$busca%' AND consultorio = '$_SESSION[usuarioNome]'");

			//	Vai contar quantas linhas a variável sql puxou.
			$quant_campos = mysqli_num_rows($sql);

		if($quant_campos == 0){
			echo '<center><strong><font color="red"> Nenhum resultado obtido! </font></strong></center>';
		}else{ ?>

		<div class="resultado">
		<table class="table table-bordered" id="data_marcadaTable" width="100%" cellspacing="0">
		<tr>
			<th><font color="red"> Mês </font></th>
			<th> Total Custos Fixos </th>
			<th> Total Custos Diretos </th>
			<th> Total Valor Consultas </th>
			<th> Demonstração Lucro </th>
			<th> Mais </th>
		</tr>
        <tfoot>
        <tr>
			<th><font color="red"> Mês </font></th>
			<th> Total Custos Fixos </th>
			<th> Total Custos Diretos </th>
			<th> Total Valor Consultas </th>
			<th> Demonstração Lucro </th>
			<th> Mais </th>
        </tr>
        </tfoot>
		<?php //	A função mysql_fetch_array retorna todos os valores puxados da sql no banco.
		while($linha = mysqli_fetch_array($sql)){
			//	Confere se o id já está no array/pesquisa, para não repeti a pesquisa no resultado.
			$consultorio = $linha['consultorio'];
			$total_custos_fixos = $linha['total_custos_fixos'];
			$total_custos_diretos = $linha['total_custos_diretos'];
			$total_valor_consultas = $linha['total_valor_consultas'];
			$data_entrada = $linha['data_entrada'];
			$demonstracao_lucro = $linha['demonstracao_lucro'];
			$demonstracao_lucro_id = $linha['demonstracao_lucro_id'];

		//	Se retorna verdade ele mostra, caso contrário não mostra.
		if(!array_search($demonstracao_lucro_id, $id_mostrado)){
		//	Exibe o resultado.?>
		<tbody>
		<tr>
			<td><span class="badge badge-danger"><?php echo $busca; ?></span></td>
			<td><span class="badge badge-danger">R$ <?php echo $total_custos_fixos; ?></span></td>
			<td><span class="badge badge-danger">R$ <?php echo $total_custos_diretos; ?></span></td>
			<td><span class="badge badge-danger">R$ <?php echo $total_valor_consultas; ?></span></td>
			<td><span class="badge badge-danger">R$ <?php echo $demonstracao_lucro; ?></span></td>
			<td>
			<a href="editar-lucro.php?demonstracao_lucro_id=<?php echo $demonstracao_lucro_id; ?>"><svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
			<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
			</svg></a>
			<a href="#" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#removedemonstracaolucro<?php echo $demonstracao_lucro_id; ?>"><svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
			<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
			</svg></a></td>
		</tr>
		</tbody>
		<?php array_push($id_mostrado, $demonstracao_lucro_id);
		}}
			$contarDados = mysqli_query($conn, "SELECT COUNT(*) AS data_entrada FROM demonstracao_lucro WHERE data_entrada LIKE '%$busca%' AND consultorio = '$_SESSION[usuarioNome]'");
			$escrever = mysqli_fetch_array($contarDados);
			echo '<center><strong><font color="red"> Resultado da busca para o mês ' . $busca . '! </font></strong></center>';
		}//else
		}	echo'</table></div><br />';
		//for
		}//else campos vazio
		}//if botao pressionado
		?>
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<tr>
				<th> Mês </th>
				<th> Total Custos Fixos </th>
				<th> Total Custos Diretos </th>
				<th> Total Valor Consultas </th>
				<th> Demonstração Lucro </th>
				<th> Mais </th>
			</tr>
			<tfoot>
			<tr>
				<th> Mês </th>
				<th> Total Custos Fixos </th>
				<th> Total Custos Diretos </th>
				<th> Total Valor Consultas </th>
				<th> Demonstração Lucro </th>
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
					$listarCustosdiretos = mysqli_query($conn, "SELECT * FROM demonstracao_lucro WHERE consultorio = '$_SESSION[usuarioNome]' LIMIT $inicio, $qnt_result_pg");
						while($escrever = mysqli_fetch_array($listarCustosdiretos)){ ?>
				<tbody>
					<tr>
						<td><span class="badge badge-danger"><?php echo $escrever['data_entrada']; ?></span></td>
						<td><span class="badge badge-danger">R$ <?php echo $escrever['total_custos_fixos']; ?></span></td>
						<td><span class="badge badge-danger">R$ <?php echo $escrever['total_custos_diretos']; ?></span></td>
						<td><span class="badge badge-danger">R$ <?php echo $escrever['total_valor_consultas']; ?></span></td>
						<td><span class="badge badge-danger">R$ <?php echo $escrever['demonstracao_lucro']; ?></span></td>
						<td>
						<a href="editar-lucro.php?demonstracao_lucro_id=<?php echo $escrever['demonstracao_lucro_id']; ?>"><svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
						<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
						</svg></a>
						<a href="#" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#removedemonstracaolucro<?php echo $escrever['demonstracao_lucro_id']; ?>"><svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
						<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
						</svg></a></td>
					</tr>
				</tbody>

				<?php } // // Fim do while da tabela despesas de demonstracao lucro.
					//	PAGINAÇÃO
					$result_pg = "SELECT COUNT(demonstracao_lucro_id) AS num_result FROM demonstracao_lucro WHERE consultorio = '$_SESSION[usuarioNome]'";
					$resultado_pg = mysqli_query($conn, $result_pg);
					$row_pg = mysqli_fetch_assoc($resultado_pg);
					//	echo $row_pg['num_result'];
					//	QUANTIDADE DE PAGINA
					$quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
					//	LIMITAR OS LINKS ANTES E DEPOIS
					$max_links = 100;
						echo "<center><a href='demonstracao-lucro.php?pagina=1'>Primeira&nbsp;</a>";

					for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
						if($pag_ant >= 1){
							echo "<a href='demonstracao-lucro.php?pagina=$pag_ant'>$pag_ant</a>";
						}
					}
							echo "&nbsp;$pagina&nbsp;";

					for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
						if($pag_dep <= $quantidade_pg){
							echo "<a href='demonstracao-lucro.php?pagina=$pag_dep'>$pag_dep</a>";
						}
					}
							echo "<a href='demonstracao-lucro.php?pagina=$quantidade_pg'>&nbsp;Última</a></center>";?>
				</table>
			</div>
        </div>
      </div>
    </div>
   <?php include('rodape.php'); ?>
  </body>
</html>