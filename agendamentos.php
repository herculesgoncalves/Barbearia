<?php 
require_once("cabecalho.php");
$data_atual = date('Y-m-d');
?>
<style type="text/css">
	.sub_page .hero_area {
		min-height: auto;
	}

	.inputs_agenda{
  background: transparent !important; 
  border:none; border-bottom: 1px solid #FFF !important; 
  font-size: 14px !important; 
  color:#FFF !important; 
  padding:0 !important;
  margin:0px !important;
  margin-bottom:5px !important;
}
</style>

</div>

<div class="footer_section" style="background: #292929; ">
	<div class="container" >
		<div class="footer_content " >
			<form id="form-agenda" method="post" style="margin-top: -25px !important">
			<div class="footer_form footer-col">
				<div class="row" style="margin-top: -40px">
					<div class="col-6">						
					<input onkeyup="buscarNome()" class="inputs_agenda" type="text" name="telefone" id="telefone" placeholder="Telefone com DDD" required />				
					</div>

					<div class="col-6">
						
					<input onchange="mudarFuncionario()" class="inputs_agenda" type="date" name="data" id="data" value="<?php echo $data_atual ?>" required />
				
					</div>



				<div class="col-12">				
					<input  onclick="buscarNome()" class="inputs_agenda" type="text" name="nome" id="nome" placeholder="Seu Nome" required />
				</div>





				</div>
				

				



				<div class="form-group" style="margin-top: 10px"> 							
					<select onchange="mudarServico()" class="form-control sel2" id="servico" name="servico" style="width:100%; height:28px" required> 
						<option value="">Selecione um Serviço</option>

						<?php 
						$query = $pdo->query("SELECT * FROM servicos ORDER BY nome asc");
						$res = $query->fetchAll(PDO::FETCH_ASSOC);
						$total_reg = @count($res);									
						if($total_reg > 0){
							for($i=0; $i < $total_reg; $i++){
								foreach ($res[$i] as $key => $value){}
									$valor = $res[$i]['valor'];
								$valorF = number_format($valor, 2, ',', '.');

								echo '<option value="'.$res[$i]['id'].'">'.$res[$i]['nome'].' - R$ '.$valorF.'</option>';
							}
						}
						?>


					</select>    
				</div>		


				<div class="form-group">			
					<select class="form-control sel2" id="funcionario" name="funcionario" style="width:100%;" onchange="mudarFuncionario()" required> 				
						echo '<option value=""><?php echo $texto_agendamento ?></option>';

					</select>   
				</div> 	


				<div class="form-group"> 
					<small>								
					<div id="listar-horarios">
						
					</div>
				</small>
				</div>	


				

								
					<div class="form-group"> 						
						<input maxlength="100" type="text" class="inputs_agenda" name="obs" id="obs" placeholder="Observações caso exista alguma.">
					</div>	

					  <button onclick="salvar()" class="botao-verde" type="submit" style="width:100%;" id="btn_agendar">
                 <span id='botao_salvar'>Confirmar Agendamento</span>
                   
                </button>

                  <a href="meus-agendamentos.php" class="botao-azul" id='botao_editar' style="width:100%; text-align: center; margin-top: 5px">              
                  Ver Agendamentos
                </a>
               

                <br><br>
               <small> <div id="mensagem" align="center"></div></small>			

               <input type="text" id="data_oculta" style="display: none">	
                <input type="hidden" id="id" name="id">	
                 <input type="hidden" id="hora_rec" nome="hora_rec">	
                  <input type="hidden" id="nome_func" nome="nome_func">	
                  <input type="hidden" id="data_rec" nome="data_rec">	
                    <input type="hidden" id="nome_serv" nome="nome_serv">			
				

			</div>



		</form>




<div id="listar-cartoes" style="margin-top: -30px">

</div>


		</div>


	</div>


</div>




<?php require_once("rodape.php") ?>






  <!-- Modal Depoimentos -->
  <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Excluir Agendamento
                   </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px" id="btn-fechar-excluir">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <form id="form-excluir">
      <div class="modal-body">

      	<span id="msg-excluir"></span>
                   
            <input type="hidden" name="id" id="id_excluir">


          <br>
          <small><div id="mensagem-excluir" align="center"></div></small>
        </div>

        <div class="modal-footer">      
          <button type="submit" class="btn btn-danger">Excluir</button>
        </div>
      </form>

      </div>
    </div>
  </div>






<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style type="text/css">
	.select2-selection__rendered {
		line-height: 45px !important;
		font-size:16px !important;
		color:#000 !important;

	}

	.select2-selection {
		height: 45px !important;
		font-size:16px !important;
		color:#000 !important;

	}
</style>  



<script type="text/javascript">
	$(document).ready(function() {
		document.getElementById("botao_editar").style.display = "none";		
		$('.sel2').select2({
			
		});

		listarFuncionarios();
	});
</script>


<script type="text/javascript">
	
	function mudarFuncionario(){
		var funcionario = $('#funcionario').val();
		var data = $('#data').val();		
		var hora = $('#hora_rec').val();

		listarHorarios(funcionario, data, hora);
		listarFuncionario();	

	}
</script>



<script type="text/javascript">
	function listarHorarios(funcionario, data, hora){	

		
		$.ajax({
			url: "ajax/listar-horarios.php",
			method: 'POST',
			data: {funcionario, data, hora},
			dataType: "text",

			success:function(result){
				if(result.trim() === '000'){
					alert('Selecione uma data igual ou maior que hoje!');

					var dt = new Date();
					var dia = String(dt.getDate()).padStart(2, '0');
					var mes = String(dt.getMonth() + 1).padStart(2, '0');
					var ano = dt.getFullYear();
					dataAtual = ano + '-' + mes + '-' + dia;
					$('#data').val(dataAtual);
					return;
				}else{
					$("#listar-horarios").html(result);
				}
				
			}
		});
	}
</script>



<script type="text/javascript">
	
	function buscarNome(){
		var tel = $('#telefone').val();	
		listarCartoes(tel);	
		
		$.ajax({
			url: "ajax/listar-nome.php",
			method: 'POST',
			data: {tel},
			dataType: "text",

			success:function(result){
				var split = result.split("*");
				console.log(split[3])

				if(split[2] == "" || split[2] == undefined){

				}else{
					$("#funcionario").val(parseInt(split[2])).change();
				}


				if(split[5] == "" || split[5] == undefined){
					document.getElementById("botao_editar").style.display = "none";					
				}else{
					$("#servico").val(parseInt(split[5])).change();
					document.getElementById("botao_editar").style.display = "block";					
					$("#botao_salvar").text('Novo Agendamento');
				}

				$("#nome").val(split[0]);
				

				$("#msg-excluir").text('Deseja Realmente excluir esse agendamento feito para o dia ' + split[7] + ' às ' + split[4]);


				mudarFuncionario()
				


			}
		});	




	}
</script>



<script type="text/javascript">
	
	function salvar(){
		$('#id').val('');
			}
</script>




<script>

	$("#form-agenda").submit(function () {
		event.preventDefault();

		$('#btn_agendar').hide();
		$('#mensagem').text('Carregando!');

		var formData = new FormData(this);

		$.ajax({
			url: "ajax/agendar.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {
				
				$('#mensagem').text('');
				$('#mensagem').removeClass()
				if (mensagem.trim() == "Agendado com Sucesso") {                    
					$('#mensagem').text(mensagem)
					buscarNome()

					var nome = $('#nome').val();
					var data = $('#data').val();
					var hora = document.querySelector('input[name="hora"]:checked').value;
					var obs = $('#obs').val();
					var nome_func = $('#nome_func').val();
					var nome_serv = $('#nome_serv').val();

					var dataF = data.split("-");
					var dia = dataF[2];
					var mes = dataF[1];
					var ano = dataF[0];
					var dataFormatada = dia + '/' + mes + '/' + ano;

					var horaF = hora.split(':');
					var horaH = horaF[0];
					var horaM = horaF[1];
					var horaFormatada = horaH + ':' + horaM;


					window.location="meus-agendamentos.php";	

					var msg_agendamento = "<?=$msg_agendamento?>";

					if(msg_agendamento == 'Sim'){

				let a= document.createElement('a');
			          a.target= '_blank';
			          a.href= 'http://api.whatsapp.com/send?1=pt_BR&phone=<?=$tel_whatsapp?>&text= _Novo Agendamento_ %0A Funcionário: *' + nome_func + '* %0A Serviço: *' + nome_serv + '* %0A Data: *' + dataFormatada + '* %0A Hora: *' + horaFormatada + '* %0A Cliente: *' + nome + '*  %0A %0A ' + obs;
			          a.click();
			          return;		

			      }


				}

			

				 else {
					//$('#mensagem').addClass('text-danger')
					$('#mensagem').text(mensagem)
				}

				$('#btn_agendar').show();

			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});

</script>





<script type="text/javascript">
	
	function listarCartoes(tel){

			$.ajax({
			url: "ajax/listar-cartoes.php",
			method: 'POST',
			data: {tel},
			dataType: "text",

			success:function(result){
				$("#listar-cartoes").html(result);
			}
		});
		
			}
</script>





<script type="text/javascript">
	function listarFuncionario(){	
		var func = $("#funcionario").val();
		
		$.ajax({
			url: "ajax/listar-funcionario.php",
			method: 'POST',
			data: {func},
			dataType: "text",

			success:function(result){
				$("#nome_func").val(result);
			}
		});
	}
</script>


<script type="text/javascript">
	function mudarServico(){
		listarFuncionarios()	
		var serv = $("#servico").val();
		
		$.ajax({
			url: "ajax/listar-servico.php",
			method: 'POST',
			data: {serv},
			dataType: "text",

			success:function(result){
				$("#nome_serv").val(result);
			}
		});
	}
</script>


<script type="text/javascript">
	function listarFuncionarios(){	
		var serv = $("#servico").val();
		
		$.ajax({
			url: "ajax/listar-funcionarios.php",
			method: 'POST',
			data: {serv},
			dataType: "text",

			success:function(result){
				$("#funcionario").html(result);
			}
		});
	}
</script>