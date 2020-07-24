<?php
	$listarDados = mysqli_query($conn, "SELECT status_vencimento FROM usuarios WHERE consultorio = '$_SESSION[usuarioNome]'");
	while($escrever = mysqli_fetch_array($listarDados)){
	if($escrever['status_vencimento'] == 'S'){ ?>
		<!-- Modal Alerta -->
		<div class="modal fade" id="alertaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> O mês entrou, atualize suas finanças! </h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true"> × </span>
				</button>
			  </div>
			  <div class="modal-body"><p style="color: #FF0000;"> Caro(a) <?php echo $_SESSION['usuarioNome']; ?>. Sua conta está próxima a data de vencimento. Você tem uma semana para atualizar seu pagamento e renovação de contrato. </p></div>
			  <div class="modal-footer">
				<button class="btn btn-primary" type="button" data-dismiss="modal"> OK </button>
			  </div>
			</div>
		  </div>
		</div>
<?php }} ?>