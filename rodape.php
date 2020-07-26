<?php
	// A sessão precisa ser iniciada em cada página diferente
	if (!isset($_SESSION)) session_start();
	// Verifica se não há a variável da sessão que identifica o usuário
	if (!isset($_SESSION['usuarioId'])) {
	// Destrói a sessão por segurança
	session_destroy();
	// Redireciona o visitante de volta pro login
	header("Location: index.php"); exit;
	}
?>
	<!-- /.container-fluid -->
            <div class="card-footer small text-muted"><center><b> Quem Somos? Somos uma pequena organização de T.I especializado em diversos serviços de automação web para seu negócio. | Onde Ficamos? Rua: Antero Quental - Bloco 14, Apto 102, Messejana - Fortaleza/CE </b></center></div>
        
		<!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span> Copyright © Totos os direitos reservados | Sistema Odontológico Desenvolvido pela <a href="http://webtec.6te.net" title="Web Tech"> Web Tech </a></span>
            </div>
          </div>
        </footer>
      </div>
      <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Controle Modal-->
	<div class="modal fade" id="duvidasModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"> ATENÇÃO! </h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"> × </span>
					</button>
				</div>
				<div class="modal-body">
				<p style="color: #FF0000;"><b> Demonstração do Mês Vigente:</b> Mostra todos os valores referentes ao mês atual, ou seja, antes de serem contabilizados no sistema, pelo botão: "Enviar". </p>
				<p style="color: #FF0000;"><b> Demonstração de todos os Mêses:</b> Mostra todos os valores já atualizados/completos referentes ao mês de sua escolha, ou seja, nesta tabela é possível editar (caso tenha algum valor que não bate na contabilidade manual) e remover (opcional), pelos ícones: "Lapís e lixeira". </p>
				<p style="color: #FF0000;"><b> Receita Líquida (+):</b> Valor total acumulado no mês com as consultas contabilizadas pelo consultório. </p>
				<p style="color: #FF0000;"><b> Custos Fixos (-):</b> Valor mensal gasto pelo consultório, tais como: água e energia, por exemplo. </p>
				<p style="color: #FF0000;"><b> Custos Direitos (-):</b> Valor gasto com os equipamentos, tais como: manuntenção de aparelho, por exemplo. </p>
				<p style="color: #FF0000;"><b> Demonstração de Lucro (=):</b> Margem de lucro do consultório no mês vigente. </p>
				</div>
				<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal"> Fechar </button>
				</div>
			</div>
		</div>
	</div>

	<!-- Infor Modal-->
    <div class="modal fade" id="inforModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Dúvidas? </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"> × </span>
            </button>
          </div>
          <div class="modal-body"><b>2.</b> Administrador | <b>3.</b> Consultório | <b>4.</b> Colaborador | <b>5.</b> Cliente
		  <p style="color: #FF0000;"> ATENÇÃO: Não mexer nos perfis de acesso 2 e 3. </p>
		  </div>
          <div class="modal-footer">
            <button class="btn btn-primary" type="button" data-dismiss="modal"> Fechar </button>
          </div>
        </div>
      </div>
    </div>

	<!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Tem certeza que você deseja encerrar? </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"> × </span>
            </button>
          </div>
          <div class="modal-body"> Selecione "Sim" para sair ou "Não" para continuar a sessão. </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal"> Não </button>
            <a class="btn btn-primary" href="logout.php"> Sim </a>
          </div>
        </div>
      </div>
    </div>

	<!-- Mascará da Moeda -->
	<script language="javascript">
	 function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){  
		 var sep = 0;  
		 var key = '';  
		 var i = j = 0;  
		 var len = len2 = 0;  
		 var strCheck = '0123456789';  
		 var aux = aux2 = '';  
		 var whichCode = (window.Event) ? e.which : e.keyCode;  
		 if (whichCode == 13 || whichCode == 8) return true;  
		 key = String.fromCharCode(whichCode); // Valor para o código da Chave  
		 if (strCheck.indexOf(key) == -1) return false; // Chave inválida  
		 len = objTextBox.value.length;  
		 for(i = 0; i < len; i++)  
			 if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;  
		 aux = '';  
		 for(; i < len; i++)  
			 if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);  
		 aux += key;  
		 len = aux.length;  
		 if (len == 0) objTextBox.value = '';  
		 if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;  
		 if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;  
		 if (len > 2) {  
			 aux2 = '';  
			 for (j = 0, i = len - 3; i >= 0; i--) {  
				 if (j == 3) {  
					 aux2 += SeparadorMilesimo;  
					 j = 0;  
				 }  
				 aux2 += aux.charAt(i);  
				 j++;  
			 }  
			 objTextBox.value = '';  
			 len2 = aux2.length;  
			 for (i = len2 - 1; i >= 0; i--)  
			 objTextBox.value += aux2.charAt(i);  
			 objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);  
		 }  
		 return false;  
	 }  
	 </script>
	 <!-- Modal Alerta -->
	 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript"> $(document).ready(function(){ $('#alertaModal').modal('show'); }); </script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>
  </body>
</html>