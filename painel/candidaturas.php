<?php 
require_once("verificar.php");
require_once("../conexao.php");
$pag = 'candidaturas'; 
@session_start();
$id_usuario = $_SESSION['id_usuario'];
$nivel_usuario = $_SESSION['nivel_usuario'];
$query = $pdo->query("SELECT * FROM usuarios WHERE id = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$nome_user = $res[0]['nome'];
	$foto_usu = $res[0]['foto'];
	$nivel_usu = $res[0]['nivel'];
	$cpf_usu = $res[0]['cpf'];
	$cpf_user = $res[0]['cpf']; 
	$senha_usu = $res[0]['senha'];
	$email_usu = $res[0]['email'];
	$id_usu = $res[0]['id'];
	$id_func = $res[0]['id_func'];
	$id_candidato = $res[0]['id_candidato'];
}
if($nivel_usu != 'Administrador'){
	$ocultar_campos = 'ocultar';
	$ocultar_espaco ='';
}else{
	$ocultar_campos ='';
	$ocultar_espaco = 'ocultar';
}

$query = $pdo->query("SELECT * FROM funcionarios WHERE id = '$id_func'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$provincia_func = $res[0]['bairro'];
	
}

//verificar se ele tem a permissão de estar nessa página
if(@$candidaturas == 'ocultar'){
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
					<div class="col-md-6">						
									<div class="form-group"> 
										<label>Candidato*</label> 
										<select class="form-control sel2" name="candidato" id="candidato" required style="width:100%;"> 
											<?php 
											if($nivel_usu == 'Recrutador' || $nivel_usu == 'Diretor'){
												$query = $pdo->query("SELECT * FROM usuarios where nivel = 'Candidato' order by id asc");
											}else{
												$query = $pdo->query("SELECT * FROM usuarios where nivel = 'Candidato' or nivel = 'Administrador' order by id asc");
											}

											$res = $query->fetchAll(PDO::FETCH_ASSOC);
											for($i=0; $i < @count($res); $i++){
												foreach ($res[$i] as $key => $value){}

													?>	
												<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?> - <?php echo $res[$i]['cpf'] ?></option>

											<?php } ?>

										</select>
									</div>					
								</div>


								<div class="col-md-6">						
									<div class="form-group"> 
										<label>Recrutador*</label> 
										<select class="form-control sel2" name="recrutador" id="recrutador" required style="width:100%;"> 
											<?php 
											if($nivel_usu == 'Recrutador'){
												$query = $pdo->query("SELECT * FROM usuarios where id = '$id_usuario' order by id asc");
											}else{
												$query = $pdo->query("SELECT * FROM usuarios where nivel = 'Recrutador' or nivel = 'Administrador' order by id asc");
											}

											$res = $query->fetchAll(PDO::FETCH_ASSOC);
											for($i=0; $i < @count($res); $i++){
												foreach ($res[$i] as $key => $value){}

													?>	
												<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?> - <?php echo $res[$i]['cpf'] ?></option>

											<?php } ?>

										</select>
									</div>					
								</div>


								


					</div>


					<div class="row">

					<div class="col-md-2">						
									<div class="form-group"> 
										<label>Data Início</label> 
										<input type="date" class="form-control" name="data_inicio" id="data_inicio" value="<?php echo date('Y-m-d') ?>"> 
									</div>						
								</div>

						<div class="<?php echo @$ocultar_campos?>" class="col-md-2">						
							<div class="form-group"> 
								<label>Data Final</label> 
								<input type="date" class="form-control" name="data_final" id="data_final" value="<?php echo date('Y-m-d') ?>"> 
							</div>						
						</div>

						

						
					<div class="col-md-3">	
							<div class="form-group"> 
								<label>Estado*</label> 
								<select class="form-control" name="estado" id="estado"> 
									<option value="Indeferido">INDEFERIDO</option>
									<option class="<?php echo @$ocultar_campos?>" value="Em Curso">EM CURSO</option>
									<option class="<?php echo @$ocultar_campos?>" value="Concluido">CONCLUIDO</option>
									<option class="<?php echo @$$ocultar_espaco ?>"  value="Entrevista">Entrevista</option>
									
								</select>
							</div>
						</div>

						<div class="col-md-5">	
							<div class="form-group"> 
								<label>Finalidade*</label> 
								<select class="form-control" name="finalidade" id="finalidade"> 
									<option value="Estagio Curricular">ESTAGIO CURRICULAR</option>
									<option value="Recolha de Dados">RECOLHA DE DADOS</option>
									<option value="Recolha de Dados">VAGA REGULAR</option>
								</select>
							</div>
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
										<label>Província*</label> 
										<div id="listar-bairros"></div>
									</div>						
								</div> -->
									

							

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
							
								
								<div class="row">
									
									<div style="margin-top:-13px" class="col-md-6">						
										<div class="form-group"> 
											<label>Direcções*</label> 
											<div id="listar-direcoes"></div>

								
										</div>						
									</div>
									<div class="col-md-6">
										<div class="form-group"> 
											<label>OBS <small>(Max 500 Caracteres)</small></label> 
											<textarea maxlength="500" type="text" class="form-control" name="descricao" id="descricao"> </textarea>
										</div>
									</div>
								</div>	
  
						<!-- <div class="col-md-3">						
							<div class="form-group"> 
								<label>Foto</label> 
								<input type="file" name="foto" onChange="carregarImg();" id="foto">
							</div>						
						</div>
						<div class="col-md-2">
							<div id="divImg">
								<img src="images/perfil/sem-perfil.jpg"  width="100px" id="target">									
							</div>
						</div> -->

						<!-- <div class="row">
							<div class="col-md-8">						
								<div class="form-group"> 
									<label>Arquivo</label> 
									<input type="file" name="arquivo_conta" onChange="carregarImgArquivos();" id="arquivo_conta">
								</div>	
							</div>
							<div class="col-md-4" style="margin-top:-10px">	
								<div id="divImgArquivos">
									<img src="images/arquivos/sem-foto.png"  width="60px" id="target-arquivos">									
								</div>					
							</div>




						</div> -->

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
							<span><b>Idade: </b></span>
							<span id="idade_mostrar"></span>							
						</div>
						
					</div>

					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						
						<div class="col-md-6">							
							<span><b>Telefone: </b></span>
							<span id="telefone_mostrar"></span>
						</div>
						<div class="col-md-6">							
							<span><b>Nível Académico: </b></span>
							<span id="nivel_academico_mostrar"></span>							
						</div>
					</div>


					


					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-6">							
							<span><b>Curso: </b></span>
							<span id="curso_mostrar"></span>
						</div>
						<div class="col-md-6">							
							<span><b>Instituição: </b></span>
							<span id="instituicoes_mostrar"></span>							
						</div>
						
					</div>


					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-6">							
							<span><b>Cidade: </b></span>
							<span id="cidade_mostrar"></span>							
						</div>
						<div class="col-md-6">							
							<span><b>Província: </b></span>
							<span id="bairro_mostrar"></span>
						</div>
						
					</div>		



					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						
						<div class="col-md-6">							
							<span><b>Direcção: </b></span>
							<span id="direcoes_mostrar"></span>
						</div>
						<div class="col-md-6">							
						<span><b>Pelouro: </b></span>
							<span id="pelouro_mostrar"></span>							
						</div>
					</div>

					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-6">							
							<span><b>Finalidade: </b></span>
							<span id="finalidade_mostrar"></span>							
						</div>
						<div class="col-md-6">							
						<span><b>Data Cadastro: </b></span>
							<span id="data_cad_mostrar"></span>	
						</div>
						
					</div>	


					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-6">							
							<span><b>Data Início: </b></span>
							<span id="data_inicio_mostrar"></span>							
						</div>
						<div class="col-md-6">							
							<span><b>Data Final: </b></span>
							<span id="data_final_mostrar"></span>							
						</div>
					</div>

					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						
						
						<div class="col-md-6">							
						<span><b>Estado: </b></span>
							<span id="estado_mostrar"></span>							
						</div>
						<div class="col-md-6">							
						<span><b>Descrição: </b></span>
							<span id="descricao_mostrar"></span>	
						</div>
					</div>

<!-- 
					<div class="row">
						<div class="col-md-12" align="center">		
							<img  width="200px" id="target_mostrar">	
						</div>
					</div> -->
					
								

				</div>


		</div>
	</div>
</div>

	<!-- Modal Arquivos -->
	<div class="modal fade" id="modalArquivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="tituloModal">Gestão de Arquivos - <span id="nome-arquivo"> </span></h4>
					<button id="btn-fechar-arquivos" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="form-arquivos" method="post">
					<div class="modal-body">

						<div class="row">
							<div class="col-md-8">						
								<div class="form-group"> 
									<label>Arquivo</label> 
									<input type="file" name="arquivo_conta" onChange="carregarImgArquivos();" id="arquivo_conta">
								</div>	
							</div>
							<div class="col-md-4" style="margin-top:-10px">	
								<div id="divImgArquivos">
									<img src="images/arquivos/sem-foto.png"  width="60px" id="target-arquivos">									
								</div>					
							</div>




						</div>

						<div class="row" style="margin-top:-40px">
							<div class="col-md-8">
								<input type="text" class="form-control" name="nome-arq"  id="nome-arq" placeholder="Nome do Arquivo * " required>
							</div>

							<div class="col-md-4">										 
								<button type="submit" class="btn btn-primary">Inserir</button>
							</div>
						</div>

						<hr>

						<small><div id="listar-arquivos"></div></small>

						<br>
						<small><div align="center" id="mensagem-arquivo"></div></small>

						<input type="hidden" class="form-control" name="id-arquivo"  id="id-arquivo">


					</div>
				</form>
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

			listarDirecoes();

		$('#pelouro').change(function(){
				listarDirecoes();
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

<script type="text/javascript">
			function carregarImgArquivos() {
				var target = document.getElementById('target-arquivos');
				var file = document.querySelector("#arquivo_conta").files[0];

				var arquivo = file['name'];
				resultado = arquivo.split(".", 2);

				if(resultado[1] === 'pdf'){
					$('#target-arquivos').attr('src', "images/pdf.png");
					return;
				}

				if(resultado[1] === 'rar' || resultado[1] === 'zip'){
					$('#target-arquivos').attr('src', "images/rar.png");
					return;
				}

				if(resultado[1] === 'doc' || resultado[1] === 'docx' || resultado[1] === 'txt'){
					$('#target-arquivos').attr('src', "images/word.png");
					return;
				}


				if(resultado[1] === 'xlsx' || resultado[1] === 'xlsm' || resultado[1] === 'xls'){
					$('#target-arquivos').attr('src', "images/excel.png");
					return;
				}


				if(resultado[1] === 'xml'){
					$('#target-arquivos').attr('src', "images/xml.png");
					return;
				}




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
			$("#form-arquivos").submit(function () {
				event.preventDefault();
				var formData = new FormData(this);

				$.ajax({
					url: pag + "/arquivos.php",
					type: 'POST',
					data: formData,

					success: function (mensagem) {
						$('#mensagem-arquivo').text('');
						$('#mensagem-arquivo').removeClass()
						if (mensagem.trim() == "Inserido com Sucesso") {                    
						//$('#btn-fechar-arquivos').click();
						$('#nome-arq').val('');
						$('#arquivo_conta').val('');
						$('#target-arquivos').attr('src','images/arquivos/sem-foto.png');
						listarArquivos();
					} else {
						$('#mensagem-arquivo').addClass('text-danger')
						$('#mensagem-arquivo').text(mensagem)
					}

				},

				cache: false,
				contentType: false,
				processData: false,

			});

			});
		</script>



		<script type="text/javascript">
			function listarArquivos(){
				var id = $('#id-arquivo').val();	
				$.ajax({
					url: pag + "/listar-arquivos.php",
					method: 'POST',
					data: {id},
					dataType: "text",

					success:function(result){
						$("#listar-arquivos").html(result);
					}
				});
			}

		</script>

	</script>