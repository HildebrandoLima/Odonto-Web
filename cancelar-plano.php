<?php include ('menuconsultorio.php'); ?>

		<!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i> Filtro de Pesquisa - Cancelar Plano </div>
            <div class="card-body">
              <div class="table-responsive">
			  <form action="" method="POST" name="form_busca" title="Buscar">
			  <select name="busca" class="form-control" autofocus="autofocus" onchange="this.form.submit()">
				<label for="busca" id="busca"> Selecione o Nome </label>
				<option value="busca"> Selecione o Nome </option>
				<?php
					$listarDados = mysqli_query($conn, "SELECT DISTINCT nome FROM usuarios WHERE consultorio = '$_SESSION[usuarioNome]'");
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
					$sql = mysqli_query($conn, "SELECT * FROM usuarios WHERE nome LIKE '%$busca%' AND consultorio = '$_SESSION[usuarioNome]'");

					//	Vai contar quantas linhas a variável sql puxou.
					$quant_campos = mysqli_num_rows($sql);

				if($quant_campos == 0){
					echo '<center><strong><font color="red"> Nenhum resultado obtido! </font></strong></center>';
				}else{
					$contarDados = mysqli_query($conn, "SELECT COUNT(*) AS nome FROM usuarios WHERE nome LIKE '%$busca%' AND consultorio = '$_SESSION[usuarioNome]'");
					$escrever = mysqli_fetch_array($contarDados);
					echo '<center><strong><font color="red"> Resultado da busca ' . $busca . '! Total da Busca: ' . $escrever['nome'] . '</font></strong></center>'; ?>

					<div class="resultado">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<tr>
							<th> Cancelar </th>
							<th><font color="red"> Nome e Sobrenome </font></th>
							<th> Perfil de Acesso <a href="#" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#inforModal">?</a></th>
						</tr>
					  <tfoot>
						<tr>
						  <th> Cancelar </th>
						  <th><font color="red"> Nome e Sobrenome </font></th>
						  <th> Perfil de Acesso <a href="#" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#inforModal">?</a></th>
						</tr>
					  </tfoot>
				<?php //	A função mysql_fetch_array retorna todos os valores puxados da sql no banco.
				while($linha = mysqli_fetch_array($sql)){
					//	Confere se o id já está no array/pesquisa, para não repeti a pesquisa no resultado.
					$nome = $linha['nome'];
					$niveis_acesso_id = $linha['niveis_acesso_id'];
					$usuario_id = $linha['usuario_id'];

				//	Se retorna verdade ele mostra, caso contrário não mostra.
				if(!array_search($usuario_id, $id_mostrado)){
				//	Exibe o resultado. ?>
				<tbody>
				<tr>
				<td><a href="#" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#cancelaModal<?php echo $usuario_id; ?>"><svg width="30" height="30" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
				</svg></a></td>
				<td><font color="red"><?php echo $nome; ?></font></td>
				<td><?php echo $niveis_acesso_id; ?></td>
				</tr></tbody>

				<!-- Modal de Cancelamento de Plano -->
				<div class="modal fade" id="cancelaModal<?php echo $usuario_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				 <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"> Tem certeza que você deseja Cancelar Plano de <?php echo $nome; ?>? </h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true"> × </span>
						</button>
					  </div>
					  <div class="modal-body"> Selecione "Sim" para cancelar plano ou "Não" caso tenha clicado por engano. </div>
					  <div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal"> Não </button>
						<a class="btn btn-primary" href="cancelar-plano.php?usuario_id=<?php echo $usuario_id; ?>"> Sim </a>
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
					  <th> Cancelar </th>
                      <th> Nome e Sobrenome </th>
                      <th> Perfil de Acesso <a href="#" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#inforModal">?</a></th>
                    </tr>
                  <tfoot>
                    <tr>
					  <th> Cancelar </th>
                      <th> Nome e Sobrenome </th>
					  <th> Perfil de Acesso <a href="#" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#inforModal">?</a></th>
                    </tr>
                  </tfoot>
                  <?php
				  $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
				  $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
				  //	SETAR A QUANTIDADE PAGINAS DE ITENS POR PAGINA
				  $qnt_result_pg = 3;
				  //	CALCULAR O INICIO VISUALIZAÇÃO
				  $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;
				  $listarDados = mysqli_query($conn, "SELECT * FROM usuarios WHERE consultorio = '$_SESSION[usuarioNome]' LIMIT $inicio, $qnt_result_pg");
				  while($escrever = mysqli_fetch_array($listarDados)){ ?>
				  <tbody>	
                    <tr>
					  <td><a href="#" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#cancelaModal<?php echo $escrever['usuario_id']; ?>">
					  <svg width="30" height="30" viewBox="0 0 16 16" fill="currentColor">
					  <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
					  </svg></a></td>
                      <td><?php echo $escrever['nome']; ?></td>
					  <td><?php echo $escrever['niveis_acesso_id']; ?></td>
                    </tr>
                  </tbody>

					<!-- Modal de Cancelamento de Plano -->
					<div class="modal fade" id="cancelaModal<?php echo $escrever['usuario_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
							<a class="btn btn-primary" href="cancelar-plano.php?usuario_id=<?php echo $escrever['usuario_id']; ?>"> Sim </a>
						  </div>
						</div>
					  </div>
					</div>

				  <?php }
				  //	PAGINAÇÃO - SOMAR A QUANTIDADE DE PATOLOGIAS
				  $result_pg = "SELECT COUNT(usuario_id) AS num_result FROM usuarios WHERE consultorio = '$_SESSION[usuarioNome]'";
				  $resultado_pg = mysqli_query($conn, $result_pg);
				  $row_pg = mysqli_fetch_assoc($resultado_pg);
				  //	echo $row_pg['num_result'];
				  //	QUANTIDADE DE PAGINA
				  $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
				  //	LIMITAR OS LINKS ANTES E DEPOIS
				  $max_links = 100;
					echo "<center><a href='cancelar-plano.php?pagina=1'>Primeira&nbsp;</a>";

				  for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
					if($pag_ant >= 1){
						echo "<a href='cancelar-plano.php?pagina=$pag_ant'>$pag_ant</a>";
					}
				  }
						echo "&nbsp;$pagina&nbsp;";
  
				  for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
					if($pag_dep <= $quantidade_pg){
						echo "<a href='cancelar-plano.php?pagina=$pag_dep'>$pag_dep</a>";
					}
				  }
						echo "<a href='cancelar-plano.php?pagina=$quantidade_pg'>&nbsp;Última</a></center>";

				//	Esse Código irá excluir os Dados Eescolhidos pelo Administrador				
				$usuario_id = FILTER_INPUT(INPUT_GET, 'usuario_id', FILTER_SANITIZE_NUMBER_INT);
				if(!empty($usuario_id)){
					$removerDados = mysqli_query($conn, "DELETE FROM usuarios WHERE usuario_id = '$usuario_id'");
					echo "<script> alert('Informações removidas com Sucesso.'); window.location='cancelar-plano.php'</script>";
				}?>
                </table>
              </div>
            </div>
          </div>
        </div>
        <?php include('rodape.php'); ?>
  </body>
</html>
