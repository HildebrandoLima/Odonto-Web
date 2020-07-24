<?php include('menuadmin.php'); ?>

		<!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i> Usuários com a Data Próximo de Vencer | <a href="#" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#duvidasModal"> Dúvidas? </a></div>
            <div class="card-body">
              <div class="table-responsive">
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-6">
						<form action="" method="POST" name="form_busca" title="Buscar">
						  <select name="busca" class="form-control" autofocus="autofocus" onchange="this.form.submit()">
							<label for="busca" id="busca"> Selecione o Status </label>
							<option value="busca"> Selecione o Status </option>
							<?php
								$listarDados = mysqli_query($conn, "SELECT nome, status_vencimento FROM usuarios WHERE status_vencimento='S' AND niveis_acesso_id = '3'");
								while($escrever = mysqli_fetch_array($listarDados)){ ?>
								<option value="<?php echo $escrever['nome']; ?>"><?php echo $escrever['nome']; ?></option> <?php } ?>
							</select>
						  </form>
						</div>
						<div class="col-md-6">
						<?php //	Quantidade de Usuários Cadastrados
						$contarDados = mysqli_query($conn, "SELECT COUNT(*) AS usuario_id FROM usuarios WHERE niveis_acesso_id = 3");
						while($escrever = mysqli_fetch_array($contarDados)){ ?>
						<center><strong><font color="#FF0000"> Ao todo são, <?php echo $escrever['usuario_id']; ?> Consultórios Cadastrados. </font></strong></center><?php }

						//	Quantidade de Usuários com Data Próximo de Vencer
						$contarDados = mysqli_query($conn, "SELECT COUNT(*) AS status_vencimento FROM usuarios WHERE status_vencimento = 'S' AND niveis_acesso_id = '3'");
						while($escrever = mysqli_fetch_array($contarDados)){ ?>
						<center><strong><font color="#FF0000"> Ao todo são, <?php echo $escrever['status_vencimento']; ?> Consultórios com a Data Próximo de Vencer. </font></strong></center><?php } ?>
						</div>
					</div>
				</div>
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
					$sql = mysqli_query($conn, "SELECT * FROM usuarios WHERE nome LIKE '%$busca%'");

					//	Vai contar quantas linhas a variável sql puxou.
					$quant_campos = mysqli_num_rows($sql);

				if($quant_campos == 0){
					echo '<center><strong><font color="red"> Nenhum resultado obtido! </font></strong></center>';
				}else{
					$contarDados = mysqli_query($conn, "SELECT COUNT(*) AS nome FROM usuarios WHERE nome LIKE '%$busca%'");
					$escrever = mysqli_fetch_array($contarDados);
					echo '<center><strong><font color="red"> Resultado da busca ' . $busca . '! Total da Busca: ' . $escrever['nome'] . '</font></strong></center>';?>

					<div class="resultado">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<tr>
                      <th> Consultório </th>
                      <th> Cadastrado </th>
                      <th> Data Atual </th>
                      <th> Status </th>
                      <th> Confirmar </th>
                    </tr>
                  <tfoot>
                    <tr>
                      <th> Consultório </th>
                      <th> Cadastrado </th>
                      <th> Data Atual </th>
                      <th> Status </th>
                      <th> Confirmar </th>
                    </tr>
                  </tfoot>
				<?php //	A função mysql_fetch_array retorna todos os valores puxados da sql no banco.
				while($linha = mysqli_fetch_array($sql)){
					//	Confere se o id já está no array/pesquisa, para não repeti a pesquisa no resultado.
					$consultorio = $linha['consultorio'];
					$nome = $linha['nome'];
					$status_vencimento = $linha['status_vencimento'];
					$data_registro = $linha['data_registro'];
					$usuario_id = $linha['usuario_id'];

				//	Se retorna verdade ele mostra, caso contrário não mostra.
				if(!array_search($usuario_id, $id_mostrado)){
				//	Exibe o resultado. ?>
				<tbody>
                    <tr>
                      <td><?php echo $consultorio; ?></td>
                      <td><?php echo date("d/m/Y", strtotime($data_registro)); ?></td>
					  <td><?php echo date('d/m/Y'); ?></td>
					  <td><form action="listar-vencimento.php" method="POST">
					  <input type="hidden" name="usuario_id" value="<?php echo $usuario_id; ?>">
					  <select class="form-control" name="status_vencimento"><option value="<?php echo $status_vencimento; ?>"><?php echo $status_vencimento; ?></option>
					  <option value="S"> S </option><option value="N"> N </option></select></td>
					  <td><input type="submit" value="OK" class="btn btn-primary btn-block"></form></td>
                    </tr>
                  </tbody>

			<?php array_push($id_mostrado, $usuario_id);
			}}}echo '</table></div><br />';
			//	else
			}//	for
			}//	else campos vazio
			}//if botao pressionado
			?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                      <th> Consultório </th>
                      <th> Cadastrado </th>
                      <th> Data Atual </th>
                      <th> Status </th>
                      <th> Confirmar </th>
                    </tr>
                  <tfoot>
                    <tr>
                      <th> Consultório </th>
                      <th> Cadastrado </th>
                      <th> Data Atual </th>
                      <th> Status </th>
                      <th> Confirmar </th>
                    </tr>
                  </tfoot>
                  <?php
				  /*$listarDados = mysqli_query($conn, "SELECT * FROM usuarios WHERE niveis_acesso_id = 2 ORDER BY nome");
				  while($escrever = mysqli_fetch_array($listarDados)){
				  $data_atual = date('d/m/Y');
				  echo '<tbody>
                    <tr>
                      <td> ' . $escrever['consultorio'] . ' </td>
                      <td> ' . date("d/m/Y", strtotime($escrever['data_registro'])) . ' </td>
					  <td> ' . $data_atual . ' </td>
					  ';

					  if($listarDados <= $data_atual){
					  echo '
					  <td><p style="color: #FF0000;"> Pagamento Vencido. </p></td>
                    </tr>
                  </tbody>';}else{
					 echo '
					  <td><p style="color: #FF0000;"> Pagamento Não Vencido. </p></td>
                    </tr>
                  </tbody>';
				  }}*/

				  $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
				  $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
				  //	SETAR A QUANTIDADE PAGINAS DE ITENS POR PAGINA
				  $qnt_result_pg = 3;
				  //	CALCULAR O INICIO VISUALIZAÇÃO
				  $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

				  $listarDados = mysqli_query($conn, "SELECT * FROM usuarios WHERE niveis_acesso_id = '3' ORDER BY nome  LIMIT $inicio, $qnt_result_pg");
				  while($escrever = mysqli_fetch_array($listarDados)){ ?>
				  <tbody>
                    <tr>
                      <td><?php echo $escrever['nome']; ?></td>
                      <td><?php echo date("d/m/Y", strtotime($escrever['data_registro'])); ?></td>
					  <td><?php echo date('d/m/Y'); ?></td>
					  <td><form action="listar-vencimento.php" method="POST">
					  <input type="hidden" name="usuario_id" value="<?php echo $escrever['usuario_id']; ?>">
					  <select class="form-control" name="status_vencimento"><option value="<?php echo $escrever['status_vencimento']; ?>"><?php echo $escrever['status_vencimento']; ?></option>
					  <option value="S"> S </option><option value="N"> N </option></select></td>
					  <td><input type="submit" value="OK" class="btn btn-primary btn-block"></form></td>
                    </tr>
                  </tbody>

				  <?php }
					  //	PAGINAÇÃO - SOMAR A QUANTIDADE DE PATOLOGIAS
					  $result_pg = "SELECT COUNT(usuario_id) AS num_result FROM usuarios WHERE niveis_acesso_id = '3'";
					  $resultado_pg = mysqli_query($conn, $result_pg);
					  $row_pg = mysqli_fetch_assoc($resultado_pg);
					  //	echo $row_pg['num_result'];
					  //	QUANTIDADE DE PAGINA
					  $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
					  //	LIMITAR OS LINKS ANTES E DEPOIS
					  $max_links = 100;
					  echo "<center><a href='administrador.php?pagina=1'>Primeira&nbsp;</a>";

					  for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
						  if($pag_ant >= 1){
							echo "<a href='administrador.php?pagina=$pag_ant'>$pag_ant</a>";
						  }
					  }
					  echo "&nbsp;$pagina&nbsp;";
					  
					  for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
						  if($pag_dep <= $quantidade_pg){
							echo "<a href='administrador.php?pagina=$pag_dep'>$pag_dep</a>";
						  }
					  }
					  echo "<a href='administrador.php?pagina=$quantidade_pg'>&nbsp;Última</a></center>";

					// ALTERAR STATUS DE PAGAMENTO
					$usuario_id = filter_input(INPUT_POST, 'usuario_id', FILTER_SANITIZE_NUMBER_INT);
					$status_vencimento = filter_input(INPUT_POST, 'status_vencimento', FILTER_SANITIZE_STRING);
					$result_usuario = "UPDATE usuarios SET status_vencimento = '$status_vencimento' WHERE usuario_id = '$usuario_id'";
					$resultado_usuario = mysqli_query($conn, $result_usuario);

				  	// ENCERRAR CÓDIGO E REDIRECINAR PÁGINA
					if(mysqli_affected_rows($conn)){
						echo "<script> alert('Informações Editadas Com Sucesso... '); window.location='listar-vencimento.php'</script>";
					}?>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted"><div id="data-hora"></div></div>
          </div>
        </div>
	
	<!-- Dúvidas Modal-->
    <div class="modal fade" id="duvidasModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Dúvidas? </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"> × </span>
            </button>
          </div>
          <div class="modal-body"><p><b> Busca:</b> Resultado dos clientes que estão com a data de pagamento vencida. </p><p><b> Nome:</b> Nome do cliente. </p>
		  <p><b> Cadastrado:</b> Data pelo qual o cliente se cadastrou. </p><p><b> Data Atual:</b> Data vigente. </p><p><b> Status:</b> N - não venceu / S - venceu. </p>
		  <p><b> Confirmar:</b> Fazer alteração caso a data tenha vencido. </p></div>
          <div class="modal-footer">
            <button class="btn btn-primary" type="button" data-dismiss="modal"> Fechar </button>
            <!-- <a class="btn btn-secondary" href="logout.php"> Não </a> -->
          </div>
        </div>
      </div>
    </div>

<?php include('rodape.php'); ?>