<?php include('menufinanceiro.php'); ?>

		<!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i> Controle Financeiro - Registrar </div>
            <div class="card-body">
                <div class="container">
				<div class="row">
				<!-- Formulário da Esquerda: Registro Indireto de Despesas -->
				<div class="col-sm">
				 <!-- <div class="card card-register mx-auto mt-5"> -->
					<div class="card-header"> Custos Fixos/Cosultório </div>
					<div class="card-body">
					  <form action="Enviarcustosfixosdb.php" method="POST" enctype="multipart/form-data">
						<div class="form-group">
						<div class="form-group">
						  <div class="form-label-group">
							<input type="hidden" id="Consultorio" name="consultorio" class="form-control" value="<?php echo $_SESSION['usuarioNome']; ?>" placeholder="Nome do Consultório" required="required">
							<label for="Consultorio"> Nome do Consultório </label>
						  </div>
						  </div>
						  <div class="form-row">
							<div class="col-md-6">
							  <div class="form-label-group">
							  <input type="text" id="Categoria" name="categoria" class="form-control" placeholder="Nome da Categoria" required="required">
								<label for="Categoria"> Nome da Categoria </label>
							  </div>
							</div>
							<div class="col-md-6">
							  <div class="form-label-group">
								<input type="text" id="Valorcustofixo" name="valor_custo_fixo" class="form-control" onKeyPress="return(MascaraMoeda(this,'.',',',event))" placeholder="R$ Valor Custo Fixo" required="required">
								<label for="Valorcustofixo"> R$ Valor Custo Fixo </label>
							  </div>
							</div>
						  </div>
						</div>
						<input type="submit" class="btn btn-primary btn-block" value="Enviar" />
					  </form>
					</div>
				 <!-- </div> -->
				  </div>
				  <!-- Formulário da Direita: Registro Direto de Equipamentos -->
				  <div class="col-sm">
				 <!-- <div class="card card-register mx-auto mt-5"> -->
					<div class="card-header"> Custos Diretos/Equipamentos </div>
					<div class="card-body">
					  <form action="Enviarcustosdiretosdb.php" method="POST" enctype="multipart/form-data">
						<div class="form-group">
						<div class="form-group">
						  <div class="form-label-group">
							<input type="hidden" id="consultorio" name="consultorio" class="form-control" value="<?php echo $_SESSION['usuarioNome']; ?>" placeholder="Nome do Consultório" required="required">
							<label for="consultorio"> Nome do Consultório </label>
						  </div>
						  </div>
						<div class="form-group">
						  <div class="form-label-group">
							<input type="text" id="Equipamento" name="equipamento" class="form-control" placeholder="Nome do Equipamento" required="required">
							<label for="Equipamento"> Nome do Equipamento </label>
						  </div>
						  </div>
						  <div class="form-row">
							<div class="col-md-6">
							  <div class="form-label-group">
								<input type="number" id="Quantidade" name="quantidade" class="form-control" placeholder="Quantidade" required="required">
								<label for="Quantidade"> Quantidade </label>
							  </div>
							</div>
							<div class="col-md-6">
							  <div class="form-label-group">
								<input type="text" id="Valorcustodireto" name="valor_custo_direto" class="form-control" onKeyPress="return(MascaraMoeda(this,'.',',',event))" placeholder="R$ Valor Custo Direto" required="required">
								<label for="Valorcustodireto"> R$ Valor Dusto Direto </label>
							  </div>
							</div>
						  </div>
						</div>
						<input type="submit" class="btn btn-primary btn-block" value="Enviar" />
					  </form>
					</div>
				 <!-- </div> -->
			  </div>
			 </div>
			</div>
           </div>
          </div>
        </div>
        <?php include('rodape.php'); ?>
  </body>
</html>