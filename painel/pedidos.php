<?php 
require_once("verificar.php");
require_once("../conexao.php");
$pag = 'pedidos';

//verificar se ele tem a permissão de estar nessa página
if(@$pedidos == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

 ?>

 <button onclick="inserir()" type="button" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Adicionar Pedidos</button>

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
								<label>Email</label> 
								<input type="email" class="form-control" name="email" id="email" required> 
							</div>						
						</div>

					
</div>
<div class="row">
						<div class="col-md-4">						
							<div class="form-group"> 
								<label>Status</label> 
								<input type="text" class="form-control" name="status" id="status" required> 
							</div>						
						</div>

						<!-- <div class="col-md-4">						
							<div class="form-group"> 
								
								<input type="hidden" class="form-control" name="data_adm" id="data_adm" value="<?php echo date('Y-m-d') ?>"> 
							</div>						
						</div> -->

						

						

						<div class="col-md-4">						
									<div class="form-group"> 
										<label>Parque*</label> 
										<select class="form-control sel2" name="corretor" id="corretor" required style="width:100%;"> 
											<?php 
											if($nivel_usu == 'Corretor'){
												$query = $pdo->query("SELECT * FROM usuarios where id = '$id_usuario' order by id asc");
											}else{
												$query = $pdo->query("SELECT * FROM usuarios where nivel = 'Corretor' or nivel = 'Administrador' order by id asc");
											}

											$res = $query->fetchAll(PDO::FETCH_ASSOC);
											for($i=0; $i < @count($res); $i++){
												foreach ($res[$i] as $key => $value){}

													?>	
												<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

											<?php } ?>

										</select>
									</div>					
								</div>


						 


					</div>




					<div class="row">
					<div class="col-md-4">						
									<div class="form-group"> 
										<label>Tipo*</label> 
										<select class="form-control sel2" name="tipo" id="tipo" required style="width:100%;"> 
											<?php 
											$query = $pdo->query("SELECT * FROM tipos order by id desc");
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
										<label>Viatura*</label> 
										<select class="form-control sel2" name="imoveis" id="imoveis" required style="width:100%;"> 
											<?php 			//where status = 'Para Venda' OR status = 'Para Aluguél'
											$query = $pdo->query("SELECT * FROM imoveis  order by id desc");
											$res = $query->fetchAll(PDO::FETCH_ASSOC);
											for($i=0; $i < @count($res); $i++){
												foreach ($res[$i] as $key => $value){}

													?>	
												<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['titulo'] ?></option>

											<?php } ?>

										</select>
									</div>						
								</div>

								
								
								<div class="col-md-4">						
							<div class="form-group"> 
								<label>Url</label> 
								<input type="text" class="form-control" name="url" id="url" required> 
							</div>						
						

						

					</div>	


					<div class="row">
						<div class="col-md-7">
							<div class="form-group"> 
								<label>Comentario <small>(Max 500 Caracteres)</small></label> 
								<textarea maxlength="500" type="text" class="form-control" name="comentario" id="comentario"> </textarea>
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
							<span><b>Cargo: </b></span>
							<span id="cargo_mostrar"></span>
						</div>
					</div>


					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-12">							
							<span><b>Endereço: </b></span>
							<span id="endereco_mostrar"></span>							
						</div>
					</div>


					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-6">							
							<span><b>Data de Admissão: </b></span>
							<span id="data_adm_mostrar"></span>							
						</div>
						<div class="col-md-6">							
							<span><b>Codigo: </b></span>
							<span id="creci_mostrar"></span>
						</div>
					</div>		



					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-6">							
							<span><b>Banco: </b></span>
							<span id="banco_mostrar"></span>							
						</div>
						<div class="col-md-6">							
							<span><b>Tipo: </b></span>
							<span id="tipo_mostrar"></span>
						</div>
					</div>	

					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-6">							
							<span><b>Agencia: </b></span>
							<span id="agencia_mostrar"></span>							
						</div>
						<div class="col-md-6">							
							<span><b>Conta: </b></span>
							<span id="conta_mostrar"></span>
						</div>
					</div>

					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-6">							
							<span><b>Chave conta: </b></span>
							<span id="pix_mostrar"></span>							
						</div>
					
					</div>		



					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-12">							
							<span><b>OBS: </b></span>
							<span id="obs_mostrar"></span>							
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
