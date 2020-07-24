<?php
	// A sessão precisa ser iniciada em cada página diferente
	if (!isset($_SESSION)) session_start();
	// Verifica se não há a variável da sessão que identifica o usuário
	if (!isset($_SESSION['usuarioId'])) {
	// Destrói a sessão por segurança
	session_destroy();
	// Redireciona o visitante de volta pro login
	header("Location: index.php");exit;
	}
	include('Conexaodb.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> Odonto Web </title>
	<!-- Icone na aba do navegador -->
	<link rel="shortcut icon" href="img/dente.png">
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
  </head>

  <body class="bg-dark">
    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header"> Editar Custo Fixo/Consultório </div>
        <div class="card-body">
		<?php
		$custo_fixo_id = FILTER_INPUT(INPUT_GET, 'custo_fixo_id', FILTER_SANITIZE_NUMBER_INT);

		$listarDados = mysqli_query($conn, "SELECT * FROM custos_fixos WHERE custo_fixo_id = '$custo_fixo_id'");
		while($escrever = mysqli_fetch_array($listarDados)){ ?>
          <form action="Editarcustofixo.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
			<div class="form-group">
			<div class="form-label-group">
				<input type="hidden" name="custo_fixo_id" value="<?php echo $escrever['custo_fixo_id']; ?>">
				<input type="hidden" id="consultorio" name="consultorio" class="form-control" value="<?php echo $_SESSION['usuarioNome']; ?>" placeholder="Nome do Consultório" required="required">
				<label for="consultorio"> Nome do Consultório </label>
              </div>
			  </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
					<input type="text" id="Categoria" name="categoria" value="<?php echo $escrever['categoria']; ?>" class="form-control" placeholder="Categoria" required="required">
                    <label for="Categoria"> Categoria </label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="Valorcustofixo" name="valor_custo_fixo" value="<?php echo $escrever['valor_custo_fixo']; ?>" class="form-control" onKeyPress="return(MascaraMoeda(this,'.',',',event))" placeholder="R$ Valor Despesa" required="required">
                    <label for="Valorcustofixo"> R$ Valor Despesa </label>
                  </div>
                </div>
              </div>
            </div>
			<input type="hidden" name="acao" value="enviado" />
            <input type="submit" class="btn btn-primary btn-block" value="Alterar" />
          </form><?php } ?>
          <div class="text-center">
            <a class="d-block small mt-3" href="custos-fixos.php"> Voltar </a>
          </div>
        </div>
      </div>
    </div>

	<!-- Mascará de Moeda -->
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
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  </body>
</html>
