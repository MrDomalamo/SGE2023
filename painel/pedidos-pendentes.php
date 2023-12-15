<?php 
require_once("verificar.php");
require_once("../conexao.php");
$pag = 'imoveis-alugados';

//verificar se ele tem a permissão de estar nessa página
if(@$imoveis_alugados == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

?>

<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>
 



<!-- ModalMostrar -->
<div class="modal fade" id="modalMostrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="tituloModal"><span id="titulo_mostrar"> </span></h4>
				<button id="btn-fechar-excluir" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<div class="modal-body">


			<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-3">							
						<span><b>Id da viatura: </b></span>
						<span id="id_mostrar"></span>							
					</div>
					<div class="col-md-4">							
						<span><b>Dono: </b></span>
						<span id="dono_mostrar"></span>
					</div>

					<div class="col-md-5">							
						<span><b>Telefone Dono: </b></span>
						<span id="tel_mostrar"></span>							
					</div>
					
				</div>	


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Email do Dono: </b></span>
						<span id="email_mostrar"></span>
					</div>
					<div class="col-md-6">							
						<span><b>Documento Dono: </b></span>
						<span id="doc_mostrar"></span>					
					</div>

					
					
				</div>			




				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					
					<div class="col-md-4">							
						<span><b>Parque: </b></span>
						<span id="corretor_mostrar"></span>
					</div>

					<div class="col-md-4">							
						<span><b>Tipo: </b></span>
						<span id="tipo_mostrar"></span>							
					</div>
					<div class="col-md-4">							
						<span><b>Valor: </b></span>
						<span id="valor_mostrar"></span>
					</div>
				</div>


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-3">							
						<span><b>Cidade: </b></span>
						<span id="cidade_mostrar"></span>							
					</div>
					<div class="col-md-3">							
						<span><b>Provincia: </b></span>
						<span id="bairro_mostrar"></span>
					</div>

					<div class="col-md-6">							
						<span><b>Endereço: </b></span>
						<span id="endereco_mostrar"></span>							
					</div>
				
				</div>


				
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-3">							
						<span><b>Ano de Fabrico: </b></span>
						<span id="ano_mostrar"></span>							
					</div>
					<div class="col-md-3">							
						<span><b>Total Visitas: </b></span>
						<span id="visitas_mostrar"></span>
					</div>

				

					<div class="col-md-2">							
						<span><b>Modelo: </b></span>
						<span id="banheiros_mostrar"></span>
					</div>

					
				</div>



					<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-2">							
						<span><b>Cor: </b></span>
						<span id="quartos_mostrar"></span>							
					</div>
					

					<div class="col-md-2">							
						<span><b>SunRoof: </b></span>
						<span id="garagens_mostrar"></span>							
					</div>
					<div class="col-md-2">							
						<span><b>Motor: </b></span>
						<span id="piscinas_mostrar"></span>
					</div>

					<div class="col-md-3">							
						<span><b>Abastecimento: </b></span>
						<span id="suites_mostrar"></span>
					</div>

					<div class="col-md-3">							
						<span><b>Status: </b></span>
						<span id="status_mostrar"></span>							
					</div>

				</div>




				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					
					<div class="col-md-3">							
						<span><b>Condição: </b></span>
						<span id="condicao_mostrar"></span>
					</div>

					
					<div class="col-md-5">							
						<span><b>Marca: </b></span>
						<div id="titulo_mostrar"></div>							
				
					</div>


					<div class="col-md-3">							
						<span><b>Transmissao: </b></span>
						<span id="condominio_mostrar"></span>
					</div>

				</div>



				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-4">							
						<span><b>Percentagem BCIM %: </b></span>
						<span id="comissao_imob_mostrar"></span>							
					</div>
					<div class="col-md-4">							
						<span><b>Percentagem Parque %: </b></span>
						<span id="comissao_corretor_mostrar"></span>
					</div>

					<div class="col-md-4">							
						<span><b>Castradado Em: </b></span>
						<span id="data_cad_mostrar"></span>							
					</div>
					
				</div>


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
				<div class="col-md-4">							
						<span><b>Validade do Anúncio: </b></span>
						<span id="validade_mostrar"></span>
					</div>

					<div class="col-md-4">							
						<span><b>Data Inicial Anúncio: </b></span>
						<span id="data_inicio_mostrar"></span>
					</div>
					
					<div class="col-md-4">							
						<span><b>Data Final Anúncio: </b></span>
						<span id="data_final_mostrar"></span>
					</div>
				</div>
 



				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-12">							
						<span><b>Descrição: </b></span>
						<div id="descricao_mostrar"></div>							
					</div>
				</div>



				


				<div class="row">
					<div class="col-md-6" align="center">		
						<img  width="300px" id="target_principal_mostrar">	
					</div>

					<div class="col-md-6" align="center">		
						<img  width="300px" id="target_planta_mostrar">	
					</div>
				</div>


				<div class="row">
					<div class="col-md-12" align="center">		
							 <iframe width="100%" height="500" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen id="target_video_mostrar"></iframe>	
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

</div>





	<!-- Modal Vistoria -->
	<div class="modal fade" id="modalVistoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="tituloModal">Preencher Vistoria - <span id="nome-vistoria"> </span></h4>
					<button id="btn-fechar-vistoria" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="form-vistoria" method="post" action="rel/vistoria_class.php" target="_blank">
					<div class="modal-body">

					
						<div class="form-group"> 
							<label>Laudo de Vistoria </label> 
							<textarea maxlength="1000" name="area" id="area" class="textareagh"> </textarea>
						</div>
					

						<br>
						<small><div align="center" id="mensagem-vistoria"></div></small>

						<input type="hidden" class="form-control" name="id-vistoria"  id="id-vistoria">


					</div>

					<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Gerar Laudo</button>
				</div>
				</form>
			</div>
		</div>

</div>







	<!-- Modal Contrato Aluguel -->
	<div class="modal fade" id="modalContratoAluguel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="tituloModal">Preencher Contrato - <span id="nome-aluguel"> </span></h4>
					<button id="btn-fechar-aluguel" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="form-aluguel" method="post" action="rel/contrato_locacao_class.php" target="_blank">
					<div class="modal-body">

					
						<div class="form-group"> 
							<label>Texto do Contrato </label> 
							<textarea name="area" id="area2" class="textareagh"> </textarea>
						</div>
					

						<br>
						<small><div align="center" id="mensagem-aluguel"></div></small>

						<input type="hidden" class="form-control" name="id-vistoria"  id="id-aluguel">


					</div>

					<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Gerar Contrato</button>
				</div>
				</form>
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






<script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>