<script>
	function modalShow() {		
		$('#modalShow').modal('show');
	}

	$(document).ready(function() {
		$('#calendar').fullCalendar({


		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay,listYear'
		},

		defaultDate:'<?php echo date('Y-m-d'); ?>',
		editable: true,
		navLinks: true,
		eventLimit: true,
		selectable: true,
		selectHelper: true,
		select: function(start, end) {
			return;
			$('#ModalAdd #inicio').val(moment(start).format('DD-MM-YYYY HH:mm:ss'));
			$('#ModalAdd #termino').val(moment(end).format('DD-MM-YYYY HH:mm:ss'));
			$('#ModalAdd').modal('show');
		},
		eventRender: function(event, element) {
			return;
			//alert(event.id)
			element.bind('click', function() {
				$('#ModalEdit #id_evento').val(event.id);
				$('#ModalEdit #titulo').val(event.title);
				$('#ModalEdit #descricao').val(event.description);
				$('#ModalEdit #cor').val(event.color);
				$('#ModalEdit #convidado').val(event.cliente);
				$('#ModalEdit #remetente').val(event.servico);
				$('#ModalEdit #status').val(event.status);
				$('#ModalEdit #inicio').val(event.start.format('DD-MM-YYYY HH:mm:ss'));
				//$('#ModalEdit #termino').val(event.end.format('DD-MM-YYYY HH:mm:ss'));
				$('#ModalEdit').modal('show');
			});
		},
		eventDrop: function(event, delta, revertFunc) { 

			edit(event);
		},
					
		eventResize: function(event,dayDelta,minuteDelta,revertFunc) { 

			edit(event);
		},

		events: [
					<?php for($i=0; $i < $total_reg; $i++){
						$data_inicio = $res[$i]['data']." ".$res[$i]['hora'];
						$data_final = $res[$i]['data']." ".$res[$i]['hora'];

						$hora_inicio = $res[$i]['hora'];
						$hora_final = $res[$i]['hora'];
						
						if($hora_inicio == '00:00:00' || $hora_inicio == ''){
							$start = $res[$i]['data'];
						}else{
							$start = $data_inicio;
						}
						if($hora_final == '00:00:00' || $hora_inicio == ''){
							$end = $res[$i]['data'];
						}else{
							$end = $data_final;
						}

						
						$cliente = $res[$i]['cliente'];
						$query2 = $pdo->query("SELECT * FROM clientes where id = '$cliente'");
						$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
						if(@count($res2) > 0){
							$nome_cliente = $res2[0]['nome'];							
						}else{
							$nome_cliente = 'Sem Cliente';
							
						}


						$funcionario = $res[$i]['funcionario'];
						$query2 = $pdo->query("SELECT * FROM usuarios where id = '$funcionario'");
						$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
						if(@count($res2) > 0){
							$profissional = $res2[0]['nome'];							
						}else{
							$profissional = 'Sem Registro';
							
						}

						$servico = $res[$i]['servico'];
						$query2 = $pdo->query("SELECT * FROM servicos where id = '$servico'");
						$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
						if(@count($res2) > 0){
							$nome_servico = $res2[0]['nome'];							
						}else{
							$nome_servico = 'Sem Serviço';
							
						}

						if($res[$i]['status'] == "Agendado"){
							$cor_agd = "#80050b";
						}else{
							$cor_agd = "#013b11";
						}


					?>
					{
						id: '<?php echo $res[$i]['id'] ?>',
						title: '<?php echo $profissional ?> / Serviço <?php echo $nome_servico ?> / Cliente <?php echo $nome_cliente ?>',
						description: '<?php echo $nome_servico ?>',
						start: '<?php echo $start; ?>',
						end: '<?php echo $end; ?>',
						color: '<?php echo $cor_agd ?>',
						cliente: '<?php echo $res[$i]['cliente'] ?>',
						servico: '<?php echo $res[$i]['servico'] ?>',
						status:'<?php echo $res[$i]['status'] ?>',
					},
					<?php } ?>
				]
			});
				
				function edit(event){
					alert('recurso indisponível')
					return;
					start = event.start.format('DD-MM-YYYY HH:mm:ss');
					if(event.end){
						end = event.end.format('DD-MM-YYYY HH:mm:ss');
					}else{
						end = start;
					}
					
					id_evento =  event.id;
					
					Event = [];
					Event[0] = id_evento;
					Event[1] = start;
					Event[2] = end;
					
					$.ajax({
					url: 'evento/action/eventoEditData.php',
					type: "POST",
					data: {Event:Event},
					success: function(rep) {
							if(rep == 'OK'){
								alert('Modificação Salva!');
							}else{
								alert('Falha ao salvar, tente novamente!'); 
							}
						}
				});
			}
		});

</script>


