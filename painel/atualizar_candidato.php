<?php 
require_once("verificar.php");
require_once("../conexao.php");
$pag = 'atualizar_candidato';

//verificar se ele tem a permissão de estar nessa página
if(@$atualizar_candidato == 'ocultar'){
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
								<input type="text" class="form-control" name="cpf" id="cpf" maxlength="14" required> 
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

						

						

						<div class="col-md-4">						
							<div class="form-group"> 
								<label>Data de Nanscimento</label> 
								<input type="date" class="form-control" name="data_nasc" id="data_nasc" value="<?php echo date('Y-m-d') ?>"> 
							</div>						
						</div>

						<div class="col-md-4">
						<div class="form-group"> 
							<label>Endereço</label> 
							<input type="text" class="form-control" name="endereco" id="endereco" placeholder="Rua X Número 20 Bairro X"> 
						</div>
					</div>

					
<!-- 
						<div class="col-md-4">						
							<div class="form-group"> 
								<label>Perfil</label> 
								<select class="form-control sel2" name="cargo" id="cargo" required style="width:100%;"> 
									<?php 
									$query = $pdo->query("SELECT * FROM cargos where nome = 'Candidato' order by nome asc");
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





						

					<div class="col-md-4">	
							<div class="form-group"> 
								<label>Estado Civil</label> 
								<select class="form-control" name="estado_civil" id="estado_civil"> 
									<option value="Casado">CASADO (A)</option>
									<option value="Divorciado">DIVORCIADO (A)</option>
									<option value="Viuvo">VIUVO (A)</option>
									<option value="Solteiro">SOLTEIRO (A)</option>
								</select>
							</div>
						</div>

						<div class="col-md-4">						
							<div class="form-group"> 
								<label>Idade</label> 
								<input type="text" class="form-control" name="idade" id="idade" required> 
							</div>						
						</div>

					
						<div class="col-md-4">	
							<div class="form-group"> 
								<label>Gênero</label> 
								<select class="form-control" name="genero" id="genero"> 
									<option value="Masculino">MASCULINO</option>
									<option value="Feminino">FEMININO</option>
								</select>
							</div>
							</div>


							<div class="row">

								<div class="col-md-4">						
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




								<div class="col-md-4">						
									<div class="form-group"> 
										<label>Província*</label> 
										<div id="listar-bairros"></div>
									</div>						
								</div>
									

								<div class="col-md-4">						
									<div class="form-group"> 
										<label>Nível Académico*</label> 
										<select class="form-control sel2" name="nivel_academico" id="nivel_academico" required style="width:100%;"> 
											<?php 
											$query = $pdo->query("SELECT * FROM nivel_academico order by id desc");
											$res = $query->fetchAll(PDO::FETCH_ASSOC);
											for($i=0; $i < @count($res); $i++){
												foreach ($res[$i] as $key => $value){}

													?>	
												<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

											<?php } ?>

										</select>
									</div>						
								</div>

								<div class="col-md-4">						
									<div class="form-group"> 
										<label>Curso*</label> 
										<select class="form-control sel2" name="curso" id="curso" required style="width:100%;"> 
											<?php 
											$query = $pdo->query("SELECT * FROM cursos order by nome asc");
											$res = $query->fetchAll(PDO::FETCH_ASSOC);
											for($i=0; $i < @count($res); $i++){
												foreach ($res[$i] as $key => $value){}

													?>	
												<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

											<?php } ?>

										</select>
									</div>	
							</div>
							
							
													


								<div class="col-md-4">						
									<div class="form-group"> 
										<label>Instituição*</label> 
										<div id="listar-instituicoes"></div>
									</div>						
								</div>

								<div class="col-md-4">
							<div class="form-group"> 
								<label>Nacionalidade</label> 
								<input type="text" class="form-control" name="nacionalidade" id="nacionalidade" placeholder="Mocambicana"> 
							</div>
						</div>	

						

						<div class="col-md-5">						
							<div class="form-group"> 
								<label>Foto</label> 
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
							<span><b>BI: </b></span>
							<span id="cpf_mostrar"></span>							
						</div>
						<div class="col-md-6">							
							<span><b>Telefone: </b></span>
							<span id="telefone_mostrar"></span>
						</div>
					</div>


					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-6">							
							<span><b>Email: </b></span>
							<span id="email_mostrar"></span>							
						</div>
						<div class="col-md-6">							
							<span><b>Endereço: </b></span>
							<span id="endereco_mostrar"></span>							
						</div>
						
					</div>


					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-6">							
							<span><b>Data de Nascimento: </b></span>
							<span id="data_adm_mostrar"></span>							
						</div>
						
						<div class="col-md-6">							
							<span><b>Nacionalidade: </b></span>
							<span id="nacionalidade_mostrar"></span>
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
							<span><b>Idade: </b></span>
							<span id="idade_mostrar"></span>
						</div>
						<div class="col-md-6">							
						<span><b>Gênero: </b></span>
							<span id="genero_mostrar"></span>							
						</div>
						
					</div>

					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-6">							
							<span><b>Curso: </b></span>
							<span id="instituicoes_mostrar"></span>							
						</div>
						<div class="col-md-6">							
							<span><b>Instituição: </b></span>
							<span id="curso_mostrar"></span>							
						</div>
					</div>
					

					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-6">							
						<span><b>Nível Académico: </b></span>
							<span id="nivel_academico_mostrar"></span>							
						</div>
						<div class="col-md-6">							
						<span><b>Estado Civil: </b></span>
							<span id="estado_civil_mostrar"></span>	
						</div>
					</div>
					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-12">							
						<span><b>Data Cadastro: </b></span>
							<span id="data_cad_mostrar"></span>	
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



	<!-- Modal Arquivos -->
	<div class="modal fade" id="modalArquivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="tituloModal">Gestão de Arquivos - <span id="nome-arquivo"> </span></h4>
					<small><div>Atenção! Neste Formulario, o usuario devera inserir os arquivos, como: CERTIFICADO, CARTA DE PEDIDO DA INSTITUIÇÃO, CARTA DE PEDIDO DO CANDIDATO, DECLARACAO DE NOTAS. Para tal, basta selecionar o arquivo, nomear e salvar.</div></small>
					<button id="btn-fechar-arquivos" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="form-arquivos" method="post">
					<div class="modal-body">

						<div class="row">
							<div class="col-md-8">						
								<div class="form-group"> 
									<label>Selecionar o Arquivo</label> 
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

			listarInstituicoes();

		$('#curso').change(function(){
				listarInstituicoes();
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
	function listarInstituicoes(){
		var curso = $('#curso').val();
    $.ajax({
        url: pag + "/listar-instituicoes.php",
        method: 'POST',
        data: {curso},
        dataType: "text",

        success:function(result){
            $("#listar-instituicoes").html(result);
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