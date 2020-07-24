<?php include('menuadmin.php'); ?>

<!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i> Consultórios Cadastrados </div>
            <div class="card-body">
              <div class="table-responsive">
			  <form action="" method="POST" name="form_busca" title="Buscar">
			  <select name="busca" class="form-control" autofocus="autofocus" onchange="this.form.submit()">
				<label for="busca" id="busca"> Selecione o Nome </label>
				<option value="busca"> Selecione o Nome </option>
				<?php
					$listarDados = mysqli_query($conn, "SELECT DISTINCT nome FROM usuarios WHERE niveis_acesso_id = '3'");
					while($escrever = mysqli_fetch_array($listarDados)){ ?>
					<option value="<?php echo $escrever['nome']; ?>"><?php echo $escrever['nome']; ?></option><?php } ?>
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
							<th><font color="red"> Nome e Sobrenome </font></th>
							<th> Telefone </th>
							<th> Início do Plano </th>
							<th> Data de Nascimento </th>
							<th> Endereço </th>
							<th> N° </th>
							<th> Bairro </th>
							<th> Código </th>
						</tr>
					  <tfoot>
						<tr>
						  <th><font color="red"> Nome e Sobrenome </font></th>
						  <th> Telefone </th>
						  <th> Início do Plano </th>
						  <th> Data de Nascimento </th>
						  <th> Endereço </th>
						  <th> N° </th>
						  <th> Bairro </th>
						  <th> Código </th>
						</tr>
					  </tfoot>
				<?php //	A função mysql_fetch_array retorna todos os valores puxados da sql no banco.
				while($linha = mysqli_fetch_array($sql)){
					//	Confere se o id já está no array/pesquisa, para não repeti a pesquisa no resultado.
					$nome = $linha['nome'];
					$consultorio = $linha['consultorio'];
					$telefone = $linha['telefone'];
					$endereco = $linha['endereco'];
					$num = $linha['num'];
					$bairro = $linha['bairro'];
					$data_registro = $linha['data_registro'];
					$usuario_id = $linha['usuario_id'];

				//	Se retorna verdade ele mostra, caso contrário não mostra.
				if(!array_search($usuario_id, $id_mostrado)){
				//	Exibe o resultado. ?>
				<tbody>
					<tr>
						<td><a href="registrar-consultorio.php"><svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"/>
						<path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"/>
						<path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						</svg></a>
						<!-- <a href="#"><svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-eye" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
						<path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
						</svg></a>
						<a href="#"><svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
						<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
						</svg></a> -->
						<a href="#" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#removeModal<?php echo $usuario_id; ?>"><svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
						<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
						</svg></a></td>
						<td><?php echo $nome; ?></td>
						<td><?php echo $consultorio; ?></td>
						<td><?php echo $telefone; ?></td>
						<td><?php echo $endereco; ?></td>
						<td><?php echo $num; ?></td>
						<td><?php echo $bairro; ?></td>
						<td><?php echo date("d/m/Y", strtotime($data_registro)); ?></td>
					</tr>
				</tbody>

			<!-- Modal para Cancelar Cadastro de Consultório -->
			<div class="modal fade" id="removeModal<?php echo $usuario_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				 <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"> Tem certeza que você deseja cancelar a conta de <?php echo $nome; ?>? </h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true"> × </span>
						</button>
					  </div>
					  <div class="modal-body"> Selecione "Sim" para cancelar plano ou "Não" caso tenha clicado por engano. </div>
					  <div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal"> Não </button>
						<a class="btn btn-primary" href="administrador.php?usuario_id=<?php echo $usuario_id; ?>"> Sim </a>
					 </div>
					</div>
				</div>
			</div>

			<?php array_push($id_mostrado, $usuario_id);
			}}}echo '</table></div><br />';
			//	else
			}//	for
			}//	else campos vazio
			}//if botao pressionado
			?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<tr>
						<th> ícones </th>
						<th> Nome </th>
						<th> Consultório </th>
						<th> Telefone </th>
						<th> Endereço </th>
						<th> N° </th>
						<th> Bairro </th>
						<th> Data de Registro </th>
					</tr>
					<tfoot>
                    <tr>
                      <th> ícones </th>
						<th> Nome </th>
						<th> Consultório </th>
						<th> Telefone </th>
						<th> Endereço </th>
						<th> N° </th>
						<th> Bairro </th>
						<th> Data de Registro </th>
                    </tr>
                  </tfoot>
                  <?php
					  $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
					  $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
					  //	SETAR A QUANTIDADE PAGINAS DE ITENS POR PAGINA
					  $qnt_result_pg = 3;
					  //	CALCULAR O INICIO VISUALIZAÇÃO
					  $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

					  $listarDados = mysqli_query($conn, "SELECT * FROM usuarios WHERE niveis_acesso_id = '3' LIMIT $inicio, $qnt_result_pg");
					  while($escrever = mysqli_fetch_array($listarDados)){ ?>
					  <tbody>
						<tr>
						  <td><a href="registrar-consultorio.php"><svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"/>
						  <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"/>
						  <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						  </svg></a>
						  <!-- <a href="#"><svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-eye" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
						  <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
						  </svg></a>
						  <a href="#"><svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
						  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
						  </svg></a> -->
						  <a href="#" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#removeModal<?php echo $escrever['usuario_id']; ?>"><svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
						  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
						  </svg></a></td>
						  <td><?php echo $escrever['nome']; ?></td>
						  <td><?php echo $escrever['consultorio']; ?></td>
						  <td><?php echo $escrever['telefone']; ?></td>
						  <td><?php echo $escrever['endereco']; ?></td>
						  <td><?php echo $escrever['num']; ?></td>
						  <td><?php echo $escrever['bairro']; ?></td>
						  <td><?php echo date("d/m/Y", strtotime($escrever['data_registro'])); ?></td>
						</tr>
					  </tbody>	  

					<!-- Modal para Cancelar Cadastro de Consultório -->
					<div class="modal fade" id="removeModal<?php echo $escrever['usuario_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						 <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"> Tem certeza que você deseja cancelar a conta de <?php echo $escrever['nome']; ?>? </h5>
								<button class="close" type="button" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true"> × </span>
								</button>
							  </div>
							  <div class="modal-body"> Selecione "Sim" para cancelar plano ou "Não" caso tenha clicado por engano. </div>
							  <div class="modal-footer">
								<button class="btn btn-secondary" type="button" data-dismiss="modal"> Não </button>
								<a class="btn btn-primary" href="administrador.php?usuario_id=<?php echo $escrever['usuario_id']; ?>"> Sim </a>
							 </div>
							</div>
						</div>
					</div>

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
					  
					//	ESSE CÓDIGO IRÁ CANCELAR/EXCLUIR OS DADOS ESCOLHIDOS PELO ADMIN, OU SEJA, A CONTA DO CONSULTÓRIO X
					$usuario_id = FILTER_INPUT(INPUT_GET, 'usuario_id', FILTER_SANITIZE_NUMBER_INT);
					if(!empty($usuario_id)){
						$removerDados = mysqli_query($conn, "DELETE FROM usuarios WHERE usuario_id = '$usuario_id'");
						echo "<script> alert('Conta Cancelada com Sucesso...'); window.location='administrador.php'</script>";
					}
					// Connection close
					mysqli_close($conn);
				?>
                </table>
              </div>
            </div>
          </div>
		  
<?php include('rodape.php'); ?>