<?php 
@session_start();
require_once("verificar.php");
require_once("../conexao.php");

$pag = 'funcionarios';
?>


<form id="form-horarios">
				<div class="row">
					<div class="col-md-2">						
						<div class="form-group">
							<label for="exampleInputEmail1">Horário</label>
							<input type="time" class="form-control" id="horario" name="horario" required>    
						</div> 	
					</div>

                    <div class="col-md-2">                      
                        <div class="form-group">
                            <label for="exampleInputEmail1">Data <small>(Encaixado)</small></label>
                            <input type="date" class="form-control" id="data" name="data">    
                        </div>  
                    </div>

					<div class="col-md-4">						
						<button type="submit" class="btn btn-primary" style="margin-top:20px">Salvar</button>
					</div>

					<input type="hidden" name="id" id="id_horarios" value="<?php echo $id_usuario ?>">

				</div>
				</form>

<small><div id="mensagem-horarios"></div></small>

<big>
<div class="bs-example widget-shadow" style="padding:15px" id="listar-horarios">
	
</div>
</big>



<script type="text/javascript">var pag = "<?=$pag?>"</script>


<script type="text/javascript">
	$(document).ready(function() {
		var func = $("#id_horarios").val();
		listarHorarios(func)
	});
</script>



<script type="text/javascript">
	

$("#form-horarios").submit(function () {

	var func = $("#id_horarios").val();
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'paginas/' + pag + "/inserir-horario.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem-horarios').text('');
            $('#mensagem-horarios').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {

                //$('#btn-fechar-horarios').click();
                listarHorarios(func);          

            } else {

                $('#mensagem-horarios').addClass('text-danger')
                $('#mensagem-horarios').text(mensagem)
            }


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});


</script>


<script type="text/javascript">
	function listarHorarios(func){
		
    $.ajax({
        url: 'paginas/' + pag + "/listar-horarios.php",
        method: 'POST',
        data: {func},
        dataType: "html",

        success:function(result){
            $("#listar-horarios").html(result);
            $('#mensagem-horario-excluir').text('');
        }
    });
}

</script>