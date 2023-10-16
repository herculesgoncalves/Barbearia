<?php 
@session_start();
require_once("verificar.php");
require_once("../conexao.php");

$pag = 'clientes_retorno';

//verificar se ele tem a permissão de estar nessa página
if(@$clientes_retorno == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}
?>

<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>

<!-- Modal Dados-->
<div class="modal fade" id="modalDados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="nome_dados"></span></h4>
				<button id="btn-fechar-perfil" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true" >&times;</span>
				</button>
			</div>
			
			<div class="modal-body">

				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Telefone: </b></span>
						<span id="telefone_dados"></span>
					</div>	

					<div class="col-md-6">							
						<span><b>Cartões: </b></span>
						<span id="cartoes_dados"></span>							
					</div>
									

				</div>


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Cadastro: </b></span>
						<span id="data_cad_dados"></span>							
					</div>
					<div class="col-md-6">							
						<span><b>Nascimento: </b></span>
						<span id="data_nasc_dados"></span>
					</div>					

				</div>


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Data Retorno: </b></span>
						<span id="retorno_dados"></span>							
					</div>
					<div class="col-md-6">							
						<span><b>Último Serviço: </b></span>
						<span id="servico_dados"></span>
					</div>					

				</div>


				


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					
					<div class="col-md-12">							
						<span><b>Endereço: </b></span>
						<span id="endereco_dados"></span>
					</div>					

				</div>


			

			</div>

			
		</div>
	</div>
</div>





<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>



