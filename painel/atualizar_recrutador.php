<?php 
require_once("verificar.php");
require_once("../conexao.php");
$pag = 'atualizar_recrutador';

//verificar se ele tem a permissão de estar nessa página
if(@$atualizar_recrutador == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

 ?>


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
						<div class="col-md-4">						
							<div class="form-group"> 
								<label>Nome</label> 
								<input type="text" class="form-control" name="nome" id="nome" required> 
							</div>						
						</div>

						<div class="col-md-4">						
							<div class="form-group"> 
								<label>Telefone</label> 
								<input type="text" class="form-control" name="telefone" id="telefone" required> 
							</div>						
						</div>


						<div class="col-md-4">						
							<div class="form-group"> 
								<label>BI</label> 
								<input type="text" class="form-control" name="creci" id="creci" required> 
							</div>						
						</div>


						


					</div>


					<div class="row">
						<div class="col-md-4">						
							<div class="form-group"> 
								<label>Email</label> 
								<input type="email" class="form-control" name="email" id="email" required> 
							</div>						
						</div>

						

						<!-- <div class="col-md-4">						
							<div class="form-group"> 
								<label>Data Admissão</label> 
								<input type="date" class="form-control" name="data_adm" id="data_adm" value="<?php echo date('Y-m-d') ?>"> 
							</div>						
						</div> -->
						<div class="col-md-4">	
							<div class="form-group"> 
								<label>Gênero</label> 
								<select class="form-control" name="genero" id="genero"> 
									<option value="Masculino">Masculino</option>
									<option value="Feminino">Feminino</option>
									<option value="Outro">Outro</option>
								</select>
							</div>
							</div>
							<div class="col-md-4">
						<div class="form-group"> 
							<label>Código</label> 
							<input type="text" class="form-control" name="cpf" id="cpf" maxlength="6" placeholder="MediaMais2023"> 
						</div>
					</div>

						<!-- <div class="col-md-4">						
							<div class="form-group"> 
								<label>Cargo</label> 
								<select class="form-control sel2" name="cargo" id="cargo" required style="width:100%;"> 
									<?php 
									$query = $pdo->query("SELECT * FROM cargos where nome ='Recrutador' order by nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}

											?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

									<?php } ?>

								</select>
							</div>						
						</div> -->


						


					</div>





					<div class="col-md-8">
						<div class="form-group"> 
							<label>Endereço</label> 
							<input type="text" class="form-control" name="endereco" id="endereco" placeholder="Rua X Número 20 Bairro X"> 
						</div>
					</div>	

						 



					
						


							<div class="row">

								<!-- <div class="col-md-3">						
									<div class="form-group"> 
										<label>Cidade*</label> 
										<select class="form-control sel2" name="cidade" id="cidade" required style="width:100%;"> 
											<?php 
											$query = $pdo->query("SELECT * FROM cidades order by nome asc");
											$res = $query->fetchAll(PDO::FETCH_ASSOC);
											for($i=0; $i < @count($res); $i++){
												foreach ($res[$i] as $key => $value){}

													?>	
												<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

											<?php } ?>

										</select>
									</div>						
								</div>




								<div class="col-md-3">						
									<div class="form-group"> 
										<label>Provincia*</label> 
										<div id="listar-bairros"></div>
									</div>						
								</div> -->



						

						<div class="col-md-5">						
							<div class="form-group"> 
								<label>Selecione uma Foto para o seu perfil</label> 
								<input type="file" name="foto" onChange="carregarImg();" id="foto">
							</div>						
						</div>
						<div class="col-md-5">
							<div id="divImg">
								<img src="images/perfil/sem-perfil.jpg"  width="100px" id="target">									
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
							<span><b>Gênero: </b></span>
							<span id="genero_mostrar"></span>							
						</div>
						<div class="col-md-6">							
							<span><b>Código do funcionario: </b></span>
							<span id="cpf_mostrar"></span>							
						</div>
						
					</div>


					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-6">							
							<span><b>Telefone: </b></span>
							<span id="telefone_mostrar"></span>
						</div>
						<div class="col-md-6">							
							<span><b>Email: </b></span>
							<span id="email_mostrar"></span>							
						</div>
						
					</div>


					<div class="row" style="border-bottom: 1px solid #cac7c7;">					
						<div class="col-md-6">							
							<span><b>Cargo: </b></span>
							<span id="cargo_mostrar"></span>
						</div>
						
					</div>

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
						<div class="col-md-6">							
							<span><b>Endereço: </b></span>
							<span id="endereco_mostrar"></span>							
						</div>
						<div class="col-md-6">							
							<span><b>Data de Admissão: </b></span>
							<span id="data_adm_mostrar"></span>							
						</div>
						
					</div>


					<div class="row">
						<div class="col-md-12" align="center">		
							<img  width="200px" id="target_mostrar">	
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


		listarBairros();

		$('#cidade').change(function(){
				listarBairros();
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
	function listarBairros(){
		var cidade = $('#cidade').val();
    $.ajax({
        url: pag + "/listar-bairros.php",
        method: 'POST',
        data: {cidade},
        dataType: "text",

        success:function(result){
            $("#listar-bairros").html(result);
        },

    });
}
</script>