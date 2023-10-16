<?php 
@session_start();
require_once("verificar.php");
require_once("../conexao.php");

//verificar se ele tem a permissão de estar nessa página
if(@$usuarios == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

$pag = 'usuarios';
?>

<div class="">      
	<a class="btn btn-primary" onclick="inserir()" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Novo Usuário</a>
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
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Nome</label>
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>    
							</div> 	
						</div>
						<div class="col-md-6">

							<div class="form-group">
								<label for="exampleInputEmail1">Email</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Email"  required>    
							</div> 	
						</div>
					</div>


					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Telefone</label>
								<input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" >    
							</div> 	
						</div>
						<div class="col-md-4">
							
							<div class="form-group">
								<label for="exampleInputEmail1">CPF</label>
								<input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" >    
							</div> 	
						</div>

						<div class="col-md-4">
							
							<div class="form-group">
								<label for="exampleInputEmail1">Nível</label>
								<select class="form-control sel2" id="cargo" name="cargo" style="width:100%;" > 

									<?php 
									$query = $pdo->query("SELECT * FROM cargos ORDER BY nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$total_reg = @count($res);
									if($total_reg > 0){
										for($i=0; $i < $total_reg; $i++){
										foreach ($res[$i] as $key => $value){}
										echo '<option value="'.$res[$i]['nome'].'">'.$res[$i]['nome'].'</option>';
										}
									}else{
											echo '<option value="0">Cadastre um Cargo</option>';
										}
									 ?>
									

								</select>   
							</div> 	
						</div>
					</div>

					

					<div class="row">
						<div class="col-md-9">
							<div class="form-group">
								<label for="exampleInputEmail1">Endereço</label>
								<input type="text" class="form-control" id="endereco" name="endereco" placeholder="Rua X Número 1 Bairro xxx" >    
							</div> 	
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">Atendimento</label>
								<select class="form-control" name="atendimento" id="atendimento">
									<option value="Sim">Sim</option>
									<option value="Não">Não</option>
								</select>  
							</div> 	
						</div>
						
					</div>





						<div class="row">
							<div class="col-md-8">						
								<div class="form-group"> 
									<label>Foto</label> 
									<input class="form-control" type="file" name="foto" onChange="carregarImg();" id="foto">
								</div>						
							</div>
							<div class="col-md-4">
								<div id="divImg">
									<img src="img/perfil/sem-foto.jpg"  width="80px" id="target">									
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
					<div class="col-md-8">							
						<span><b>Email: </b></span>
						<span id="email_dados"></span>							
					</div>
					<div class="col-md-4">							
						<span><b>Senha: </b></span>
						<span id="senha_dados"></span>
					</div>					

				</div>


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>CPF: </b></span>
						<span id="cpf_dados"></span>							
					</div>
					<div class="col-md-6">							
						<span><b>Telefone: </b></span>
						<span id="telefone_dados"></span>
					</div>					

				</div>




				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Nível: </b></span>
						<span id="nivel_dados"></span>							
					</div>
					<div class="col-md-6">							
						<span><b>Ativo: </b></span>
						<span id="ativo_dados"></span>
					</div>		
								

				</div>


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
						
					<div class="col-md-6">							
						<span><b>Cadastro: </b></span>
						<span id="data_dados"></span>
					</div>	

						<div class="col-md-6">							
						<span><b>Atendimento: </b></span>
						<span id="atendimento_dados"></span>
					</div>				

				</div>






				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					
					<div class="col-md-12">							
						<span><b>Endereço: </b></span>
						<span id="endereco_dados"></span>
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








<!-- Modal -->
<div class="modal fade" id="modalPermissoes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">
					Usuário: <span id="nome-usuario"></span>

					<span style="position:absolute; right:35px">
						<input class="form-check-input" type="checkbox" id="input-todos" onchange="marcarTodos()">
						<label class="" >Marcar Todos</label>
					</span>

				</h4>

				
				<button id="btn-fechar-permissoes" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<div class="modal-body">

				<div class="row" id="listar-permissoes">

				</div>

				<div class="row">	
					<div class="col-md-12">						
				
						
					</div>	
				</div>	

				<br>
				<input type="hidden" name="id" id="id-usuario"> 
				<small><div id="mensagem-permissao" align="center" class="mt-3"></div></small>		

				

				


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






<script type="text/javascript">
	function listarPermissoes(id){
		$.ajax({
			url: 'paginas/' + pag + "/listar-permissoes.php",
			method: 'POST',
			data: {id},
			dataType: "html",

			success:function(result){
				$("#listar-permissoes").html(result);
				$('#mensagem-permissao').text('');
				//$('#input-todos').prop('checked', false);
			}
		});
	}


	function marcarTodos(){
		let checkbox = document.getElementById('input-todos');
		var usuario = $('#id-usuario').val();
		
		if(checkbox.checked) {
		    adicionarPermissoes(usuario);		    
		} else {
		    limparPermissoes(usuario);
		}
	}



	function adicionarPermissoes(id){
		$.ajax({
			url: 'paginas/' + pag + "/add-permissoes.php",
			method: 'POST',
			data: {id},
			dataType: "html",

			success:function(result){
				listarPermissoes(id)
			}
		});	
	}


	function limparPermissoes(id){
		$.ajax({
			url: 'paginas/' + pag + "/limpar-permissoes.php",
			method: 'POST',
			data: {id},
			dataType: "html",

			success:function(result){
				listarPermissoes(id)
			}
		});	
	}


	function adicionarPermissao(idpermissao, idusuario){
		
		$.ajax({
			url: 'paginas/' + pag + "/add-permissao.php",
			method: 'POST',
			data: {idpermissao, idusuario},
			dataType: "html",

			success:function(result){
				listarPermissoes(idusuario)
			}
		});	
	}

</script>