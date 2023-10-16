<?php 
@session_start();
require_once("verificar.php");
require_once("../conexao.php");

$pag = 'fornecedores';

//verificar se ele tem a permissão de estar nessa página
if(@$fornecedores == 'ocultar'){
	echo "<script>window.location='../index.php'</script>";
	exit();
}
?>

<div class="">      
	<a class="btn btn-primary" onclick="inserir()" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Novo Fornecedor</a>
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
						<div class="col-md-7">
							<div class="form-group">
								<label for="exampleInputEmail1">Nome</label>
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>    
							</div> 	
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label for="exampleInputEmail1">Telefone</label>
								<input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" >    
							</div> 	
						</div>
						
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Tipo Chave Pix</label>
								<select class="form-control" name="tipo_chave" id="tipo_chave">
									<option value="">Selecionar Chave</option>
									<option value="CPF">CPF</option>
									<option value="Telefone">Telefone</option>
									<option value="Email">Email</option>
									<option value="Código">Código</option>
									<option value="CNPJ">CNPJ</option>
								</select>  
							</div> 	
						</div>



						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Chave Pix</label>
								<input type="text" class="form-control" id="chave_pix" name="chave_pix" placeholder="Chave Pix" > 
							</div> 	
						</div>
					</div>

					

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="exampleInputEmail1">Endereço</label>
								<input type="text" class="form-control" id="endereco" name="endereco" placeholder="Rua X Número 1 Bairro xxx" >    
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
						<span><b>Cadastro: </b></span>
						<span id="data_cad_dados"></span>							
					</div>
					

				</div>


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					
					<div class="col-md-6">							
						<span><b>Tipo Chave: </b></span>
						<span id="tipo_chave_dados"></span>
					</div>	

					<div class="col-md-6">							
						<span><b>Chave Pix: </b></span>
						<span id="chave_pix_dados"></span>
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



