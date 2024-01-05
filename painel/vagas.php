<?php 
require_once("verificar.php");
require_once("../conexao.php");
$pag = 'vagas';
@session_start();
$id_usuario = $_SESSION['id_usuario'];
$nivel_usuario = $_SESSION['nivel_usuario'];
$query = $pdo->query("SELECT * FROM usuarios WHERE id = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$nivel_usu = $res[0]['nivel'];
}

//verificar se ele tem a permissão de estar nessa página
if(@$vagas == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

 ?>
<?php
 if($nivel_usu != 'Candidato' && $nivel_usu != 'Recrutador'){
	echo <<<HTML
	<button onclick="inserir()" type="button" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Cadastrar Vaga</button>
HTML;
	
 }
 
 ?>
 <!--<button type="button" class="btn btn-primary btn-flat btn-pri"><li class="<?php echo @$rel_funcionarios ?>"><a href="#" data-toggle="modal" data-target="#RelFun" style="color:#fff"><i class="fa fa-plus" aria-hidden="true"></i> PDF</a></li></button>-->

<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>




<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="tituloModal"></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-6">						
							<div class="form-group"> 
								<label>Nome</label> 
								<input type="text" class="form-control" name="nome" id="nome" required> 
							</div>						
						</div>

						<div class="col-md-6">						
							<div class="form-group"> 
								<label>Descrição</label> 
								<textarea rows="" cols="" class="form-control" name="descricao" id="descricao" required></textarea>  
							</div>						
						</div>
					</div>


							<div class="row">

							<div class="col-md-6">						
									<div class="form-group"> 
										<label>Área*</label> 
										<select class="form-control sel2" name="pelouro" id="pelouro" required style="width:100%;"> 
											<?php 
											$query = $pdo->query("SELECT * FROM pelouros order by nome asc");
											$res = $query->fetchAll(PDO::FETCH_ASSOC);
											for($i=0; $i < @count($res); $i++){
												foreach ($res[$i] as $key => $value){}

													?>	
												<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

											<?php } ?>

										</select>
									</div>	
							</div>
												
									<div class="col-md-6">						
									<div class="form-group"> 
										<label>Direcção*</label> 
										<div id="listar-direcoes"></div>
									</div>						
								</div>





					</div>				
					

					<br>
					<input type="hidden" name="id" id="id"> 
					<small><div id="mensagem" align="center" class="mt-3"></div></small>					

				</div>


				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>



			</form>

		</div>
	</div>
</div>

<div class="modal fade" id="modalConcorrer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				Concorrer a Vaga de: 
				<h4 class="modal-title" id="nome_concorrer"></h4>
				<button id="btn-fechar-concorrer" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="formConcorrer">
				<div class="modal-body">

						<div class="row">

							<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-6">							
							<span><b>Departamento: </b></span>
							<span id="direcao_concorrer"></span>							
						</div>
						<div class="col-md-6">							
							<span><b>Área: </b></span>
							<span id="pelouro_concorrer"></span>
						</div>
					</div>	
					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-12">							
							<span><b>Descrição: </b></span>
							<span id="descricao_concorrer"></span>							
						</div>
					</div>
												
					</div>				
					

					<br>
					<input type="hidden" name="id_concorrer" id="id_concorrer"> 
					<small><div id="mensagem_concorrer" align="center" class="mt-3"></div></small>					

				</div>


				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Submeter</button>
				</div>



			</form>

		</div>
	</div>
</div>



<!-- ModalMostrar -->
<div class="modal fade" id="modalMostrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="tituloModal"><span id="nome_mostrar"> </span></h4>
				<button id="btn-fechar-excluir" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
				<div class="modal-body">			
					

					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-6">							
							<span><b>Departamento: </b></span>
							<span id="direcao_mostrar"></span>							
						</div>
						<div class="col-md-6">							
							<span><b>Área: </b></span>
							<span id="pelouro_mostrar"></span>
						</div>
					</div>	
					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-12">							
							<span><b>Descrição: </b></span>
							<span id="descricao_mostrar"></span>							
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

		$('#myTab a[href="#home"]').tab('show');

		$('.sel2').select2({
			dropdownParent: $('#modalForm')
		});

		listarDirecoes();

		$('#pelouro').change(function(){
				listarDirecoes();
			});
	});
</script>

<script type="text/javascript">
		$("#formConcorrer").submit(function () {
			event.preventDefault();
			var formData = new FormData(this);

			$.ajax({
				url: pag + "/submeter.php",
				type: 'POST',
				data: formData,

				success: function (mensagem) {
					$('#mensagem_concorrer').text('');
					$('#mensagem_concorrer').removeClass()
					if (mensagem.trim() == "Salvo com Sucesso") {                    
						$('#btn-fechar-concorrer').click();						
						listar();
					} else {
						$('#mensagem_concorrer').addClass('text-danger')
						$('#mensagem_concorrer').text(mensagem)
					}

				},

				cache: false,
				contentType: false,
				processData: false,

			});

		});
	</script>

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
	function listarDirecoes(){
		var pelouro = $('#pelouro').val();
    $.ajax({
        url: pag + "/listar-direcoes.php",
        method: 'POST',
        data: {pelouro},
        dataType: "text",

        success:function(result){
            $("#listar-direcoes").html(result);
        },

    });
}
</script>