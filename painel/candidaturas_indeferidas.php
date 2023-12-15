<?php 
require_once("verificar.php");
require_once("../conexao.php");
$pag = 'candidaturas_indeferidas';

//verificar se ele tem a permissão de estar nessa página
if(@$candidaturas_indeferidas == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

 ?>

<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
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