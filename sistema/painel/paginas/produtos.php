<?php 
@session_start();
require_once("verificar.php");
require_once("../conexao.php");

$pag = 'produtos';

//verificar se ele tem a permissão de estar nessa página
if(@$produtos == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}
?>

<div class="">      
	<a class="btn btn-primary" onclick="inserir()" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Novo Produto</a>
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
								<label for="exampleInputEmail1">Categoria</label>
								<select class="form-control sel2" id="categoria" name="categoria" style="width:100%;" > 

									<?php 
									$query = $pdo->query("SELECT * FROM cat_produtos ORDER BY id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$total_reg = @count($res);
									if($total_reg > 0){
										for($i=0; $i < $total_reg; $i++){
										foreach ($res[$i] as $key => $value){}
										echo '<option value="'.$res[$i]['id'].'">'.$res[$i]['nome'].'</option>';
										}
									}else{
											echo '<option value="0">Cadastre uma Categoria</option>';
										}
									 ?>
									

								</select>   
							</div> 	
						</div>
						
					</div>


					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="exampleInputEmail1">Descrição <small>(Até 255 Caracteres)</small></label>
								<input maxlength="255" type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição do Produto" >    
							</div> 	
						</div>
						
					</div>


					<div class="row">

					<div class="col-md-4">

							<div class="form-group">
								<label for="exampleInputEmail1">Valor Compra</label>
								<input type="text" class="form-control" id="valor_compra" name="valor_compra" placeholder="Valor Compra" >    
							</div> 	
						</div>					
						

						<div class="col-md-4">

							<div class="form-group">
								<label for="exampleInputEmail1">Valor Venda</label>
								<input type="text" class="form-control" id="valor_venda" name="valor_venda" placeholder="Valor Venda" >    
							</div> 	
						</div>	


						<div class="col-md-4">

							<div class="form-group">
								<label for="exampleInputEmail1">Alerta Estoque</label>
								<input type="number" class="form-control" id="nivel_estoque" name="nivel_estoque" placeholder="Nível Mínimo" >    
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
									<img src="img/produtos/sem-foto.jpg"  width="80px" id="target">									
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





<!-- Modal Saida-->
<div class="modal fade" id="modalSaida" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="nome_saida"></span></h4>
				<button id="btn-fechar-saida" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true" >&times;</span>
				</button>
			</div>
			
			<div class="modal-body">
				<form id="form-saida">

				<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								
								<input type="number" class="form-control" id="quantidade_saida" name="quantidade_saida" placeholder="Quantidade Saída" required>    
							</div> 	
						</div>

						<div class="col-md-5">
							<div class="form-group">								
								<input type="text" class="form-control" id="motivo_saida" name="motivo_saida" placeholder="Motivo Saída" required>    
							</div> 	
						</div>
						<div class="col-md-3">
							<button type="submit" class="btn btn-primary">Salvar</button>
						
						</div>
					</div>	
				
				<input type="hidden" id="id_saida" name="id">
				<input type="hidden" id="estoque_saida" name="estoque">

				</form>

				<br>
					<small><div id="mensagem-saida" align="center"></div></small>
			</div>

			
		</div>
	</div>
</div>





<!-- Modal Entrada-->
<div class="modal fade" id="modalEntrada" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="nome_entrada"></span></h4>
				<button id="btn-fechar-entrada" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true" >&times;</span>
				</button>
			</div>
			
			<div class="modal-body">
				<form id="form-entrada">

				<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								
								<input type="number" class="form-control" id="quantidade_entrada" name="quantidade_entrada" placeholder="Quantidade Entrada" required>    
							</div> 	
						</div>

						<div class="col-md-5">
							<div class="form-group">								
								<input type="text" class="form-control" id="motivo_entrada" name="motivo_entrada" placeholder="Motivo Entrada" required>    
							</div> 	
						</div>
						<div class="col-md-3">
							<button type="submit" class="btn btn-primary">Salvar</button>
						
						</div>
					</div>	
				
				<input type="hidden" id="id_entrada" name="id">
				<input type="hidden" id="estoque_entrada" name="estoque">

				</form>

				<br>
					<small><div id="mensagem-entrada" align="center"></div></small>
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
	

$("#form-saida").submit(function () {

    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'paginas/' + pag + "/saida.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem-saida').text('');
            $('#mensagem-saida').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {

                $('#btn-fechar-saida').click();
                listar();          

            } else {

                $('#mensagem-saida').addClass('text-danger')
                $('#mensagem-saida').text(mensagem)
            }


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});
</script>





 <script type="text/javascript">
	

$("#form-entrada").submit(function () {

    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'paginas/' + pag + "/entrada.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem-entrada').text('');
            $('#mensagem-entrada').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {

                $('#btn-fechar-entrada').click();
                listar();          

            } else {

                $('#mensagem-entrada').addClass('text-danger')
                $('#mensagem-entrada').text(mensagem)
            }


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});
</script>