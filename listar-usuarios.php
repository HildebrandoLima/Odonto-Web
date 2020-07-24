<?php include ('menuconsultorio.php'); ?>

		<!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i> Filtro de Pesquisa - Lista de Clientes </div>
            <div class="card-body">
              <div class="table-responsive">
			  <form action="" method="POST" name="form_busca" title="Buscar">
			  <select name="busca" class="form-control" autofocus="autofocus" onchange="this.form.submit()">
				<label for="busca" id="busca"> Selecione o Nome </label>
				<option value="busca"> Selecione o Nome </option>
				<?php
					$listarDados = mysqli_query($conn, "SELECT DISTINCT nome FROM usuarios WHERE niveis_acesso_id = '5' AND consultorio = '$_SESSION[usuarioNome]'");
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
					$telefone = $linha['telefone'];
					$inicio_plano = $linha['inicio_plano'];
					$data_nascimento = $linha['data_nascimento'];
					$endereco = $linha['endereco'];
					$num = $linha['num'];
					$bairro = $linha['bairro'];
					$usuario_id = $linha['usuario_id'];

				//	Se retorna verdade ele mostra, caso contrário não mostra.
				if(!array_search($usuario_id, $id_mostrado)){
				//	Exibe o resultado. ?>
				<tbody>
						<tr><td><font color="red"><?php echo $nome; ?></font></td>
						<td><?php echo $telefone; ?></td>
						<td><?php echo date("d/m/Y", strtotime($inicio_plano)); ?></td>
						<td><?php echo date("d/m/Y", strtotime($data_nascimento)); ?></td>
						<td><?php echo $endereco; ?></td>
						<td><?php echo $num; ?>'</td>
						<td><?php echo $bairro; ?></td>
						<td><?php echo $usuario_id; ?></td>
						</tr></tbody>

			<?php array_push($id_mostrado, $usuario_id);
			}}}echo '</table></div><br />';
			//	else
			}//	for
			}//	else campos vazio
			}//if botao pressionado
			?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                      <th> Nome e Sobrenome </th>
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
                      <th> Nome e Sobrenome </th>
                      <th> Telefone </th>
                      <th> Início do Plano </th>
					  <th> Data de Nascimento </th>
                      <th> Endereço </th>
                      <th> N° </th>
                      <th> Bairro </th>
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
				  $listarDados = mysqli_query($conn, "SELECT * FROM usuarios WHERE niveis_acesso_id = '5' AND consultorio = '$_SESSION[usuarioNome]' LIMIT $inicio, $qnt_result_pg");
				  while($escrever = mysqli_fetch_array($listarDados)){ ?>
				  <tbody>
                    <tr>
                      <td><?php echo $escrever['nome']; ?> </td>
                      <td><?php echo $escrever['telefone']; ?></td>
                      <td><?php echo date("d/m/Y", strtotime($escrever['inicio_plano'])); ?></td>
					  <td><?php echo date("d/m/Y", strtotime($escrever['data_nascimento'])); ?></td>
                      <td><?php echo $escrever['endereco']; ?></td>
                      <td><?php echo $escrever['num']; ?></td>
					  <td><?php echo $escrever['bairro']; ?></td>
					  <td><?php echo $escrever['usuario_id']; ?></td>
                    </tr>
                  </tbody>

				  <?php }
				  //	PAGINAÇÃO - SOMAR A QUANTIDADE DE PATOLOGIAS
				  $result_pg = "SELECT COUNT(usuario_id) AS num_result FROM usuarios WHERE niveis_acesso_id = '5' AND consultorio = '$_SESSION[usuarioNome]'";
				  $resultado_pg = mysqli_query($conn, $result_pg);
				  $row_pg = mysqli_fetch_assoc($resultado_pg);
				  //	echo $row_pg['num_result'];
				  //	QUANTIDADE DE PAGINA
				  $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
				  //	LIMITAR OS LINKS ANTES E DEPOIS
				  $max_links = 100;
					echo "<center><a href='listar-usuarios.php?pagina=1'>Primeira&nbsp;</a>";

				  for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
					if($pag_ant >= 1){
						echo "<a href='listar-usuarios.php?pagina=$pag_ant'>$pag_ant</a>";
					}
				  }
						echo "&nbsp;$pagina&nbsp;";
  
				  for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
					if($pag_dep <= $quantidade_pg){
						echo "<a href='listar-usuarios.php?pagina=$pag_dep'>$pag_dep</a>";
					}
				  }
						echo "<a href='listar-usuarios.php?pagina=$quantidade_pg'>&nbsp;Última</a></center>";
				  ?>
                </table>
              </div>
            </div>
          </div>
        </div>
        <?php include('rodape.php'); ?>
  </body>
</html>
