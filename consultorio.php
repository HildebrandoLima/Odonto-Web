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
	include ('menuconsultorio.php');
?>

		<!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i> Consultas Marcadas - Página Inicial </div>
            <div class="card-body">
              <div class="table-responsive">
			  <form action="" method="POST" name="form_busca" title="Buscar">
			  <select name="busca" class="form-control" autofocus="autofocus" onchange="this.form.submit()">
				<label for="busca" id="busca"> Selecione a Data </label>
				<option value="busca"> Selecione a Data </option>
				<?php
					$listarDados = mysqli_query($conn, "SELECT DISTINCT data_marcada FROM consulta WHERE consultorio = '$_SESSION[usuarioNome]'");
					while($escrever = mysqli_fetch_array($listarDados)){
					echo '<option value="' . $escrever['data_marcada'] . '"> ' . $escrever['data_marcada'] . ' </option>';}
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
					$sql = mysqli_query($conn, "SELECT * FROM consulta WHERE data_marcada LIKE '%$busca%' AND consultorio = '$_SESSION[usuarioNome]'");

					//	Vai contar quantas linhas a variável sql puxou.
					$quant_campos = mysqli_num_rows($sql);

				if($quant_campos == 0){
					echo '<center><strong><font color="red"> Nenhum resultado obtido! </font></strong></center>';
				}else{ ?>

					<div class="resultado">
					<table class="table table-bordered" id="data_marcadaTable" width="100%" cellspacing="0">
					<tr>
					  <th> Nome </th>
                      <th><font color="red"> Data Marcada </font></th>
                      <th> Pagamento </th>
                      <th> Status </th>
                      <th> Confirmar </th>
					</tr>
                  <tfoot>
                    <tr>
					  <th> Nome </th>
                      <th><font color="red"> Data Marcada </font></th>
                      <th> Pagamento </th>
                      <th> Status </th>
                      <th> Confirmar </th>
                    </tr>
                  </tfoot>
				<?php //	A função mysql_fetch_array retorna todos os valores puxados da sql no banco.
				while($linha = mysqli_fetch_array($sql)){
					//	Confere se o id já está no array/pesquisa, para não repeti a pesquisa no resultado.
					$consultorio = $linha['consultorio'];
					$nome = $linha['nome'];
					$data_marcada = $linha['data_marcada'];
					$valor = $linha['valor'];
					$consulta_id = $linha['consulta_id'];

				//	Se retorna verdade ele mostra, caso contrário não mostra.
				if(!array_search($consulta_id, $id_mostrado)){
				//	Exibe o resultado.?>
				<tbody>
                    <tr>
                      <td><form action="consultorio.php" method="POST" enctype="multipart/form-data"><input type="hidden" name="consultorio" value="<?php echo $consultorio; ?>">
					  <input type="checkbox" name="nome" value="<?php echo $nome; ?>" checked /> <?php echo $nome;?></td>
                      <td><input type="checkbox" name="data_marcada" value="<?php echo $data_marcada; ?>" checked /> <?php echo date("d/m/Y", strtotime($data_marcada)); ?></td>
					  <td><select name="pagamento" class="form-control"><option value="Dinheiro"> Dinheiro </option><option value="Cartão"> Cartão </option><option value="Nullo"> Nullo </option></select>
					  <input type="hidden" name="valor" value="<?php echo $valor; ?>"><input type="hidden" name="entrada" value="N"></td>
					  <td><select name="status" class="form-control"><option value="Presente"> Presente </option><option value="Ausente"> Ausente </option></select></td>
                      <td><input type="hidden" name="acao" value="enviado" />
					  <!-- <input type="image" src="img/visto.jpg" width="20" height="20" value="Confirmar" title="Confirmar" class="botao"> -->
					  <button class="btn btn-primary" type="submit"><svg width="10" height="10" viewBox="0 0 16 16" fill="currentColor">
					  <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
					  </svg></button>
				      <a href="#" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#consultaModal<?php echo $consulta_id; ?>">
					  <svg width="30" height="30" viewBox="0 0 16 16" fill="currentColor">
					  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
					  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
					  </svg></a>
					 </form></td>
                    </tr>
                  </tbody>
			<?php array_push($id_mostrado, $consulta_id);
			}}
			$contarDados = mysqli_query($conn, "SELECT COUNT(*) AS data_marcada FROM consulta WHERE data_marcada LIKE '%$busca%' AND consultorio = '$_SESSION[usuarioNome]'");
			$escrever = mysqli_fetch_array($contarDados);
			echo '<center><strong><font color="red"> Resultado da busca ' . date("d/m/Y", strtotime($busca)) . '! Total de Pessoas Marcadas para esta Data: ' . $escrever['data_marcada'] . '</font></strong></center>';
			}//else
			}echo'</table></div><br />';
			//for
			}//else campos vazio
			}//if botao pressionado
			?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                      <th> Nome </th>
					  <th> Data Marcada </th>
                      <th> Pagamento </th>
					  <th> Status </th>
                      <th> Confirmar </th>
                    </tr>
                  <tfoot>
                    <tr>
                      <th> Nome </th>
                      <th> Data Marcada </th>
                      <th> Pagamento </th>
					  <th> Status </th>
                      <th> Confirmar </th>
                    </tr>
                  </tfoot>
                  <?php
				   $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
				   $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
				   //	SETAR A QUANTIDADE PAGINAS DE ITENS POR PAGINA
				   $qnt_result_pg = 3;
				  //	CALCULAR O INICIO VISUALIZAÇÃO
				  $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;
				  $listarDados = mysqli_query($conn, "SELECT * FROM consulta WHERE consultorio = '$_SESSION[usuarioNome]' LIMIT $inicio, $qnt_result_pg");
				  while($escrever = mysqli_fetch_array($listarDados)){?>
				  <tbody>
                    <tr>
                      <td><form action="consultorio.php" method="POST" enctype="multipart/form-data"><input type="hidden" name="consultorio" value="<?php echo $escrever['consultorio']; ?>">
					  <input type="checkbox" name="nome" value="<?php echo $escrever['nome']; ?>" checked /> <?php echo $escrever['nome']; ?></td>
                      <td><input type="checkbox" name="data_marcada" value="<?php echo $escrever['data_marcada']; ?>" checked /> <?php echo date("d/m/Y", strtotime($escrever['data_marcada'])); ?></td>
					  <td><select name="pagamento" class="form-control"><option value="Dinheiro"> Dinheiro </option><option value="Cartão"> Cartão </option><option value="Nullo"> Nullo </option></select>
					  <input type="hidden" name="valor" value="<?php echo $escrever['valor']; ?>"><input type="hidden" name="entrada" value="N"></td>
					  <td><select name="status" class="form-control"><option value="Presente"> Presente </option><option value="Ausente"> Ausente </option></select></td>
                      <td><input type="hidden" name="acao" value="enviado" />
					  <!-- <input type="image" src="img/visto.jpg" width="20" height="20" value="Confirmar" title="Confirmar" class="botao"> -->
					  <button class="btn btn-primary" type="submit"><svg width="10" height="10" viewBox="0 0 16 16" fill="currentColor">
					  <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
					  </svg></button>
				      <a href="#" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#consultaModal<?php echo $escrever['consulta_id']; ?>">
					  <svg width="30" height="30" viewBox="0 0 16 16" fill="currentColor">
					  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
					  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
					  </svg></a>
					 </form></td>
                    </tr>
                  </tbody>

				   <!-- MODAL PARA CONFIRMAR CONSULTA -->
					<div class="modal fade" id="consultaModal<?php echo $escrever['consulta_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"> Tem certeza que você deseja Cancelar Plano de <?php echo $escrever['nome']; ?>? </h5>
							<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true"> × </span>
							</button>
						  </div>
						  <div class="modal-body"> Selecione "Sim" para cancelar plano ou "Não" caso tenha clicado por engano. </div>
						  <div class="modal-footer">
							<button class="btn btn-secondary" type="button" data-dismiss="modal"> Não </button>
							<a class="btn btn-primary" href="consultorio.php?consulta_id=<?php echo $escrever['consulta_id']; ?>"> Sim </a>
						  </div>
						</div>
					  </div>
					</div>

					<?php } // Fim do While que lista a tabela de consultas.
					  //	PAGINAÇÃO - SOMAR A QUANTIDADE DE PATOLOGIAS
					  $result_pg = "SELECT COUNT(consulta_id) AS num_result FROM consulta WHERE consultorio = '$_SESSION[usuarioNome]'";
					  $resultado_pg = mysqli_query($conn, $result_pg);
					  $row_pg = mysqli_fetch_assoc($resultado_pg);
					  //	echo $row_pg['num_result'];
					  //	QUANTIDADE DE PAGINA
					  $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
					  //	LIMITAR OS LINKS ANTES E DEPOIS
					  $max_links = 100;
					  echo "<center><a href='consultorio.php?pagina=1'>Primeira&nbsp;</a>";

					  for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
						  if($pag_ant >= 1){
							echo "<a href='consultorio.php?pagina=$pag_ant'>$pag_ant</a>";
						  }
					  }
					  echo "&nbsp;$pagina&nbsp;";
					  
					  for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
						  if($pag_dep <= $quantidade_pg){
							echo "<a href='consultorio.php?pagina=$pag_dep'>$pag_dep</a>";
						  }
					  }
					  echo "<a href='consultorio.php?pagina=$quantidade_pg'>&nbsp;Última</a></center>";

				  //	Esse código irá inserir os dados escolhidos pelo admin
				  if(isset($_POST['consultorio'])){
					if($_POST['status'] == 'Presente'){
				  $consultorio = $_POST['consultorio'];
				  $nome = $_POST['nome'];
				  $data_marcada = $_POST['data_marcada'];
				  $pagamento = $_POST['pagamento'];
				  $valor = $_POST['valor'];
				  $entrada = $_POST['entrada'];
				  $status = $_POST['status'];

				  $tabela = "SELECT * FROM status WHERE data_marcada = '$data_marcada'";
				  $verifica = mysqli_query($conn, $tabela);

				  if($verifica){
					$busca = mysqli_num_rows($verifica);
				  if(($busca) == '0'){
					$insereDados = mysqli_query($conn, "INSERT INTO status (consultorio , nome , data_marcada , pagamento , valor , entrada , status , data_entrada) VALUES ('$consultorio' , '$nome' , '$data_marcada' , '$pagamento' , '$valor' , '$entrada' , '$status' , NOW())");  
					echo "<script> alert('Informações enviadas com sucesso.'); window.location='consultorio.php'</script>";
				  }else{
					echo "<script> alert('Dado repedito. Não é permitido fazer a mesma transferência.'); window.location='consultorio.php'</script>";				  
				  }
				  // Free result set
					mysqli_free_result($verifica);
				  }}else{
					  $consultorio = $_POST['consultorio'];
					  $nome = $_POST['nome'];
					  $data_marcada = $_POST['data_marcada'];
					  $pagamento = $_POST['pagamento'];
					  $valor = "00,00";
					  $entrada = $_POST['entrada'];
					  $status = $_POST['status'];

					  $tabela = "SELECT * FROM status WHERE data_marcada = '$data_marcada'";
					  $verifica = mysqli_query($conn, $tabela);

					  if($verifica){
						$busca = mysqli_num_rows($verifica);
					  if(($busca) == '0'){
						$insereDados = mysqli_query($conn, "INSERT INTO status (consultorio , nome , data_marcada , pagamento , valor , entrada , status , data_entrada) VALUES ('$consultorio' , '$nome' , '$data_marcada' , '$pagamento' , '$valor' , '$entrada' , '$status' , NOW())");  
						echo "<script> alert('Informações enviadas com sucesso.'); window.location='consultorio.php'</script>";
					  }else{
						echo "<script> alert('Dado repedito. Não é permitido fazer a mesma transferência.'); window.location='consultorio.php'</script>";				  
					  }
				  // Free result set
					mysqli_free_result($verifica);
				  }
				  }}else if(isset($_POST['consultorio'])){
					  echo "<script> alert('Não foi possível Confirmar os dados...'); window.location='consultorio.php'</script>";
				  }

				  //	ESSE CÓDIGO IRÁ EXCLUIR OS DADOS ESCOLHIDOS PELO ADMIN				
				  $consulta_id = FILTER_INPUT(INPUT_GET, 'consulta_id', FILTER_SANITIZE_NUMBER_INT);
					if(!empty($consulta_id)){
						$removerDados = mysqli_query($conn, "DELETE FROM consulta WHERE consulta_id = '$consulta_id'");
						echo "<script> alert('Dados Confirmados com Sucesso...'); window.location='consultorio.php'</script>";
					}
				  // Connection close
				  mysqli_close($conn);
				?>
                </table>
              </div>
            </div>
          </div>
<?php include('rodape.php'); ?>