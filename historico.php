<?php include ('menuconsultorio.php'); ?>

		<!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i> Filtro de Pesquisa - Histórico de Clientes </div>
            <div class="card-body">
              <div class="table-responsive">
			  <form action="" method="POST" name="form_busca" title="Buscar">
			  <select name="busca" class="form-control" autofocus="autofocus" onchange="this.form.submit()">
				<label for="busca" id="busca"> Selecione o Nome </label>
				<option value="busca"> Selecione o Nome </option>
				<?php
					$listarDados = mysqli_query($conn, "SELECT nome FROM status WHERE consultorio = '$_SESSION[usuarioNome]'");
					while($escrever = mysqli_fetch_array($listarDados)){
					echo '<option value="' . $escrever['nome'] . '"> ' . $escrever['nome'] . ' </option>';}
				?>
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
					$sql = mysqli_query($conn, "SELECT * FROM status WHERE nome LIKE '%$busca%' AND consultorio = '$_SESSION[usuarioNome]'");

					//	Vai contar quantas linhas a variável sql puxou.
					$quant_campos = mysqli_num_rows($sql);

				if($quant_campos == 0){
					echo '<center><strong><font color="red"> Nenhum resultado obtido! </font></strong></center>';
				}else{
					$contarDados = mysqli_query($conn, "SELECT COUNT(*) AS nome FROM status WHERE nome LIKE '%$busca%' AND consultorio = '$_SESSION[usuarioNome]'");
					$escrever = mysqli_fetch_array($contarDados);
					echo '<center><strong><font color="red"> Resultado da busca ' . $busca . '! Total de Busca: ' . $escrever['nome'] . '</font></strong></center>';?>

					<div class="resultado">
					<table class="table table-bordered" id="data_marcadaTable" width="100%" cellspacing="0">
					<tr>
					  <th> Data Marcada </th>
                      <th><font color="red"> Nome e Sobrenome </font></th>
                      <th> Forma de Pagamento </th>
                      <th> Status </th>
                      <th> Entrada </th>
					  <th> Data Entrada </th>
                      <th> Entrada no Cartão </th>
					</tr>
                  <tfoot>
                    <tr>
				 	  <th> Data Marcada </th>
                      <th><font color="red"> Nome e Sobrenome </font></th>
                      <th> Forma de Pagamento </th>
                      <th> Status </th>
                      <th> Entrada </th>
					  <th> Data Entrada </th>
                      <th> Entrada no Cartão </th>
                    </tr>
                  </tfoot>
				<?php //	A função mysql_fetch_array retorna todos os valores puxados da sql no banco.
				while($linha = mysqli_fetch_array($sql)){
					//	Confere se o id já está no array/pesquisa, para não repeti a pesquisa no resultado.
					$data_marcada = $linha['data_marcada'];
					$nome = $linha['nome'];
					$pagamento = $linha['pagamento'];
					$entrada = $linha['entrada'];
					$status = $linha['status'];
					$data_entrada = $linha['data_entrada'];
					$status_id = $linha['status_id'];

				//	Se retorna verdade ele mostra, caso contrário não mostra.
				if(!array_search($status_id, $id_mostrado)){
				//	Exibe o resultado.?>
				<tbody>
                    <tr>
					  <td><?php echo date("d/m/Y", strtotime($data_marcada)); ?></td>
                      <td><?php echo $nome; ?></td>
                      <td><?php echo $pagamento; ?></td>
					  <?php if($status == "Presente"){ ?>
					  <td><font color="green"><?php echo  $status; ?></font></td><?php }else{ ?><td><font color="red"><?php echo $status;?></font></td><?php } ?>
                      <td><?php echo $entrada; ?></td>
					  <td><?php echo  $data_entrada; ?></td>
					  <?php if($pagamento == 'Dinheiro' || $pagamento == 'Nullo' || $entrada == 'S'){ ?>
					  <td><form action="Atualizarcartao.php?status_id=<?php echo $status_id; ?>" method="POST"><input type="hidden" name="status_id" value="<?php echo $status_id; ?>"><input type="hidden" name="entrada" value="S">
					  <button class="btn btn-primary" type="submit" title="Entrada já Confirmada" disabled><svg width="20" height="20" viewBox="0 0 16 16" fill="currentColor">
					  <path fill-rule="evenodd" d="M2.854 7.146a.5.5 0 0 0-.708 0l-2 2a.5.5 0 1 0 .708.708L2.5 8.207l1.646 1.647a.5.5 0 0 0 .708-.708l-2-2zm13-1a.5.5 0 0 0-.708 0L13.5 7.793l-1.646-1.647a.5.5 0 0 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0 0-.708z"/>
					  <path fill-rule="evenodd" d="M8 3a4.995 4.995 0 0 0-4.192 2.273.5.5 0 0 1-.837-.546A6 6 0 0 1 14 8a.5.5 0 0 1-1.001 0 5 5 0 0 0-5-5zM2.5 7.5A.5.5 0 0 1 3 8a5 5 0 0 0 9.192 2.727.5.5 0 1 1 .837.546A6 6 0 0 1 2 8a.5.5 0 0 1 .501-.5z"/>
					  </svg> Atualizar </button></form></td></tr></tbody>
					  <?php }else{ ?>
					  <td><form action="Atualizarcartao.php?status_id=<?php echo $status_id; ?>" method="POST"><input type="hidden" name="status_id" value="<?php echo $status_id; ?>"><input type="hidden" name="entrada" value="S">
					  <button class="btn btn-primary" type="submit" title="Entrada não Confirmada"><svg width="20" height="20" viewBox="0 0 16 16" fill="currentColor">
					  <path fill-rule="evenodd" d="M2.854 7.146a.5.5 0 0 0-.708 0l-2 2a.5.5 0 1 0 .708.708L2.5 8.207l1.646 1.647a.5.5 0 0 0 .708-.708l-2-2zm13-1a.5.5 0 0 0-.708 0L13.5 7.793l-1.646-1.647a.5.5 0 0 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0 0-.708z"/>
					  <path fill-rule="evenodd" d="M8 3a4.995 4.995 0 0 0-4.192 2.273.5.5 0 0 1-.837-.546A6 6 0 0 1 14 8a.5.5 0 0 1-1.001 0 5 5 0 0 0-5-5zM2.5 7.5A.5.5 0 0 1 3 8a5 5 0 0 0 9.192 2.727.5.5 0 1 1 .837.546A6 6 0 0 1 2 8a.5.5 0 0 1 .501-.5z"/>
					  </svg> Atualizar </button></form></td></tr></tbody>

				<?php } // Fim do While que lista a tabela de clientes.
				array_push($id_mostrado, $status_id);
				}}}//else
				}echo'</table></div><br />';
				//for
				}//else campos vazio
				}//if botao pressionado
				?>
                <table class="table table-bordered" id="data_marcadaTable" width="100%" cellspacing="0">
                    <tr>
					  <th> Data Marcada </th>
                      <th> Nome e Sobrenome </th>
                      <th> Forma de Pagamento </th>
					  <th> Status </th>
					  <th> Entrada </th>
					  <th> Data Entrada </th>
                      <th> Entrada no Cartão </th>
                    </tr>
                  <tfoot>
                    <tr>
				 	  <th> Data Marcada </th>
                      <th> Nome e Sobrenome </th>
                      <th> Forma de Pagamento </th>
					  <th> Status </th>
					  <th> Entrada </th>
					  <th> Data Entrada </th>
                      <th> Entrada no Cartão </th>
                    </tr>
                  </tfoot>
                  <?php
				  $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
				   $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
				   //	SETAR A QUANTIDADE PAGINAS DE ITENS POR PAGINA
				   $qnt_result_pg = 3;
				  //	CALCULAR O INICIO VISUALIZAÇÃO
				  $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;
				  $listarDados = mysqli_query($conn, "SELECT * FROM status WHERE consultorio = '$_SESSION[usuarioNome]' LIMIT $inicio, $qnt_result_pg");
				  while($escrever = mysqli_fetch_array($listarDados)){?>
				  <tbody>
                    <tr>
					  <td><?php echo date("d/m/Y", strtotime($escrever['data_marcada'])); ?></td>
                      <td><?php echo $escrever['nome']; ?></td>
                      <td><?php echo $escrever['pagamento']; ?></td>
					  <?php if($escrever['status'] == "Presente"){ ?><td><font color="green"><?php echo $escrever['status']; ?></font></td><?php }else{ ?><td><font color="red"><?php echo $escrever['status']; ?></font></td><?php } ?>
                      <td><?php echo $escrever['entrada']; ?></td>
					  <td><?php echo $escrever['data_entrada']; ?></td>
					  <?php if($escrever['pagamento'] == 'Dinheiro' || $escrever['pagamento'] == 'Nullo' || $escrever['entrada'] == 'S'){ ?>
					  <td><form action="Atualizarcartao.php?status_id=<?php echo $escrever['status_id']; ?>" method="POST"><input type="hidden" name="status_id" value="<?php echo $escrever['status_id']; ?>"><input type="hidden" name="entrada" value="S">
					  <button class="btn btn-primary" type="submit" title="Entrada já Confirmada" disabled><svg width="20" height="20" viewBox="0 0 16 16" fill="currentColor">
					  <path fill-rule="evenodd" d="M2.854 7.146a.5.5 0 0 0-.708 0l-2 2a.5.5 0 1 0 .708.708L2.5 8.207l1.646 1.647a.5.5 0 0 0 .708-.708l-2-2zm13-1a.5.5 0 0 0-.708 0L13.5 7.793l-1.646-1.647a.5.5 0 0 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0 0-.708z"/>
					  <path fill-rule="evenodd" d="M8 3a4.995 4.995 0 0 0-4.192 2.273.5.5 0 0 1-.837-.546A6 6 0 0 1 14 8a.5.5 0 0 1-1.001 0 5 5 0 0 0-5-5zM2.5 7.5A.5.5 0 0 1 3 8a5 5 0 0 0 9.192 2.727.5.5 0 1 1 .837.546A6 6 0 0 1 2 8a.5.5 0 0 1 .501-.5z"/>
					  </svg> Atualizar </button></form></td></tr></tbody>
					  <?php }else{ ?>
					  <td><form action="Atualizarcartao.php?status_id=<?php echo $escrever['status_id']; ?>" method="POST"><input type="hidden" name="status_id" value="<?php echo $escrever['status_id']; ?>"><input type="hidden" name="entrada" value="S">
					  <button class="btn btn-primary" type="submit" title="Entrada não Confirmada"><svg width="20" height="20" viewBox="0 0 16 16" fill="currentColor">
					  <path fill-rule="evenodd" d="M2.854 7.146a.5.5 0 0 0-.708 0l-2 2a.5.5 0 1 0 .708.708L2.5 8.207l1.646 1.647a.5.5 0 0 0 .708-.708l-2-2zm13-1a.5.5 0 0 0-.708 0L13.5 7.793l-1.646-1.647a.5.5 0 0 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0 0-.708z"/>
					  <path fill-rule="evenodd" d="M8 3a4.995 4.995 0 0 0-4.192 2.273.5.5 0 0 1-.837-.546A6 6 0 0 1 14 8a.5.5 0 0 1-1.001 0 5 5 0 0 0-5-5zM2.5 7.5A.5.5 0 0 1 3 8a5 5 0 0 0 9.192 2.727.5.5 0 1 1 .837.546A6 6 0 0 1 2 8a.5.5 0 0 1 .501-.5z"/>
					  </svg> Atualizar </button></form></td></tr></tbody>

				 <?php
				 } // Fim do else para habilitar/desabilitar botão.
				 } // Fim do While que lista a tabela de clientes.
				 //	PAGINAÇÃO - SOMAR A QUANTIDADE DE PATOLOGIAS
				 $result_pg = "SELECT COUNT(status_id) AS num_result FROM status WHERE consultorio = '$_SESSION[usuarioNome]'";
				 $resultado_pg = mysqli_query($conn, $result_pg);
				 $row_pg = mysqli_fetch_assoc($resultado_pg);
				 //	echo $row_pg['num_result'];
				 //	QUANTIDADE DE PAGINA
				 $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
				 //	LIMITAR OS LINKS ANTES E DEPOIS
				 $max_links = 100;
				 echo "<center><a href='historico.php?pagina=1'>Primeira&nbsp;</a>";

				for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
					if($pag_ant >= 1){
						echo "<a href='historico.php?pagina=$pag_ant'>$pag_ant</a>";
					}
				}
					echo "&nbsp;$pagina&nbsp;";
  
				for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
					if($pag_dep <= $quantidade_pg){
						echo "<a href='historico.php?pagina=$pag_dep'>$pag_dep</a>";
					}
				}
					echo "<a href='historico.php?pagina=$quantidade_pg'>&nbsp;Última</a></center>";?>
                </table>
              </div>
            </div>
          </div>
        </div>
        <?php include('rodape.php'); ?>
  </body>
</html>
