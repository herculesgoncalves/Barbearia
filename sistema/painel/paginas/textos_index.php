<?php 
@session_start();
require_once("verificar.php");
require_once("../conexao.php");

$pag = 'textos_index';

//verificar se ele tem a permissão de estar nessa página
if(@$textos_index == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

?>

<div class="">      
	<a class="btn btn-primary" onclick="inserir()" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Novo Texto</a>
</div>

<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>






<!-- Modal Inserir-->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><span id="titulo_inserir"></span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true" >&times;</span>
				</button>
			</div>
			
			<form id="form">
			<div class="modal-body">

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="exampleInputEmail1">Título <small>(Até 25 Caracteres)</small></label>
								<input maxlength="25" type="text" class="form-control" id="titulo" name="titulo" placeholder="Título do Texto" >    
							</div> 	
						</div>
						
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="exampleInputEmail1">Descrição <small>(Até 255 Caracteres)</small></label>
								<input maxlength="255" type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição do Texto" >    
							</div> 	
						</div>
						
					</div>

					
						<input type="hidden" name="id" id="id">

					<br>
					<small><div id="mensagem" align="center"></div></small>
				</div>


				<div class="modal-footer">      
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>

							
		</div>
	</div>
</div>



<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>


