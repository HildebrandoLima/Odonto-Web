<?php include('menufinanceiro.php'); ?>

		<!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i> Controle Financeiro - Analisar Custos </div>
            <div class="card-body">
                <div class="container">
				<div class="row">
				<!-- Formulário da Esquerda: Registro Indireto de custos_fixoss -->
				<div class="col-sm">
				 <!-- <div class="card card-register mx-auto mt-5"> -->
					<div class="card-header"> Custos Fixos/Cosultório </div>
					<div class="card-body">
						<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"></table>
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<tr>
						  <th> Qtd Cadastrado </th>
						  <th> Valor Total dos Custos Fixos </th>
						  <th> Ver Mais </th>
						</tr>
					  <tfoot>
						<tr>
						  <th> Qtd Cadastrado </th>
						  <th> Valor Total dos Custos Fixos </th>
						  <th> Ver Mais </th>
						</tr>
					  </tfoot>
					  <tbody>
						<tr>
						  <td><?php	//	Contar quantidade de custos fixos do consultório  referente ao usuário cadastrado
						  $contarCustosfixos = mysqli_query($conn, "SELECT COUNT(*) AS custo_fixo_id FROM custos_fixos WHERE consultorio = '$_SESSION[usuarioNome]'");
						  while($escrever = mysqli_fetch_array($contarCustosfixos)){ ?>
						  <span class="badge badge-danger"><?php echo $escrever['custo_fixo_id']; ?></span><?php } ?></td>
						  <td><?php	//	Somar quantidade de custos fixoss do consultório referente ao usuário cadastrado
						  $totalCustosfixos = mysqli_query($conn, "SELECT SUM(valor_custo_fixo) AS totalcustosfixos FROM custos_fixos WHERE consultorio = '$_SESSION[usuarioNome]'");
						  while($escrever = mysqli_fetch_array($totalCustosfixos)){ ?>
						  <span class="badge badge-danger">R$ <?php echo $escrever['totalcustosfixos']; ?></span><?php } ?></td>
						  <td><a href="custos-fixos.php"><svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-eye" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
						  <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
						  </svg></a></td>
						</tr>
					  </tbody>
					</table>
					</div>
					</div>
				 <!-- </div> -->
				  </div>
				  <!-- Formulário da Direita: Registro Direto de custos_diretoss -->
				  <div class="col-sm">
				 <!-- <div class="card card-register mx-auto mt-5"> -->
					<div class="card-header"> Custos Diretos de Equipamentos </div>
					<div class="card-body">
						<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<tr>
						  <th> Qtd Cadastrado </th>
						  <th> Valor Total de Custos Direitos </th>
						  <th> Ver Mais </th>
						</tr>
					  <tfoot>
						<tr>
						  <th> Qtd Cadastrado </th>
						  <th> Valor Total de Custos Direitos </th>
						  <th> Ver Mais </th>
						</tr>
					  </tfoot>
					  <tbody>
						<tr>
						  <td><?php	//	Contar quantidade de custos diretos dos equipamentos referente ao usuário cadastrado
						  $contarCustosdireto = mysqli_query($conn, "SELECT COUNT(*) AS custo_direto_id FROM custos_diretos WHERE consultorio = '$_SESSION[usuarioNome]'");
					      while($escrever = mysqli_fetch_array($contarCustosdireto)){ ?>
						  <span class="badge badge-danger"><?php echo $escrever['custo_direto_id']; ?></span><?php } ?></td>
						  <td><?php	//	Somar quantidade de custos diretos dos equipamentos referente ao usuário cadastrado
						  $totalCustosdiretos = mysqli_query($conn, "SELECT SUM((quantidade * valor_custo_direto)) AS totalcustosdiretos FROM custos_diretos WHERE consultorio = '$_SESSION[usuarioNome]'");
						  while($escrever = mysqli_fetch_array($totalCustosdiretos)){ ?>
						  <span class="badge badge-danger">R$ <?php echo $escrever['totalcustosdiretos']; ?></span><?php } ?></td>
						  <td><a href="custos-diretos.php"><svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-eye" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
						  <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
						  </svg></a></td>
						</tr>
					  </tbody>
					</table>
					</div>
					</div>
				 <!-- </div> -->
			  </div>
			 </div>
			<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<tr>
					<th> Valor Total de Apurados do Cosultório </th>
					<th> Valor Total dos Custos Fixos </th>
					<th> Valor Total de Custos Direitos </th>
					<th> Demonstração de Lucro </th>
					<th> Atualizar Valores </th>
					</tr>
				<tfoot>
				<tr>
					<th> Valor Total de Apurados do Cosultório </th>
					<th> Valor Total dos Custos Fixos </th>
					<th> Valor Total de Custos Direitos </th>
					<th> Demonstração de Lucro </th>
					<th> Atualizar Valores </th>
				</tr>
				</tfoot>
				<tbody>
				<tr>
					<td><?php	//	Calcular quantidade de apurados do consultório referente ao usuário cadastrado
					$totalApuradoconsultorio = mysqli_query($conn, "SELECT SUM(valor) AS total_valor_consultas FROM status WHERE consultorio = '$_SESSION[usuarioNome]'");
					while($escrever1 = mysqli_fetch_array($totalApuradoconsultorio)){ ?>
					<span class="badge badge-danger">R$ <?php echo $escrever1['total_valor_consultas']; ?></span></td>
					<td><?php	//	Calcular quantidade de custos fixos do consultório referente ao usuário cadastrado
					$totalCustosfixos = mysqli_query($conn, "SELECT SUM(valor_custo_fixo) AS total_custos_fixos FROM custos_fixos WHERE consultorio = '$_SESSION[usuarioNome]'");
					while($escrever2 = mysqli_fetch_array($totalCustosfixos)){ ?>
					<span class="badge badge-danger">R$ <?php echo $escrever2['total_custos_fixos']; ?></span></td>
					<td><?php	//	Calcular quantidade de custos diretos dos equipamentos referente ao usuário cadastrado
					$totalCustosdiretos = mysqli_query($conn, "SELECT SUM((quantidade * valor_custo_direto)) AS total_custos_diretos FROM custos_diretos WHERE consultorio = '$_SESSION[usuarioNome]'");
					while($escrever3 = mysqli_fetch_array($totalCustosdiretos)){ ?>
					<span class="badge badge-danger">R$ <?php echo $escrever3['total_custos_diretos']; ?></span></td>
					<td><?php	//	Calcular a demonstracao de lucro do consultório referente ao usuário cadastrado
					$demonstracao_lucro = (($escrever2['total_custos_fixos'] + $escrever3['total_custos_diretos']) - $escrever1['total_valor_consultas']); ?>
					<span class="badge badge-danger">R$ <?php echo $demonstracao_lucro; ?></span></td>
					<td><form action="Enviarcustosdb.php" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="consultorio" value="<?php echo $_SESSION['usuarioNome']; ?>">
					<input type="hidden" name="total_valor_consultas" value="<?php echo $escrever1['total_valor_consultas']; ?>">
					<input type="hidden" name="total_custos_fixos" value="<?php echo $escrever2['total_custos_fixos']; ?>">
					<input type="hidden" name="total_custos_diretos" value="<?php echo $escrever3['total_custos_diretos']; ?>">
					<input type="hidden" name="demonstracao_lucro" value="<?php echo $demonstracao_lucro; ?>">
					<button class="btn btn-primary" type="submit" title="Atualizar Valores"><svg width="20" height="20" viewBox="0 0 16 16" fill="currentColor">
					<path fill-rule="evenodd" d="M2.854 7.146a.5.5 0 0 0-.708 0l-2 2a.5.5 0 1 0 .708.708L2.5 8.207l1.646 1.647a.5.5 0 0 0 .708-.708l-2-2zm13-1a.5.5 0 0 0-.708 0L13.5 7.793l-1.646-1.647a.5.5 0 0 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0 0-.708z"/>
					<path fill-rule="evenodd" d="M8 3a4.995 4.995 0 0 0-4.192 2.273.5.5 0 0 1-.837-.546A6 6 0 0 1 14 8a.5.5 0 0 1-1.001 0 5 5 0 0 0-5-5zM2.5 7.5A.5.5 0 0 1 3 8a5 5 0 0 0 9.192 2.727.5.5 0 1 1 .837.546A6 6 0 0 1 2 8a.5.5 0 0 1 .501-.5z"/>
					</svg> Atualizar </button></form><?php }}} ?></td>
				</tr>
			</tbody>
			</table>
		 </div>
		</div>
       </div>
      </div>
     </div>
<?php include('rodape.php'); ?>
  </body>
</html>