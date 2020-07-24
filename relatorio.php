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

include('topo.php');
?>
<!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i> Relatório </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
				<div class="window" id="janela1">
				<a href="#" class="fechar"> X </a>
				<h4> Janela Modal </h4>
				<p> Informações do usuário selecionado, </p>
				<p><a href="#"> Detalhes. </a></p>
				</div>
				<!-- mascara para cobrir o site -->
				<div id="mascara"></div>
                  <thead>
                    <tr>
					  <th> Cod </th>
					  <th> Detalhes </th>                      
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
					  <th> Cod </th>
					  <th> Detalhes </th>
                    </tr>
                  </tfoot>
                  <?php
				  include('conexaoBD.php');
				  $ListarDados = mysqli_query($conn, "SELECT * FROM status");
				  while($Escrever = mysqli_fetch_array($ListarDados)){
				  echo '<tbody>
                    <tr>
					  <td> ' . $Escrever['id'] . ' </td>
                      <td> <a href="#janela1" rel="modal"> ' . $Escrever['nome'] . ' </a> </td>
                    </tr>
                  </tbody>';};?>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
        <div class="card-footer small text-muted"><b> Quem Somos? Somos uma empresa especializada em diversos serviços voltados a odontologia. | Onde Ficamos? AV. Juvenal de Castro - 249 Centro - Horizonte/CE | Contato: Fone: (85)3336.0567, Zap: (85)99428.4706, Zap: (85)98418.3087 </b></div>
        <?php include('rodape.php'); ?>
		<style>
		.window{
		display:none;
		width:300px;
		height:300px;
		position:absolute;
		left:0;
		top:0;
		background:#FFF;
		z-index:9900;
		padding:10px;
		border-radius:10px;
		}
 
		#mascara{
		display:none;
		position:absolute;
		left:0;
		top:0;
		z-index:9000;
		background-color:#000;
		}
 
		.fechar{display:block; text-align:right;}
		</style>
		<script>
		$(document).ready(function(){
		$("a[rel=modal]").click( function(ev){
        ev.preventDefault();
 
        var id = $(this).attr("href");
 
        var alturaTela = $(document).height();
        var larguraTela = $(window).width();
     
        //colocando o fundo preto
        $('#mascara').css({'width':larguraTela,'height':alturaTela});
        $('#mascara').fadeIn(1000); 
        $('#mascara').fadeTo("slow",0.8);
 
        var left = ($(window).width() /2) - ( $(id).width() / 2 );
        var top = ($(window).height() / 2) - ( $(id).height() / 2 );
     
        $(id).css({'top':top,'left':left});
        $(id).show();   
    });
 
    $("#mascara").click( function(){
        $(this).hide();
        $(".window").hide();
    });
 
    $('.fechar').click(function(ev){
        ev.preventDefault();
        $("#mascara").hide();
        $(".window").hide();
    });
});
</script>
</body>
</html>
