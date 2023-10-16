<?php 
@session_start();
require_once("verificar.php");
require_once("../conexao.php");

$pag = 'marketing';

//verificar se ele tem a permissão de estar nessa página
if(@$marketing == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}
?>

<div class="">      
	<a class="btn btn-primary" onclick="inserir()" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Nova Campanha</a>
</div>

<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>






<!-- Modal Inserir-->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
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
								<label for="exampleInputEmail1">Título</label>
								<input maxlength="100" type="text" class="form-control" id="titulo" name="titulo" placeholder="Título da Campanha" >    
							</div> 	
						</div>

						<div class="col-md-12">
							
							<div class="form-group">
								<label for="exampleInputEmail1">Mensagem <small>(Até 500 Caracteres)</small></label>
							<input maxlength="500" type="text" class="form-control" id="mensagem_input" name="mensagem" placeholder="Mensagem que vai ser mostrada abaixo do título da campanha" >   
							</div> 	
						</div>
						
					</div>


					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Item 1 </label>
								<input maxlength="100" type="text" class="form-control" id="item1" name="item1" placeholder="Item 1 se Houver" >    
							</div> 	
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Item 2 </label>
								<input maxlength="100" type="text" class="form-control" id="item2" name="item2" placeholder="Item 2 se Houver" >    
							</div> 	
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Item 3 </label>
								<input maxlength="100" type="text" class="form-control" id="item3" name="item3" placeholder="Item 3 se Houver" >    
							</div> 	
						</div>

						
					</div>


						<div class="row">
						
						
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Item 4 </label>
								<input maxlength="100" type="text" class="form-control" id="item4" name="item4" placeholder="Item 4 se Houver" >    
							</div> 	
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Item 5 </label>
								<input maxlength="100" type="text" class="form-control" id="item5" name="item5" placeholder="Item 5 se Houver" >    
							</div> 	
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Item 6 </label>
								<input maxlength="100" type="text" class="form-control" id="item6" name="item6" placeholder="Item 6 se Houver" >    
							</div> 	
						</div>
						
					</div>





					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Item 7 </label>
								<input maxlength="100" type="text" class="form-control" id="item7" name="item7" placeholder="Item 7 se Houver" >    
							</div> 	
						</div>

						
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Item 8 </label>
								<input maxlength="100" type="text" class="form-control" id="item8" name="item8" placeholder="Item 8 se Houver" >    
							</div> 	
						</div>


						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Item 9 </label>
								<input maxlength="100" type="text" class="form-control" id="item9" name="item9" placeholder="Item 9 se Houver" >    
							</div> 	
						</div>
						
					</div>



						<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Item 10 </label>
								<input maxlength="100" type="text" class="form-control" id="item10" name="item10" placeholder="Item 10 se Houver" >    
							</div> 	
						</div>

						
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Item 11 </label>
								<input maxlength="100" type="text" class="form-control" id="item11" name="item11" placeholder="Item 11 se Houver" >    
							</div> 	
						</div>


						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Item 12 </label>
								<input maxlength="100" type="text" class="form-control" id="item12" name="item12" placeholder="Item 12 se Houver" >    
							</div> 	
						</div>
						
					</div>




					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Item 13 </label>
								<input maxlength="100" type="text" class="form-control" id="item13" name="item13" placeholder="Item 13 se Houver" >    
							</div> 	
						</div>

						
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Item 14 </label>
								<input maxlength="100" type="text" class="form-control" id="item14" name="item14" placeholder="Item 14 se Houver" >    
							</div> 	
						</div>


						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Item 15 </label>
								<input maxlength="100" type="text" class="form-control" id="item15" name="item15" placeholder="Item 15 se Houver" >    
							</div> 	
						</div>
						
					</div>



					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Item 16 </label>
								<input maxlength="100" type="text" class="form-control" id="item16" name="item16" placeholder="Item 16 se Houver" >    
							</div> 	
						</div>

						
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Item 17 </label>
								<input maxlength="100" type="text" class="form-control" id="item17" name="item17" placeholder="Item 17 se Houver" >    
							</div> 	
						</div>


						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Item 18 </label>
								<input maxlength="100" type="text" class="form-control" id="item18" name="item18" placeholder="Item 18 se Houver" >    
							</div> 	
						</div>
						
					</div>


					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Item 19 </label>
								<input maxlength="100" type="text" class="form-control" id="item19" name="item19" placeholder="Item 19 se Houver" >    
							</div> 	
						</div>

						
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Item 20 </label>
								<input maxlength="100" type="text" class="form-control" id="item20" name="item20" placeholder="Item 20 se Houver" >    
							</div> 	
						</div>


					
						
					</div>



					<div class="row">

				
						<div class="col-md-12">
							
							<div class="form-group">
								<label for="exampleInputEmail1">Mensagem de Conclusão <small>(Até 500 Caracteres)</small></label>
							<input maxlength="500" type="text" class="form-control" id="conclusao" name="conclusao" placeholder="Mensagem que vai ser mostrada abaixo dos itens ou caso não tenha itens será mostrada abaixo da outra descrição" >   
							</div> 	
						</div>				
						

					
					</div>

					

						<div class="row">
							<div class="col-md-4">						
								<div class="form-group"> 
									<label>Imagem (Formato PNG)</label> 
									<input class="form-control" type="file" name="foto" onChange="carregarImg();" id="foto">
								</div>						
							</div>
							<div class="col-md-4">
								<div id="divImg">
									<img src="img/produtos/sem-foto.jpg"  width="80px" id="target">									
								</div>
							</div>


							<div class="col-md-4">						
								<div class="form-group"> 
									<label>Áudio (Formato OGG)</label> 
									<input class="form-control" type="file" name="audio"  id="audio">
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
						<span><b>Criada Em: </b></span>
						<span id="data_dados"></span>							
					</div>
					<div class="col-md-6">							
						<span><b>Útimo Envio: </b></span>
						<span id="data_envio_dados"></span>
					</div>					

				</div>


			

				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Envios: </b></span>
						<span id="envios_dados"></span>
					</div>

				</div>

				<div class="" style="margin-top: 20px;" align="center">

					<div style="margin-top: 10px; text-align:center;" align="center"> 
						<div style="margin-bottom: 10px">
						<b><u><small>Demonstração da Mensagem</small></u></b>
						</div>

						<div style="margin-top: 10px; width:350px; border:1px solid #acacad; margin:0 auto; text-align: left; padding:5px" >
							<small>
								<b><span id="titulo_dados"></span></b><br>
							<span id="mensagem_dados"></span><br><br>

							
							<div id="item1_dad">✅<span id="item1_dados"></span><br></div>
							<div id="item2_dad">✅<span id="item2_dados"></span><br></div>
							<div id="item3_dad">✅<span id="item3_dados"></span><br></div>
							<div id="item4_dad">✅<span id="item4_dados"></span><br></div>
							<div id="item5_dad">✅<span id="item5_dados"></span><br></div>
							<div id="item6_dad">✅<span id="item6_dados"></span><br></div>
							<div id="item7_dad">✅<span id="item7_dados"></span><br></div>
							<div id="item8_dad">✅<span id="item8_dados"></span><br>
							</div>

							<div id="item9_dad">✅<span id="item9_dados"></span><br>
							</div>
							<div id="item10_dad">✅<span id="item10_dados"></span><br>
							</div>
							<div id="item11_dad">✅<span id="item11_dados"></span><br>
							</div>
							<div id="item12_dad">✅<span id="item12_dados"></span><br>
							</div>
							<div id="item13_dad">✅<span id="item13_dados"></span><br>
							</div>
							<div id="item14_dad">✅<span id="item14_dados"></span><br>
							</div>
							<div id="item15_dad">✅<span id="item15_dados"></span><br>
							</div>
							<div id="item16_dad">✅<span id="item16_dados"></span><br>
							</div>
							<div id="item17_dad">✅<span id="item17_dados"></span><br>
							</div>
							<div id="item18_dad">✅<span id="item18_dados"></span><br>
							</div>
							<div id="item19_dad">✅<span id="item19_dados"></span><br>
							</div>
							<div id="item20_dad">✅<span id="item20_dados"></span><br>
							</div>

							<br>
							<i><span id="conclusao_dados"></span></i><br><br>

							<img src="" id="target_dados" width="70%"><br><br>
							<audio  controls="controls" class="" style="height:25px; width:180px"  id="audio_dados">							
							<source class="form-control" src="" type="audio/mp3" />
						</audio>

						</small>

						</div>
					</div>
					
				</div>

				


			</div>

			
		</div>
	</div>
</div>







<!-- Modal Entrada-->
<div class="modal fade" id="modalEntrada" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="nome_entrada"></span> - <span id="total_clientes"></span> Clientes</h4>
				<button id="btn-fechar-entrada" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true" >&times;</span>
				</button>
			</div>
			
			<div class="modal-body">
				<form id="form-entrada">

				<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<label for="exampleInputEmail1">Clientes</label>
								<select name="clientes" id="clientes" class="form-control" onchange="selecionarClientes()">
									<option value="Teste">Teste (Administrador)</option>
									<option value="">Todos</option>
									<option value="Aniversáriantes Mês">Aniversariantes Mês</option>
									<option value="Aniversáriantes Dia">Aniversariantes Dia</option>
									<option value="Clientes Semana">Clientes Cadastrados Semana</option>
									<option value="Clientes Mês">Clientes Cadastrados Mês</option>
								</select>
							</div> 	
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Intervalo Disparos </label>
								<select name="tempo" class="form-control">
									<option value="15">15 Segundos</option>
									<option value="10">10 Segundos</option>
									<option value="6">6 Segundos</option>
									<option value="3">3 Segundos</option>										
									
								</select>
							</div> 	
						</div>

						<div class="col-md-3" style="margin-top: 22px">
							<button id="btn_disparar" type="submit" class="btn btn-primary">Disparar</button>
						
						</div>


					</div>	




				
				<input type="hidden" id="id_entrada" name="id">
				

				</form>

				<br>
					<small><div id="mensagem-entrada" align="center"></div></small>


					<div style="margin-top: 10px; text-align:center;" align="center"> 
						<div style="margin-bottom: 10px">
						<b><u><small>Demonstração da Mensagem</small></u></b>
						</div>

						<div style="margin-top: 10px; width:350px; border:1px solid #acacad; margin:0 auto; text-align: left; padding:5px" >
							<small>
								<b><span id="titulo_disparar"></span></b><br>
							<span id="mensagem_disparar"></span><br><br>

							<div id="item1_dis">✅<span id="item1_disparar"></span><br></div>
							<div id="item2_dis">✅<span id="item2_disparar"></span><br></div>
							<div id="item3_dis">✅<span id="item3_disparar"></span><br></div>
							<div id="item4_dis">✅<span id="item4_disparar"></span><br></div>
							<div id="item5_dis">✅<span id="item5_disparar"></span><br></div>
							<div id="item6_dis">✅<span id="item6_disparar"></span><br></div>
							<div id="item7_dis">✅<span id="item7_disparar"></span><br></div>
							<div id="item8_dis">✅<span id="item8_disparar"></span><br></div>

							<div id="item9_dis">✅<span id="item9_disparar"></span><br>
							</div>
							<div id="item10_dis">✅<span id="item10_disparar"></span><br>
							</div>
							<div id="item11_dis">✅<span id="item11_disparar"></span><br>
							</div>
							<div id="item12_dis">✅<span id="item12_disparar"></span><br>
							</div>
							<div id="item13_dis">✅<span id="item13_disparar"></span><br>
							</div>
							<div id="item14_dis">✅<span id="item14_disparar"></span><br>
							</div>
							<div id="item15_dis">✅<span id="item15_disparar"></span><br>
							</div>
							<div id="item16_dis">✅<span id="item16_disparar"></span><br>
							</div>
							<div id="item17_dis">✅<span id="item17_disparar"></span><br>
							</div>
							<div id="item18_dis">✅<span id="item18_disparar"></span><br>
							</div>
							<div id="item19_dis">✅<span id="item19_disparar"></span><br>
							</div>
							<div id="item20_dis">✅<span id="item20_disparar"></span><br>
							</div>

							<br>
							<i><span id="conclusao_disparar"></span></i><br><br>

							<img src="" id="target_disparar" width="70%"><br><br>
							<audio  controls="controls" class="" style="height:25px; width:180px"  id="audio_disparar">							
							<source class="form-control" src="" type="audio/mp3" />
						</audio>

						</small>

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

	$('#btn_disparar').hide();
	$('#mensagem-entrada').text('Enviando!!');

    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'paginas/' + pag + "/disparar.php",
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

            $('#btn_disparar').show();

        },

        cache: false,
        contentType: false,
        processData: false,

    });

});
</script>


<script type="text/javascript">
	function selecionarClientes(){
		var cli = $('#clientes').val();

		  $.ajax({
        url: 'paginas/' + pag + "/listar_clientes.php",
        method: 'POST',
        data: {cli},
        dataType: "text",

        success: function (mensagem) {               
           $('#total_clientes').text(mensagem);
        },      

    });
	}
</script>


<script type="text/javascript">
	function pararDisparo(hash){
		
	$.ajax({
        url: 'paginas/' + pag + "/api_parar_disparos.php",
        method: 'POST',
        data: {hash},
        dataType: "text",

        success: function (mensagem) {               
          listar(); 
        },      

    });
	}
</script>