<?php 
@session_start();
require_once("verificar.php");
require_once("../conexao.php");

$pag = 'clientes';

//verificar se ele tem a permissão de estar nessa página
if(@$clientes == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}
?>




 <div class="row top-50">
<div class="col-md-8 float-esq" >	
  <a class="btn btn-primary" onclick="inserir()" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> <span class="esc">Novo Cliente</span></a>
</div>
<div class="col-md-3 float-esq" >
	<input onkeyup="listarClientes()" class="form-control" type="text" name="buscar" id="buscar" placeholder="Buscar por CPF, Nome ou Telefone" style="border-radius: 5px">
	<input type="hidden" id="pagina">
</div>
<div class="col-md-1 float-esq" >
   <button onclick="listarClientes()" id="btn-buscar" class="btn btn-primary"><i class="fa fa-search"></i></button>
</div>

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
			<form id="form_cli">
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
								<label for="exampleInputEmail1">Telefone</label>
								<input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" >    
							</div> 	
						</div>
					
					</div>

					<div class="row">

						<div class="col-md-7">
							<div class="form-group">
								<label for="exampleInputEmail1">Cpf</label>
								<input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" >    
							</div> 	
						</div>

							<div class="col-md-5">
							<div class="form-group">
								<label for="exampleInputEmail1">Cartões</label>
								<input type="number" class="form-control" id="cartao" name="cartao"  value="0">    
							</div> 	
						</div>
					</div>

							

					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label for="exampleInputEmail1">Endereço</label>
								<input type="text" class="form-control" id="endereco" name="endereco" placeholder="Rua X Número 1 Bairro xxx" >    
							</div> 	
						</div>


						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Nascimento</label>
								<input type="date" class="form-control" id="data_nasc" name="data_nasc" >    
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


				<br>

				<small><table class="table table-hover">
	<thead> 
	<tr> 
	<th>Último Serviço</th>	
	<th class="esc">Data</th> 
	<th class="esc">Valor</th> 	
	<th class="esc">OBS</th> 	
	
	</tr> 
	</thead> 
	<tbody>
	<td><span id="servico_dados_tab"></span></td>
	<td><span id="data_dados_tab"></span></td>
	<td><span id="valor_dados_tab"></span></td>
	<td><span id="obs_dados_tab"></span></td>
	</tbody>
	</table></small>

	<hr>

	<div id="listar-debitos">

	</div>
			

			</div>

			
		</div>
	</div>
</div>




<!-- Modal Contrato-->
<div class="modal fade" id="modalContrato" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_contrato"></span></h4>
				<button id="btn-fechar-conta" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>	
			<form id="form-contrato">	
			<div class="modal-body">

					<div>
						<textarea name="contrato" id="contrato" class="textareag"> </textarea>
					</div>
					<input type="hidden" name="id" id="id_contrato">

					<small><div id="mensagem-contrato" align="center"></div></small>
					
			</div>
			<div class="modal-footer">       
				<button type="submit" class="btn btn-primary">Gerar Relatório</button>
			</div>	
			</form>		

				

		</div>
	</div>
</div>




<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>

<script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

<script type="text/javascript">
	$(document).ready( function () {
		listarClientes()
	} );

</script>


<script type="text/javascript">
	
function listarClientes(pagina){

	$("#pagina").val(pagina);

  var busca = $("#buscar").val();
    $.ajax({
        url: 'paginas/' + pag + "/listar.php",
        method: 'POST',
        data: {busca, pagina},
        dataType: "html",

        success:function(result){
            $("#listar").html(result);
           
        }
    });
}

function listarDebitos(id){	 

    $.ajax({
        url: 'paginas/' + pag + "/listar-debitos.php",
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(result){
            $("#listar-debitos").html(result);
           
        }
    });
}
</script>


<script type="text/javascript">
	
$("#form_cli").submit(function () {

    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'paginas/' + pag + "/salvar.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem').text('');
            $('#mensagem').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {

                $('#btn-fechar').click();

                var pagina = $("#pagina").val();
                listarClientes(pagina)          

            } else {

                $('#mensagem').addClass('text-danger')
                $('#mensagem').text(mensagem)
            }


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});





function excluir(id){
    $.ajax({
        url: 'paginas/' + pag + "/excluir.php",
        method: 'POST',
        data: {id},
        dataType: "text",

        success: function (mensagem) {            
            if (mensagem.trim() == "Excluído com Sucesso") {                
                 var pagina = $("#pagina").val();
                listarClientes(pagina)              
            } else {
                $('#mensagem-excluir').addClass('text-danger')
                $('#mensagem-excluir').text(mensagem)
            }

        },      

    });
}



	function listarTextoContrato(id){
	
    $.ajax({
        url: 'paginas/' + pag + "/texto-contrato.php",
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(result){            
            nicEditors.findEditor("contrato").setContent(result);	          
        }
    });
}




$("#form-contrato").submit(function () {
	var id_emp = $('#id_contrato').val();
    event.preventDefault();
    nicEditors.findEditor('contrato').saveContent();
    var formData = new FormData(this);

    $.ajax({
        url: 'paginas/' + pag + "/salvar-contrato.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem-contrato').text('');
            $('#mensagem-contrato').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {                
                   
                let a= document.createElement('a');
                a.target= '_blank';
                a.href= 'rel/contrato_servico_class.php?id=' + id_emp;
                a.click();  	 

            } else {

                $('#mensagem-contrato').addClass('text-danger')
                $('#mensagem-contrato').text(mensagem)
            }


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});

</script>



<script type="text/javascript">
	function baixar(id, cliente){
    $.ajax({
        url: 'paginas/receber/baixar.php',
        method: 'POST',
        data: {id},
        dataType: "text",

        success: function (mensagem) {            
            if (mensagem.trim() == "Baixado com Sucesso") {                
                listarDebitos(cliente);                
            } else {
                    $('#mensagem-excluir-baixar').addClass('text-danger')
                    $('#mensagem-excluir-baixar').text(mensagem)
                }

        },      

    });
}

</script>