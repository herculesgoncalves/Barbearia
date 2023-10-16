<?php 
@session_start();
require_once("verificar.php");
require_once("../conexao.php");

$pag = 'estoque';
//verificar se ele tem a permissão de estar nessa página
if(@$estoque == 'ocultar'){
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
					<div class="col-md-7">							
						<span><b>Categoria: </b></span>
						<span id="categoria_dados"></span>							
					</div>
					<div class="col-md-5">							
						<span><b>Valor Compra: </b></span>
						<span id="valor_compra_dados"></span>
					</div>					

				</div>


			

				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-7">							
						<span><b>Valor Venda: </b></span>
						<span id="valor_venda_dados"></span>
					</div>

					<div class="col-md-5">							
						<span><b>Estoque: </b></span>
						<span id="estoque_dados"></span>							
					</div>
						

				</div>

				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					
					<div class="col-md-8">							
						<span><b>Alerta Nível Mínimo Estoque: </b></span>
						<span id="nivel_estoque_dados"></span>							
					</div>
						

				</div>


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-12">							
						<span><b>Descrição: </b></span>
						<span id="descricao_dados"></span>							
					</div>

				
						

				</div>

			


				<div class="row">
					<div class="col-md-12" align="center">		
						<img width="250px" id="target_mostrar">	
					</div>					
				</div>


			</div>

			
		</div>
	</div>
</div>





<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>


<script type="text/javascript">
	$(document).ready(function() {
    $('.sel2').select2({
    	dropdownParent: $('#modalForm')
    });
});
</script>


<script type="text/javascript">
	function carregarImg() {
    var target = document.getElementById('target');
    var file = document.querySelector("#foto").files[0];
    
        var reader = new FileReader();

        reader.onloadend = function () {
            target.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);

        } else {
            target.src = "";
        }
    }
</script>


